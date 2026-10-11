
<!DOCTYPE html>
<html lang="fr">

<?php require "../app/views/head.php"; ?>

<body>
    <?php require "../app/views/header.php"; ?>

    <main>
        <section>
            <h1>
                <img src="<?= asset('images/about me.png') ?>" alt="" class="icon">
                À propos de moi
            </h1>

            <p>
                Actuellement en formation de Webmaster et Métiers de l'Internet
                au FCU à Calais, je suis des cours de langages informatiques,
                Photoshop, Illustrator...
            </p>

            <h1>
                <img src="<?= asset('images/education.png') ?>" alt="" class="icon">
                Expériences et formations
            </h1>

            <article class="pics">
                <figure>
                    <img src="<?= asset('images/ulco logo.png') ?>" alt="">
                    <figcaption></figcaption>
                </figure>

                <figure>
                    <img src="<?= asset('images/simplon logo.png') ?>" alt="">
                    <figcaption></figcaption>
                </figure>

                <figure>
                    <img src="<?= asset('images/flag gb.png') ?>" alt="">
                    <figcaption></figcaption>
                </figure>
            </article>
        </section>
    </main>

    <?php require "../app/views/footer.php"; ?>
</body>

</html>
