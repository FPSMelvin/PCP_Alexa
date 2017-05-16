<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'));
$ssml;


// check if there is data sent by Alexa
if (isset($data) && isset($data->request)) {
  ?>
  {
    "version": "1.0",
    "sessionAttributes": {},
    "response": {
      "outputSpeech": {
        "type": "PlainText",
        "text": "You said you're leaving Seattle, right?"
      },
      "shouldEndSession": false,
      "directives": [
        {
          "type": "Dialog.ConfirmSlot",
          "slotToConfirm": "day"
        }
      ]
    }
  }
<?php
}




 ?>