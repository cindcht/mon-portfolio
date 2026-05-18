<?php
//bdd settings//

// ============================== 
// CONNEXION À LA BASE DE DONNÉES 
// ==============================
$db = require '../bdd.php';

// ==============================
// RÉCUPÉRATION DE LA LISTE
// ==============================

// Requête SQL pour récupérer tous les utilisateurs
$sql = 'SELECT * FROM projets';

// Préparation de la requête
$statement = $db->prepare($sql);

// Exécution de la requête
$statement->execute();

// Récupération de tous les résultats sous forme de tableau
$listeProjets= $statement->fetchAll();


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

    <main>
   

        <section>
            <h1>Mes créations/projets</h1>
            <p> Cliquez sur l'image pour avoir la description.</p>
                  <ul id="picsprojects">
                    
                    <?php foreach($listeProjets as $projet) : ?>
                    <li> 
                       

                        <?php $card = [
                        
                     
                        'src'=> $projet['photo'], 
                        'alt'=> $projet['nom'],
                        'href'=> "projets/show.php?id={$projet['id']}"

                        ]
                        
                        
                    ?>
                    <?php require $page_base."components/card.php"?>
                    <a href="projets/update.php">Modifier</a>
                    <a href="projets/delete.php">Supprimer</a>
                    
                    
                    </li>
                      <?php endforeach ?>
        
                </ul>
                

                  </section>
                  <section>
                    <a href="projets/create.php">Ajouter</a>

                  </section>
    </main>
     <?php require "$page_base/footer.php"; ?>
</body>
</html>