
<?php
require '../app/views/competences/update.php';
?>

<!DOCTYPE html>
<html lang="fr">

<?php require '../app/views/head.php'; ?>

<body>
    <?php require '../app/views/header.php'; ?>

    <main>
        <h1>Modifier</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <fieldset>
                <?php
                $card = [
                    'src' => $competence['photo'],
                    'alt' => $competence['nom'],
                    'href' => "/competences/show?id={$competence['id']}"
                ];

                require '../app/views/components/card.php';
                ?>

                <label for="photo">Modifier la photo</label>
                <input type="file" name="photo" id="photo">
            </fieldset>

            <fieldset>
                <ul>
                    <li>
                        <label for="nom">Nom</label>
                        <input
                            type="text"
                            name="nom"
                            id="nom"
                            value="<?= htmlspecialchars($competence['nom']) ?>"
                        >
                    </li>

                    <li>
                        <label for="description">Description</label>
                        <input
                            type="text"
                            name="description"
                            id="description"
                            value="<?= htmlspecialchars($competence['url']) ?>"
                        >
                    </li>
                </ul>
            </fieldset>

            <section class="form-buttons">
                <button type="submit" name="modifier">
                    Confirmer la modification
                </button>

                <a href="/competences/index" class="btn-cancel">Annuler</a>
            </section>
        </form>
    </main>

    <?php require '../app/views/footer.php'; ?>

</body>
</html>
