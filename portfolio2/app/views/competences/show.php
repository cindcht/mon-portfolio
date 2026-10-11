
<!DOCTYPE html>
<html lang="fr">

<?php require "../app/views/head.php"; ?>

<body>
    <?php require "../app/views/header.php"; ?>

    <main>
        <?php
        $card = [
            'src' => asset($competence['photo']),
            'alt' => $competence['nom'],
            'href' => asset("competences/show?id={$competence['id']}"),
            'figcaption' => $competence['url']
        ];

        require "../app/views/components/card.php";
        ?>
    </main>

    <?php require "../app/views/footer.php"; ?>
</body>

</html>

