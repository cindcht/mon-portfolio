<?php
//bdd settings//

// ============================== 
// CONNEXION À LA BASE DE DONNÉES 
// ==============================
require '../model.php';

// ==============================
// RÉCUPÉRATION DE LA LISTE
// ==============================

// Requête SQL pour récupérer tous les projets
$listeProjets = all('projets');


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
                        ];
                        
                        
                    ?>
                    <?php require $page_base."components/card.php"?>
                    
                    <a href="projets/update.php?id=<?= $projet['id'] ?>">Modifier</a>
                    <p>
                    <a href="projets/delete.php?id=<?= $projet['id'] ?>">Supprimer</a>
                    </p>
                    
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