<?php

require 'nextAppointment.php';

$data = file_get_contents('php://input');
$json = json_decode($data, true);

//file_put_contents('test2.txt', $data.PHP_EOL, FILE_APPEND);

$ssml;
$delegate = false;

//var_dump($json['request']['type']);


if(isset($json['request']['type'])){

   $type = $json['request']['type'];

   if ($type == "LaunchRequest"){
       $ssml = launchRequest();
   }

   //var_dump($ssml);

}

$day;

if(isset($json['request']['dialogState'])){
    if($json['request']['dialogState'] == "STARTED"){
        $delegate = true;
        $ssml = "<speak>it is working</speak>";
    }
}
// check if the user says any day in his request
if(isset($json['request']['intent']['slots']['day']['value'])){
    $day = $json['request']['intent']['slots']['day']['value'];
    $ssml = dailySchedule($day);
}else{
  $ssml = errorMessage();
}




if(isset($json['session']['application']['applicationId'])){

   $Id     = $json['session']['application']['applicationId'];
   $name   = $json['request']['intent']['name'];

   switch ($name) {
       case "NextAppointment":
           $ssml = nextAppointment();
           break;
       case "DailyScheduleIntent":




           break;
       case "testIntent":
           $ssml = testGeluid();
           break;
       default:
           $array = array(
               "response" => array(
                   "outputSpeech" => array(
                       "type" => "SSML",
                       "ssml" => $ssml
                       )
               )
           );

           $response = $array;
   }

   // if($type == "LaunchRequest"){
   //   $ssml = launchRequest();
   // }else{
   //   switch ($name) {
   //       case "NextAppointment":
   //           $ssml = nextAppointment();
   //           break;
   //       case "DailyScheduleIntent":
   //           $ssml = dailySchedule($day);
   //           break;
   //       case "":
   //           echo "";
   //           break;
   //       default:
   //         $array = array(
   //             "response" => array(
   //                 "outputSpeech" => array(
   //                     "type" => "SSML",
   //                     "ssml" => $ssml
   //                     )
   //             )
   //         );
   //
   //         $response = $array;
   //   }
   // }

   $array = array(
       "response" => array(
           "outputSpeech" => array(
               "type" => "SSML",
               "ssml" => $ssml
               )
       )
   );

   $response = $array;

}

$dialogDelegate = array(
   "type" => "Dialog.Delegate"/*,
   "updatedIntent" => array(
       "name" => "DailyScheduleIntent",
       "confirmationStatus" => "NONE",
       "slots" => array(
           "string" => array(
               "name" => "day",
               "value" => "string",
               "confirmationstatus" => "NONE"
           )
       )
   )*/
);

$array = array(
   "response" => array(
       "outputSpeech" => array(
           "type" => "SSML",
           "ssml" => $ssml
       )
   )
);
$response = $array;

//Check if it should delegate or send out outputSpeech
//$delegate ? $response = $dialogDelegate : $response = $array;
if($delegate){
    $response = $dialogDelegate;
    $delegate = false;
}
else{
    $response = $array;
}

header('Content-Type: application/json');
echo json_encode($response);

?>
