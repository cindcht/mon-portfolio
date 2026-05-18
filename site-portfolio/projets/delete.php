<?php
// ============================== 
// CONNEXION À LA BASE DE DONNÉES 
// ==============================
$db = require '../bdd.php';

// ==============================
// RÉCUPÉRATION DE L’ID 
// ==============================
$id = (int) ($_GET['id'] ?? 0);

// ============================== 
// RÉCUPÉRATION DE L’UTILISATEUR 
// ==============================  
// création de la requête
$sql = 'SELECT * FROM projets WHERE id = :id';
// envoi de la requête et récupération du résultat
$statement = $db->prepare($sql);
$statement->execute(['id' => $id]);
$projet = $statement->fetch();

// Si aucun utilisateur n’est trouvé → redirection vers la liste
if (!$projet) {
    header('location:../projets/index.php');
    exit;
}

// ============================== 
// TRAITEMENT DU FORMULAIRE
// ==============================
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supprimer'])) {
    // suppression de l'utilisateur
    $sql = 'DELETE FROM projets WHERE id = :id';
    // envoi de la requête
    $statement = $db->prepare($sql);
    $statement->execute(['id' => $id]);

    // Dossier relatif de stockage des photos
    // par rapport à la racine du projet
    $relDir =  '../';

    // suppression de la photo si elle existe
    if (is_file("{$relDir}{$projet['photo']}")) {
        unlink("{$relDir}{$projet['photo']}");
    }
    // redirection
    header('location:../projets/index.php');
    exit;
}

// ============================== 
// VARIABLES POUR LA VUE 
// ==============================
$page_base = '../';
$page_title = "Supprimer-{$projet['nom']}";
$page_styles = ['utilisateur'];

?>
<!DOCTYPE html>
<html lang='fr'>

<?php require "$page_base/head.php" ?>

<body>
    <?php require "$page_base/header.php" ?>

    <main>
        <h1>Supprimer</h1>
        <form action="" method="post">
            <section class="form-buttons">
                <button type="submit" name="supprimer">Confirmer la suppression</button>
                <a href="projets/index.php">Annuler</a>
            </section>
        </form>
        <?php
        $card = [
            'src' => $projet['photo'],
            'alt' => "photo de {$projet['nom']}",
            'href'=> "projets/show.php?id={$projet['id']}"
        ];
        require("$page_base/components/card.php");
        ?>
    </main>

    <?php require "$page_base/footer.php" ?>
</body>

</html>