<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

// SET ID to delete
$manga->id = $data->id;

// Delete manga
if ($manga->delete()) {
    echo json_encode(
        array('message' => 'Manga Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Manga Not Deleted')
    );
}
