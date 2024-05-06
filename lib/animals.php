<?php

function getAnimals(PDO $pdo): array {
  $query = 'SELECT * FROM animals';
  $stmt = $pdo->query($query);
  return $stmt->fetchAll();
}

function getAnimalById(PDO $pdo, INT $id): array {
  $query = 'SELECT * FROM animals WHERE id = :id';
  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getAnimalsByHabitat(PDO $pdo, STRING $habitat): array {
  $query = 'SELECT * FROM animals JOIN habitats ON animals.habitat_id = habitats.id WHERE habitats.title = :habitat';
  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':habitat', $habitat, PDO::PARAM_STR);
  $stmt->execute();
  return $stmt->fetchAll();
}

function addAnimal(PDO $pdo, STRING $name, STRING $habitat): bool {
  $query = 'INSERT INTO animals (name, habitat_id) VALUES (:name, (SELECT id FROM habitats WHERE title = :habitat))';
  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':name', $name, PDO::PARAM_STR);
  $stmt->bindValue(':habitat', $habitat, PDO::PARAM_STR);
  return $stmt->execute();
}

function deleteAnimal(PDO $pdo, INT $id): bool {
  $query = 'DELETE FROM animals WHERE id = :id';
  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  return $stmt->execute();
}