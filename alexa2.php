<?php
header('Content-Type: application/json');

$data = json_decode( file_get_contents('php://input') );

if (isset($data) && isset($data->request) && isset($data->request->dialogState) && $data->request->dialogState == 'COMPLETED') {
?>
{
    "version": "1.0",
    "sessionAttributes": {},
    "response": {
        "outputSpeech": {
            "type": "PlainText",
            "text": "This will be fun. hiking from Seattle to Portland on 2017-04-21"
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

} else {

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

<?php }
