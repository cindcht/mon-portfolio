<?php

$db = require '../bdd.php';
/**
 * L’instruction global $db permet d’accéder à la variable $db
 * définie dans le fichier bdd.php.
 * 
 * Cette pratique n’est pas recommandée dans un projet en production,
 * car elle crée une dépendance globale.
 * 
 * Nous l’utilisons ici pour simplifier le code.
 * Elle sera supprimée lorsque nous aborderons la programmation orientée objet.
 */

/**
 * Récupérer avec une clause personnalisée
 * 
 * Exemple :
 * $admins = where(
 *     'utilisateurs',
 *     ['email' => 'test@example.com', 'role' => 'admin']
 * );
 */
function where(string $table, array $conditions = []): array
{
    global $db;

    $sql = "SELECT * FROM $table";

    if ($conditions) {
        $clauses = array_map(
            fn($column) => "$column = :$column",
            array_keys($conditions)
        );

        $sql .= ' WHERE ' . implode(' AND ', $clauses);
    }

    $stmt = $db->prepare($sql);
    $stmt->execute($conditions);

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Récupérer toutes les lignes d'une table
 * 
 * Exemple :
 * $utilisateurs = all('utilisateurs');
 * foreach ($utilisateurs as $u) {
 *     echo $u['nom'] . ' ' . $u['prenom'] . "\n";
 * }
 */
function all(string $table): array
{
    return where($table);
}

/**
 * Récupérer une ligne par ID
 * 
 * Exemple :
 * $utilisateur = find('utilisateurs', 3);
 * echo $utilisateur['nom'] ?? 'Non trouvé';
 */
function find(string $table, int $id): ?array
{
    return where($table, ['id' => $id])[0] ?? null;
}

/**
 * Insérer une ligne
 * 
 * Exemple :
 * $id = create('utilisateurs', ['nom' => 'Dupont', 'prenom' => 'Jean', 'email' => 'jean.dupont@example.com', 'role' => 'user']);
 * echo "Nouvel utilisateur créé avec l'id $id";
 */
function create(string $table, array $datas): int
{
    global $db;

    $cols = implode(', ', array_keys($datas));
    $values = ':' . implode(', :', array_keys($datas));

    $stmt = $db->prepare("INSERT INTO `$table` ($cols) VALUES ($values)");
    $stmt->execute($datas);

    return (int) $db->lastInsertId();
}

/**
 * Mettre à jour une ligne par ID
 * 
 * Exemple :
 * $success = update('utilisateurs', ['id' => 3, 'nom' => 'Durand', 'prenom' => 'Paul', 'role' => 'admin']);
 * echo $success ? "Mise à jour OK" : "Erreur";
 */
function update(string $table, array $datas): bool
{
    global $db;

    if (!isset($datas['id'])) {
        throw new \InvalidArgumentException('ID manquant pour la mise à jour');
    }

    $id = $datas['id'];
    unset($datas['id']);

    $set = implode(', ', array_map(fn($k) => "$k = :$k", array_keys($datas)));

    $sql = "UPDATE `$table` SET $set WHERE id = :id";
    $stmt = $db->prepare($sql);

    return $stmt->execute([...$datas, 'id' => $id]);
}

/**
 * Supprimer une ligne par ID
 * 
 * Exemple :
 * $success = delete('utilisateurs', 3);
 * echo $success ? "Suppression OK" : "Erreur";
 */
function delete(string $table, int $id): bool
{
    global $db;

    $sql = "DELETE FROM `$table` WHERE id = :id";
    $stmt = $db->prepare($sql);
    
    return $stmt->execute(['id' => $id]);
}