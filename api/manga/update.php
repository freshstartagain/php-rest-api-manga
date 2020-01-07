<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../../config/Database.php');
include_once('../../model/Manga.php');

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate manga object
$manga = new Manga($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$manga->id = $data->id;

$manga->name = $data->name;
$manga->synopsis = $data->synopsis;
$manga->status = $data->status;
$manga->author_id = $data->author_id;


// Update manga
if ($manga->update()) {
    echo json_encode(
        array('message' => 'Manga Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Manga Not Updated')
    );
}
