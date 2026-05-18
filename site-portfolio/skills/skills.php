<?php

$page_base = './';
$page_title = 'compétences';
$page_styles = ['skills'];


?>

<!DOCTYPE html>
<html lang="en">
<?php require "$page_base/head.php"; ?>
<body>
     <?php require "$page_base/header.php"; ?>

    <main>
        <section>
        <h1> <img src="images/skills icon.png" alt="" class="icon"/>Mes compétences</h1>
        
        <P>
           <?php require "bdd.php"; ?>

           <?php foreach ($listecompetences as $competence) {
                    echo $competence['nom'] ."<br>";
}
           ?>
        </P>

        <p>

       <article id="skillspics">
             <figure>
             <img src="images/logo html.png" alt=""/>
             <figcaption></figcaption>
             </figure>
       

        
            <figure>
            <img src="images/communication logo.png" alt="" height="250px" width="250px"/>
            <figcaption></figcaption>
            </figure> 
        

       
            <figure>
            <img src="images/photoshop.png" alt="" height="250px" width="250px"/>
            <figcaption></figcaption>
            </figure> 
        

        
            <figure>
            <img src="images/illustrator.png" alt="" height="250px" width="250px"/>
            <figcaption></figcaption>
            </figure> 

    </article>
        
    </p>

</section>
    </main>
        
     <?php require "$page_base/footer.php"; ?>
</body>
</html>