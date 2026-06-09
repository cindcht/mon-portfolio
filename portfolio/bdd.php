<?php
// bdd.php – création d'une connexion PDO

// Configuration de la base de données (à adapter selon votre serveur)
$host     = 'localhost';
$port     = 3306;          // Vérifier le port dans phpMyAdmin si nécessaire
$dbname   = 'wmi_2025_dauchart';
$username = 'root';        // Sur certains serveurs, le mot de passe peut être vide
$password = 'root';
$charset  = 'utf8mb4';     // Supporte accents et emojis

// DSN (Data Source Name)
$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";

// Options PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Gestion des erreurs avec exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Récupération sous forme de tableau associatif
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Prévention des injections SQL
];

// Création de la connexion PDO
try {
    $pdo = new PDO($dsn, $username, $password, $options);
    return $pdo; // Retourne l'objet PDO pour l'utiliser dans le fichier principal
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données.');
}