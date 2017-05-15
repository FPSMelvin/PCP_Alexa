<?php
require 'functions.php';
header('Content-Type: application/json');

$data = json_decode( file_get_contents('php://input') );
$ssml;


// check if there is data
if (isset($data) && isset($data->request)){

  // check if dialogstate is completed
  if (isset($data) && isset($data->request) && isset($data->request->dialogState) && $data->request->dialogState == 'COMPLETED') {

      // retrieve intent name
      $name = $data->request->intent->name;

      // check which string equals intent name from above
      switch ($name) {
          case "RefuelIntent":
            $ssml = refuelAppointment();
            break;
          case "NextAppointment":
              $ssml = nextAppointment();
              break;
          case "DailyScheduleIntent":
              $day = $data->request->intent->slots->day->value;
              if (isset($day)){
                $ssml = dailySchedule($day);
              }else{
                $ssml = "<speak>I did not understand the day</speak>";
              }
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
                "content": "test card"
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
