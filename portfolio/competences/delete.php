<?php
// ============================== 
// CONNEXION À LA BASE DE DONNÉES 
// ==============================
require '../model.php';

// ==============================
// INCLUSION HELPERS
// ==============================
require '../helpers.php';

// ==============================
// RÉCUPÉRATION DE L’ID 
// ==============================
$id = (int) ($_GET['id'] ?? 0);

// ============================== 
// RÉCUPÉRATION DU PROJET 
// ==============================  
$competence = find('competences', $id);

// Si aucun projet n’est trouvé → redirection vers la liste
if (!$competence) {
    header('location:../competences/index.php');
    exit;
}

// ============================== 
// TRAITEMENT DU FORMULAIRE
// ==============================
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supprimer'])) {
    // suppression du projet
    delete('competences', $id);

    // Dossier relatif de stockage des photos
    // par rapport à la racine du projet
    $relDir =  '../';

    // suppression de la photo si elle existe
    if (is_file("{$relDir}{$competence['photo']}")) {
        unlink("{$relDir}{$competence['photo']}");
    }
    // redirection
    header('location:../competences/index.php');
    exit;
}

// ============================== 
// VARIABLES POUR LA VUE 
// ==============================
$page_base = '../';
$page_title = "Supprimer-{$competence['nom']}";
$page_styles = ['projets'];

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
                <a href="competences/index.php">Annuler</a>
            </section>
        </form>
        <?php
        $card = [
            'src' => $competence['photo'],
            'alt'=> $competence['nom'],
            'href'=> "competences/show.php?id={$competence['id']}"
        ];
        require("$page_base/components/card.php");
        ?>
    </main>

    <?php require "$page_base/footer.php" ?>
</body>

</html>