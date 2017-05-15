<?php
require 'functions.php';
header('Content-Type: application/json');

$data = json_decode( file_get_contents('php://input') );
$ssml;



if (isset($data) && isset($data->request)){

  if (isset($data) && isset($data->request) && isset($data->request->dialogState) && $data->request->dialogState == 'COMPLETED') {

      $name = $data->request->intent->name;

      switch ($name) {
          case "refuelIntent":
            $ssml = refuelAppointment();
            break;
          case "NextAppointment":
              $ssml = nextAppointment();
              break;
          case "DailyScheduleIntent":
              $day = $data->request->intent->slots->day->value;
              $ssml = dailySchedule($day);
              //  if (isset($json['request']['intent']['slots']['day']['value'])) {
              //     $day = $json['request']['intent']['slots']['day']['value'];
              //     $ssml = dailySchedule($day);
              //   }
              break;
          case "testIntent":
              $ssml = testGeluid();
              break;
          default:
              $ssml = "<speak>Empty</speak>";
      }

  ?>
    {
        "version": "1.0",
        "sessionAttributes": {},
        "response": {
            "outputSpeech": {
                "type": "SSML",
                "ssml": "<?php echo $ssml;?>"
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
  }
  else{

      $name = $data->request->intent->name;

      switch ($name) {
        case "testIntent":
          $ssml = testGeluid();
            $array = array(
                "response" => array(
                    "outputSpeech" => array(
                        "type" => "SSML",
                        "ssml" => $ssml
                        )
                )
            );
            echo json_encode($array);
          break;
        default:
        ?>{
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
        }<?php
    }
  }
}
?>
