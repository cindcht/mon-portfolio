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
$projet = find('projets', $id);

// Si aucun utilisateur n’est trouvé → redirection vers la liste
if (!$projet) {
    header('location:../projets/index.php');
    exit();
}

//variables php settings//

$page_base = '../';
$page_title = 'projets';
$page_styles = ['projets'];

?>

<!DOCTYPE html>
<html lang="en">
<?php require "$page_base/head.php"; ?>
<body>
     <?php require "$page_base/header.php"; ?>
                    <?php $card = [
                        'src'=> $projet['photo'], 
                        'alt'=> $projet['nom'],
                        'href'=> "projets/show.php?id={$projet['id']}",
                        'figcaption' => $projet['url']
                        ]
                        
                    ?>
                    <?php require $page_base."components/card.php"?>
</body>
</body>
</html>