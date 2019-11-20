<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Push Notifications Helper
 * Author: Sorav Garg
 * Author Email: soravgarg123@gmail.com
 * Description: This helper is used to send push notifications.
 * version: 1.0
 */
if (!function_exists('send_android_notification')) {

    function send_android_notification($data, $target, $badges = 0) {
        $CI = & get_instance();
        $fields = array
            (
            'notification' => $data
        );
        if (is_array($target)) {
            $fields['registration_ids'] = $target;
        } else {
            $fields['to'] = $target;
        }
        
        $headers = array
            (
            'Authorization: key=AAAADLkgFwk:APA91bHpM2Os6XK2K1xUnskTsUd-3iKbM2ItYCP6MlOrEqQIkv_T0t5AgyuTOWZSOtA86h-W0RLp8r3KLzUD5VjrrXLC2v1czcTyTCm8BVBFyxspsXI5gOsffEmYygrWBkvbhCjP8wtL',
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        $resp = json_decode($result);
        // if ($resp->success == 1) {
        //     //log_message('ERROR', "Android - Message send successfully, message -");
        // } else {
        //    // log_message('ERROR', "Android - Message failed, message - ");
        // }
        curl_close($ch);

        return $resp;
    }

}

if (!function_exists('send_ios_notification')) {

    function send_ios_notification($deviceToken, $message, $params = array(), $badges = 0) {
        $CI = & get_instance();
        // Put your private key's passphrase here:
        $passphrase = '123456';
        $user_certificate_path = APPPATH . APNS_CERTIFICATE_PATH;

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $user_certificate_path);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        // Open a connection to the APNS server
        $fp = stream_socket_client(APNS_GATEWAY_URL, $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp) {
            log_message('ERROR', "APN: Maybe some errors: $err: $errstr, message - " . $message);
        } else {
            log_message('ERROR', "Connected to APNS, message - " . $message);
        }


        // Create the payload body
        $body['aps'] = array(
            'alert' => $message,
            'params' => $params,
            'badge' => (int) $badges,
            'sound' => 'default'
        );

        // Encode the payload as JSON
        $payload = json_encode($body);

        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));

        if (!$result) {
            log_message('ERROR', "APN: Message not delivered, message - " . $message);
        } else {
            log_message('ERROR', "APN: Message successfully delivered, message - " . $message);
        }

        // Close the connection to the server
        fclose($fp);
    }

}

if (!function_exists('sendNotification')) {

    function sendNotification($userId, $notificationData) {
        /** to send push notification * */
        $options = array('table' => 'users_device_history',
            'data' => 'device_token,device_type',
            'where' => array('user_id' => $userId),
            'single' => true);
        $userDevice = commonGetHelper($options);
        if (!empty($userDevice)) {
            if ($userDevice->device_type == "ANDROID") {
                $token = $userDevice->device_token;
                send_android_notification($notificationData, $token);
            } elseif ($userDevice->device_type == "IOS") {

                $token = $userDevice->device_token;
                if ($token != 'NA') {
                    $message = $notificationData['message'];
                    send_ios_notification($token, $message, $notificationData);
                }
            }
        }
        return true;
    }

}
/* End of file push_notification_helper.php */
/* Location: ./system/application/helpers/push_notification_helper.php */
?>