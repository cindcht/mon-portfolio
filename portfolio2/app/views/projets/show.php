
<!DOCTYPE html>
<html lang="fr">

<?php require "../app/views/head.php"; ?>

<body>
    <?php require "../app/views/header.php"; ?>

    <main>
        <?php
        $card = [
            'src' => asset($projet['photo']),
            'alt' => $projet['nom'],
            'href' => asset("projets/show?id={$projet['id']}"),
            'figcaption' => $projet['url']
        ];

        require "../app/views/components/card.php";
        ?>
    </main>

    <?php require "../app/views/footer.php"; ?>
</body>

</html>
