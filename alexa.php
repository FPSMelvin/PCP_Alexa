<?php

require 'nextAppointment.php';

$data = file_get_contents('php://input');
$json = json_decode($data, true);

if(isset($json['session']['application']['applicationId'])){

    $Id     = $json['session']['application']['applicationId'];
    //$type   = $json['request']['type'];
    $name   = $json['request']['intent']['name'];
    //$day = $json['request']['intent']['slots']['day']['value'];

    $ssml;

    //$ssml   = errorMessage();

    switch ($name) {
        case "NextAppointment":
            $ssml = nextAppointment();
            break;
        case "DailyScheduleIntent":
            if(isset($json['request']['intent']['slots']['day'])){
              $day = $json['request']['intent']['slots']['day']['value'];
              $ssml = dailySchedule($day);
            }else{
              $ssml = errorMessage();
            }
            break;
        case "test":
            echo "";
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

header('Content-Type: application/json');
echo json_encode($response);

?>
