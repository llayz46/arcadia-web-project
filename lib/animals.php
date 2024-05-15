<?php

function getAnimalsAndBreed(PDO $pdo, INT $limit = null, BOOL $order = false): array {
  $query = 'SELECT animals.id AS animal_id, animals.name AS animal_name, animals.feed AS animal_feed, animals.feed_date AS animal_feedDate, breeds.id AS breed_id, breeds.name AS breed_name 
            FROM animals 
            JOIN breeds ON animals.breed_id = breeds.id 
            WHERE animals.breed_id = breeds.id';

  if ($order) {
    $query .= ' ORDER BY animal_id DESC';
  }
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

function getBreeds(PDO $pdo): array {
  $query = 'SELECT * FROM breeds';
  $stmt = $pdo->query($query);
  return $stmt->fetchAll();
}

function getAnimalById(PDO $pdo, INT $id): array|bool {
  $query = 'SELECT * FROM animals WHERE id = :id';
  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getAnimalHabitatById(PDO $pdo, INT $id): array|bool {
  $query = 'SELECT habitats.title AS habitat_title
            FROM animals 
            JOIN habitats ON animals.habitat_id = habitats.id
            WHERE animals.id = :id';
  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getAnimalsByHabitat(PDO $pdo, STRING $habitat): array {
  $query = 'SELECT animals.id AS animal_id, animals.name AS animal_name, breeds.id AS breed_id, breeds.name AS breed_name, habitats.title AS habitat_title
            FROM animals 
            JOIN breeds ON animals.breed_id = breeds.id
            JOIN habitats ON animals.habitat_id = habitats.id
            WHERE animals.breed_id = breeds.id
            AND habitats.title = :habitat';
  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':habitat', $habitat, PDO::PARAM_STR);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addAnimal(PDO $pdo, STRING $name, STRING $habitat, STRING $breed): bool {
  $query = 'INSERT INTO animals (name, habitat_id, breed_id) VALUES (:name, (SELECT id FROM habitats WHERE title = :habitat), (SELECT id FROM breeds WHERE name = :breed))';
  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':name', $name, PDO::PARAM_STR);
  $stmt->bindValue(':habitat', $habitat, PDO::PARAM_STR);
  $stmt->bindValue(':breed', $breed, PDO::PARAM_STR);
  return $stmt->execute();
}

function updateAnimal(PDO $pdo, INT $id, STRING $name, INT $habitat, INT $breed): bool {
  $sql = 'UPDATE animals
          SET name = :name, habitat_id = :habitat, breed_id = :breed
          WHERE id = :id';
  $stmt = $pdo->prepare($sql);

  $stmt->bindValue(':name', $name, PDO::PARAM_STR);
  $stmt->bindValue(':habitat', $habitat, PDO::PARAM_INT);
  $stmt->bindValue(':breed', $breed, PDO::PARAM_INT);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);

  return $stmt->execute();
}

function deleteAnimal(PDO $pdo, INT $id): bool {
  try {
    $pdo->beginTransaction();

    $query = 'DELETE FROM animal_reports WHERE animal_id = :id';
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $query = 'DELETE FROM animals WHERE id = :id';
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    
    $pdo->commit();
    return $stmt->execute();
  } catch (PDOException $e) {
    return false;
  }
}

function addAnimalFeed(PDO $pdo, STRING $feed, INT $id, DATETIME $date): bool {
  $query = 'UPDATE animals SET feed = :feed, feed_date = :feed_date WHERE id = :id';
  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':feed', $feed, PDO::PARAM_STR);
  $stmt->bindValue(':feed_date', $date->format('Y-m-d H-i-s'), PDO::PARAM_STR);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  return $stmt->execute();
}

function addBreed(PDO $pdo, STRING $name): bool {
  $query = 'INSERT INTO breeds (name) VALUES (:name)';
  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':name', $name, PDO::PARAM_STR);
  return $stmt->execute();
}