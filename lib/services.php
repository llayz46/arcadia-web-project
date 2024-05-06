<?php

function getServices(PDO $pdo, INT $limit = null): array {
  $sql = 'SELECT * FROM services';

  if ($limit) {
    $sql .= ' LIMIT :limit';
  }

  $stmt = $pdo->prepare($sql);

  if ($limit) {
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
  }

  $stmt->execute();
  $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $formattedServices = [];

  foreach ($services as $service) {
    $formattedServices[$service['title']] = $service;
  }

  return $formattedServices;
}

function getServiceById(PDO $pdo, INT $id): array|bool {
  $sql = 'SELECT * FROM services WHERE id = :id';
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createService(PDO $pdo, STRING $title, STRING $about, STRING $content): bool {
  $title = filter_var(strtolower($title), FILTER_SANITIZE_SPECIAL_CHARS);
  $about = filter_var($about, FILTER_SANITIZE_SPECIAL_CHARS);
  $content = filter_var($content, FILTER_SANITIZE_SPECIAL_CHARS);

  $check = 'SELECT * FROM services WHERE title = :title';
  $stmtCheck = $pdo->prepare($check);
  $stmtCheck->bindValue(':title', $title);
  $stmtCheck->execute();
  $checkResult = $stmtCheck->fetch(PDO::FETCH_ASSOC);

  if ($checkResult) {
    return false;
  }

  $sql = 'INSERT INTO services (title, about, content)
          VALUES (:title, :about, :content)';
  $stmt = $pdo->prepare($sql);

  $stmt->bindValue(':title', $title);
  $stmt->bindValue(':about', $about);
  $stmt->bindValue(':content', $content);

  return $stmt->execute();
}

function deleteService(PDO $pdo, INT $id): bool {
  $sql = 'DELETE FROM services WHERE id = :id';
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  return $stmt->execute();
}

function updateService(PDO $pdo, INT $id, STRING $title, STRING $about, STRING $content): bool {
  $title = filter_var(strtolower($title), FILTER_SANITIZE_SPECIAL_CHARS);
  $about = filter_var($about, FILTER_SANITIZE_SPECIAL_CHARS);
  $content = filter_var($content, FILTER_SANITIZE_SPECIAL_CHARS);

  $sql = 'UPDATE services
          SET title = :title, about = :about, content = :content
          WHERE id = :id';
  $stmt = $pdo->prepare($sql);

  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->bindValue(':title', $title);
  $stmt->bindValue(':about', $about);
  $stmt->bindValue(':content', $content);

  return $stmt->execute();
}