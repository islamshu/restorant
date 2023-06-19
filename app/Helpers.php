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
function if_is_open(){
$current_time = now()->format('H:i:s'); // Get the current time

$start_time = get_general_value('start_at'); // Opening time
$end_time = get_general_value('end_at'); // Closing time

if ($start_time <= $end_time) {
    // Case 1: The opening time is earlier than the closing time
    if ($current_time >= $start_time && $current_time <= $end_time) {
        // The restaurant is open
        return 1;
    } else {
        // The restaurant is closed
        return 0;
    }
} else {
    // Case 2: The opening time is later than the closing time (e.g., overnight)
    if ($current_time >= $start_time || $current_time <= $end_time) {
        // The restaurant is open
        return 1;
    } else {
        // The restaurant is closed
        return 0;
    }
}
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

