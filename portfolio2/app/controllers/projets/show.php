
<?php
require '../app/views/projets/show.php';
?>

<!DOCTYPE html>
<html lang="fr">

<?php require '../app/views/head.php'; ?>

<body>
    <?php require '../app/views/header.php'; ?>

    <main>
        <?php
        $card = [
            'src' => $projet['photo'],
            'alt' => $projet['nom'],
            'href' => "/projets/show?id={$projet['id']}",
            'figcaption' => $projet['url']
        ];

        require '../app/views/components/card.php';
        ?>
    </main>

</body>
</html>
