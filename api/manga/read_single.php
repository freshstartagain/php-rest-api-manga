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

// Get ID
$manga->id = isset($_GET['id']) ? $_GET['id'] : die();


// Get Manga
$manga->read_single();


// Create Array
$manga_arr = array(
    'id' => $manga->id,
    'name' => $manga->name,
    'synopsis' => $manga->synopsis,
    'status' => $manga->status,
    'author_id' => $manga->author_id,
    'author_name' => $manga->author_name,
    'created_at' => $manga->created_at
);

// Make JSON
print_r(json_encode($manga_arr));