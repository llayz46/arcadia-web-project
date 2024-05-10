<?php

function getAnimalReportsByAnimalId(PDO $pdo, INT $id): array {
  $query = 'SELECT * FROM animal_reports WHERE animal_id = :id ORDER BY id DESC';
  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetchAll();
}

function getAnimalReportByAnimalId(PDO $pdo, INT $id): array {
  $query = 'SELECT * FROM animal_reports WHERE animal_id = :id ORDER BY id DESC LIMIT 1';
  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addReport(PDO $pdo, STRING $state, STRING $detail = null, STRING $food, DATETIME $date, INT $animalId, INT $userId): bool {
  $query = 'INSERT INTO animal_reports (state, food, date, animal_id, user_id) VALUES (:state, :food, :date, :animal_id, :user_id)';
  if ($detail) {
    $query = 'INSERT INTO animal_reports (state, state_detail, food, date, animal_id, user_id) VALUES (:state, :detail, :food, :date, :animal_id, :user_id)';
  }
  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':state', $state, PDO::PARAM_STR);
  if ($detail) {
    $stmt->bindValue(':detail', $detail, PDO::PARAM_STR);
  }
  $stmt->bindValue(':food', $food, PDO::PARAM_STR);
  $stmt->bindValue(':date', $date->format('Y-m-d'), PDO::PARAM_STR);
  $stmt->bindValue(':animal_id', $animalId, PDO::PARAM_INT);
  $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
  return $stmt->execute();
}

function getReports(PDO $pdo, INT $limit = null): array {
  $query = 'SELECT * FROM animal_reports ORDER BY id DESC';

  if ($limit) {
    $query .= ' LIMIT :limit';
  }

  $stmt = $pdo->prepare($query);

  if ($limit) {
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
  }

  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}