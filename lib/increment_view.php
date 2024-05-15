<?php
require_once 'config.php';
require_once 'session.php';
require_once 'pdo.php';
require_once 'mongodb.php';
require_once 'animals.php';

if (isset($_POST['animal_id'])) {
  $id = $_POST['animal_id'];
  $animal = getAnimalById($pdo, $_POST['animal_id']);

  if (!empty($id)) {
    $collection->updateOne(
      ["animal" => $animal['name']], 
      [ '$inc' => [ "view" => 1 ] ]
    );
  }
}