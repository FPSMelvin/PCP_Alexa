<?php
header('Content-Type: application/json');

$data = json_decode( file_get_contents('php://input') );


if (isset($data) && isset($data->request) && isset($data->request->dialogState) && $data->request->dialogState == 'COMPLETED') {
}
else{
    $dialogDelegate = json_decode('{
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
}');
    $response = $dialogDelegate;
}
echo json_encode($response);

?>

