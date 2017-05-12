<?php
require 'functions.php';
header('Content-Type: application/json');

$data = json_decode( file_get_contents('php://input') );

// $ssml = "<speak>Empty</speak>";
// if(isset($data['request']['intent']['name'])){
//     $name   = $data['request']['intent']['name'];
//
//     switch ($name) {
//        case "NextAppointment":
//            $ssml = nextAppointment();
//            break;
//        case "DailyScheduleIntent":
//           if (isset($json['request']['intent']['slots']['day']['value'])) {
//              $day = $json['request']['intent']['slots']['day']['value'];
//              $ssml = dailySchedule($day);
//            }
//            break;
//        case "testIntent":
//            $ssml = testGeluid();
//            break;
//        default:
//            $ssml = "<speak>Empty</speak>";
//
//     }
// }


if (isset($data) && isset($data->request) && isset($data->request->dialogState) && $data->request->dialogState == 'COMPLETED') {

?>
  {
      "version": "1.0",
      "sessionAttributes": {},
      "response": {
          "outputSpeech": {
              "type": "SSML",
              "ssml": "<speak>Empty</speak>"
          },
          "card": {
              "type": "Simple",
              "title": "SessionSpeechlet - Travel booking",
              "content": "SessionSpeechlet - This will be fun. hiking from Seattle to Portland on 2017-04-21"
          },
          "reprompt": {
              "outputSpeech": {
                  "type": "PlainText",
                  "text": ""
              }
          },
          "shouldEndSession": true
      }
  }
  <?php

  // $day = $data->request->intent->slots->day->value;
  // $ssml = dailySchedule($day);
  //
  // $array = array(
  //     "version" => "1.0",
  //     "sessionAttributes" => array(),
  //     "reponse" => array(
  //         "outputSpeech" => array(
  //             "type" => "SSML",
  //             "ssml" => $ssml
  //             )
  //     ),
  //     "card" => array(
  //         "type" => "Simple",
  //         "title" => "SessionSpeechlet - Travel booking",
  //         "content" => "SessionSpeechlet - This will be fun. hiking from eindhoven to amsterdam on 2017-04-21"
  //     ),
  //     "reprompt" => array(
  //         "outputSpeech" => array(
  //             "type" => "PlainText",
  //             "text" => ""
  //         )
  //     ),
  //     "shouldEndSession" => true
  // );
  //
  // $response = $array;
  //
  // echo json_encode($response);

}
else{
  ?>
  {
      "version": "1.0",
      "sessionAttributes": {},
      "response": {
          "outputSpeech": null,
          "card": null,
          "directives": [
              {
                  "type": "Dialog.Delegate"
              }
          ],
          "reprompt": null,
          "shouldEndSession": false
      }
  }
  <?php
}








?>
