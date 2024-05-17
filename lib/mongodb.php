<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Exception;
use MongoDB\Client;

try {
  $mongodb = new MongoDB\Client(_MONGO_URL_);
  $database = $mongodb->selectDatabase(_MONGO_DB_)->command(['ping' => 1]);
  $collection = $database->selectCollection(_MONGO_COLLECTION_)->command(['ping' => 1]);
} catch (Exception $e) {
  die('Erreur de connexion à MongoDB : ' . $e->getMessage());
}