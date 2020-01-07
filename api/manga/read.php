<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../model/Manga.php');


// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate manga object
$manga = new Manga($db);

// Manga query
$result = $manga->read();

// Get row count
$num = $result->rowCount();

// Check if there is manga
if ($num > 0) {
    // Manga array
    $manga_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $manga_item = array(
            'id' => $id,
            'name' => $name,
            'synopsis' => $synopsis,
            'status' => $status,
            'author_id' => $author_id,
            'author_name' => $author_name,
            'created_at' => $created_at
        );

        // Push to "data"
        array_push($manga_arr, $manga_item);
    }

    // Turn to JSON & ouput
    echo json_encode($manga_arr);
}else{
    // No manga
    echo json_encode(
        array('message' => 'No Manga Found')
    );
}
