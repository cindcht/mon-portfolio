<?php

$page_base = './';
$page_styles = ['index'];



?>

<!DOCTYPE html>
<html lang="en">

<?php require "$page_base/head.php"; ?>

<body>
    <?php require "$page_base/header.php"; ?>

    <main>
        <section> 
            <h1> <img src="images/about me.png" alt="" class="icon"/>A propos de moi</h1>
            <p>Actuellement en formation de Webmaster et M&tier de l'Internet au FCU à Calais, dans laquelle je suis des cours de languages informatique,
                Photoshop, Illustrator...</p> 
                <p>Et afin de valider
                    mon année je dois trouver une alternance.</p>
            
            <p>
                <h1> <img src="images/education.png" alt="" class="icon"/> Expériences et formations</h1>
            <ul>
            <?php 
            require "bdd.php";
            
            ?>

            <?php 
            foreach ($listeformations as $formation) {
                echo $formation['nom'] . " - " . $formation['année'] . "<br>";
}
            ?>
            </ul>
            </p>
       
            <article class="pics">

                <figure>
                    <img src="images/ulco logo.png" alt=""/>
                    <figcaption></figcaption>
                </figure>
            

                    <figure>
                        <img src="images/simplon logo.png" alt=""/>
                        <figcaption></figcaption>
                 </figure>


                    <figure>
                        <img src="images/flag gb.png" alt=""/>
                        <figcaption></figcaption>
                </figure>

            </article>

 </section>   
    </main>
   <?php require "$page_base/footer.php"; ?>
</body>
</html>