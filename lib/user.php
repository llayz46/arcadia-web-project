<?php

function verifyUserAndRoleByLoginPassword(PDO $pdo, string $email, string $password): array|bool {
  $sql = "SELECT * FROM users
          JOIN roles ON roles.id = users.role_id
          WHERE email = :email";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':email', $email);
  $stmt->execute();

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password'])) {
    return $user;
  } else {
    return false;
  }
}

function createUserByEmailPassword(PDO $pdo, string $email, string $password, string $role): bool {
  $check = 'SELECT * FROM users WHERE email = :email';
  $stmtCheck = $pdo->prepare($check);
  $stmtCheck->bindValue(':email', $email);
  $stmtCheck->execute();
  $checkResult = $stmtCheck->fetch(PDO::FETCH_ASSOC);

  if ($checkResult) {
    return false;
  }

  $sql = 'INSERT INTO users (email, password, role_id)
          VALUES (:email, :password, (SELECT id FROM roles WHERE name = :role))';
  $stmt = $pdo->prepare($sql);

  $password = password_hash($password, PASSWORD_DEFAULT);

  $stmt->bindValue(':email', $email);
  $stmt->bindValue(':password', $password);
  $stmt->bindValue(':role', $role);

  return $stmt->execute();
}