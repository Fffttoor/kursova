<?php
session_start();
if (isset($_POST) && count($_POST) > 0) {
    $VALIDATE = TRUE;
    include 'db_pdo.php';
    $text = str_replace('\'', '"', $_POST['text']);
    $word_to_change = str_replace('\'', '"', $_POST['word_to_change']);
    $_SESSION['success'] = 0;
    $_SESSION['error1'] = 1;
    $_SESSION['error2'] = 1;
    $_SESSION['error3'] = 1;
    $position = strpos($text, $word_to_change);
    if ($position === false) {
        $VALIDATE = false;
        $_SESSION['error1'] = 0;
    }


    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://wordsapiv1.p.rapidapi.com/words/" . $word_to_change . "/synonyms",
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
        $_SESSION['error2'] = 0;
        $VALIDATE = false;
    }
    if (!(strpos($response, 'word not found') === false)) {
        $_SESSION['error3'] = 0;
        $VALIDATE = false;
    } else {
        $p1 = explode("[", $response);
        $p2 = explode("\"", $p1[1]);
        if ($p2[1] == NULL ) {
            $_SESSION['error3'] = 0;
            $VALIDATE = false;
        }
        else{
            $synonim = $p2[1];
        }

    }

    if ($VALIDATE) {
        $_SESSION['success'] = 1;

        $changed_text = str_replace($word_to_change, $synonim, $text);
        $result = $dbh->query("INSERT INTO `synonims`(`text`, `word_to_change`,`synonym`,`changed_text`) VALUES('$text','$word_to_change','$synonim','$changed_text')");
    }
};
header("location: index.php");
die();