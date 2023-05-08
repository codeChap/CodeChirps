# CodeChirps

Introducing "CodeChirps" - bite-sized code snippets for every digital nest builder out there, ready to help you soar through your coding journey! 🐦💻 #CodeChirps #FlyWithCode

### StreamGPT
If you want to 😎 steam from OpenAI just like the big kids do🚀, here is how to do it with PHP from the command line 💻. #chatGPT4 #OpenAi #php #CodeChirps 🐦🤖✨
```php
// To run, type: php StreamGPT.php

// Set API key and endpoint
$api_key =  file_get_contents('openAiKey.secret');
$endpoint = "https://api.openai.com/v1/chat/completions";

// Create a cURL session
$ch = curl_init($endpoint);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer {$api_key}"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    "model"            => 'gpt-4',
    "messages" => [
        [
            "role"    => "user",
            "content" => "You are ChatGPT, a large language model trained by OpenAI. Please answer the following question: What is the capital of South Africa?"
        ],
    ],
    "temperature"       => 1, // Control's randomness, less is more deterministic
    "top_p"             => 0, // Diversity
    "n"                 => 1, // Number of choices to return
    "frequency_penalty" => 0, // Penalize new tokens based on their existing frequency
    "presence_penalty"  => 0, // Penalize new tokens based on whether they appear in the text so far
    "stream"            => 1  // Stream back partial results as they are generated, instead of waiting for completion
]));

// The magic happens here
curl_setopt($ch, CURLOPT_WRITEFUNCTION, function($curl, $data) {

    $string = substr($data, 6);
    if($json = json_decode($string, true)){
        if( ! empty($json['choices'][0]['delta']['content']) ) {
            print $json['choices'][0]['delta']['content'];
        }
    }

    return strlen($data); // Return the number of bytes sent
});

curl_exec($ch);
```

### GiggleSearch
If you ever feel the need to reinvent the wheel and build your own  search engine for giggles, don't sweat it! Just use Google's API and  call it "GiggleSearch"! Voila! 😂🔍 Here's how: #Googleception  #RecursionFTW #buildinpublic 

```php
// Google search endpoint
$endPoint = "https://www.googleapis.com/customsearch/v1";

// Set credentials
$apiKey  = file_get_contents('googleSearchApiKey.secret'); // Obtained from https://console.developers.google.com/apis/credentials
$cx      = file_get_contents('searchEngineId.secret'); // Obtained from https://cse.google.com/cse/all

// Set parameters ( Additional parameters can be found here: https://developers.google.com/custom-search/json-api/v1/reference/cse/list)
$start   = 1; // Start index of the results
$num     = 10; // Number of results per page, max is 10
$country = 'ZA'; // Country code to search from

// Set the query to search for in google
$query = urlencode("Open AI");

// Build the final URL
$url = $endPoint."?key={$apiKey}&cx={$cx}&gl={$country}&start={$start}&num={$num}&q={$query}";

// Get the results from google
$result = json_decode(file_get_contents($url));

// Dump the result
print_r($result);
```