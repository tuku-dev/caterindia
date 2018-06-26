<?php

class Helpers {
    //Genrate Key for url passing
    public static function keyMaker($id) {
        $secretkey = '1HutysK98UuuhDasdfafdCrackThisBeeeeaaaatchkHgjsheIHFH44fheo1FhHEfo2oe6fifhkhs';
        $key = md5($id . $secretkey);
        return $key;
    }
    public static function getShare() {
        $admin_data = DB::table('core')->where('id', '=', '1')->get();
        return $admin_data;
    }
}

if (!function_exists('encodeString')) {
    function encodeString($val) {
        if (!empty($val)) {
            $ret_ = Crypt::encrypt($val);
            return $ret_;
        }
    }
}

?>