# CodeChirps

Introducing "CodeChirps" - bite-sized code snippets for every digital nest builder out there, ready to help you soar through your coding journey! 🐦💻 #CodeChirps #FlyWithCode

### GiggleSearch
If you ever feel the need to reinvent the wheel and build your own  search engine for giggles, don't sweat it! Just use Google's API and  call it "GiggleSearch"! Voila! 😂🔍 Here's how: #Googleception  #RecursionFTW #buildinpublic 

```
<?php

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

?>
```