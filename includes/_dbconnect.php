<?php
  try {
    $connexion = new PDO(
        $_ENV['DB_HOST'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASSWORD']);
    $connexion -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $getError) {
    echo 'Erreur : ' . $getError->getMessage();
    die();
}
?>