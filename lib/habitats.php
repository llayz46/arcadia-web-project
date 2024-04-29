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