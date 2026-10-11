
<!DOCTYPE html>
<html lang="fr">

<?php require "../app/views/head.php"; ?>

<body>
    <?php require "../app/views/header.php"; ?>

    <main>
        <h1>Supprimer</h1>

        <form action="" method="post">
            <section class="form-buttons">
                <button type="submit" name="supprimer">
                    Confirmer la suppression
                </button>

                <a href="<?= asset('projets/index') ?>">Annuler</a>
            </section>
        </form>

        <?php
        $card = [
            'src' => asset($projet['photo']),
            'alt' => $projet['nom'],
            'href' => asset("projets/show?id={$projet['id']}")
        ];

        require "../app/views/components/card.php";
        ?>
    </main>

    <?php require "../app/views/footer.php"; ?>
</body>

</html>
