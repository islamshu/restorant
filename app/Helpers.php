<?php

use App\Models\GeneralInfo;


function get_general_value($key)
{
    $general = GeneralInfo::where('key', $key)->first();
    if ($general) {
        return $general->value;
    }

    return '';
}
function get_status($status){
    if($status == 1){
        return 'done';
    }elseif($status == 2){
        return 'watting';
    }
    elseif($status == 3){
        return 'canceld';
    }
}
function get_button_status($status){
    if($status == 1){
        return 'success';
    }elseif($status == 2){
        return 'info';
    }
    elseif($status == 3){
        return 'danger';
    }
}

