<?php

function getAnimalReportsByAnimalId(PDO $pdo, INT $id): array {
  $query = 'SELECT * FROM animal_reports WHERE animal_id = :id';
  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetchAll();
}