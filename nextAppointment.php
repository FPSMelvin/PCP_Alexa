<?php
function nextAppointment(){
    //Get moment untill next appointment
    $time = time();
    $appointmentTime = strtotime("15:30:00 GMT+1");
    $timeDifference = $appointmentTime - $time;

    //Calculate time difference in hours and seconds
    $hours = floor($timeDifference / 3600);
    $mins = floor($timeDifference / 60 % 60);

    //$ssml = "<speak>Your next appointment is in " . $hours . " hours and " . $mins . " minutes.</speak>";
    $ssml = "<speak>
                I want to tell you a secret.
                <amazon:effect name='whispered'>I am not a real human.</amazon:effect>.
                Can you believe it?
            </speak>";


    return $ssml;
}

function dailySchedule($dayParam){
    $ssml = "<speak>I don't now what your schedule is for " . $dayParam . ", sorry.";
    return $ssml;
}

function errorMessage(){
    $ssml = "<speak>talk better pls.</speak>";
    return $ssml;
}

function launchRequest(){
    $ssml = "<speak><p>I'm Milo, how can I help you today?</speak>";
    return $ssml;
}
