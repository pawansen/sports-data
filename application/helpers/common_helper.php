<?php

defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * [get user ]
 */
if (!function_exists('getUser')) {

    function getUser($id = "") {
        $CI = & get_instance();
        return $CI->common_model->customGet(array('table' => 'users', 'where' => array('id' => $id), 'single' => true));
    }

}

/**
 * [common query ]
 */
if (!function_exists('commonGetHelper')) {

    function commonGetHelper($option) {
        $ci = get_instance();
        return $ci->common_model->customGet($option);
    }

}

/**
 * [common query ]
 */
if (!function_exists('commonCountHelper')) {

    function commonCountHelper($option) {
        $ci = get_instance();
        return $ci->common_model->customCount($option);
    }

}


/**
 * [get common configure ]
 */
if (!function_exists('getConfig')) {

    function getConfig($key) {
        $ci = get_instance();
        $option = array('table' => SETTING,
            'where' => array('option_name' => $key, 'status' => 1),
            'single' => true,
        );
        $is_result = $ci->common_model->customGet($option);
        if (!empty($is_result)) {
            return $is_result->option_value;
        } else {
            return false;
        }
    }

}

/**
 * [get common configure ]
 */
if (!function_exists('getEmailTemplate')) {

    function getEmailTemplate($key) {
        $ci = get_instance();
        $option = array('table' => "email_template",
            'where' => array('email_type' => $key, 'is_active' => 1, 'delete_status' => 0),
            'single' => true,
        );
        $is_result = $ci->common_model->customGet($option);
        if (!empty($is_result)) {
            return $is_result;
        } else {
            return false;
        }
    }

}

/**
 * [Multidimensional Array Searching (Find key by specific value)]
 */
if (!function_exists('matchKeyValue')) {

    function matchKeyValue($products, $field, $value) {
        foreach ($products as $key => $product) {
            if ($product->$field === $value)
                return true;
        }
        return false;
    }

}

/**
 * [get role ]
 */
if (!function_exists('getRole')) {

    function getRole($id = "") {
        $CI = & get_instance();
        $option = array('table' => USERS . ' as user',
            'select' => 'group.name as group_name',
            'join' => array(array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=user.id', 'left'),
                array(GROUPS . ' as group', 'group.id=ugroup.group_id', 'left')),
            'where' => array('user.id' => $id),
            'single' => true
        );
        $user = $CI->common_model->customGet($option);
        if (!empty($user)) {
            return ucwords($user->group_name);
        } else {
            return false;
        }
    }

}

/**
 * [get role position ]
 */
if (!function_exists('getRolePosition')) {

    function getRolePosition($organization_id, $limit, $offset) {
        $CI = & get_instance();
        $option = array('table' => HIERARCHY_ROLE_ORDER . ' as roles',
            'select' => 'role_id',
            'where' => array('roles.organization_id' => $organization_id
            ),
            'order' => array('roles.id' => 'desc'),
            'single' => true,
            'limit' => array($limit => $offset),
            'group_by' => array('roles.id')
        );

        $roles = $CI->common_model->customGet($option);
        if (!empty($roles)) {
            return $roles->role_id;
        } else {
            return false;
        }
    }

}


/**
 * [get common configure ]
 */
if (!function_exists('is_options')) {

    function is_options() {
        $options = array(
            'admin_email',
            'site_name',
            'date_foramte',
            'site_meta_title',
            'site_meta_description',
            'site_logo',
            'google_captcha',
            'data_sitekey',
            'secret_key',
            'login_background',
            'paytm_environment',
            'paytm_merchant_key',
            'paytm_merchant_mid',
            'paytm_merchant_website',
            'currency',
            'admin_percentage',
            'vendor_percentage',
            'team_point_credit',
            'salary_cap',
            'google_app_id',
            'google_app_secret',
            'facebook_app_id',
            'facebook_app_secret',
            'coutn_down_date',
            'first_time_deposite_bonus_min_amount',
            'game_join_time',
            'prediction_first_rank_price',
            'prediction_second_rank_price',
            'prediction_third_rank_price',
        );
        return $options;
    }

}


/**
 * [get common configure ]
 */
if (!function_exists('is_modules')) {

    function is_modules() {
        $options = array(
            'users',
            'ipl prediction',
            'series',
            'matches',
            'venders',
            'team',
            'contest',
            'cms',
            'setting'
        );
        return $options;
    }

}

if (!function_exists('zipcodeRange')) {

    function zipcodeRange() {
        $zipcode = array();
        $zipcode['range_1_2999'] = '1 TO 2999 INR';
        $zipcode['range_3000_5000'] = '3000 TO 5000 INR';
        $zipcode['range_5001_8000'] = '5001 TO 8000 INR';
        $zipcode['range_upto_8001'] = 'ABOVE 8001';
        return $zipcode;
    }

}


/**
 * [print pre ]
 */
if (!function_exists('dump')) {

    function dump($data) {
        echo"<pre>";
        print_r($data);
        echo"</pre>";
        exit;
    }

}

/**
 * [Get year between Two Dates ]
 */
if (!function_exists('getYearBtTwoDate')) {

    function getYearBtTwoDate($datetime1, $datetime2) {
        //$datetime1 = new DateTime("$datetime1");
        //$datetime2 = new DateTime("$datetime2");

        $startDate = new DateTime($datetime1);
        $endDate = new DateTime($datetime2);

        $difference = $endDate->diff($startDate);

        return $difference->d; // This will print '12' die();
    }

}

/**
 * [To print last query]
 */
if (!function_exists('lq')) {

    function lq() {
        $CI = & get_instance();
        echo $CI->db->last_query();
        die;
    }

}

/**
 * [To get database error message]
 */
if (!function_exists('db_err_msg')) {

    function db_err_msg() {
        $CI = & get_instance();
        $error = $CI->db->error();
        if (isset($error['message']) && !empty($error['message'])) {
            return 'Database error - ' . $error['message'];
        } else {
            return FALSE;
        }
    }

}

/**
 * [To parse html]
 * @param string $str
 */
if (!function_exists('parseHTML')) {

    function parseHTML($str) {
        $str = str_replace('src="//', 'src="https://', $str);
        return $str;
    }

}

/**
 * [To get current datetime]
 */
if (!function_exists('datetime')) {

    function datetime($default_format = 'Y-m-d H:i:s') {
        $datetime = date($default_format);
        return $datetime;
    }

}

/**
 * [To convert date time format]
 * @param datetime $datetime
 * @param string $format
 */
if (!function_exists('convertDateTime')) {

    function convertDateTime($datetime, $format = 'd M Y h:i A') {
        $convertedDateTime = date($format, strtotime($datetime));
        return $convertedDateTime;
    }

}

/**
 * [To encode string]
 * @param string $str
 */
if (!function_exists('encoding')) {

    function encoding($str) {
        $one = serialize($str);
        $two = @gzcompress($one, 9);
        $three = addslashes($two);
        $four = base64_encode($three);
        $five = strtr($four, '+/=', '-_.');
        return $five;
    }

}

/**
 * [To decode string]
 * @param string $str
 */
if (!function_exists('decoding')) {

    function decoding($str) {
        $one = strtr($str, '-_.', '+/=');
        $two = base64_decode($one);
        $three = stripslashes($two);
        $four = @gzuncompress($three);
        if ($four == '') {
            return "z1";
        } else {
            $five = unserialize($four);
            return $five;
        }
    }

}
/**
 * [To generate random token]
 * @param string $length
 */
if (!function_exists('generateToken')) {

    function generateToken($length) {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet) - 1;
        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[crypto_rand_secure(0, $max)];
        }
        return $token;
    }

}

/**
 * [To check null value]
 * @param string $value
 */
if (!function_exists('null_checker')) {

    function null_checker($value, $custom = "") {
        $return = "";
        if ($value != "" && $value != NULL) {
            $return = ($value == "" || $value == NULL) ? $custom : $value;
            return $return;
        } else {
            return $return;
        }
    }

}

/**
 * [To get default image if file not exist]
 * @param  [string] $filename
 * @param  [string] $filepath
 */
if (!function_exists('display_image')) {

    function display_image($filename, $filepath) {
        /* Send image path last slash */
        $file_path_name = $filepath . $filename;
        if (!empty($filename) && @file_exists($file_path_name)) {
            return urlencode(base_url() . $file_path_name);
        } else {
            return urlencode(base_url() . DEFAULT_NO_IMG_PATH);
        }
    }

}

/**
 * [To delete file from directory]
 * @param  [string] $filename
 * @param  [string] $filepath
 */
if (!function_exists('unlink_file')) {

    function unlink_file($filename, $filepath) {
        /* Send file path last slash */
        $file_path_name = $filepath . $filename;
        if (!empty($filename) && @file_exists($file_path_name) && @unlink($file_path_name)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
/**
 * [To auto generate password]
 * @param  [string] $filename
 */
if (!function_exists('randomPassword')) {

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ#@&!';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $pass[] = rand(1, 100);
        return implode($pass); //turn the array into a string
    }

}

/**
 * [To auto generate random unique]
 * @param  [string] $filename
 */
if (!function_exists('commonUniqueCode')) {

    function commonUniqueCode() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = strtoupper($alphabet[$n]);
        }
        $pass[] = rand(1, 100);
        return implode($pass); //turn the array into a string
    }

}

/**
 * [To add point]
 */
if (!function_exists('all_points')) {

    function all_points($point = 5, $value = "") {
        $htm = "";
        for ($i = 1; $i <= $point; $i += 0.5) {
            $select = (!empty($value)) ? ($value == $i) ? "selected" : "" : "";
            $htm .= "<option value='" . $i . "' " . $select . ">" . $i . "</option>";
        }
        return $htm;
    }

}

/**
 * [To add point]
 */
if (!function_exists('search_exif')) {

    function search_exif($exif, $field, $val) {
        if (!empty($exif)) {
            foreach ($exif as $data) {
                if ($data->$field == $val) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

}

/**
 * [To add point]
 */
if (!function_exists('search_exif_return')) {

    function search_exif_return($exif, $field, $val) {
        if (!empty($exif)) {
            foreach ($exif as $key => $data) {
                if ($data->$field == $val) {
                    return $data->id;
                }
            }
        } else {
            return false;
        }
    }

}



/**
 * [To generate random string]
 */
if (!function_exists('generateRandomString')) {

    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

}

/**
 * [Fantasy Icon]
 */
if (!function_exists('Icon')) {

    function Icon() {
        echo '<img width="18" src="' . base_url() . CRICKET_ICON_COLOR . '" />';
    }

}

/**
 * [Check Series open closed ]
 */
if (!function_exists('checkSeriesOpen')) {

    function checkSeriesOpen($series_id) {
        $ci = get_instance();
        $option = array(
            'table' => 'matches',
            'select' => 'match_date_time,series_id',
            'where' => array('series_id' => $series_id),
            'order' => array('match_date' => 'desc'),
            'single' => true
        );
        $series = $ci->common_model->customGet($option);
        if (!empty($series)) {
            $matchDate = $series->match_date_time;
            $UtcDateTime1 = trim(ISTToConvertUTC(date('Y-m-d H:i'), 'UTC', 'UTC'));
            $currDate = strtotime(date('Y-m-d'));
            if ($matchDate > $UtcDateTime1) {
                return "<div class='text-info'>OPEN</div>";
            } else {
                return "<div class='text-danger'>CLOSED</div>";
            }
        }
        return "<div class='text-danger'>CLOSED</div>";
    }

}

/**
 * [Fantasy Point Dynamic input]
 */
if (!function_exists('fantasyPointInput')) {

    function fantasyPointInput() {
        $inputField = array();

        /** all available points * */
        $inputField['main']['captain'] = "Captain points Multiplier ";
        $inputField['main']['vice_captain'] = "Vice captain points multiplier";
        $inputField['main']['starting_xi'] = "For being part of the starting XI";
        $inputField['main']['run'] = "Every Run Scored";
        $inputField['main']['wicket_run_out'] = "Wicket";
        $inputField['main']['catch'] = "Catch";
        $inputField['main']['stumping_run_out_direct'] = "Stumping";
        $inputField['main']['duck'] = "Duck";

        /** this two points discussion on * */
        // $inputField['main']['caught_bowled'] = "Caught & Bowled";
        $inputField['main']['run_out_thrower_catcher'] = "Run-out (thrower/catcher)";
        /** end * */
        $inputField['bonus']['every_fours'] = "Four Hit / bonus ";
        $inputField['bonus']['every_six'] = "Six Hit / bonus ";
        $inputField['bonus']['half_century'] = "Half Century ";
        $inputField['bonus']['century'] = "Century";
        $inputField['bonus']['maiden_over'] = "Maiden ";
        $inputField['bonus']['4_wickets'] = "4 Wickets Bonus";


        /** new points * */
        $inputField['bonus']['75_runs'] = "75 Runs";
        $inputField['main']['golden_duck'] = "Golden duck (out on 1st ball)";
        $inputField['strike_rate']['between_100_and_149_99_runs_per_100_balls'] = "Strike rate between 100 & 149.99";
        $inputField['strike_rate']['between_150_and_199_99_runs_per_100_balls'] = "Strike rate between 150 & 199.99";
        $inputField['strike_rate']['between_200_and_more_runs_per_100_balls'] = "Strike rate between 200 & more";
        $inputField['bonus']['3_wickets'] = "3 Wickets Bonus";
        $inputField['bonus']['5_wickets'] = "5 Wickets and above Bonus";
        $inputField['bonus']['wicket_keeper_catch'] = "Wicket keeper Catch";
        /** end * */
        $inputField['economy_rate']['applicable_for_players_bowling_minimum_overs'] = "Applicable for players bowling minimum overs";
        $inputField['economy_rate']['between_6_and_5_runs_per_over'] = "Between 6 and 5 runs per over";
        $inputField['economy_rate']['between_499_and_4_runs_per_over'] = "Between 4.99 and 4 runs per over";
        $inputField['economy_rate']['below_4_runs_per_over'] = "Below 4 runs per over";
        $inputField['economy_rate']['between_9_and_10_runs_per_over'] = "Between 9 and 10 runs per over";
        $inputField['economy_rate']['between_10_1_and_11_runs_per_over'] = "Between 10.1 and 11 runs per over";
        $inputField['economy_rate']['above_11_runs_per_over'] = "Above 11 runs per over";
        $inputField['economy_rate']['between_4_5_and_3_5_runs_per_over'] = "Between 4.5 and 3.5 runs per over";
        $inputField['economy_rate']['between_3_49_and_2_5_runs_per_over'] = "Between 3.49 and 2.5 runs per over";
        $inputField['economy_rate']['below_2_5_runs_per_over'] = "Below 2.5 runs per over";
        $inputField['economy_rate']['between_7_and_8_runs_per_over'] = "Between 7 and 8 runs per over";
        $inputField['economy_rate']['between_8_1_and_9_runs_per_over'] = "Between 8.1 and 9 runs per over";
        $inputField['economy_rate']['above_9_runs_per_over'] = "Above 9 runs per over";

        $inputField['strike_rate']['applicable_for_players_batting_minimum_balls'] = "Applicable for players batting minimum balls ";
        $inputField['strike_rate']['between_60_and_70_runs_per_100_balls'] = "Between 60 and 70  runs per 100 balls ";
        $inputField['strike_rate']['Between_50_and_59_9_runs_per_100_balls'] = "Between 50 and 59.9  runs per 100 balls";
        $inputField['strike_rate']['below_50_runs_per_100_balls'] = "Below 50 runs per 100 balls";
        $inputField['strike_rate']['between_50_and_60_runs_per_100_balls'] = "Between 50 and 60 runs per 100 balls";
        $inputField['strike_rate']['between_40_and_49_9_runs_per_100_balls'] = "Between 40 and 49.9 runs per 100 balls";
        $inputField['strike_rate']['below_40_runs_per_100_balls'] = "Below 40 runs per 100 balls";

        return $inputField;
    }

}

/**
 * [Fantasy modules Dynamic input]
 */
if (!function_exists('fantasy_modules')) {

    function fantasy_modules() {
        $modules = array();
        $modules['users'] = 'Users';
        $modules['series'] = 'Series';
        $modules['matches'] = 'Matches';
        $modules['vendors'] = 'vendors';
        //$modules['notification']    = 'Notification';

        return $modules;
    }

}

function count_digit($number) {
    return strlen($number);
}

function divider($number_of_digits) {
    $tens = "1";

    if ($number_of_digits > 8)
        return 10000000;

    while (($number_of_digits - 1) > 0) {
        $tens .= "0";
        $number_of_digits--;
    }
    return $tens;
}

function getnumbertoWords($num) {
    //function call
    $ext = ""; //thousand,lac, crore
    $number_of_digits = count_digit($num); //this is call :)
    if ($number_of_digits > 3) {
        if ($number_of_digits % 2 != 0)
            $divider = divider($number_of_digits - 1);
        else
            $divider = divider($number_of_digits);
    } else
        $divider = 1;

    $fraction = $num / $divider;
    $fraction = number_format($fraction, 2);
    if ($number_of_digits == 4 || $number_of_digits == 5)
        $ext = "k";
    if ($number_of_digits == 6 || $number_of_digits == 7)
        $ext = "Lac";
    if ($number_of_digits == 8 || $number_of_digits == 9)
        $ext = "Cr";
    return $fraction . " " . $ext;
}

/**
 * [Fantasy modules Dynamic input]
 */
if (!function_exists('auctionClosedCheck')) {

    function auctionClosedCheck() {
        $currentDate = strtotime(date('Y-m-d H:i:s'));
        $closedDate = strtotime('2018-01-27 07:00:00');
        if ($currentDate > $closedDate) {
            return false;
        } else {
            return true;
        }
    }

}

/**
 * [Fantasy Point Dynamic input]
 */
if (!function_exists('pointInConfig')) {

    function pointInConfig($match_type) {
        $inputField = array();

        $inputField[] = "starting_xi" . '_' . $match_type;
        $inputField[] = "run" . '_' . $match_type;
        $inputField[] = 'wicket_run_out' . '_' . $match_type;
        $inputField[] = 'catch' . '_' . $match_type;
        $inputField[] = "caught_bowled" . '_' . $match_type;
        $inputField[] = "stumping_run_out_direct" . '_' . $match_type;
        $inputField[] = "run_out_thrower_catcher" . '_' . $match_type;
        $inputField[] = "duck" . '_' . $match_type;
        $inputField[] = "every_fours" . '_' . $match_type;
        $inputField[] = "every_six" . '_' . $match_type;
        $inputField[] = "half_century" . '_' . $match_type;
        $inputField[] = "century" . '_' . $match_type;
        $inputField[] = "maiden_over" . '_' . $match_type;
        $inputField[] = "4_wickets" . '_' . $match_type;
        $inputField[] = "5_wickets" . '_' . $match_type;
        $inputField[] = "applicable_for_players_bowling_minimum_overs" . '_' . $match_type;
        $inputField[] = "between_6_and_5_runs_per_over" . '_' . $match_type;
        $inputField[] = "between_499_and_4_runs_per_over" . '_' . $match_type;
        $inputField[] = "below_4_runs_per_over" . '_' . $match_type;
        $inputField[] = "between_9_and_10_runs_per_over" . '_' . $match_type;
        $inputField[] = "between_10_1_and_11_runs_per_over" . '_' . $match_type;
        $inputField[] = "above_11_runs_per_over" . '_' . $match_type;
        $inputField[] = "between_4_5_and_3_5_runs_per_over" . '_' . $match_type;
        $inputField[] = "between_3_49_and_2_5_runs_per_over" . '_' . $match_type;
        $inputField[] = "below_2_5_runs_per_over" . '_' . $match_type;
        $inputField[] = "between_7_and_8_runs_per_over" . '_' . $match_type;
        $inputField[] = "between_8_1_and_9_runs_per_over" . '_' . $match_type;
        $inputField[] = "above_9_runs_per_over" . '_' . $match_type;
        $inputField[] = "applicable_for_players_batting_minimum_balls" . '_' . $match_type;
        $inputField[] = "between_60_and_70_runs_per_100_balls" . '_' . $match_type;
        $inputField[] = "Between_50_and_59_9_runs_per_100_balls" . '_' . $match_type;
        $inputField[] = "below_50_runs_per_100_balls" . '_' . $match_type;
        $inputField[] = "between_50_and_60_runs_per_100_balls" . '_' . $match_type;
        $inputField[] = "between_40_and_49_9_runs_per_100_balls" . '_' . $match_type;
        $inputField[] = "below_40_runs_per_100_balls" . '_' . $match_type;
        $inputField[] = "75_runs" . '_' . $match_type;
        $inputField[] = "golden_duck" . '_' . $match_type;
        $inputField[] = "between_100_and_149_99_runs_per_100_balls" . '_' . $match_type;
        $inputField[] = "between_150_and_199_99_runs_per_100_balls" . '_' . $match_type;
        $inputField[] = "between_200_and_more_runs_per_100_balls" . '_' . $match_type;
        $inputField[] = "3_wickets" . '_' . $match_type;
        $inputField[] = "5_wickets" . '_' . $match_type;
        $inputField[] = "wicket_keeper_catch" . '_' . $match_type;

        return $inputField;
    }

}
/**
 * [Fantasy modules Dynamic input]
 */
if (!function_exists('UTCToConvertIST')) {

    function UTCToConvertIST($dateTime, $timeZone) {
        $date = new DateTime($dateTime, new DateTimeZone('UTC'));
        $date->setTimezone(new DateTimeZone($timeZone));
        return $date->format('Y-m-d H:i');
    }

}

/**
 * [Fantasy modules Dynamic input]
 */
if (!function_exists('ISTToConvertUTC')) {

    function ISTToConvertUTC($dateTime, $timeZone, $type = "IST") {
        if ($type == "IST") {
            $date = new DateTime($dateTime, new DateTimeZone('Asia/Kolkata'));
            $date->setTimezone(new DateTimeZone($timeZone));
            return $date->format('Y-m-d H:i');
        } else {
            $date = new DateTime($dateTime, new DateTimeZone('UTC'));
            $date->setTimezone(new DateTimeZone($timeZone));
            return $date->format('Y-m-d H:i');
        }
    }

}

/**
 * [Fantasy modules Dynamic input]
 */
if (!function_exists('ABRConvert')) {

    function ABRConvert($str) {
        $localTeam = "";
        if (str_word_count($str) == 1) {
            $localTeam = substr($str, 0, 3);
        } else {
            $words = explode(" ", $str);
            foreach ($words as $value) {
                $localTeam .= substr($value, 0, 1);
            }
        }
        return strtoupper($localTeam);
    }

}
/**
 * [Fantasy modules Dynamic input]
 */
if (!function_exists('userChipWalletCalculate')) {

    function userChipWalletCalculate($uid, $chips, $trasactionMessage = "", $notificationMessage = "", $transactionPayType = "", $bonusType = "", $inviteUserId = 0) {
        $ci = get_instance();
        $opening_balance = 0;
        $cr = 0;
        $available_balance = 0;
        $orderId = generateToken(6);
        $options = array(
            'table' => 'user_chip',
            'select' => 'bonus_chip,winning_chip,chip',
            'where' => array('user_id' => $uid),
            'single' => true
        );
        $UserChip = $ci->common_model->customGet($options);
        if (!empty($UserChip)) {
            $bonus_chip = abs($UserChip->bonus_chip) + abs($chips);
            $totalChip = abs($UserChip->chip) + abs($chips);
            $opening_balance = $UserChip->chip;
            $cr = $chips;
            $available_balance = $totalChip;
            $optionsChip = array(
                'table' => 'user_chip',
                'data' => array('bonus_chip' => $bonus_chip,
                    'chip' => $totalChip),
                'where' => array('user_id' => $uid)
            );
            $ci->common_model->customUpdate($optionsChip);
        } else {
            $cr = $chips;
            $available_balance = $chips;
            $optionsChip = array(
                'table' => 'user_chip',
                'data' => array('bonus_chip' => $chips,
                    'chip' => $chips,
                    'user_id' => $uid,
                    'update_date' => date('Y-m-d H:i:s')),
            );
            $ci->common_model->customInsert($optionsChip);
        }
        /* To Transaction History Insert */
        $options = array(
            'table' => 'transactions_history',
            'data' => array(
                'user_id' => $uid,
                'match_id' => 0,
                'opening_balance' => $opening_balance,
                'cr' => $cr,
                'orderId' => $orderId,
                'available_balance' => $available_balance,
                'message' => $trasactionMessage,
                'datetime' => date('Y-m-d H:i:s'),
                'transaction_type' => 'CHIP',
                'pay_type' => $transactionPayType,
                'bonus_type' => $bonusType,
                'invite_user_id' => $inviteUserId
            )
        );
        $ci->common_model->customInsert($options);
        $options = array(
            'table' => 'notifications',
            'data' => array(
                'user_id' => $uid,
                'type_id' => 0,
                'sender_id' => 1,
                'noti_type' => 'USER_CREDIT_CHIP',
                'message' => $notificationMessage,
                'read_status' => 'NO',
                'sent_time' => date('Y-m-d H:i:s'),
                'user_type' => 'USER'
            )
        );
        $ci->common_model->customInsert($options);
        return true;
    }

}

/**
 * [Fantasy modules Dynamic input]
 */
if (!function_exists('walletAddAmount')) {

    function walletAddAmount($uid, $cash) {
        $ci = get_instance();
        $options = array(
            'table' => 'wallet',
            'select' => '*',
            'where' => array('user_id' => $uid),
            'single' => true
        );
        $UserCash = $ci->common_model->customGet($options);
        if (!empty($UserCash)) {
            $purchase_amount = abs($UserCash->purchase_amount) + abs($cash);
            $total_amount_due = abs($UserCash->total_amount_due) + abs($cash);
            $optionsCash = array(
                'table' => 'wallet',
                'data' => array('purchase_amount' => $purchase_amount,
                    'total_amount_due' => $total_amount_due),
                'where' => array('user_id' => $uid),
                'update_date' => date('Y-m-d H:i:s')
            );
            $ci->common_model->customUpdate($optionsCash);
        } else {
            $optionsCash = array(
                'table' => 'wallet',
                'data' => array('purchase_amount' => $cash,
                    'total_amount_due' => $cash,
                    'user_id' => $uid,
                    'create_date' => date('Y-m-d H:i:s')),
            );
            $ci->common_model->customInsert($optionsCash);
        }
        return true;
    }

}
if (!function_exists('walletDepositAmount')) {

    function walletDepositAmount($uid, $cash) {
        $ci = get_instance();
        $options = array(
            'table' => 'wallet',
            'select' => '*',
            'where' => array('user_id' => $uid),
            'single' => true
        );
        $UserCash = $ci->common_model->customGet($options);
        if (!empty($UserCash)) {
            $deposit_amount = abs($UserCash->deposit_amount) + abs($cash);
            $total_amount_due = abs($UserCash->total_amount_due) - abs($cash);
            $optionsCash = array(
                'table' => 'wallet',
                'data' => array('deposit_amount' => $deposit_amount,
                    'total_amount_due' => abs($total_amount_due)),
                'where' => array('user_id' => $uid),
                'update_date' => date('Y-m-d H:i:s')
            );
            $update = $ci->common_model->customUpdate($optionsCash);
            if ($update) {
                /* To Admin Notification Insert */
                $options = array(
                    'table' => 'users',
                    'select' => 'first_name,last_name,email',
                    'where' => array('id' => $uid),
                    'single' => true
                );
                $user = $ci->common_model->customGet($options);
                if (!empty($user)) {
                    $message = $user->first_name . ' ' . $user->last_name . " have done pay amount of Rs.$deposit_amount";
                } else {
                    $message = "The new amount deposited Rs.$deposit_amount";
                }
                $options = array(
                    'table' => 'notifications',
                    'data' => array(
                        'user_id' => 1,
                        'type_id' => 0,
                        'sender_id' => $uid,
                        'noti_type' => 'PAYMENT_DEPOSIT',
                        'message' => $message,
                        'read_status' => 'NO',
                        'sent_time' => date('Y-m-d H:i:s'),
                        'user_type' => 'ADMIN'
                    )
                );
                $ci->common_model->customInsert($options);
                return $total_amount_due;
            } else {
                return false;
            }
        }
        return false;
    }

}
if (!function_exists('WelcomecashBonusWalletCalculate')) {

    function WelcomecashBonusWalletCalculate($uid, $cash, $trasactionMessage = "", $notificationMessage = "", $transactionPayType = "", $bonusType = "", $inviteUserId = 0) {
        $ci = get_instance();
        $opening_balance = 0;
        $cr = 0;
        $available_balance = 0;
        $orderId = generateToken(6);
        $options = array(
            'table' => 'wallet',
            'select' => '*',
            'where' => array('user_id' => $uid),
            'single' => true
        );
        $UserCash = $ci->common_model->customGet($options);
        //dump($UserCash);
        if (!empty($UserCash)) {
            $bonus_cash = abs($UserCash->cash_bonus_amount) + abs($cash);
            $totalCash = abs($UserCash->total_balance) + abs($cash);
            $opening_balance = $UserCash->total_balance;
            $cr = $cash;
            $available_balance = $totalCash;
            $optionsCash = array(
                'table' => 'wallet',
                'data' => array('cash_bonus_amount' => $bonus_cash,
                    'total_balance' => $totalCash, 'is_welcome_bonus' => 1),
                'where' => array('user_id' => $uid),
                'update_date' => date('Y-m-d H:i:s')
            );
            $ci->common_model->customUpdate($optionsCash);
        } else {
            $cr = $cash;
            $available_balance = $cash;
            $optionsCash = array(
                'table' => 'wallet',
                'data' => array('deposited_amount' => $cash,
                    'total_balance' => $cash,
                    'user_id' => $uid,
                    'is_welcome_bonus' => 1,
                    'create_date' => date('Y-m-d H:i:s')),
            );
            $ci->common_model->customInsert($optionsCash);
        }
        /* To Transaction History Insert */

        $options = array(
            'table' => 'transactions_history',
            'data' => array(
                'user_id' => $uid,
                'match_id' => 0,
                'opening_balance' => $opening_balance,
                'cr' => $cr,
                'orderId' => $orderId,
                'available_balance' => $available_balance,
                'message' => $trasactionMessage,
                'datetime' => date('Y-m-d H:i:s'),
                'transaction_type' => 'CASH',
                'pay_type' => $transactionPayType,
                'bonus_type' => $bonusType,
                'invite_user_id' => $inviteUserId
            )
        );

        $ci->common_model->customInsert($options);
        $options = array(
            'table' => 'notifications',
            'data' => array(
                'user_id' => $uid,
                'type_id' => 0,
                'sender_id' => 1,
                'noti_type' => 'USER_CASH_BONUS',
                'message' => $notificationMessage,
                'read_status' => 'NO',
                'sent_time' => date('Y-m-d H:i:s'),
                'user_type' => 'USER'
            )
        );
        $ci->common_model->customInsert($options);
        cashWalletReports($uid, $cash, $transactionPayType);
        return true;
    }

}
/**
 * [Welcome bonus first time verify all account Email, Pan, Mobile, AAdhar Card Number]
 */
if (!function_exists('welcomeBonusVerified')) {

    function welcomeBonusVerified($uid) {
        $ci = get_instance();
        $option = array('table' => 'users as USR',
            'select' => 'USR.id as user_id,USR.created_date as regis_date,USR.email_verify_date as email_verify_date,USR.email_verify,USR.verify_mobile_date as verify_mobile_date,USR.verify_mobile,USR.ip_address,USR.device_id',
            //'join' => array('user_pan_card as UPC' => 'UPC.user_id=USR.id'),
            'where' => array('USR.id' => $uid, 'USR.email_verify' => 1,
                'USR.verify_mobile' => 1),
            'single' => true
        );
        $userData = $ci->common_model->customGet($option);

        //dump($userData);
        if (!empty($userData)) {


            $options = array(
                'table' => 'wallet',
                'select' => 'is_welcome_bonus',
                'where' => array('user_id' => $uid),
                'single' => true
            );
            $isWelcome = $ci->common_model->customGet($options);
            if (!empty($isWelcome)) {
                if ($isWelcome->is_welcome_bonus == 1) {
                    return true;
                }
            }

            $ip_address = $userData->ip_address;
            $device_id = $userData->device_id;

            $userIPAdd = "";
            if ($ip_address != "") {

                $options = array('table' => 'users as USER',
                    'select' => 'USER.id as user_id',
                    'where' => array('USER.id !=' => $uid, 'USER.ip_address' => $ip_address),
                        //'or_where'=>array('USER.device_id'=>$device_id)
                );
                $userIPAdd = $ci->common_model->customGet($options);
            }

            $userDevAdd = "";
            if ($userDevAdd != "") {
                $options = array('table' => 'users as USER',
                    'select' => 'USER.id as user_id',
                    'where' => array('USER.id !=' => $uid, 'USER.device_id' => $device_id),
                        //'or_where'=>array('USER.device_id'=>$device_id)
                );
                $userDevAdd = $ci->common_model->customGet($options);
            }

            $regis_date = date('Y-m-d', strtotime($userData->regis_date));
            $email_verify_date = date('Y-m-d', strtotime($userData->email_verify_date));
            $verify_mobile_date = date('Y-m-d', strtotime($userData->verify_mobile_date));
            if (empty($userDevAdd) && empty($userIPAdd)) {
                if ($regis_date == $email_verify_date && $regis_date == $verify_mobile_date) {
                    $trasactionMessage = "To Get Welcome Bonus Cash ";
                    $notificationMessage = "Conguratilation! Cash credit of 50 has been added to your cash bonus wallet as a welcome bonus";

                    WelcomecashBonusWalletCalculate($uid, 50, $trasactionMessage, $notificationMessage, 'BONUS', 'WELCOME');

                    referralSchemeCashBonus($uid);
                }
            }
        }
        return true;
    }

}
/**
 * [If the player has credit balance then system will automatically take 5% from playwinfantsy chips account]
 */
if (!function_exists('accountPolicyCreditChip')) {

    function accountPolicyCreditChip($uid, $chip) {
        /* $trasactionMessage = "To Get Bonus playwinfantasy chip Every Cash Credit Transaction";
          $notificationMessage = "Conguratilation! Chip credit of $chip has been added to your playwinfantasy chip wallet as a cash credit transaction bonus";
          userChipWalletCalculate($uid, $chip, $trasactionMessage, $notificationMessage, 'BONUS'); */
        return true;
    }

}

/**
 * [Fantasy modules Dynamic input]
 */
/** cashType = DEBIT,CREDIT,WINNING,BONUS,WITHDRAWAL  * */
if (!function_exists('cashWalletReports')) {

    function cashWalletReports($uid, $cash, $cashType) {
        $ci = get_instance();
        $opening_balance = 0;
        $cr = 0;
        $available_balance = 0;
        $options = array(
            'table' => 'user_cash_reports',
            'select' => '*',
            'where' => array('user_id' => $uid),
            'single' => true
        );
        $UserCash = $ci->common_model->customGet($options);
        if (!empty($UserCash)) {
            $data = array();
            if ($cashType == "DEBIT") {
                $data['total_debit_cash'] = abs($UserCash->total_debit_cash) + abs($cash);
            } elseif ($cashType == "CREDIT") {
                $data['total_credit_cash'] = abs($UserCash->total_credit_cash) + abs($cash);
            } elseif ($cashType == "WINNING") {
                $data['total_winning_cash'] = abs($UserCash->total_winning_cash) + abs($cash);
            } elseif ($cashType == "BONUS") {
                $data['total_bonus_cash'] = abs($UserCash->total_bonus_cash) + abs($cash);
            } elseif ($cashType == "WITHDRAWAL") {
                $data['total_withdrawal_cash'] = abs($UserCash->total_withdrawal_cash) + abs($cash);
            } elseif ($cashType == "REFUND") {
                $data['total_refund_amount'] = abs($UserCash->total_refund_amount) + abs($cash);
            }
            if (!empty($data)) {
                $optionsCash = array(
                    'table' => 'user_cash_reports',
                    'data' => $data,
                    'where' => array('user_id' => $uid)
                );
                $ci->common_model->customUpdate($optionsCash);
            }
            return true;
        } else {
            $data = array('user_id' => $uid);
            if ($cashType == "DEBIT") {
                $data['total_debit_cash'] = abs($cash);
            } elseif ($cashType == "CREDIT") {
                $data['total_credit_cash'] = abs($cash);
            } elseif ($cashType == "WINNING") {
                $data['total_winning_cash'] = abs($cash);
            } elseif ($cashType == "BONUS") {
                $data['total_bonus_cash'] = abs($cash);
            } elseif ($cashType == "WITHDRAWAL") {
                $data['total_withdrawal_cash'] = abs($cash);
            } elseif ($cashType == "REFUND") {
                $data['total_refund_amount'] = abs($cash);
            }
            if (!empty($data)) {
                $optionsCash = array(
                    'table' => 'user_cash_reports',
                    'data' => $data
                );
                $ci->common_model->customInsert($optionsCash);
            }
            return true;
        }
        return true;
    }

}

/**
 * [REFERENCE SCHEME]
 */
if (!function_exists('referralSchemeCashBonus')) {

    function referralSchemeCashBonus($invite_user_id) {
        $ci = get_instance();
        $option = array('table' => 'user_referrals as UR',
            'select' => 'UR.*,USR.device_type',
            'join' => array(array('users as USR' => 'USR.id=UR.invite_user_id'),
                array(USER_GROUPS . ' as ugroup', 'ugroup.user_id=UR.user_id', 'inner'),
            ),
            'where' => array('UR.invite_user_id' => $invite_user_id),
            'where_not_in' => array('ugroup.group_id' => 3),
        );
        $userData = $ci->common_model->customGet($option);
        //dump($userData);
        if (!empty($userData)) {
            foreach ($userData as $rows) {
                $uId = $rows->user_id;
                $inviteUserId = $rows->invite_user_id;
                $referral_total_chip = $rows->referral_total_chip;
                $referral_total_cash_bonus = $rows->referral_total_cash_bonus;
                $is_verify_account = $rows->is_verify_account;
                $is_app_download = $rows->is_app_download;
                $options = array(
                    'table' => 'user_cash_reports',
                    'select' => 'total_credit_cash',
                    'where' => array('user_id' => $inviteUserId),
                    'single' => true
                );
                $UserCash = $ci->common_model->customGet($options);

                /* if (!empty($UserCash)) {
                  // Your first installment of playwinfantasy chips shall be pay only after your friend cross the total play of Rs. 400/- to join cash contest.
                  //if ($UserCash->total_credit_cash >= 400) {
                  // $option = array('table' => 'users as USR',
                  //     'select' => 'USR.id as user_id,USR.email_verify,USR.verify_mobile,UPC.verification_status as pan_status',
                  //     'join' => array('user_pan_card as UPC' => 'UPC.user_id=USR.id'),
                  //     'where' => array('USR.id' => $inviteUserId, 'USR.email_verify' => 1,
                  //         'USR.verify_mobile' => 1, 'UPC.verification_status' => 2));

                  $option = array('table' => 'users as USR',
                  'select' => 'USR.id as user_id,USR.email_verify,USR.verify_mobile',
                  'where' => array('USR.id' => $inviteUserId, 'USR.email_verify' => 1,
                  'USR.verify_mobile' => 1));

                  $invitedUserVerification = $ci->common_model->customGet($option);


                  if (!empty($invitedUserVerification)) {
                  // Your account shall be credited with Rs. 50 Cash chips once your friend verify his pan card and aadhar card
                  if ($is_verify_account != 1) {
                  $trasactionMessage = "To Get Referral Cash Bonus Verify Account";
                  $notificationMessage = "Conguratilation! Cash credit of 50 has been added to your cash bonus wallet as a Referral scheme verified account";
                  cashBonusWalletCalculate($uId, 50, $trasactionMessage, $notificationMessage, 'BONUS', 'VERIFIED', $inviteUserId);
                  $option = array('table' => 'user_referrals',
                  'data' => array('is_verify_account' => 1,
                  'referral_total_cash_bonus' => abs($referral_total_cash_bonus) + 50),
                  'where' => array('id' => $rows->id)
                  );
                  $ci->common_model->customUpdate($option);
                  }
                  }
                  //}
                  } */
                /** app download cash bonus scheme * */
                /** Your accouns shall be credited with additional Rs. 50 once your friend download app * */
                $appDevice = $rows->device_type;
                if ($appDevice == "ANDROID" || $appDevice == "IOS") {

                    $option = array('table' => 'users as USR',
                        'select' => 'USR.id as user_id,USR.email_verify,USR.verify_mobile,UPC.verification_status as pan_status,USR.created_date as user_date,UPC.create_date as user_pan_date',
                        'join' => array(
                            array('user_pan_card as UPC' => 'UPC.user_id=USR.id')),
                        //  array('user_aadhar_card as UAC' => 'UAC.user_id=USR.id')),
                        'where' => array('USR.id' => $inviteUserId, 'USR.email_verify' => 1,
                            'USR.verify_mobile' => 1, 'UPC.verification_status' => 2),
                        //'UAC.verification_status' => 2),
                        'single' => true,
                    );

                    /* $option = array('table' => 'users as USR',
                      'select' => 'USR.id as user_id,USR.email_verify,USR.verify_mobile',
                      'where' => array('USR.id' => $inviteUserId, 'USR.email_verify' => 1,
                      'USR.verify_mobile' => 1)); */
                    $invitedUserVerificationPAN = $ci->common_model->customGet($option);
                    //echo $ci->db->last_query();
                    //dump($invitedUserVerification);

                    if (!empty($invitedUserVerificationPAN)) {

                        /* $user_date = date('Y-m-d',strtotime($invitedUserVerificationPAN->user_date));
                          $user_pan_date = date('Y-m-d',strtotime($invitedUserVerificationPAN->user_pan_date));

                          $new_user_date = date('Y-m-d', strtotime('+3 day', strtotime($user_date)));

                          if($user_date==$user_pan_date ){ */

                        $trasactionMessage = "To Get Referral Cash Bonus App Download For PAN Card";
                        $notificationMessage = "Conguratulation! Cash credit of 50 has been added to your cash bonus wallet as a Referral scheme app download";

                        $option = array('table' => 'transactions_history',
                            'where' => array('user_id' => $uId, 'invite_user_id' => $inviteUserId, 'message' => trim($trasactionMessage)),
                            'single' => true
                        );
                        $existsPANBounus = $ci->common_model->customGet($option);
                        if (empty($existsPANBounus)) {

                            cashBonusWalletCalculate($uId, 50, $trasactionMessage, $notificationMessage, 'BONUS', 'APP_DOWNLOAD', $inviteUserId);
                            $option = array('table' => 'user_referrals',
                                'where' => array('id' => $rows->id),
                                'single' => true
                            );
                            $existsBounus = $ci->common_model->customGet($option);
                            $option = array('table' => 'user_referrals',
                                'data' => array('is_app_download' => 1,
                                    'referral_total_cash_bonus' => abs($existsBounus->referral_total_cash_bonus) + 50),
                                'where' => array('id' => $rows->id)
                            );
                            $ci->common_model->customUpdate($option);
                        }
                        //}   
                    }

                    $option = array('table' => 'users as USR',
                        'select' => 'USR.id as user_id,USR.email_verify,USR.verify_mobile,UAC.verification_status as aadhar_status,USR.created_date as user_date,UAC.create_date as user_aadhar_date',
                        'join' => array(
                            // array('user_pan_card as UPC' => 'UPC.user_id=USR.id'),
                            array('user_aadhar_card as UAC' => 'UAC.user_id=USR.id')),
                        'where' => array('USR.id' => $inviteUserId, 'USR.email_verify' => 1,
                            'USR.verify_mobile' => 1, 'UAC.verification_status' => 2),
                        //'UPC.verification_status' => 2),
                        'single' => true,
                    );

                    $invitedUserVerificationAadhar = $ci->common_model->customGet($option);
                    if (!empty($invitedUserVerificationAadhar)) {
                        /* $user_date = date('Y-m-d',strtotime($invitedUserVerificationAadhar->user_date));
                          $user_aadhar_date = date('Y-m-d',strtotime($invitedUserVerificationAadhar->user_aadhar_date));

                          if( $user_date==$user_aadhar_date){ */

                        $trasactionMessage = "To Get Referral Cash Bonus App Download For Aadhar Card";
                        $notificationMessage = "Conguratulation! Cash credit of 50 has been added to your cash bonus wallet as a Referral scheme app download";

                        $option = array('table' => 'transactions_history',
                            'where' => array('user_id' => $uId, 'invite_user_id' => $inviteUserId, 'message' => trim($trasactionMessage)),
                            'single' => true
                        );
                        $existsPANBounus = $ci->common_model->customGet($option);
                        if (empty($existsPANBounus)) {

                            cashBonusWalletCalculate($uId, 50, $trasactionMessage, $notificationMessage, 'BONUS', 'APP_DOWNLOAD', $inviteUserId);
                            $option = array('table' => 'user_referrals',
                                'where' => array('id' => $rows->id),
                                'single' => true
                            );
                            $existsBounus = $ci->common_model->customGet($option);
                            $option = array('table' => 'user_referrals',
                                'data' => array('is_app_download' => 1,
                                    'referral_total_cash_bonus' => abs($existsBounus->referral_total_cash_bonus) + 50),
                                'where' => array('id' => $rows->id)
                            );
                            $ci->common_model->customUpdate($option);
                        }
                        // }   
                    }
                }
            }
            return true;
        }
        return true;
    }

}

/**
 * [REFERENCE SCHEME]
 */
if (!function_exists('referralSchemeEveryCreditBonus')) {

    function referralSchemeEveryCreditBonus($invite_user_id, $creditCash) {
        $ci = get_instance();
        $option = array('table' => 'user_referrals as UR',
            'select' => 'UR.*',
            'join' => array('users as USR' => 'USR.id=UR.invite_user_id'),
            'where' => array('UR.invite_user_id' => $invite_user_id),
            'single' => true
        );
        $userData = $ci->common_model->customGet($option);
        //dump($userData);
        if (!empty($userData)) {
            $inviteUserId = $userData->invite_user_id;
            $uId = $userData->user_id;
            $options = array(
                'table' => 'user_cash_reports',
                'select' => 'total_credit_cash',
                'where' => array('user_id' => $inviteUserId),
                'single' => true
            );
            $UserCash = $ci->common_model->customGet($options);
            if (!empty($UserCash)) {
                /** Your first installment of playwinfantasy chips shall be pay only after your friend cross the total play of Rs. 400/- to join cash contest. * */
                //if ($UserCash->total_credit_cash >= 400 && $UserCash->total_credit_cash <= 5000) {
                if ($UserCash->total_credit_cash <= 5000) {
                    $chipBonus = ($creditCash / 4);
                    $trasactionMessage = "To Get Referral Bonus playwinfantasy chip Every Cash Credit";
                    $notificationMessage = "Conguratilation! Chip credit of $chipBonus has been added to your playwinfantasy chip wallet as a cash referral credit bonus";
                    userChipWalletCalculate($uId, $chipBonus, $trasactionMessage, $notificationMessage, "BONUS", "EVERY_CREDIT", $inviteUserId);
                    $option = array('table' => 'user_referrals',
                        'data' => array('referral_total_chip' => abs($userData->referral_total_chip) + $chipBonus),
                        'where' => array('id' => $userData->id)
                    );
                    $ci->common_model->customUpdate($option);
                    if ($userData->is_verify_account == 1 && $userData->is_app_download == 1 && $userData->is_remove_chip != 1) {
                        $option = array('table' => 'user_referrals as UR',
                            'select' => 'UR.*',
                            'join' => array('users as USR' => 'USR.id=UR.invite_user_id'),
                            'where' => array('UR.id' => $userData->id),
                            'single' => true
                        );
                        $checkReferralChip = $ci->common_model->customGet($option);
                        if ($checkReferralChip->referral_total_chip >= 100) {
                            $option = array('table' => 'user_referrals',
                                'data' => array('referral_total_chip' => abs($checkReferralChip->referral_total_chip) - abs($userData->referral_total_cash_bonus),
                                    'is_remove_chip' => 1),
                                'where' => array('id' => $userData->id)
                            );
                            $ci->common_model->customUpdate($option);
                            /* $option = array('table' => 'user_chip',
                              'data' => array('bonus_chip' => "bonus_chip - ".$userData->referral_total_cash_bonus."",
                              'chip' => "chip - ".$userData->referral_total_cash_bonus.""),
                              'where' => array('user_id' => $uId)); */
                            $sql = "UPDATE `user_chip` SET `bonus_chip` = `bonus_chip` - $userData->referral_total_cash_bonus, `chip` = `chip` - $userData->referral_total_cash_bonus WHERE `user_id` = $uId";
                            $ci->common_model->customQuery($sql, false, true);
                        }
                    }
                }
            }
            return true;
        }
        return true;
    }

}

/**
 * [To get offsets]
 * @param  [int] $page_no
 */
if (!function_exists('get_offsets')) {

    function get_offsets($page_no = 0) {
        $offset = ($page_no == 0) ? 0 : (int) $page_no * 20 - 20;
        return $offset;
    }

}

/**
 * [Fantasy Point Dynamic input]
 */
if (!function_exists('predictionQuestion')) {

    function predictionQuestion() {
        $inputField = array();
        $inputField['total_run_scored_by_opening_team'] = "Total Run scored by opening team";
        $inputField['win_by_wicket'] = "Team win by how many wickets";
        $inputField['win_by_runs'] = "Team win by how many runs";
        $inputField['maximum_six_by_plyer'] = "Maximum six by which batsman";
        $inputField['maximum_four_by_player'] = "Maximum Four by which batsman";
        $inputField['maximum_wicket_by_plyer'] = "Maximum wickets by which baller";
        $inputField['total_clean_bold_wicket'] = "Total clean bold wickets for the day";
        $inputField['man_of_the_match'] = "Man of the Match";
        $inputField['total_number_of_catch_out_for_the_day'] = "Total Number of catch out for the day";
        $inputField['winner_team_of_the_day'] = "Winner Team of the day";


        return $inputField;
    }

}

/**
 * [Fantasy Point Dynamic input]
 */
if (!function_exists('predictionQuestionGetAnswer')) {

    function predictionQuestionGetAnswer($matchId, $key) {
        $ci = get_instance();
        $option = array('table' => 'prediction_question_answer',
            'where' => array('question_key' => $key, 'match_id' => $matchId),
            'single' => true,
        );
        $is_result = $ci->common_model->customGet($option);
        if (!empty($is_result)) {
            return $is_result->question_value;
        } else {
            return false;
        }
    }

}

/**
 * [Fantasy modules Dynamic input]
 */
/** cashType = DEBIT,CREDIT,WINNING,BONUS,WITHDRAWAL  * */
if (!function_exists('toCheckWithdrawalPerDay')) {

    function toCheckWithdrawalPerDay($uid) {
        $ci = get_instance();
        $options = array(
            'table' => 'transactions_history',
            'select' => 'SUM(cr) as totalDeposit',
            'where' => array('user_id' => $uid,
                'transaction_type' => 'CASH',
                'pay_type' => 'DEPOSIT',
                'DATE(datetime)' => date('Y-m-d')
            ),
            'single' => true
        );
        return $ci->common_model->customGet($options);
    }

}

/**
 * [Fantasy Point Dynamic input]
 */
if (!function_exists('toCheckWinLose')) {

    function toCheckWinLose($contestId) {
        $ci = get_instance();
        $option = array('table' => 'user_team_rank',
            'select' => 'winning_amount',
            'where' => array('contest_id' => $contestId, 'winning_amount' => 0)
        );
        $loseUser = $ci->common_model->customCount($option);
        $option = array('table' => 'user_team_rank',
            'select' => 'winning_amount',
            'where' => array('contest_id' => $contestId, 'winning_amount >' => 0)
        );
        $winUser = $ci->common_model->customCount($option);
        return $winUser . ' W / ' . $loseUser . ' L';
    }

}

/**
 * [Fantasy Point Dynamic input]
 */
if (!function_exists('toUserCheckWinLose')) {

    function toUserCheckWinLose($contestId, $userId) {
        $ci = get_instance();
        $option = array('table' => 'user_team_rank',
            'select' => 'winning_amount',
            'where' => array('contest_id' => $contestId, 'user_id' => $userId),
            'single' => true
        );
        $userRecord = $ci->common_model->customGet($option);
        $status = 'N/A';
        if (!empty($userRecord)) {
            if ($userRecord->winning_amount > 0) {
                $status = 'WIN';
            } else {
                $status = 'LOSE';
            }
        }
        return $status;
    }

}

/**
 * [Fantasy Point Dynamic input]
 */
if (!function_exists('toUserWinnerAmount')) {

    function toUserWinnerAmount($contestId, $userId) {
        $ci = get_instance();
        $option = array('table' => 'user_team_rank',
            'select' => 'winning_amount',
            'where' => array('contest_id' => $contestId, 'user_id' => $userId),
            'single' => true
        );
        $userRecord = $ci->common_model->customGet($option);
        $status = 0;
        if (!empty($userRecord)) {
            $status = $userRecord->winning_amount;
        }
        return $status;
    }

}

/**
 * [Fantasy Point Dynamic input]
 */
if (!function_exists('toCheckLiveMatch')) {

    function toCheckLiveMatch($matchId) {
        $ci = get_instance();
        $options = array(
            'table' => 'matches',
            'where' => array('status' => 'open', 'match_id' => $matchId),
        );
        $UtcDateTime1 = trim(ISTToConvertUTC(date('Y-m-d H:i'), 'UTC', 'UTC'));
        $options['where']['match_date_time <='] = $UtcDateTime1;
        $userRecord = $ci->common_model->customGet($options);
        if (!empty($userRecord)) {
            return true;
        }
        return false;
    }

}

/**
 * [Fantasy modules Dynamic input]
 */
if (!function_exists('refundCashWalletCalculate')) {

    function refundCashWalletCalculate($uid, $contest_id, $match_id, $orderId, $deposit_cr, $winning_cr, $bonus_cr, $trasactionMessage = "", $notificationMessage = "", $transactionPayType = "") {
        //echo $trasactionMessage;die;
        $ci = get_instance();
        $options = array(
            'table' => 'users',
            'select' => '*',
            'where' => array('id' => $uid),
            'single' => true
        );
        $users = $ci->common_model->customGet($options);
        if (!empty($users)) {

            $opening_balance = 0;
            $cr = 0;
            $available_balance = 0;
            $options = array(
                'table' => 'wallet',
                'select' => '*',
                'where' => array('user_id' => $uid),
                'single' => true
            );
            $UserCash = $ci->common_model->customGet($options);
            //$cash = abs($deposit_cr) + abs($winning_cr) + abs($bonus_cr);
            $cash = abs($deposit_cr) + abs($winning_cr);
            if (!empty($UserCash)) {
                $deposited_amount = abs($UserCash->deposited_amount) + abs($deposit_cr);
                $winning_amount = abs($UserCash->winning_amount) + abs($winning_cr);
                $cash_bonus_amount = abs($UserCash->cash_bonus_amount) + abs($bonus_cr);

                $totalCash = abs($UserCash->total_balance) + abs($cash);
                $opening_balance = $UserCash->total_balance;
                $cr = $cash;
                $available_balance = $totalCash;
                $optionsCash = array(
                    'table' => 'wallet',
                    'data' => array('deposited_amount' => $deposited_amount,
                        'winning_amount' => $winning_amount,
                        'cash_bonus_amount' => $cash_bonus_amount,
                        'total_balance' => $totalCash),
                    'where' => array('user_id' => $uid),
                    'update_date' => date('Y-m-d H:i:s')
                );
                $ci->common_model->customUpdate($optionsCash);
            } else {
                $cr = $cash;
                $available_balance = $cash;
                $optionsCash = array(
                    'table' => 'wallet',
                    'data' => array('deposited_amount' => $deposited_amount,
                        'winning_amount' => $winning_amount,
                        'cash_bonus_amount' => $cash_bonus_amount,
                        'total_balance' => $cash,
                        'user_id' => $uid,
                        'create_date' => date('Y-m-d H:i:s')),
                );
                $ci->common_model->customInsert($optionsCash);
            }
            /* To Transaction History Insert for cash */
            $options = array(
                'table' => 'transactions_history',
                'data' => array(
                    'user_id' => $uid,
                    'match_id' => $match_id,
                    'contest_id' => $contest_id,
                    'opening_balance' => $opening_balance,
                    'cr' => $cr,
                    'orderId' => $orderId,
                    'available_balance' => $available_balance,
                    'message' => $trasactionMessage,
                    'datetime' => date('Y-m-d H:i:s'),
                    'transaction_type' => 'CASH',
                    'pay_type' => $transactionPayType
                )
            );
            $ci->common_model->customInsert($options);
            /* To Transaction History Insert for cash */
            if (!empty($UserCash)) {

                /* To Transaction History Insert for cash bonus */
                $options = array(
                    'table' => 'transactions_history',
                    'data' => array(
                        'user_id' => $uid,
                        'match_id' => $match_id,
                        'contest_id' => $contest_id,
                        'opening_balance' => $UserCash->cash_bonus_amount,
                        'cr' => $bonus_cr,
                        'orderId' => $orderId,
                        'available_balance' => $cash_bonus_amount,
                        'message' => $trasactionMessage,
                        'datetime' => date('Y-m-d H:i:s'),
                        'transaction_type' => 'CASH',
                        'pay_type' => 'BONUS'
                    )
                );
                $ci->common_model->customInsert($options);
            }
            /* To Transaction History Insert for cash bonus */
            $options = array(
                'table' => 'notifications',
                'data' => array(
                    'user_id' => $uid,
                    'type_id' => 0,
                    'sender_id' => 1,
                    'noti_type' => 'USER_CASH_REFUND',
                    'message' => $notificationMessage,
                    'read_status' => 'NO',
                    'sent_time' => date('Y-m-d H:i:s'),
                    'user_type' => 'USER'
                )
            );
            $ci->common_model->customInsert($options);
            $options = array(
                'table' => 'notifications',
                'data' => array(
                    'user_id' => 1,
                    'type_id' => $contest_id,
                    'sender_id' => $uid,
                    'noti_type' => 'USER_CASH_REFUND',
                    'message' => $notificationMessage,
                    'read_status' => 'NO',
                    'sent_time' => date('Y-m-d H:i:s'),
                    'user_type' => 'ADMIN'
                )
            );
            $ci->common_model->customInsert($options);
            /** to send push notification * */
            $notificationData = array(
                'title' => 'Refund Amount',
                'message' => $notificationMessage,
                'type' => "USER_CASH_REFUND",
                'type_id' => $contest_id,
                'user_id' => $uid,
                'badges' => 0,
            );
            sendNotification($uid, $notificationData);
            cashWalletReports($uid, $cash, "REFUND");
            return true;
        }
        return true;
    }

}
if (!function_exists('refundCashWalletCalculateOLD')) {

    function refundCashWalletCalculateOLD($uid, $contest_id, $match_id, $orderId, $cash, $trasactionMessage = "", $notificationMessage = "", $transactionPayType = "") {
        $ci = get_instance();
        $options = array(
            'table' => 'users',
            'select' => '*',
            'where' => array('id' => $uid),
            'single' => true
        );
        $users = $ci->common_model->customGet($options);
        if (!empty($users)) {

            $opening_balance = 0;
            $cr = 0;
            $available_balance = 0;
            $options = array(
                'table' => 'wallet',
                'select' => '*',
                'where' => array('user_id' => $uid),
                'single' => true
            );
            $UserCash = $ci->common_model->customGet($options);
            if (!empty($UserCash)) {
                $deposited_amount = abs($UserCash->deposited_amount) + abs($cash);
                $totalCash = abs($UserCash->total_balance) + abs($cash);
                $opening_balance = $UserCash->total_balance;
                $cr = $cash;
                $available_balance = $totalCash;
                $optionsCash = array(
                    'table' => 'wallet',
                    'data' => array('deposited_amount' => $deposited_amount,
                        'total_balance' => $totalCash),
                    'where' => array('user_id' => $uid),
                    'update_date' => date('Y-m-d H:i:s')
                );
                $ci->common_model->customUpdate($optionsCash);
            } else {
                $cr = $cash;
                $available_balance = $cash;
                $optionsCash = array(
                    'table' => 'wallet',
                    'data' => array('deposited_amount' => $cash,
                        'total_balance' => $cash,
                        'user_id' => $uid,
                        'create_date' => date('Y-m-d H:i:s')),
                );
                $ci->common_model->customInsert($optionsCash);
            }
            /* To Transaction History Insert */
            $options = array(
                'table' => 'transactions_history',
                'data' => array(
                    'user_id' => $uid,
                    'match_id' => $match_id,
                    'contest_id' => $contest_id,
                    'opening_balance' => $opening_balance,
                    'cr' => $cr,
                    'orderId' => $orderId,
                    'available_balance' => $available_balance,
                    'message' => $trasactionMessage,
                    'datetime' => date('Y-m-d H:i:s'),
                    'transaction_type' => 'CASH',
                    'pay_type' => $transactionPayType
                )
            );
            $ci->common_model->customInsert($options);
            $options = array(
                'table' => 'notifications',
                'data' => array(
                    'user_id' => $uid,
                    'type_id' => 0,
                    'sender_id' => 1,
                    'noti_type' => 'USER_CASH_REFUND',
                    'message' => $notificationMessage,
                    'read_status' => 'NO',
                    'sent_time' => date('Y-m-d H:i:s'),
                    'user_type' => 'USER'
                )
            );
            $ci->common_model->customInsert($options);
            $options = array(
                'table' => 'notifications',
                'data' => array(
                    'user_id' => 1,
                    'type_id' => $contest_id,
                    'sender_id' => $uid,
                    'noti_type' => 'USER_CASH_REFUND',
                    'message' => $notificationMessage,
                    'read_status' => 'NO',
                    'sent_time' => date('Y-m-d H:i:s'),
                    'user_type' => 'ADMIN'
                )
            );
            $ci->common_model->customInsert($options);
            /** to send push notification * */
            $notificationData = array(
                'title' => 'Refund Amount',
                'message' => $notificationMessage,
                'type' => "USER_CASH_REFUND",
                'type_id' => $contest_id,
                'user_id' => $uid,
                'badges' => 0,
            );
            sendNotification($uid, $notificationData);
            cashWalletReports($uid, $cash, "REFUND");
            return true;
        }
        return true;
    }

}

/**
 * [Fantasy modules Dynamic input]
 */
if (!function_exists('refundChipWalletCalculate')) {

    function refundChipWalletCalculate($uid, $contest_id, $match_id, $orderId, $cash, $trasactionMessage = "", $notificationMessage = "", $transactionPayType = "") {
        $ci = get_instance();
        $options = array(
            'table' => 'users',
            'select' => '*',
            'where' => array('id' => $uid),
            'single' => true
        );
        $users = $ci->common_model->customGet($options);
        if (!empty($users)) {
            $opening_balance = 0;
            $cr = 0;
            $available_balance = 0;
            $options = array(
                'table' => 'user_chip',
                'select' => '*',
                'where' => array('user_id' => $uid),
                'single' => true
            );
            $UserCash = $ci->common_model->customGet($options);
            if (!empty($UserCash)) {
                $bonus_chip = abs($UserCash->bonus_chip) + abs($cash);
                $totalCash = abs($UserCash->chip) + abs($cash);
                $opening_balance = $UserCash->chip;
                $cr = $cash;
                $available_balance = $totalCash;
                $optionsCash = array(
                    'table' => 'user_chip',
                    'data' => array('bonus_chip' => $bonus_chip,
                        'chip' => $totalCash),
                    'where' => array('user_id' => $uid),
                    'update_date' => date('Y-m-d H:i:s')
                );
                $ci->common_model->customUpdate($optionsCash);
            } else {
                $cr = $cash;
                $available_balance = $cash;
                $optionsCash = array(
                    'table' => 'user_chip',
                    'data' => array('bonus_chip' => $cash,
                        'chip' => $cash,
                        'user_id' => $uid,
                        'update_date' => date('Y-m-d H:i:s')),
                );
                $ci->common_model->customInsert($optionsCash);
            }
            /* To Transaction History Insert */
            $options = array(
                'table' => 'transactions_history',
                'data' => array(
                    'user_id' => $uid,
                    'match_id' => $match_id,
                    'contest_id' => $contest_id,
                    'opening_balance' => $opening_balance,
                    'cr' => $cr,
                    'orderId' => $orderId,
                    'available_balance' => $available_balance,
                    'message' => $trasactionMessage,
                    'datetime' => date('Y-m-d H:i:s'),
                    'transaction_type' => 'CHIP',
                    'pay_type' => $transactionPayType
                )
            );
            $ci->common_model->customInsert($options);
            $options = array(
                'table' => 'notifications',
                'data' => array(
                    'user_id' => $uid,
                    'type_id' => 0,
                    'sender_id' => 1,
                    'noti_type' => 'USER_CHIP_REFUND',
                    'message' => $notificationMessage,
                    'read_status' => 'NO',
                    'sent_time' => date('Y-m-d H:i:s'),
                    'user_type' => 'USER'
                )
            );
            $ci->common_model->customInsert($options);
            $options = array(
                'table' => 'notifications',
                'data' => array(
                    'user_id' => 1,
                    'type_id' => $contest_id,
                    'sender_id' => $uid,
                    'noti_type' => 'USER_CHIP_REFUND',
                    'message' => $notificationMessage,
                    'read_status' => 'NO',
                    'sent_time' => date('Y-m-d H:i:s'),
                    'user_type' => 'ADMIN'
                )
            );
            $ci->common_model->customInsert($options);
            /** to send push notification * */
            $notificationData = array(
                'title' => 'Refund Playwin fantasy Chip',
                'message' => $notificationMessage,
                'type' => "USER_CHIP_REFUND",
                'type_id' => $contest_id,
                'user_id' => $uid,
                'badges' => 0,
            );
            sendNotification($uid, $notificationData);
            return true;
        }
        return true;
    }

}

/**
 * [Refund amount if contest cancel]
 */
if (!function_exists('getCancelContest')) {

    function getCancelContest() {
        $ci = get_instance();
        $option = array('table' => 'contest',
            'select' => 'id',
            'where' => array('refund_status' => 0, 'delete_status' => 0),
            'where_in' => array('status' => array(1, 3))
        );
        $contestList = $ci->common_model->customGet($option);
        /*  $sql ="SELECT cont.id FROM `contest_matches` as CM Inner JOIN `contest` as cont on cont.id=CM.contest_id WHERE CM.`match_id` = 38768 and cont.status=2";
          $contestList = $ci->common_model->customQuery($sql); */
        //dump($contestList);
        foreach ($contestList as $contest) {
            cancelContestRefundAmount($contest->id);
        }
        return true;
    }

}

/**
 * [Refund amount if contest cancel]
 */
if (!function_exists('cancelContestRefundAmount')) {

    function cancelContestRefundAmount($contestId) {
        $ci = get_instance();
        $option = array('table' => 'join_contest as JC',
            'select' => 'CT.refund_status,JC.user_id,JC.contest_id,JC.joining_amount,JC.chip,JC.match_id,JC.team_id,CT.contest_name,JC.deposit_cr,JC.winning_cr,JC.bonus_cr',
            'join' => array('contest as CT' => 'CT.id=JC.contest_id'),
            'where' => array('JC.contest_id' => $contestId, 'CT.refund_status' => 0),
            'where_in' => array('CT.status' => array(1, 3))
        );
        $joinContestData = $ci->common_model->customGet($option);
        // dump($joinContestData);
        if (!empty($joinContestData)) {
            foreach ($joinContestData as $contest) {
                $uid = $contest->user_id;
                $cash = $contest->joining_amount;
                $chip = $contest->chip;
                $match_id = $contest->match_id;
                $contest_id = $contest->contest_id;
                $team_id = $contest->team_id;
                $contest_name = $contest->contest_name;
                $orderId = generateToken(6);
                $team_name = "";

                $options = array(
                    'table' => 'user_team',
                    'select' => 'id,name',
                    'where' => array('id' => $team_id,
                        'match_id' => $match_id,
                        'user_id' => $uid),
                    'single' => true
                );
                $isTeam = $ci->common_model->customGet($options);
                if (!empty($isTeam)) {
                    $team_name = $isTeam->name;
                }
                $optionsCash = array(
                    'table' => 'contest',
                    'data' => array('refund_status' => 1),
                    'where' => array('id' => $contest_id)
                );
                $ci->common_model->customUpdate($optionsCash);

                $options = array(
                    'table' => 'matches',
                    'select' => 'match_id,match_date_time,localteam,visitorteam,match_num',
                    'where' => array('status' => 'open',
                        'matches.play_status' => 1,
                        'match_id' => $match_id),
                    'single' => true
                );
                $matches_details = $ci->common_model->customGet($options);
                if (!empty($matches_details)) {
                    $localteam = $matches_details->localteam;
                    $visitorteam = $matches_details->visitorteam;
                    if (!empty($matches_details->match_num)) {
                        $match_num = $matches_details->match_num;
                    } else {
                        $match_num = "";
                    }
                    $full_match_name = ABRConvert($localteam) . ' VS ' . ABRConvert($visitorteam) . ' ' . $match_num;
                } else {
                    $full_match_name = "";
                }

                if ($cash > 0) {

                    $bonus_cr = $contest->bonus_cr;
                    $winning_cr = $contest->winning_cr;
                    $deposit_cr = $contest->deposit_cr;

                    $trasactionMessage = "Refund Cancelled contest $full_match_name – $contest_name / Trans ID $orderId";
                    $notificationMessage = "Cash credit of $cash has been added to your cash wallet as a cancel contest refund amount";
                    //refundCashWalletCalculate($uid, $contest_id, $match_id, $orderId, $cash, $trasactionMessage, $notificationMessage, 'REFUND');
                    refundCashWalletCalculate($uid, $contest_id, $match_id, $orderId, $deposit_cr, $winning_cr, $bonus_cr, $trasactionMessage, $notificationMessage, 'REFUND');
                    cancelContestCashMail($contest_id, $uid);
                }
                if ($chip > 0) {
                    $trasactionMessage = "Refund Cancelled contest $full_match_name – $contest_name / Trans ID $orderId";
                    $notificationMessage = "Playwin fantasy chip credit of $chip has been added to your chip wallet as a cancel contest refund chip";
                    refundChipWalletCalculate($uid, $contest_id, $match_id, $orderId, $chip, $trasactionMessage, $notificationMessage, 'REFUND');
                    cancelContestChipMail($contest_id, $uid);
                }
            }
        }
        return true;
    }

}


if (!function_exists('smsSendOld')) {

    function smsSendOld($postfields = array()) {

        /* $postfields = array('mobile' => "8236893792,9753589610",
          'message' => "Your playwinfantasy verification code is 758563",
          ); */

        /*
          login.bulksmsgateway.in/sendmessage.php?user=playwinfanta@2018&password=sonali123@&mobile=7415180860&message=hello priyanka&sender=PLYWIN&type=3 */


        if (empty($postfields)) {
            return false;
        }
        $postfields['sender'] = 'PLYWIN';
        $postfields['type'] = 3;
        $postfields['user'] = 'playwinfanta@2018';
        $postfields['password'] = 'sonali123@';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://login.bulksmsgateway.in/sendmessage.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // change to 1 to verify cert 
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_USERPWD, "playwinfanta@2018:sonali123@");
        $result = curl_exec($ch);
        if (!empty($result)) {
            $result = json_decode($result);
            if (isset($result->status) && $result->status == "success") {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
if (!function_exists('smsSend')) {

    function smsSend($postfields = array()) {

        if (empty($postfields)) {
            return false;
        }
        //print_r($postfields);die;
        $number = $postfields['mobile'];
        $text = $postfields['message'];

        /* $url = "http://roundsms.com/api/sendhttp.php?authkey=NGJhNjBiMWEyYTR&mobiles=$number&message=$text&sender=ROUSMS&type=1&route=2"; */
        $url = "login.bulksmsgateway.in/sendmessage.php?user=playwinfanta@2018&password=sonali123@&mobile=$number&message=$text&sender=PLYWIN&type=3";


        /*  $url = "http://websmsapp.in/api/mt/SendSMS?user=gharjaisakhanaa&password=9320274416@@&senderid=Criche&channel=Trans&DCS=0&flashsms=0&number=$number&text=$text&route=2"; */

        $url = str_replace(' ', '+', $url);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $result = curl_exec($ch);

        //echo $result->error;
        //print_r($result);die;
        if (!empty($result)) {

            $result = json_decode($result);

            if (isset($result->status) && $result->status == "success") {

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}

if (!function_exists('cancelContestCashMail')) {

    function cancelContestCashMail($contestId, $userId) {
        $ci = get_instance();

        $option = array('table' => 'join_contest as JC',
            'select' => 'CT.refund_status,JC.user_id,JC.contest_id,JC.joining_amount,JC.chip,JC.match_id,user.first_name,user.email,CT.contest_name,CT.user_invite_code,user.phone',
            'join' => array(array('contest as CT' => 'CT.id=JC.contest_id'),
                array('users as user' => 'user.id=JC.user_id')),
            'where' => array('JC.contest_id' => $contestId, 'JC.user_id' => $userId),
            'single' => true
        );
        $contestData = $ci->common_model->customGet($option);

        if (!empty($contestData)) {

            $contest_code = $contestData->user_invite_code;
            $user_name = $contestData->first_name;
            $cash = $contestData->joining_amount;
            $contest_name = $contestData->contest_name;
            $user_email = $contestData->email;
            $user_mobile = $contestData->phone;
            $flag = false;
            if (!empty($user_mobile) && $user_mobile != 'null') {

                $postfields = array('mobile' => $user_mobile,
                    'message' => "Refund of Rs.$cash has been credited to your Playwin Fantasy wallet of cancelled contest $contest_name.",
                );
                if (smsSend($postfields)) {
                    $flag = true;
                } else {
                    $flag = false;
                }
            }

            $html = array();
            $html['contest_code'] = $contest_code;
            $html['contest_name'] = $contest_name;
            $html['message'] = "Cash credit of $cash has been added to your cash wallet as a cancel contest refund amount";
            $html['logo'] = base_url() . getConfig('site_logo');
            $html['site'] = getConfig('site_name');
            $html['user'] = ucwords($user_name);
            $email_template = $ci->load->view('email/cancel_contest_tpl', $html, true);
            $status = send_mail($email_template, '[' . getConfig('site_name') . '] Cancel Contest', $user_email, getConfig('admin_email'));

            if ($status) {

                $flag = true;
            } else {
                $flag = false;
            }
            if ($flag) {
                return true;
            } else {
                return false;
            }
        }

        return true;
    }

}


if (!function_exists('cancelContestChipMail')) {

    function cancelContestChipMail($contestId, $userId) {
        $ci = get_instance();

        $option = array('table' => 'join_contest as JC',
            'select' => 'CT.refund_status,JC.user_id,JC.contest_id,JC.joining_amount,JC.chip,JC.match_id,user.first_name,user.email,CT.contest_name,CT.user_invite_code,user.phone',
            'join' => array(array('contest as CT' => 'CT.id=JC.contest_id'),
                array('users as user' => 'user.id=JC.user_id')),
            'where' => array('JC.contest_id' => $contestId, 'JC.user_id' => $userId),
            'single' => true
        );
        $contestData = $ci->common_model->customGet($option);

        if (!empty($contestData)) {

            $contest_code = $contestData->user_invite_code;
            $user_name = $contestData->first_name;
            $cash = $contestData->joining_amount;
            $contest_name = $contestData->contest_name;
            $user_email = $contestData->email;
            $chip = $contestData->chip;
            $user_mobile = $contestData->phone;
            $flag = false;
            if (!empty($user_mobile) && $user_mobile != 'null') {

                $postfields = array('mobile' => $user_mobile,
                    'message' => "Refund of playwinfantasy chip $chip has been credited to your Playwin Fantasy chip wallet of cancelled contest $contest_name.",
                );
                if (smsSend($postfields)) {
                    $flag = true;
                } else {
                    $flag = false;
                }
            }

            $html = array();
            $html['contest_code'] = $contest_code;
            $html['contest_name'] = $contest_name;
            $html['message'] = "Playwin fantasy chip credit of $chip has been added to your chip wallet as a cancel contest refund chip";
            $html['logo'] = base_url() . getConfig('site_logo');
            $html['site'] = getConfig('site_name');
            $html['user'] = ucwords($user_name);
            $email_template = $ci->load->view('email/cancel_contest_tpl', $html, true);
            $status = send_mail($email_template, '[' . getConfig('site_name') . '] Cancel Contest', $user_email, getConfig('admin_email'));
            if ($status) {
                $flag = true;
            } else {
                $flag = false;
            }

            if ($flag) {
                return true;
            } else {

                return false;
            }
        }

        return true;
    }

}


/**
 * [get common configure ]
 */
if (!function_exists('getPredictionAnswer')) {

    function getPredictionAnswer($matchId, $key) {
        $ci = get_instance();
        $option = array('table' => 'prediction_question_answer',
            'where' => array('match_id' => $matchId, 'question_key' => $key),
            'single' => true,
        );
        $is_result = $ci->common_model->customGet($option);
        if (!empty($is_result)) {
            return $is_result->question_value;
        } else {
            return false;
        }
    }

}

/**
 * [get common configure ]
 */
if (!function_exists('getMatchPlayerName')) {

    function getMatchPlayerName($matchId, $playerId) {
        $ci = get_instance();
        $option = array('table' => 'matches',
            'select' => 'series_id',
            'where' => array('match_id' => $matchId),
            'single' => true,
        );
        $matches = $ci->common_model->customGet($option);
        if (!empty($matches)) {
            $option = array('table' => 'match_player',
                'select' => 'player_name,team',
                'where' => array('series_id' => $matches->series_id, 'player_id' => $playerId),
                'single' => true,
            );
            $playerName = $ci->common_model->customGet($option);
            if (!empty($playerName)) {
                return $playerName->player_name;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}

if (!function_exists('getMatchPlayTeamName')) {

    function getMatchPlayTeamName($matchId, $teamId) {
        $ci = get_instance();
        $option = array('table' => 'matches',
            'select' => '*',
            'where' => array('match_id' => $matchId),
            'single' => true,
        );
        $matches = $ci->common_model->customGet($option);
        if (!empty($matches)) {
            if ($teamId == $matches->localteam_id) {
                return $matches->localteam;
            }
            if ($teamId == $matches->visitorteam_id) {
                return $matches->visitorteam;
            }
            return false;
        } else {
            return false;
        }
    }

}

if (!function_exists('playwinChipWinnerWalletCalculates')) {

    function playwinChipWinnerWalletCalculates($uid, $cash) {
        $ci = get_instance();
        if ($cash > 0) {
            $trasactionMessage = "To Get Game Prediction Winner playwin fantasy chip";
            $notificationMessage = "Conguratilation! playwin fantasy chip credit of $cash has been added to your chip wallet as a game prediction winner";
            $opening_balance = 0;
            $cr = 0;
            $available_balance = 0;
            $orderId = generateToken(6);
            $options = array(
                'table' => 'user_chip',
                'select' => '*',
                'where' => array('user_id' => $uid),
                'single' => true
            );
            $UserCash = $ci->common_model->customGet($options);
            if (!empty($UserCash)) {
                $winning_amount = abs($UserCash->winning_chip) + abs($cash);
                $totalCash = abs($UserCash->chip) + abs($cash);
                $opening_balance = $UserCash->chip;
                $cr = $cash;
                $available_balance = $totalCash;
                $optionsCash = array(
                    'table' => 'user_chip',
                    'data' => array('winning_chip' => $winning_amount,
                        'chip' => $totalCash),
                    'where' => array('user_id' => $uid),
                    'update_date' => date('Y-m-d H:i:s')
                );
                $ci->common_model->customUpdate($optionsCash);
            } else {
                $cr = $cash;
                $available_balance = $cash;
                $optionsCash = array(
                    'table' => 'user_chip',
                    'data' => array('winning_chip' => $cash,
                        'chip' => $cash,
                        'user_id' => $uid,
                        'update_date' => date('Y-m-d H:i:s')),
                );
                $ci->common_model->customInsert($optionsCash);
            }
            /* To Transaction History Insert */
            $options = array(
                'table' => 'transactions_history',
                'data' => array(
                    'user_id' => $uid,
                    'match_id' => 0,
                    'opening_balance' => $opening_balance,
                    'cr' => $cr,
                    'orderId' => $orderId,
                    'available_balance' => $available_balance,
                    'message' => $trasactionMessage,
                    'datetime' => date('Y-m-d H:i:s'),
                    'transaction_type' => 'CHIP',
                    'pay_type' => "WINNING",
                    'match_id' => 0,
                    'contest_id' => 0
                )
            );
            $ci->common_model->customInsert($options);
            $options = array(
                'table' => 'notifications',
                'data' => array(
                    'user_id' => $uid,
                    'type_id' => 0,
                    'sender_id' => 1,
                    'noti_type' => 'USER_CHIP_WINNING',
                    'message' => $notificationMessage,
                    'read_status' => 'NO',
                    'sent_time' => date('Y-m-d H:i:s'),
                    'user_type' => 'USER'
                )
            );
            $ci->common_model->customInsert($options);
        }

        return true;
    }

}

if (!function_exists('checkUserVerification')) {

    function checkUserVerification($user_id) {
        $ci = get_instance();
        $option = array('table' => 'users as USR',
            'select' => 'USR.id as user_id,USR.email_verify,USR.verify_mobile',
            'where' => array('USR.id' => $user_id, 'USR.email_verify' => 1,
                'USR.verify_mobile' => 1));
        $invitedUserVerification = $ci->common_model->customGet($option);
        if (!empty($invitedUserVerification)) {
            return true;
        } else {
            return false;
        }
    }

}

if (!function_exists('checkStr')) {

    function checkStr($str) {

        $ci = get_instance();

        if (!empty($str) && isset($str)) {
            $contest = explode(" ", $str);
            if (count($contest) > 1) {
                return $contest[0] . ' ' . $contest[1];
            } else {
                return $contest[0];
            }
        } else {
            return $str;
        }
    }

}



