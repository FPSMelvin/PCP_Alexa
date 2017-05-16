<?php
require 'functions.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'));
$ssml;


// check if there is data sent by Alexa
if (isset($data) && isset($data->request)) {

    // check if dialogstate is completed
    if (isset($data) && isset($data->request) && isset($data->request->dialogState) && $data->request->dialogState == 'COMPLETED') {

        // retrieve intent name
        $name = $data->request->intent->name;

        // check which string equals intent name from above
        switch ($name) {
            case "RefuelIntent":
                $refuelTime;
                if($data->request->intent->slots->refuelTime->value){
                    $refuelTime = $data->request->intent->slots->refuelTime->value;
                    $myArray = explode(':', $refuelTime);
                    $time = intval($myArray[0]);
                }
                $ssml = refuelAppointment($time);
                break;
            case "NextAppointment":
                $ssml = nextAppointment();
                break;
            case "DailyScheduleIntent":
                $day       = $data->request->intent->slots->day->value;
                $alarmTime = null;

                if (isset($data->request->intent->slots->setAlarmTime->value)) {
                    $alarmTime = $data->request->intent->slots->setAlarmTime->value;
                }

                if (isset($day)) {
                    $ssml = dailySchedule($day, $alarmTime);
                } else {
                    $ssml = "<speak>I did not understand the day</speak>";
                }
                break;
            case "testIntent":
                $ssml = testGeluid();
                break;
            case "ShortSchedule":
                $day       = $data->request->intent->slots->shortDay->value;
                $alarmTime = null;

                // if (isset($data->request->intent->slots->shortSetAlarmTime->value)) {
                //     $alarmTime = $data->request->intent->slots->shortSetAlarmTime->value;
                // }

                if (isset($day)) {
                    $ssml = shortSchedule($day, $alarmTime);
                } else {
                    $ssml = "<speak>I did not understand the day</speak>";
                }
                break;
            default:
                $ssml = "<speak>see you later aligator</speak>";
        }

        // put content into an array
        $array = array(
            "version" => "1.0",
            "sessionAttributes" => array(),
            "response" => array(
                "outputSpeech" => array(
                    "type" => "SSML",
                    "ssml" => $ssml
                ),
                "card" => array(
                    "type" => "Simple",
                    "title" => "SessionSpeechlet - Travel booking",
                    "content" => "test card"
                ),
                "reprompt" => array(
                    "outputSpeech" => array(
                        "type" => "PlainText",
                        "text" => ""
                    )
                ),
                "shouldEndSession" => true
            )
        );
        echo json_encode($array);
    }

    // dialogstate is not completed ( still ongoing )
    else {

      $launchRequest = $data->request->type;

      if ($launchRequest == "LaunchRequest"){
        $ssml = '<speak>Hello this is Milo</speak>';
        $array = array(
            "version" => "1.0",
            "sessionAttributes" => array(),
            "response" => array(
                "outputSpeech" => array(
                    "type" => "SSML",
                    "ssml" => $ssml
                ),
                "card" => array(
                    "type" => "Simple",
                    "title" => "SessionSpeechlet - Travel booking",
                    "content" => "test card"
                ),
                "reprompt" => array(
                    "outputSpeech" => array(
                        "type" => "PlainText",
                        "text" => ""
                    )
                ),
                "shouldEndSession" => false
            )
        );
        echo json_encode($array);
    }

        $name = $data->request->intent->name;

        switch ($name) {
            case "testIntent":
                $ssml  = testGeluid();
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
                $array = array(
                    "version" => "1.0",
                    "sessionAttributes" => array(),
                    "response" => array(
                        "outputSpeech" => NULL,
                        "card" => NULL,
                        "directives" => array(
                            0 => array(
                                "type" => "Dialog.Delegate"
                            )
                        ),
                        "reprompt" => NULL,
                        "shouldEndSession" => false
                    )
                );
                echo json_encode($array);
        }
    }


}
?>
