<?php

$BaseURL = "http://255e42ec.ngrok.io/";

// PHP Script to convert the CSV to a JSON feed, each time the script is run it re-reads the file.
// {"Event":"DoorBell Pressed","TimeStamp":"15:57:22","Image":"./images/15:57:22.jpg"}

$csvFile = file('Events.csv');
    $data = [];
    foreach ($csvFile as $line) {
        $data[] = str_getcsv($line);
    }



foreach ($data as $EventData) {
    //echo $EventData[2];
    // Remove all the unwanted bits from the image file
    $ParsedImage = str_replace(" ","",$EventData[2]);
    $ParsedImage = str_replace("./","",$ParsedImage);
  $EventHistoryArray[] = '{"Event":"'.$EventData[0].'","TimeStamp":"'.str_replace(" ","",$EventData[1]).'","Image":"'.$BaseURL.$ParsedImage.'"}';
}
$commaSeparated = implode(",", $EventHistoryArray);


// Convert the CSV into JSON Stream
//{"Event":"DoorBell Pressed","TimeStamp":"15:57:22","Image":"./images/15:57:22.jpg"}


// Assemble the JSON response
$JSONResponse = '{"Events":['.$commaSeparated.']}';
echo $JSONResponse;
?>