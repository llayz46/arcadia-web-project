<?php

function getHabitats(PDO $pdo, INT $limit = null): array {
  $sql = 'SELECT * FROM habitats';

  if ($limit) {
    $sql .= ' LIMIT :limit';
  }

  $stmt = $pdo->prepare($sql);

  if ($limit) {
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
  }

  $stmt->execute();
  $habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $formattedHabitats = [];

  foreach ($habitats as $habitat) {
    $formattedHabitats[$habitat['title']] = $habitat;
  }

  return $formattedHabitats;
}

function getHabitatById(PDO $pdo, INT $id): array|bool {
  $sql = 'SELECT * FROM habitats WHERE id = :id';
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createHabitat(PDO $pdo, STRING $title, STRING $content): bool {
  $title = filter_var(strtolower($title), FILTER_SANITIZE_SPECIAL_CHARS);
  $content = filter_var($content, FILTER_SANITIZE_SPECIAL_CHARS);

  $check = 'SELECT * FROM habitats WHERE title = :title';
  $stmtCheck = $pdo->prepare($check);
  $stmtCheck->bindValue(':title', $title);
  $stmtCheck->execute();
  $checkResult = $stmtCheck->fetch(PDO::FETCH_ASSOC);

  if ($checkResult) {
    return false;
  }

  $sql = 'INSERT INTO habitats (title, content)
          VALUES (:title, :content)';
  $stmt = $pdo->prepare($sql);

  $stmt->bindValue(':title', $title);
  $stmt->bindValue(':content', $content);

  return $stmt->execute();
}

function deleteHabitat(PDO $pdo, INT $id): bool {
  $sql = 'DELETE FROM habitats WHERE id = :id';
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  return $stmt->execute();
}