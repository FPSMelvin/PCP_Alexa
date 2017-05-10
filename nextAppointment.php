<?php
function nextAppointment(){
    //Get moment untill next appointment
    $time = time();
    $appointmentTime = strtotime("15:30:00 GMT+1");
    $timeDifference = $appointmentTime - $time;

    //Calculate time difference in hours and seconds
    $hours = floor($timeDifference / 3600);
    $mins = floor($timeDifference / 60 % 60);


    $ssml = "<speak>Your next appointment is in " . $hours . " hours and " . $mins . " minutes.</speak>";
    return $ssml;
}
