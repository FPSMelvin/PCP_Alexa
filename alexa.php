<?php

require 'nextAppointment.php';

$data = file_get_contents('php://input');
$json = json_decode($data, true);

if(isset($json['session']['application']['applicationId'])){

    $Id     = $json['session']['application']['applicationId'];

    $type   = $json['request']['type'];
    $name   = $json['request']['intent']['name'];

    $day = $json['request']['intent']['slots']['day']['value'];

    //$ssml   = errorMessage();

    if($type == "LaunchRequest"){
      $ssml = launchRequest();
    }else{
      switch ($name) {
          case "NextAppointment":
              $ssml = nextAppointment();
              break;
          case "DailyScheduleIntent":
              $ssml = dailySchedule($day);
              break;
          case "":

              break;
          default:
              //$ssml = errorMessage();
      }
    }

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

header('Content-Type: application/json');
echo json_encode($response);
