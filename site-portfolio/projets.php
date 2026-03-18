<?php

$page_base = './';


?>

<!DOCTYPE html>
<html lang="en">
<?php require "$page_base/head.php"; ?>
<body>
     <?php require "$page_base/header.php"; ?>
<body>
    <main>
        <section>
            <h1>Mes créations/projets</h1>
            <p> Cliquez sur l'image pour avoir la description.</p>
                  <ul id="picsprojects">
            <li><a href="crea-paysage.php">
                 <figure class="projets">
                    <img class="imgprojets" src="images/paysage.png" alt=""/>
                    <figcaption></figcaption>
                </figure>
            </a></li>
            
             <li><a href="projet-noel.php">
                 <figure class="projets">
                    <img class="imgprojets" src="images/projetnoel.jpg" alt=""/>
                    <figcaption></figcaption>
                </figure>
            </a></li>

            <li><a href="livre-cuisine.php">
                 <figure class="projets">
                    <img class="imgprojets" src="images/livre recette.png" alt=""/>
                    <figcaption></figcaption>
                </figure>
            </a></li>

             <li><a href="arketing.php">
                 <figure class="projets">
                    <img class="imgprojets" src="images/arketing.png" alt=""/>
                    <figcaption></figcaption>
                </figure>
            </a></li>

            <li><a href="carte-de-voeux.php">
                 <figure class="projets">
                    <img class="imgprojets" src="images/carte de voeux.png" alt=""/>
                    <figcaption></figcaption>
                </figure>
            </a></li>

            
          
           </ul>

                  

                




        </section>
    </main>
     <?php require "$page_base/footer.php"; ?>
</body>
</html>