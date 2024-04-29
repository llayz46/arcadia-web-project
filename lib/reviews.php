<?php

function getReviews(PDO $pdo): array {
  $sql = "SELECT * FROM reviews";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}