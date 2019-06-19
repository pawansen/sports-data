<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/third_party/razorpay-php/Razorpay.php';

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Payment extends Common_Controller {

    public $PAYTM_ENVIRONMENT = "";
    public $PAYTM_MERCHANT_KEY = "";
    public $PAYTM_MERCHANT_MID = "";
    public $PAYTM_MERCHANT_WEBSITE = "";
    public $PAYTM_DOMAIN = "";
    public $PAYTM_REFUND_URL = "";
    public $PAYTM_STATUS_QUERY_URL = "";
    public $PAYTM_STATUS_QUERY_NEW_URL = "";
    public $PAYTM_TXN_URL = "";
    public $data = array();
    public $file_data = "";

    function __construct() {
        parent::__construct();
        $this->lang->load('en', 'english');
        $this->PAYTM_ENVIRONMENT = (getConfig('paytm_environment') != "") ? getConfig('paytm_environment') : "TEST";
        $this->PAYTM_MERCHANT_KEY = getConfig('paytm_merchant_key');
        $this->PAYTM_MERCHANT_MID = getConfig('paytm_merchant_mid');
        $this->PAYTM_MERCHANT_WEBSITE = getConfig('paytm_merchant_website');
        $this->PAYTM_DOMAIN = ($this->PAYTM_ENVIRONMENT == "PROD") ? "secure.paytm.in" : "pguat.paytm.com";
        $this->PAYTM_REFUND_URL = 'https://' . $this->PAYTM_DOMAIN . '/oltp/HANDLER_INTERNAL/REFUND';
        $this->PAYTM_STATUS_QUERY_URL = 'https://' . $this->PAYTM_DOMAIN . '/oltp/HANDLER_INTERNAL/TXNSTATUS';
        $this->PAYTM_STATUS_QUERY_NEW_URL = 'https://' . $this->PAYTM_DOMAIN . '/oltp/HANDLER_INTERNAL/getTxnStatus';
        $this->PAYTM_TXN_URL = 'https://' . $this->PAYTM_DOMAIN . '/oltp-web/processTransaction';
    }

    function index() {
        $this->data['parent'] = "Payment";
        $this->data['title'] = "Payment";
        $option = array('table' => 'payment',
            'select' => 'payment.orderId,payment.amount,payment.txnid,payment.payment_type,payment.invoice_date,'
            . 'user.first_name,user.last_name,user.email,payment.id,payment.user_id,payment.sales_user_id,payment.status',
            'join' => array('users as user' => 'user.id=payment.user_id'),
            'order' => array('payment.id' => 'DESC')
        );

        $this->data['list'] = $this->common_model->customGet($option);
        $this->load->admin_render('list', $this->data, 'inner_script');
    }
    
    function paymentVerify($order_id, $user_id, $payment,$sales_user_id) {
        if (!empty($order_id) && !empty($user_id) && !empty($payment) && !empty($sales_user_id)) {
            walletDepositAmount($user_id, $payment);
             $optionsCash = array(
                'table' => 'payment',
                'data' => array(
                    'payment_type' => "CASH",
                    'status' => "SUCCESS",
                ),
                 'where' => array('id' => $order_id)
            );
            $this->common_model->customUpdate($optionsCash);
            /** send push notification * */
            $option = array(
                'table' => 'users_device_history',
                'select' => 'device_token',
                'where' => array(
                    'user_id' => $user_id,
                ),
                'single' => true
            );
            $deviceHistory = $this->common_model->customGet($option);
            if (!empty($deviceHistory)) {
                 $data_array = array(
                    'title' => "Payment verified",
                    'body' => "Successfully payment has been verified",
                    'type' => "Push",
                    'badges' => 1,
                );
                send_android_notification($data_array, $deviceHistory->device_token, 1);
                
                $options = array(
                    'table' => 'notifications',
                    'data' => array(
                        'user_id' => $user_id,
                        'type_id' => 0,
                        'sender_id' => 1,
                        'noti_type' => 'Payment verified',
                        'message' => "Successfully payment has been verified",
                        'read_status' => 'NO',
                        'sent_time' => date('Y-m-d H:i:s'),
                        'user_type' => 'USER'
                    )
                );
                $this->common_model->customInsert($options);
            }
            $this->session->set_flashdata('success', "Successfully verified");
            redirect('payment');
        } else {
            $this->session->set_flashdata('error', "Records not found");
            redirect('payment');
        }
    }

    function encrypt_e($input, $ky) {
        $key = $ky;
        $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
        $input = $this->pkcs5_pad_e($input, $size);
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
        $iv = "@@@@&&&&####$$$$";
        mcrypt_generic_init($td, $key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $data = base64_encode($data);
        return $data;
    }

    function decrypt_e($crypt, $ky) {

        $crypt = base64_decode($crypt);
        $key = $ky;
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
        $iv = "@@@@&&&&####$$$$";
        mcrypt_generic_init($td, $key, $iv);
        $decrypted_data = mdecrypt_generic($td, $crypt);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $decrypted_data = $this->pkcs5_unpad_e($decrypted_data);
        $decrypted_data = rtrim($decrypted_data);
        return $decrypted_data;
    }

    function pkcs5_pad_e($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    function pkcs5_unpad_e($text) {
        $pad = ord($text{strlen($text) - 1});
        if ($pad > strlen($text))
            return false;
        return substr($text, 0, -1 * $pad);
    }

    function generateSalt_e($length) {
        $random = "";
        srand((double) microtime() * 1000000);

        $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
        $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
        $data .= "0FGH45OP89";

        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }

        return $random;
    }

    function checkString_e($value) {
        if ($value == 'null')
            $value = '';
        return $value;
    }

    function getChecksumFromArray($arrayList, $key, $sort = 1) {
        if ($sort != 0) {
            ksort($arrayList);
        }
        $str = $this->getArray2Str($arrayList);
        $salt = $this->generateSalt_e(4);
        $finalString = $str . "|" . $salt;
        $hash = hash("sha256", $finalString);
        $hashString = $hash . $salt;
        $checksum = $this->encrypt_e($hashString, $key);
        return $checksum;
    }

    function getChecksumFromString($str, $key) {

        $salt = $this->generateSalt_e(4);
        $finalString = $str . "|" . $salt;
        $hash = hash("sha256", $finalString);
        $hashString = $hash . $salt;
        $checksum = $this->encrypt_e($hashString, $key);
        return $checksum;
    }

    function verifychecksum_e($arrayList, $key, $checksumvalue) {
        $arrayList = $this->removeCheckSumParam($arrayList);
        ksort($arrayList);
        $str = $this->getArray2StrForVerify($arrayList);
        $paytm_hash = $this->decrypt_e($checksumvalue, $key);
        $salt = substr($paytm_hash, -4);

        $finalString = $str . "|" . $salt;

        $website_hash = hash("sha256", $finalString);
        $website_hash .= $salt;

        $validFlag = "FALSE";
        if ($website_hash == $paytm_hash) {
            $validFlag = "TRUE";
        } else {
            $validFlag = "FALSE";
        }
        return $validFlag;
    }

    function verifychecksum_eFromStr($str, $key, $checksumvalue) {
        $paytm_hash = $this->decrypt_e($checksumvalue, $key);
        $salt = substr($paytm_hash, -4);

        $finalString = $str . "|" . $salt;

        $website_hash = hash("sha256", $finalString);
        $website_hash .= $salt;

        $validFlag = "FALSE";
        if ($website_hash == $paytm_hash) {
            $validFlag = "TRUE";
        } else {
            $validFlag = "FALSE";
        }
        return $validFlag;
    }

    function getArray2Str($arrayList) {
        $findme = 'REFUND';
        $findmepipe = '|';
        $paramStr = "";
        $flag = 1;
        foreach ($arrayList as $key => $value) {
            $pos = strpos($value, $findme);
            $pospipe = strpos($value, $findmepipe);
            if ($pos !== false || $pospipe !== false) {
                continue;
            }

            if ($flag) {
                $paramStr .= $this->checkString_e($value);
                $flag = 0;
            } else {
                $paramStr .= "|" . $this->checkString_e($value);
            }
        }
        return $paramStr;
    }

    function getArray2StrForVerify($arrayList) {
        $paramStr = "";
        $flag = 1;
        foreach ($arrayList as $key => $value) {
            if ($flag) {
                $paramStr .= $this->checkString_e($value);
                $flag = 0;
            } else {
                $paramStr .= "|" . $this->checkString_e($value);
            }
        }
        return $paramStr;
    }

    function redirect2PG($paramList, $key) {
        $hashString = $this->getchecksumFromArray($paramList);
        $checksum = $this > encrypt_e($hashString, $key);
    }

    function removeCheckSumParam($arrayList) {
        if (isset($arrayList["CHECKSUMHASH"])) {
            unset($arrayList["CHECKSUMHASH"]);
        }
        return $arrayList;
    }

    function getTxnStatus($requestParamList) {
        return $this->callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
    }

    function getTxnStatusNew($requestParamList) {
        return $this->callNewAPI(PAYTM_STATUS_QUERY_NEW_URL, $requestParamList);
    }

    function initiateTxnRefund($requestParamList) {
        $CHECKSUM = $this->getRefundChecksumFromArray($requestParamList, PAYTM_MERCHANT_KEY, 0);
        $requestParamList["CHECKSUM"] = $CHECKSUM;
        return $this->callAPI(PAYTM_REFUND_URL, $requestParamList);
    }

    function callAPI($apiURL, $requestParamList) {
        $jsonResponse = "";
        $responseParamList = array();
        $JsonData = json_encode($requestParamList);
        $postData = 'JsonData=' . urlencode($JsonData);
        $ch = curl_init($apiURL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($postData))
        );
        $jsonResponse = curl_exec($ch);
        $responseParamList = json_decode($jsonResponse, true);
        return $responseParamList;
    }

    function callNewAPI($apiURL, $requestParamList) {
        $jsonResponse = "";
        $responseParamList = array();
        $JsonData = json_encode($requestParamList);
        $postData = 'JsonData=' . urlencode($JsonData);
        $ch = curl_init($apiURL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($postData))
        );
        $jsonResponse = curl_exec($ch);
        $responseParamList = json_decode($jsonResponse, true);
        return $responseParamList;
    }

    function getRefundChecksumFromArray($arrayList, $key, $sort = 1) {
        if ($sort != 0) {
            ksort($arrayList);
        }
        $str = $this->getRefundArray2Str($arrayList);
        $salt = $this->generateSalt_e(4);
        $finalString = $str . "|" . $salt;
        $hash = hash("sha256", $finalString);
        $hashString = $hash . $salt;
        $checksum = $this->encrypt_e($hashString, $key);
        return $checksum;
    }

    function getRefundArray2Str($arrayList) {
        $findmepipe = '|';
        $paramStr = "";
        $flag = 1;
        foreach ($arrayList as $key => $value) {
            $pospipe = strpos($value, $findmepipe);
            if ($pospipe !== false) {
                continue;
            }

            if ($flag) {
                $paramStr .= $this->checkString_e($value);
                $flag = 0;
            } else {
                $paramStr .= "|" . $this->checkString_e($value);
            }
        }
        return $paramStr;
    }

    function callRefundAPI($refundApiURL, $requestParamList) {
        $jsonResponse = "";
        $responseParamList = array();
        $JsonData = json_encode($requestParamList);
        $postData = 'JsonData=' . urlencode($JsonData);
        $ch = curl_init($apiURL);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $refundApiURL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $jsonResponse = curl_exec($ch);
        $responseParamList = json_decode($jsonResponse, true);
        return $responseParamList;
    }

    /**
     * Function Name: payPayTm
     * Description:   To pay by paytm method
     */
    function payTmDemo() {

        $dataResponse = array();
        $paramList = array();
        $user_id = 19;
        $ORDER_ID = "ORDS" . rand(100000000, 999999999999);
        $CUST_ID = $user_id;
        $INDUSTRY_TYPE_ID = "Retail";
        $CHANNEL_ID = "WEB";
        $TXN_AMOUNT = 500;
        // Create an array having all required parameters for creating checksum.
        $dataResponse['MID'] = $paramList["MID"] = $this->PAYTM_MERCHANT_MID;
        $dataResponse['ORDER_ID'] = $paramList["ORDER_ID"] = $ORDER_ID;
        $dataResponse['CUST_ID'] = $paramList["CUST_ID"] = $CUST_ID;
        $dataResponse['INDUSTRY_TYPE_ID'] = $paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
        $dataResponse['CHANNEL_ID'] = $paramList["CHANNEL_ID"] = $CHANNEL_ID;
        $dataResponse['TXN_AMOUNT'] = $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
        $dataResponse['WEBSITE'] = $paramList["WEBSITE"] = $this->PAYTM_MERCHANT_WEBSITE;
        $dataResponse['CALLBACK_URL'] = $paramList["CALLBACK_URL"] = base_url() . 'payment/PayResponse';
        $dataResponse['CHECKSUMHASH'] = $this->getChecksumFromArray($paramList, $this->PAYTM_MERCHANT_KEY);
        $dataResponse['PAYTM_TXN_URL'] = $this->PAYTM_TXN_URL;
        $option = array(
            'table' => 'payment',
            'data' => array(
                'user_id' => $user_id,
                'orderId' => $ORDER_ID,
                'amount' => $TXN_AMOUNT,
                'datetime' => date('Y-m-d H:i:s'),
            ),
        );
        $userData = $this->common_model->customInsert($option);
        $this->load->view('payment-test', $dataResponse);
    }

    /**
     * Function Name: PayResponse
     * Description:   To handle response
     */
    function PayResponse() {

        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";
        $paramList = $_POST;
        if ($_POST["STATUS"] == "TXN_FAILURE") {
            $option = array(
                'table' => 'payment',
                'where' => array('orderId' => $_POST['ORDERID'])
            );
            $this->common_model->customDelete($option);
            redirect('#/ac-balance?orderid=' . $_POST['ORDERID'] . '&checkstatus=2&txnstatus=cancel');
        } else {
            $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : "";
            $isValidChecksum = $this->verifychecksum_e($paramList, $this->PAYTM_MERCHANT_KEY, $paytmChecksum);
            if ($isValidChecksum == "TRUE" && $_POST["STATUS"] == "TXN_SUCCESS") {
                /* user payment add */
                $option = array(
                    'table' => 'payment',
                    'data' => array(
                        'amount' => $_POST['TXNAMOUNT'],
                        'currency' => $_POST['CURRENCY'],
                        'txnid' => $_POST['TXNID'],
                        'status' => "SUCCESS",
                        'datetime' => date('Y-m-d H:i:s')
                    ),
                    'where' => array('orderId' => $_POST['ORDERID'])
                );
                $this->common_model->customUpdate($option);
                $option = array(
                    'table' => 'payment',
                    'select' => 'payment.user_id,users.email,users.first_name',
                    'join' => array('users' => 'users.id=payment.user_id'),
                    'where' => array('payment.orderId' => $_POST['ORDERID']),
                    'single' => true
                );
                $userData = $this->common_model->customGet($option);
                if (!empty($userData)) {
                    /** If the player has credit balance then system will automatically take 5% from playwinfantsy chips account * */
                    $creditCash = (abs($_POST['TXNAMOUNT']) * 5) / 100;
                    $creditChipBonus = round($creditCash);
                    accountPolicyCreditChip($userData->user_id, $creditChipBonus);
                    $cash_opening_balance = 0;
                    $cash_credit = 0;
                    $cash_available_balance = 0;
                    /* user payment wallet add & update */
                    $option = array(
                        'table' => 'wallet',
                        'where' => array('user_id' => $userData->user_id),
                        'single' => true
                    );
                    $userWallet = $this->common_model->customGet($option);
                    if (!empty($userWallet)) {
                        $prevDepositedAmount = $userWallet->deposited_amount;
                        $curDepositedAmount = $_POST['TXNAMOUNT'];
                        $totalDepositedAmount = abs($prevDepositedAmount) + abs($curDepositedAmount);
                        $prevWinningAmount = $userWallet->winning_amount;
                        $prevCashBonusAmount = $userWallet->cash_bonus_amount;
                        $totalCurrentBalance = abs($prevWinningAmount) + abs($prevCashBonusAmount) + abs($totalDepositedAmount);
                        $optionUpdate = array(
                            'table' => 'wallet',
                            'data' => array(
                                'deposited_amount' => $totalDepositedAmount,
                                'total_balance' => $totalCurrentBalance,
                                'update_date' => date('Y-m-d H:i:s')
                            ),
                            'where' => array('user_id' => $userData->user_id)
                        );
                        $this->common_model->customUpdate($optionUpdate);
                        $cash_opening_balance = $userWallet->total_balance;
                        $cash_credit = $_POST['TXNAMOUNT'];
                        $cash_available_balance = $totalCurrentBalance;
                    } else {
                        $optionW = array(
                            'table' => 'wallet',
                            'data' => array(
                                'user_id' => $userData->user_id,
                                'deposited_amount' => $_POST['TXNAMOUNT'],
                                'total_balance' => $_POST['TXNAMOUNT'],
                                'create_date' => date('Y-m-d H:i:s')
                            )
                        );
                        $this->common_model->customInsert($optionW);
                        $cash_credit = $_POST['TXNAMOUNT'];
                        $cash_available_balance = $_POST['TXNAMOUNT'];
                    }
                    /** To check first time user bonus * */
                    $flagGetBonus = 1;
                    if (!empty($userWallet)) {
                        if ($userWallet->is_first_bonus != 1) {
                            $flagGetBonus = 0;
                        }
                    } else {
                        $flagGetBonus = 0;
                    }
                    if ($flagGetBonus != 1) {
                        $minBountAmount = getConfig('first_time_deposite_bonus_min_amount');
                        if ($minBountAmount <= $_POST['TXNAMOUNT']) {
                            $opening_balance = 0;
                            $cr = 0;
                            $available_balance = 0;
                            $options = array(
                                'table' => 'user_chip',
                                'select' => 'bonus_chip,winning_chip,chip',
                                'where' => array('user_id' => $userData->user_id),
                                'single' => true
                            );
                            $UserChip = $this->common_model->customGet($options);
                            if (!empty($UserChip)) {
                                $bonusChipCredit = $_POST['TXNAMOUNT'];
                                if ($_POST['TXNAMOUNT'] > 1000) {
                                    $bonusChipCredit = 1000;
                                }
                                $bonus_chip = abs($UserChip->bonus_chip) + abs($bonusChipCredit);
                                $totalChip = abs($UserChip->chip) + abs($bonusChipCredit);
                                $opening_balance = $UserChip->chip;
                                $cr = $bonusChipCredit;
                                $available_balance = $totalChip;
                                $optionsChip = array(
                                    'table' => 'user_chip',
                                    'data' => array('bonus_chip' => $bonus_chip,
                                        'chip' => $totalChip),
                                    'where' => array('user_id' => $userData->user_id)
                                );
                                $this->common_model->customUpdate($optionsChip);
                            } else {
                                $bonusChipCredit = $_POST['TXNAMOUNT'];
                                if ($_POST['TXNAMOUNT'] > 1000) {
                                    $bonusChipCredit = 1000;
                                }
                                $cr = $bonusChipCredit;
                                $available_balance = $bonusChipCredit;
                                $optionsChip = array(
                                    'table' => 'user_chip',
                                    'data' => array('bonus_chip' => $bonusChipCredit,
                                        'chip' => $bonusChipCredit,
                                        'user_id' => $userData->user_id,
                                        'update_date' => date('Y-m-d H:i:s')),
                                );
                                $this->common_model->customInsert($optionsChip);
                            }
                            /* To Transaction History Insert */
                            $options = array(
                                'table' => 'transactions_history',
                                'data' => array(
                                    'user_id' => $userData->user_id,
                                    'match_id' => 0,
                                    'opening_balance' => $opening_balance,
                                    'cr' => $cr,
                                    'orderId' => $_POST['ORDERID'],
                                    'available_balance' => $available_balance,
                                    'message' => "First time deposit get bonus playwinfantasy chip",
                                    'datetime' => date('Y-m-d H:i:s'),
                                    'transaction_type' => 'CHIP',
                                    'pay_type' => "BONUS",
                                    'bonus_type' => "FIRST_DEPOSIT"
                                )
                            );
                            $this->common_model->customInsert($options);
                        }
                        $options = array('table' => 'wallet',
                            'data' => array('is_first_bonus' => 1),
                            'where' => array('user_id' => $userData->user_id));
                        $this->common_model->customUpdate($options);
                    }
                    /* user payment transaction history add */
                    $orderId = $_POST['ORDERID'];
                    $options = array(
                        'table' => 'transactions_history',
                        'data' => array(
                            'user_id' => $userData->user_id,
                            'match_id' => 0,
                            'orderId' => $orderId,
                            'opening_balance' => $cash_opening_balance,
                            'cr' => $cash_credit,
                            'available_balance' => $cash_available_balance,
                            'message' => "Deposited Cash - Order ID  $orderId",
                            'datetime' => date('Y-m-d H:i:s'),
                            'transaction_type' => 'CASH',
                            'pay_type' => "DEPOSIT"
                        )
                    );
                    $this->common_model->customInsert($options);

                    /* user payment sent mail */
                    $html = array();
                    $html['logo'] = base_url() . getConfig('site_logo');
                    $html['site'] = getConfig('site_name');
                    $html['amount'] = $_POST['TXNAMOUNT'];
                    $html['orderId'] = $_POST['ORDERID'];
                    $html['user'] = ucwords($userData->first_name);
                    $email_template = $this->load->view('email/user_payment_information_tpl', $html, true);
                    send_mail($email_template, '[' . getConfig('site_name') . '] Your deposit is successful. Start playing now!', $userData->email, getConfig('admin_email'));
                    /* admin notification */
                    $options = array(
                        'table' => 'notifications',
                        'data' => array(
                            'user_id' => 1,
                            'type_id' => 0,
                            'sender_id' => $userData->user_id,
                            'noti_type' => 'DEPOSITE_AMOUNT',
                            'message' => "New Deposited Cash " . getConfig('currency') . ". " . $_POST['TXNAMOUNT'],
                            'read_status' => 'NO',
                            'sent_time' => date('Y-m-d H:i:s'),
                            'user_type' => 'ADMIN'
                        )
                    );
                    $this->common_model->customInsert($options);
                    /* user notification */
                    $options = array(
                        'table' => 'notifications',
                        'data' => array(
                            'user_id' => $userData->user_id,
                            'type_id' => 0,
                            'sender_id' => 1,
                            'noti_type' => 'USER_DEPOSITE_AMOUNT',
                            'message' => "Your deposite of " . getConfig('currency') . ". " . $_POST['TXNAMOUNT'] . " was successful.",
                            'read_status' => 'NO',
                            'sent_time' => date('Y-m-d H:i:s'),
                            'user_type' => 'USER'
                        )
                    );
                    $this->common_model->customInsert($options);
                    cashWalletReports($userData->user_id, $_POST['TXNAMOUNT'], 'DEBIT');
                    redirect('#/ac-balance?orderid=' . $_POST['ORDERID'] . '&checkstatus=1&txnstatus=success');
                }
            } else {
                redirect('#/ac-balance?orderid=&checkstatus=3&txnstatus=failure');
            }
        }
    }

    /**
     * Function Name: PayUMoneyPayResponseSuccess
     * Description:   To handle payumoney pay response success
     */
    function PayUMoneyPayResponseSuccess() {
        $payResponse = $_POST;
        $UID = $payResponse['udf1'];
        $status = strtolower($payResponse['status']);
        $txnid = $payResponse['txnid'];
        $amount = $payResponse['amount'];
        $orderid = $payResponse['productinfo'];
        $txnDate = $payResponse['addedon'];
        if ($status == "failure") {
            $option = array(
                'table' => 'payment',
                'where' => array('orderId' => $orderid, 'status !=' => 'SUCCESS')
            );
            $this->common_model->customDelete($option);
            $return['status'] = 0;
            $return['message'] = "Payment failure";
            $this->response($return);
            exit;
        } else if ($status == "success") {
            $option = array(
                'table' => 'payment',
                'select' => 'payment.orderId',
                'join' => array('users' => 'users.id=payment.user_id'),
                'where' => array('payment.orderId' => $orderid,
                    'payment.user_id' => $UID,
                    'payment.status' => 'SUCCESS'),
                'single' => true
            );
            $paymentCheckIsDone = $this->common_model->customGet($option);
            if (!empty($paymentCheckIsDone)) {
                $return['status'] = 0;
                $return['message'] = "Payment already done for ORDERID:$orderid";
                $this->response($return);
                exit;
            }
            /* user payment add */
            $option = array(
                'table' => 'payment',
                'data' => array(
                    'amount' => $amount,
                    'currency' => "INR",
                    'txnid' => $txnid,
                    'status' => "SUCCESS",
                    'payment_type' => "PAYUMONEY",
                    'pay_response' => json_encode($payResponse),
                    'datetime' => date('Y-m-d H:i:s')
                ),
                'where' => array('orderId' => $orderid, 'user_id' => $UID)
            );
            $this->common_model->customUpdate($option);
            $option = array(
                'table' => 'payment',
                'select' => 'payment.user_id,users.email,users.first_name',
                'join' => array('users' => 'users.id=payment.user_id'),
                'where' => array('payment.orderId' => $orderid),
                'single' => true
            );
            $userData = $this->common_model->customGet($option);
            if (!empty($userData)) {
                /** If the player has credit balance then system will automatically take 5% from playwinfantsy chips account * */
                $creditCash = (abs($amount) * 5) / 100;
                $creditChipBonus = round($creditCash);
                accountPolicyCreditChip($userData->user_id, $creditChipBonus);
                $cash_opening_balance = 0;
                $cash_credit = 0;
                $cash_available_balance = 0;
                /* user payment wallet add & update */
                $option = array(
                    'table' => 'wallet',
                    'where' => array('user_id' => $userData->user_id),
                    'single' => true
                );
                $userWallet = $this->common_model->customGet($option);
                if (!empty($userWallet)) {
                    $prevDepositedAmount = $userWallet->deposited_amount;
                    $curDepositedAmount = $amount;
                    $totalDepositedAmount = abs($prevDepositedAmount) + abs($curDepositedAmount);
                    $prevWinningAmount = $userWallet->winning_amount;
                    $prevCashBonusAmount = $userWallet->cash_bonus_amount;
                    $totalCurrentBalance = abs($prevWinningAmount) + abs($prevCashBonusAmount) + abs($totalDepositedAmount);
                    $optionUpdate = array(
                        'table' => 'wallet',
                        'data' => array(
                            'deposited_amount' => $totalDepositedAmount,
                            'total_balance' => $totalCurrentBalance,
                            'update_date' => date('Y-m-d H:i:s')
                        ),
                        'where' => array('user_id' => $userData->user_id)
                    );
                    $this->common_model->customUpdate($optionUpdate);
                    $cash_opening_balance = $userWallet->total_balance;
                    $cash_credit = $amount;
                    $cash_available_balance = $totalCurrentBalance;
                } else {
                    $optionW = array(
                        'table' => 'wallet',
                        'data' => array(
                            'user_id' => $userData->user_id,
                            'deposited_amount' => $amount,
                            'total_balance' => $amount,
                            'create_date' => date('Y-m-d H:i:s')
                        )
                    );
                    $this->common_model->customInsert($optionW);
                    $cash_credit = $amount;
                    $cash_available_balance = $amount;
                }
                /** To check first time user bonus * */
                $flagGetBonus = 1;
                if (!empty($userWallet)) {
                    if ($userWallet->is_first_bonus != 1) {
                        $flagGetBonus = 0;
                    }
                } else {
                    $flagGetBonus = 0;
                }
                if ($flagGetBonus != 1) {
                    $minBountAmount = getConfig('first_time_deposite_bonus_min_amount');
                    if ($minBountAmount <= $amount) {
                        $opening_balance = 0;
                        $cr = 0;
                        $available_balance = 0;
                        $options = array(
                            'table' => 'user_chip',
                            'select' => 'bonus_chip,winning_chip,chip',
                            'where' => array('user_id' => $userData->user_id),
                            'single' => true
                        );
                        $UserChip = $this->common_model->customGet($options);
                        if (!empty($UserChip)) {
                            $bonusChipCredit = $amount;
                            if ($amount > 1000) {
                                $bonusChipCredit = 1000;
                            }
                            $bonus_chip = abs($UserChip->bonus_chip) + abs($bonusChipCredit);
                            $totalChip = abs($UserChip->chip) + abs($bonusChipCredit);
                            $opening_balance = $UserChip->chip;
                            $cr = $bonusChipCredit;
                            $available_balance = $totalChip;
                            $optionsChip = array(
                                'table' => 'user_chip',
                                'data' => array('bonus_chip' => $bonus_chip,
                                    'chip' => $totalChip),
                                'where' => array('user_id' => $userData->user_id)
                            );
                            $this->common_model->customUpdate($optionsChip);
                        } else {
                            $bonusChipCredit = $amount;
                            if ($amount > 1000) {
                                $bonusChipCredit = 1000;
                            }
                            $cr = $bonusChipCredit;
                            $available_balance = $bonusChipCredit;
                            $optionsChip = array(
                                'table' => 'user_chip',
                                'data' => array('bonus_chip' => $bonusChipCredit,
                                    'chip' => $bonusChipCredit,
                                    'user_id' => $userData->user_id,
                                    'update_date' => date('Y-m-d H:i:s')),
                            );
                            $this->common_model->customInsert($optionsChip);
                        }
                        /* To Transaction History Insert */
                        $options = array(
                            'table' => 'transactions_history',
                            'data' => array(
                                'user_id' => $userData->user_id,
                                'match_id' => 0,
                                'opening_balance' => $opening_balance,
                                'cr' => $cr,
                                'orderId' => $orderid,
                                'available_balance' => $available_balance,
                                'message' => "First time deposit get bonus playwinfantasy chip",
                                'datetime' => date('Y-m-d H:i:s'),
                                'transaction_type' => 'CHIP',
                                'pay_type' => "BONUS",
                                'bonus_type' => "FIRST_DEPOSIT"
                            )
                        );
                        $this->common_model->customInsert($options);
                    }
                    $options = array('table' => 'wallet',
                        'data' => array('is_first_bonus' => 1),
                        'where' => array('user_id' => $userData->user_id));
                    $this->common_model->customUpdate($options);
                }
                /* user payment transaction history add */
                $options = array(
                    'table' => 'transactions_history',
                    'data' => array(
                        'user_id' => $userData->user_id,
                        'match_id' => 0,
                        'orderId' => $orderid,
                        'opening_balance' => $cash_opening_balance,
                        'cr' => $cash_credit,
                        'available_balance' => $cash_available_balance,
                        'message' => "Deposited Cash - Order ID  $orderId",
                        'datetime' => date('Y-m-d H:i:s'),
                        'transaction_type' => 'CASH',
                        'pay_type' => "DEPOSIT"
                    )
                );
                $this->common_model->customInsert($options);

                /* user payment sent mail */
                $html = array();
                $html['logo'] = base_url() . getConfig('site_logo');
                $html['site'] = getConfig('site_name');
                $html['amount'] = $amount;
                $html['orderId'] = $orderid;
                $html['user'] = ucwords($userData->first_name);
                $email_template = $this->load->view('email/user_payment_information_tpl', $html, true);
                send_mail($email_template, '[' . getConfig('site_name') . '] Your deposit is successful. Start playing now!', $userData->email, getConfig('admin_email'));
                /* admin notification */
                $options = array(
                    'table' => 'notifications',
                    'data' => array(
                        'user_id' => 1,
                        'type_id' => 0,
                        'sender_id' => $userData->user_id,
                        'noti_type' => 'DEPOSITE_AMOUNT',
                        'message' => "New Deposited Cash " . getConfig('currency') . ". " . $amount,
                        'read_status' => 'NO',
                        'sent_time' => date('Y-m-d H:i:s'),
                        'user_type' => 'ADMIN'
                    )
                );
                $this->common_model->customInsert($options);
                /* user notification */
                $options = array(
                    'table' => 'notifications',
                    'data' => array(
                        'user_id' => $userData->user_id,
                        'type_id' => 0,
                        'sender_id' => 1,
                        'noti_type' => 'USER_DEPOSITE_AMOUNT',
                        'message' => "Your deposite of " . getConfig('currency') . ". " . $amount . " was successful.",
                        'read_status' => 'NO',
                        'sent_time' => date('Y-m-d H:i:s'),
                        'user_type' => 'USER'
                    )
                );
                $this->common_model->customInsert($options);
                cashWalletReports($userData->user_id, $amount, 'DEBIT');
                /** to send push notification * */
                $notificationData = array(
                    'title' => 'Deposite Amount',
                    'message' => "Your deposite of " . getConfig('currency') . ". " . $amount . " was successful.",
                    'type' => "USER_DEPOSITE_AMOUNT",
                    'type_id' => 0,
                    'user_id' => $userData->user_id,
                    'badges' => 0,
                );
                sendNotification($userData->user_id, $notificationData);
                $return['status'] = 1;
                $return['message'] = "Payment Success";
                $this->response($return);
                exit;
            }
        } else {
            $return['status'] = 0;
            $return['message'] = "Payment failure";
            $this->response($return);
            exit;
        }
    }

    /**
     * Function Name: PayUMoneyPayResponseFailure
     * Description:   To handle payumoney pay response failure
     */
    function PayUMoneyPayResponseFailure() {
        $payResponse = $_POST;
        $UID = $payResponse['udf1'];
        $status = strtolower($payResponse['status']);
        $txnid = $payResponse['txnid'];
        $amount = $payResponse['amount'];
        $orderid = $payResponse['productinfo'];
        $txnDate = $payResponse['addedon'];
        if ($status == "failure") {
            $option = array(
                'table' => 'payment',
                'where' => array('orderId' => $orderid, 'status !=' => 'SUCCESS')
            );
            $this->common_model->customDelete($option);
            $return['status'] = 0;
            $return['message'] = "Payment failure";
            $this->response($return);
            exit;
        }
    }

    /**
     * Function Name: PayUMoneyPayResponseFailure
     * Description:   To handle payumoney pay response failure
     */
    function payuMoneyResponseSuccessWEB() {

        $option = array(
            'table' => 'user_winner_config',
            'data' => array(
                'response' => json_encode($_POST)
            )
        );
        $this->common_model->customInsert($option);
    }

    function payuMoneyResponseFailureWEB() {
        $option = array(
            'table' => 'user_winner_config',
            'data' => array(
                'response' => json_encode($_POST)
            )
        );
        $this->common_model->customInsert($option);
    }

    function razorPayHandler() {
        $success = true;
        $keyId = 'rzp_live_ncwsdMGuDg8ohl';
        $keySecret = 'UylMJYc5yAbgoBHA4YAj75GO';
        $displayCurrency = 'INR';
        $productinfo = $_POST['razorpay_order_id'];
        if (empty($_POST['razorpay_payment_id']) === false) {
            $api = new Api($keyId, $keySecret);
            try {
                $attributes = array(
                    'razorpay_order_id' => $_POST['razorpay_order_id'],
                    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                    'razorpay_signature' => $_POST['razorpay_signature']
                );
                $api->utility->verifyPaymentSignature($attributes);
                /* user payment add */
                $option = array(
                    'table' => 'payment',
                    'data' => array(
                        'currency' => "INR",
                        'txnid' => $_POST['razorpay_payment_id'],
                        'status' => "SUCCESS",
                        'datetime' => date('Y-m-d H:i:s')
                    ),
                    'where' => array('orderId' => $productinfo)
                );
                $this->common_model->customUpdate($option);

                $option = array(
                    'table' => 'payment',
                    'select' => 'payment.user_id,users.email,users.first_name,payment.amount',
                    'join' => array('users' => 'users.id=payment.user_id'),
                    'where' => array('payment.orderId' => $productinfo),
                    'single' => true
                );
                $userData = $this->common_model->customGet($option);
                if (!empty($userData)) {
                    $amount = $userData->amount;
                    /** If the player has credit balance then system will automatically take 5% from playwinfantsy chips account * */
                    $creditCash = (abs($amount) * 5) / 100;
                    $creditChipBonus = round($creditCash);
                    accountPolicyCreditChip($userData->user_id, $creditChipBonus);
                    $cash_opening_balance = 0;
                    $cash_credit = 0;
                    $cash_available_balance = 0;
                    /* user payment wallet add & update */
                    $option = array(
                        'table' => 'wallet',
                        'where' => array('user_id' => $userData->user_id),
                        'single' => true
                    );
                    $userWallet = $this->common_model->customGet($option);
                    if (!empty($userWallet)) {
                        $prevDepositedAmount = $userWallet->deposited_amount;
                        $curDepositedAmount = $amount;
                        $totalDepositedAmount = abs($prevDepositedAmount) + abs($curDepositedAmount);
                        $prevWinningAmount = $userWallet->winning_amount;
                        $prevCashBonusAmount = $userWallet->cash_bonus_amount;
                        $totalCurrentBalance = abs($prevWinningAmount) + abs($prevCashBonusAmount) + abs($totalDepositedAmount);
                        $optionUpdate = array(
                            'table' => 'wallet',
                            'data' => array(
                                'deposited_amount' => $totalDepositedAmount,
                                'total_balance' => $totalCurrentBalance,
                                'update_date' => date('Y-m-d H:i:s')
                            ),
                            'where' => array('user_id' => $userData->user_id)
                        );
                        $this->common_model->customUpdate($optionUpdate);
                        $cash_opening_balance = $userWallet->total_balance;
                        $cash_credit = $amount;
                        $cash_available_balance = $totalCurrentBalance;
                    } else {
                        $optionW = array(
                            'table' => 'wallet',
                            'data' => array(
                                'user_id' => $userData->user_id,
                                'deposited_amount' => $amount,
                                'total_balance' => $amount,
                                'create_date' => date('Y-m-d H:i:s')
                            )
                        );
                        $this->common_model->customInsert($optionW);
                        $cash_credit = $amount;
                        $cash_available_balance = $amount;
                    }
                    /** To check first time user bonus * */
                    $flagGetBonus = 1;
                    if (!empty($userWallet)) {
                        if ($userWallet->is_first_bonus != 1) {
                            $flagGetBonus = 0;
                        }
                    } else {
                        $flagGetBonus = 0;
                    }
                    if ($flagGetBonus != 1) {
                        $minBountAmount = getConfig('first_time_deposite_bonus_min_amount');
                        if ($minBountAmount <= $amount) {
                            $opening_balance = 0;
                            $cr = 0;
                            $available_balance = 0;
                            $options = array(
                                'table' => 'user_chip',
                                'select' => 'bonus_chip,winning_chip,chip',
                                'where' => array('user_id' => $userData->user_id),
                                'single' => true
                            );
                            $UserChip = $this->common_model->customGet($options);
                            if (!empty($UserChip)) {
                                $bonusChipCredit = $amount;
                                if ($amount > 1000) {
                                    $bonusChipCredit = 1000;
                                }
                                $bonus_chip = abs($UserChip->bonus_chip) + abs($bonusChipCredit);
                                $totalChip = abs($UserChip->chip) + abs($bonusChipCredit);
                                $opening_balance = $UserChip->chip;
                                $cr = $bonusChipCredit;
                                $available_balance = $totalChip;
                                $optionsChip = array(
                                    'table' => 'user_chip',
                                    'data' => array('bonus_chip' => $bonus_chip,
                                        'chip' => $totalChip),
                                    'where' => array('user_id' => $userData->user_id)
                                );
                                $this->common_model->customUpdate($optionsChip);
                            } else {
                                $bonusChipCredit = $amount;
                                if ($amount > 1000) {
                                    $bonusChipCredit = 1000;
                                }
                                $cr = $bonusChipCredit;
                                $available_balance = $bonusChipCredit;
                                $optionsChip = array(
                                    'table' => 'user_chip',
                                    'data' => array('bonus_chip' => $bonusChipCredit,
                                        'chip' => $bonusChipCredit,
                                        'user_id' => $userData->user_id,
                                        'update_date' => date('Y-m-d H:i:s')),
                                );
                                $this->common_model->customInsert($optionsChip);
                            }
                            /* To Transaction History Insert */
                            $options = array(
                                'table' => 'transactions_history',
                                'data' => array(
                                    'user_id' => $userData->user_id,
                                    'match_id' => 0,
                                    'opening_balance' => $opening_balance,
                                    'cr' => $cr,
                                    'orderId' => $productinfo,
                                    'available_balance' => $available_balance,
                                    'message' => "First time deposit get bonus playwinfantasy chip",
                                    'datetime' => date('Y-m-d H:i:s'),
                                    'transaction_type' => 'CHIP',
                                    'pay_type' => "BONUS",
                                    'bonus_type' => "FIRST_DEPOSIT"
                                )
                            );
                            $this->common_model->customInsert($options);
                        }
                        $options = array('table' => 'wallet',
                            'data' => array('is_first_bonus' => 1),
                            'where' => array('user_id' => $userData->user_id));
                        $this->common_model->customUpdate($options);
                    }
                    /* user payment transaction history add */
                    $options = array(
                        'table' => 'transactions_history',
                        'data' => array(
                            'user_id' => $userData->user_id,
                            'match_id' => 0,
                            'orderId' => $productinfo,
                            'opening_balance' => $cash_opening_balance,
                            'cr' => $cash_credit,
                            'available_balance' => $cash_available_balance,
                            'message' => "Deposited Cash - Order ID  $productinfo",
                            'datetime' => date('Y-m-d H:i:s'),
                            'transaction_type' => 'CASH',
                            'pay_type' => "DEPOSIT"
                        )
                    );
                    $this->common_model->customInsert($options);

                    /* user payment sent mail */
                    $html = array();
                    $html['logo'] = base_url() . getConfig('site_logo');
                    $html['site'] = getConfig('site_name');
                    $html['amount'] = $amount;
                    $html['orderId'] = $productinfo;
                    $html['user'] = ucwords($userData->first_name);
                    $email_template = $this->load->view('email/user_payment_information_tpl', $html, true);
                    send_mail($email_template, '[' . getConfig('site_name') . '] Your deposit is successful. Start playing now!', $userData->email, getConfig('admin_email'));
                    /* admin notification */
                    $options = array(
                        'table' => 'notifications',
                        'data' => array(
                            'user_id' => 1,
                            'type_id' => 0,
                            'sender_id' => $userData->user_id,
                            'noti_type' => 'DEPOSITE_AMOUNT',
                            'message' => "New Deposited Cash " . getConfig('currency') . ". " . $amount,
                            'read_status' => 'NO',
                            'sent_time' => date('Y-m-d H:i:s'),
                            'user_type' => 'ADMIN'
                        )
                    );
                    $this->common_model->customInsert($options);
                    /* user notification */
                    $options = array(
                        'table' => 'notifications',
                        'data' => array(
                            'user_id' => $userData->user_id,
                            'type_id' => 0,
                            'sender_id' => 1,
                            'noti_type' => 'USER_DEPOSITE_AMOUNT',
                            'message' => "Your deposite of " . getConfig('currency') . ". " . $amount . " was successful.",
                            'read_status' => 'NO',
                            'sent_time' => date('Y-m-d H:i:s'),
                            'user_type' => 'USER'
                        )
                    );
                    $this->common_model->customInsert($options);
                    cashWalletReports($userData->user_id, $amount, 'DEBIT');
                    /** to send push notification * */
                    $notificationData = array(
                        'title' => 'Deposite Amount',
                        'message' => "Your deposite of " . getConfig('currency') . ". " . $amount . " was successful.",
                        'type' => "USER_DEPOSITE_AMOUNT",
                        'type_id' => 0,
                        'user_id' => $userData->user_id,
                        'badges' => 0,
                    );
                    sendNotification($userData->user_id, $notificationData);

                    redirect('#/ac-balance?orderid=' . $productinfo . '&checkstatus=1&txnstatus=success');
                    // $return['status'] = 1;
                    // $return['message'] = "Payment Success";
                    // $this->response($return);
                    // exit;
                }
            } catch (SignatureVerificationError $e) {
                $success = false;
                $option = array(
                    'table' => 'payment',
                    'where' => array('orderId' => $productinfo)
                );
                $this->common_model->customDelete($option);
                redirect('#/ac-balance?orderid=&checkstatus=3&txnstatus=failure');
            }
        }
    }

}
