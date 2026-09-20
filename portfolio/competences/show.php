<?php
require '../model.php';

// ==============================
// RÉCUPÉRATION DE L’ID 
// ==============================
$id = (int) ($_GET['id'] ?? 0);

// ==============================
// RÉCUPÉRATION DE L’UTILISATEUR
// ==============================

// Récupération du projet (tableau associatif)
$competence = find('competences', $id);

// Si aucun utilisateur n’est trouvé → redirection vers la liste
if (!$comptence) {
    header('location:../competences/index.php');
    exit();
}

//variables php settings//

$page_base = '../';
$page_title = 'compétences';
$page_styles = ['projets'];

?>

<!DOCTYPE html>
<html lang="en">
<?php require "$page_base/head.php"; ?>
<body>
     <?php require "$page_base/header.php"; ?>
                    <?php $card = [
                        'src'=> $competence['photo'], 
                        'alt'=> $competence['nom'],
                        'href'=> "competences/show.php?id={$competence['id']}",
                        'figcaption' => $competence['url']
                        ]
                        
                    ?>
                    <?php require $page_base."components/card.php"?>
</body>
</body>
</html>