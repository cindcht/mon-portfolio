<?php

/**
 * Routeur minimaliste
 * -------------------
 * Rôle :
 *  - Nettoyer l’URL
 *  - Extraire contrôleur + action
 *  - Inclure dynamiquement le bon fichier contrôleur
 */

// Chargement du modèle (fonctions d’accès à la base de données)
require '../app/models/model.php';
// Chargement des helpers (fonctions utilitaires) 
require '../app/helpers.php';

/* -------------------------------------------------------------
   Construction du chemin demandé à partir de 
   l’URL du client et du script d’entrée public/index.php
------------------------------------------------------------- */

// Récupère le chemin demandé, sans les paramètres GET
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Récupère le dossier de base de l'application
$basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

// Supprime le chemin de base s'il est présent
if (str_starts_with($requestUri, $basePath)) {
   $requestUri = substr($requestUri, strlen($basePath));
}

// Normalise le chemin en ajoutant un seul / au début
$path = '/' . ltrim($requestUri, '/');

/* -------------------------------------------------------------
   Découpage du chemin en segments pour 
   déterminer le contrôleur et l’action
------------------------------------------------------------- */

$params = $path === '/' ? [] : explode('/', trim($path, '/'));

// controleur et action par défaut si non précisés dans l'URL
$controller = $params[0] ?? 'home';
$action = $params[1] ?? 'index';

/* -------------------------------------------------------------
   Gestion des erreurs : contrôleur ou action manquants
------------------------------------------------------------- */

$controllerFile = "../app/controllers/$controller/$action.php";

if (!file_exists($controllerFile)) {
   http_response_code(404);
   $controllerFile = "../app/controllers/error/index.php";
}

/* -------------------------------------------------------------
   Inclusion dynamique du fichier contrôleur
------------------------------------------------------------- */

require $controllerFile;
require '../app/controllers/home/index.php';