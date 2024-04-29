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