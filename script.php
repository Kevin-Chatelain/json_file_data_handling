<?php 
$data = file_get_contents('php://input');
json_encode($data);
file_put_contents('note.json', $data);
?>