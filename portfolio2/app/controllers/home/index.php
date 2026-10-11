
<?php
// ==============================
// INCLUSION DE LA VUE
// ==============================
require '../app/views/home/index.php';
?>

<!DOCTYPE html>
<html lang="fr">

<?php require '../app/views/head.php'; ?>

<body>
    <?php require '../app/views/header.php'; ?>

    <main>
        <section>
            <h1>
                <img src="/images/about me.png" alt="" class="icon">
                À propos de moi
            </h1>

            <p>
                Actuellement en formation de Webmaster et Métiers de l'Internet
                au FCU à Calais, je suis des cours de langages informatiques,
                Photoshop, Illustrator...
            </p>

            <h1>
                <img src="/images/education.png" alt="" class="icon">
                Expériences et formations
            </h1>

            <article class="pics">
                <figure>
                    <img src="/images/ulco logo.png" alt="Logo ULCO">
                    <figcaption></figcaption>
                </figure>

                <figure>
                    <img src="/images/simplon logo.png" alt="Logo Simplon">
                    <figcaption></figcaption>
                </figure>

                <figure>
                    <img src="/images/flag gb.png" alt="Drapeau britannique">
                    <figcaption></figcaption>
                </figure>
            </article>
        </section>
    </main>

    <?php require '../app/views/footer.php'; ?>

</body>
</html>
