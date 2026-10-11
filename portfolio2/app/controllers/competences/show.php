
<?php
require '../app/views/competences/show.php';
?>

<!DOCTYPE html>
<html lang="fr">

<?php require '../app/views/head.php'; ?>

<body>
    <?php require '../app/views/header.php'; ?>

    <main>
        <?php
        $card = [
            'src' => $competence['photo'],
            'alt' => $competence['nom'],
            'href' => "/competences/show?id={$competence['id']}",
            'figcaption' => $competence['url']
        ];

        require '../app/views/components/card.php';
        ?>
    </main>

</body>
</html>
