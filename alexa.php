<?php

$data = file_get_contents('php://input');
$json = json_decode($data, true);

if(isset($json['session']['application']['applicationId'])){

        $Id = $json['session']['application']['applicationId'];

				$name = $json['request']['intent']['name'];

				switch ($name) {
				    case "next appointment":
				        //code to be executed if n=label1;
								nextAppointment();
				        break;
				    case "":
				        code to be executed if n=label2;
				        break;
				    case "":
				        code to be executed if n=label3;
				        break;
				    default:
							header('Content-Type: application/json');
							echo json_encode("doet het niett");
				}


        // if ($Id == "amzn1.ask.skill.02d549bc-a7ad-403e-bdb5-40b5fc1f0a41"){
			  //               //echo "succes";
				// 							$array = array(
			  //       "response" => array(
			  //           "outputSpeech" => array(
			  //               "type" => "SSML",
			  //               "ssml" => "\n<speak>\n\t<p>\n\t\t<s>Bart do your job</s>\n\t\t\n</speak>\n"
			  //           )
			  //       )
			  //   );
				//
    		// 	$response = $array;
        // }
}

header('Content-Type: application/json');
echo json_encode($response);

else{
	header('Content-Type: application/json');
  echo json_encode("doet het niett");
}


?>
