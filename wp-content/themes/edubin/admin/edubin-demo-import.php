<?php

class EdubinEnvatoApi
{
    // Bearer, no need for OAUTH token, change this to your bearer string
    // https://build.envato.com/api/#token

    private static $bearer = "uYJt07Y0Wz9Eum0mX3hsUJtTotYhU"."v"."e"."y"; //

    public static function getPurchaseData($code)
    {

        //setting the header for the rest of the api
        $bearer   = 'bearer ' . self::$bearer;
        $header   = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json; charset=utf-8';
        $header[] = 'Authorization: ' .$bearer;

        $verify_url = 'https://api.envato.com/v3/market/author/sale/';
        $ch_verify  = curl_init($verify_url . '?code=' . $code);

        curl_setopt($ch_verify, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch_verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch_verify, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch_verify, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

        $cinit_verify_data = curl_exec($ch_verify);
        curl_close($ch_verify);

        if ( $cinit_verify_data != "" ) {
            return json_decode($cinit_verify_data);
        } else {
            return false;
        }

    }

    public static function verifyPurchase($code)
    {
        $verify_obj = self::getPurchaseData($code);

        // Check for correct verify code
        if (
            (false === $verify_obj) ||
            !is_object($verify_obj) ||
            isset($verify_obj->error) ||
            !isset($verify_obj->sold_at)
        ) {
            return -1;
        }

        // If empty or date present, then it's valid
        if (
            $verify_obj->supported_until == "" ||
            $verify_obj->supported_until != null
        ) {
            return $verify_obj;
        }

        // Null or something non-string value, thus support period over
        return 0;

    }
}

function edubin_check_tvc()
{
    return true;
    $theme_fv_code = get_option('edubin_tv_option');
    $obj_get_id = EdubinEnvatoApi::verifyPurchase($theme_fv_code);
    
    if (is_object($obj_get_id)) {
        $tid = $obj_get_id->item->id;
    }
     else{
        $tid = '';
    }
    if (isset($theme_fv_code) && strlen($theme_fv_code) == '36' && $tid == '24037792') {
        $purchase_code = htmlspecialchars($theme_fv_code);
        $obj = EdubinEnvatoApi::verifyPurchase($theme_fv_code);
        if (is_object($obj)) {
            return true;
        }
    }
}

//get_template_part( 'admin/demos-01'); 
get_template_part( 'admin/demos-02'); 
get_template_part( 'admin/demos-03'); 


function edubin_dialog_options($options)
{
    return array_merge($options, array(
        'width'       => 300,
        'dialogClass' => 'wp-dialog',
        'resizable'   => false,
        'height'      => 'auto',
        'modal'       => true,
    ));
}
add_filter('pt-ocdi/confirmation_dialog_options', 'edubin_dialog_options', 10, 1);
add_filter('pt-ocdi/disable_pt_branding', '__return_true');


get_template_part( 'admin/demos-04'); 

if (edubin_check_tvc()) {
    $edubin_tvfi = "edubin_import_files";
} else {
    $edubin_tvfi = "edubin_import_flies";
}

add_filter('pt-ocdi/import_files', $edubin_tvfi);

get_template_part( 'admin/demos-05'); 
