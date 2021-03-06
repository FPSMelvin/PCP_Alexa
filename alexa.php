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
            case "ShortRefuelIntent":
              $ssml = shortRefuelAppointment();
              break;
            case "RefuelIntent":
                $refuelTime;
                if($data->request->intent->slots->refuelTime->value){
                    $refuelTime = $data->request->intent->slots->refuelTime->value;
                    $myArray = explode(':', $refuelTime);
                    $time = intval($myArray[0]);
                }
                $time = 5;
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
                $ssml = shortSchedule();
                break;
            case "ParkingIntent":
                $ssml = parkCar();
                break;
            case "ShortParkingIntent":
                $ssml = shortParkCar();
                break;
            case "PublicTransportIntent":
                $ssml = publicTransport();
                break;
            case "ShortPublicTransportIntent":
                $ssml = shortpublicTransport();
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
                    "title" => "Session Milo",
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

    // dialogstate is not completed ( still ongoing ) dus als je zegt: Open Milo
    else {

      $launchRequest = $data->request->type;

      if ($launchRequest == "LaunchRequest"){
        $ssml = '<speak>Hello, what can I help you with?</speak>';
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


    //Extended Public Transport Intent
    if ($data->request->intent->name == "ExtendedPublicTransportIntent"){
        // $array = array (
        //   'version' => '1.0',
        //   'sessionAttributes' => array (),
        //   'response' => array (
        //       'outputSpeech' => array (
        //     'type' => 'PlainText',
        //         'text' => 'From where did you want to start your trip?',
        //         ),
        //     'shouldEndSession' => false,
        //     'directives' =>
        //     array (
        //       0 =>
        //       array (
        //         'type' => 'Dialog.ElicitSlot',
        //         'slotToElicit' => 'testNumber',
        //       ),
        //     ),
        //   ),
        // );
        // echo json_encode($array);

        ?>
             {
               "version": "1.0",
               "sessionAttributes": {},
               "response": {
                 "outputSpeech": {
                   "type": "PlainText",
                   "text": "extend testing testing"
                 },
                 "shouldEndSession": false
               }
             }

        <?php
    }









        // als de Dialog niet completed is EN het is geen launch request, kijken of het uberhaupt een dialog is.
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
