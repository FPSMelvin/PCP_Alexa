<?php

require 'nextAppointment.php';

$data = file_get_contents('php://input');
$json = json_decode($data, true);

if(isset($json['session']['application']['applicationId'])){

    $Id     = $json['session']['application']['applicationId'];
    $type   = $json['request']['type'];
    $name   = $json['request']['intent']['name'];
    $ssml   = errorMessage();

    if($type == "LaunchRequest"){
      LaunchRequest();
    }else{
      switch ($name) {
          case "NextAppointment":
              //code to be executed if n=label1;
              $ssml = nextAppointment();
              break;
          case "":
              //code to be executed if n=label2;
              break;
          case "":
              //code to be executed if n=label3;
              break;
          default:
              $ssml = errorMessage();
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
