<?php
require_once 'templates/aside-nav.php';
require_once __DIR__ . '/../../lib/pdo.php';
require_once __DIR__ . '/../../lib/user.php';

$errors = [];
$success = [];

if (isset($_POST['createUser'])) {
  if ($_POST['password'] !== $_POST['password_confirm']) {
    $errors[] = 'Les mots de passe ne correspondent pas';
  } else {
    $res = createUserByEmailPassword($pdo, $_POST['email'], $_POST['password'], $_POST['role']);

    if ($res) {
      $success[] = 'Le compte a été créé avec succès';
    } else {
      $errors[] = 'Erreur lors de la création du compte';
    }
  }
}
?>

<main class="dashboard__main">
  <h2 class="dashboard__title">Créer un compte</h2>
  <form method="post" class="dashboard__account-form">
    <label for="email" class="dashboard__account-label">
      Adresse email
      <input class="dashboard__account-input" type="email" name="email" id="email" required>
    </label>
    <label for="password" class="dashboard__account-label">
      Mot de passe
      <input class="dashboard__account-input" type="password" name="password" id="password" required>
    </label>
    <label for="password_confirm" class="dashboard__account-label">
      Confirmer le mot de passe
      <input class="dashboard__account-input" type="password" name="password_confirm" id="password_confirm" required>
    </label>
    <label for="role" class="dashboard__account-label">
      Choisissez un rôle
      <select name="role" id="role" class="dashboard__account-input">
        <option value="veterinaire">Vétérinaire</option>
        <option value="employe">Employé</option>
      </select>
    </label>
    <input class="dashboard__account-submit" type="submit" value="Créer le compte" name="createUser">
  </form>
  <?php if ($errors) {
    foreach ($errors as $error) { ?>
      <div class="dashboard__account-info">
        <h3 class="dashboard__account-message--error"><?= $error ?></h3>
      </div>
    <?php }
  } else if ($success) {
    foreach ($success as $message) { ?>
      <div class="dashboard__account-info">
        <h3 class="dashboard__account-message--success"><?= $message ?></h3>
      </div>
  <?php }
  } ?>
</main>
</body>

</html>