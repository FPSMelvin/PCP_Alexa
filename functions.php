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
   // $ssml = "<speak>
   //             I want to tell you a secret.
   //             <amazon:effect name='whispered'>I am not a real human.</amazon:effect>.
   //             Can you believe it?
   //         </speak>";


   return $ssml;
}

function dailySchedule($dayParam, $setAlarmTime){
    $ssml = "<speak>Allright, done. Good night!</speak>";
    return $ssm;
}

function dailySchedule($dayParam, $setAlarmTime){
    
    $ssml = "<speak>I don't know what your schedule is for " . $dayParam . ", sorry.</speak>";
    if(isset($setAlarmTime)){
        $ssml = "<speak>Allright, I have set your alarm at " . $setAlarmTime . "</speak>";
    }

    return $ssml;
}

function errorMessage($var){
   if(!isset($var)){
       $var = "00";
   }
   $ssml = "<speak>Error code " . $var ."</speak>";
   return $ssml;
}

function launchRequest(){
   $ssml = "<speak>Hello I'm Milo What can I help you with today</speak>";
   return $ssml;
}

function testGeluid(){
   $ssml = "<speak>Uptempo is the tempo  yessss </speak>";
   return $ssml;
}

function refuelAppointment(){
    $ssml = "<speak>Ok, message sent!</speak>";
    return $ssml;
}