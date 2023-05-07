<?php

// To run, type: php StreamGPT.php

// Set API key and endpoint
$api_key =  file_get_contents('openAiKey.secret');
$endpoint = "https://api.openai.com/v1/chat/completions";

// Prepare the prompt
$prompt = "You are ChatGPT, a large language model trained by OpenAI. Please answer the following question: What is the capital of South Africa?";

// Set up headers
$headers = [
    "Content-Type: application/json",
    "Authorization: Bearer {$api_key}"
];

// Default post body
$body = [
    "model"            => 'gpt-4',
    "messages" => [
        [
            "role"    => "user",
            "content" => $prompt
        ],
    ],
    "temperature"       => 1, // Control's randomness, less is more deterministic
    "top_p"             => 0, // Diversity
    "n"                 => 1, // Number of choices to return
    "frequency_penalty" => 0, // Penalize new tokens based on their existing frequency
    "presence_penalty"  => 0, // Penalize new tokens based on whether they appear in the text so far
    "stream"            => true // Stream back partial results as they are generated, instead of waiting for completion
];

// Create a cURL session
$ch = curl_init($endpoint);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));

// The magic happens here
curl_setopt($ch, CURLOPT_WRITEFUNCTION, function($curl, $data) {

    $string = substr($data, 6);
    if($json = json_decode($string, true)){
        if( ! empty($json['choices'][0]['delta']['content']) ) {
            print $json['choices'][0]['delta']['content'];
        }
    }

    // Return the number of bytes sent
    return strlen($data);
});

curl_exec($ch);
?>
