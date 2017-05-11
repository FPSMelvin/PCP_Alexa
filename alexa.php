<?php

require 'nextAppointment.php';

$data = file_get_contents('php://input');
$json = json_decode($data, true);

$day;
$ssml;
$delegate = false;

//file_put_contents('test2.txt', $data.PHP_EOL, FILE_APPEND);
//var_dump($json['request']['type']);

if(isset($json['request']['type'])){
   $type = $json['request']['type'];
   if ($type == "LaunchRequest"){
       $ssml = launchRequest();
   }
   //var_dump($ssml);
}



// check if response has a session and applicationid
if(isset($json['session']['application']['applicationId'])){

   $Id     = $json['session']['application']['applicationId'];
   $name   = $json['request']['intent']['name'];

   switch ($name) {
       case "NextAppointment":
           $ssml = nextAppointment();
           break;
       case "DailyScheduleIntent":
          if (isset($json['request']['intent']['slots']['day']['value'])) {
             $day = $json['request']['intent']['slots']['day']['value'];
             $ssml = dailySchedule($day);
           }else{
             $delegate = true;
             //$ssml = errorMessage();
           }
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
   "type" => "Dialog.Delegate",
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


if ($delegate == true){
  $response = $dialogDelegate;
  $delegate = false;
}

//Check if it should delegate or send out outputSpeech
//$delegate ? $response = $dialogDelegate : $response = $array;


$reponse = array(
   "type" => "Dialog.Delegate",
);

header('Content-Type: application/json');
echo json_encode($response);

file_put_contents('test3.txt', json_encode($response).PHP_EOL, FILE_APPEND);

?>
