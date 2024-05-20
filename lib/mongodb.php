<?php
require_once __DIR__ . '/../vendor/autoload.php';

try {
  $mongodb = new MongoDB\Client(_MONGO_URL_);
  $database = $mongodb->selectDatabase(_MONGO_DB_);
  $collection = $database->selectCollection(_MONGO_COLLECTION_);
} catch (Exception $e) {
  die('Erreur de connexion à MongoDB : ' . $e->getMessage());
}