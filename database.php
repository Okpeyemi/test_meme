<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=galerie", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion: ". $e->getMessage();
}
?>