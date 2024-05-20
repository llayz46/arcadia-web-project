<?php

try {
  $pdo = new PDO('mysql:host='._DB_HOST_.';dbname='._DB_NAME_.';charset=utf8mb4', _DB_USER_, _DB_PASS_, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ]);
} catch (PDOException $e) {
  die('Une erreur est survenue lors de la connexion à la base de données.');
}