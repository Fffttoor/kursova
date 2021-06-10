<?php
session_start();
if (isset($_POST['word']) && !(empty($_POST['word']))) {
    $word = str_replace('\'', '"', $_POST['word']);

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://wordsapiv1.p.rapidapi.com/words/" . $word . "/synonyms",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: wordsapiv1.p.rapidapi.com",
            "x-rapidapi-key: 3c04e05461mshcf0ede0667d3184p1c11adjsn6beb4fd0d32c"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo 'API 505 error';
    }
    if (!(strpos($response, 'word not found') === false)) {
        echo '<span class="error">This word wasn\'t found in our DB, please try another one</span>';
    } else {
        $p1 = explode("[", $response);
        $p2 = explode(",", $p1[1]);
        if (empty($p2[1]) || $p2 == ']}') {
            echo '<span class="error">This word wasn\'t found in our DB, please try another one</span>';
        } else {
            $synonim = $p2;
            echo '<div class="text-wrapper">';
            $i=0;
            foreach ($synonim as $syn) {
                $i++;
                echo '<span class="each-synonim">'.$i.' '.$syn . '</span>';
            }
            echo '</div>';
        }


    }

}





