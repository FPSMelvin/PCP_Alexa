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

function dailySchedule($dayParam, $setAlarmTime){

    $ssml = "<speak>Allright done, good night!</speak>";
    if(isset($setAlarmTime)){
        $ssml = "<speak>Allright, I have set your alarm at <say-as interpret-as='time'>" . $setAlarmTime . "</say-as> for " . $dayParam .  ". make sure to make time for breakfast. Breakfast makes your day better!</speak>";
    }

    return $ssml;
}

function shortSchedule(){
    $ssml = "<speak>Allright, good night!</speak>";
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
   $ssml = "<speak>Hello, what can I help you with?</speak>";
   return $ssml;
}

function testGeluid(){
   $ssml = "<speak>Uptempo is the tempo  <amazon:effect name='whispered'>yesssss</amazon:effect> </speak>";
   return $ssml;
}

function refuelAppointment($time){
    //$ssml = "<speak>Ok, message sent!</speak>";
    $ssml = "<speak>Alright, message sent that you'll be <say-as interpret-as='time'>" . $time . "</say-as> minutes later</speak>";
    return $ssml;
}

function shortRefuelAppointment(){
    //$ssml = "<speak>Ok, message sent!</speak>";
    $ssml = "<speak>Ok, done!</speak>";
    return $ssml;
}

function publicTransport(){
    //$ssml = "<speak>Ok, message sent!</speak>";
    $ssml = "<speak>No problem. Have a good trip!</speak>";
    return $ssml;
}

function parkCar(){
    $ssml = "<speak>Ok, then just follow the navigation. Go get ‘em champ!</speak>";
    return $ssml;
}

function shortParkCar(){
  $ssml = "<speak>There is a parkMobile zone, three hundred meters from your current location. Just follow the navigation</speak>";
  return $ssml;
}
//
// function shortPublicTransport(){
//     $ssml = "<speak>The train is the fastest way, travel information is sent to your phone.</speak>";
//     return $ssml;
// }
