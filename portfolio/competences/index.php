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
$listeCompetences = all('competences');


//variables php settings//

$page_base = '../';
$page_title = 'Compétences';
$page_styles = ['projets'];

?>

<!DOCTYPE html>
<html lang="en">
<?php require "$page_base/head.php"; ?>
<body>
     <?php require "$page_base/header.php"; ?>

    <main>
   

        <section>
            <h1>Mes compétences</h1>

          
                  <ul id="picsprojects">
                    
                    <?php foreach($listeCompetences as $competence) : ?>
                    <li> 
                       

                        <?php $card = [
                        
                     
                        'src'=> $competence['photo'], 
                        'alt'=> $competence['nom'],
                        'href'=> "competences/show.php?id={$competence['id']}"
                        ];
                        
                        
                    ?>
                    <?php require $page_base."components/card.php"?>
                    
                    <a href="competences/update.php?id=<?= $competence['id'] ?>">Modifier</a>
                    <p>
                    <a href="competences/delete.php?id=<?= $competence['id'] ?>">Supprimer</a>
                    </p>
                    
                    </li>
                      <?php endforeach ?>
                      
        
                </ul>
                
                

                  </section>
                  <section>
                          <a href="competences/create.php">Ajouter</a>
                  </section>
    </main>
     <?php require "$page_base/footer.php"; ?>
</body>
</html>