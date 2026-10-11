
<!DOCTYPE html>
<html lang="fr">

<?php require "../app/views/head.php"; ?>

<body>
    <?php require "../app/views/header.php"; ?>

    <main>
        <h1>Ajouter</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Compétence</legend>
                <ul>
                    <li>
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom">
                    </li>

                    <li>
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description">
                    </li>
                </ul>
            </fieldset>

            <fieldset>
                <legend>Photo</legend>
                <ul>
                    <li>
                        <label for="photo">Photo</label>
                        <input type="file" name="photo" id="photo">
                    </li>
                </ul>
            </fieldset>

            <section class="form-buttons">
                <button type="submit" name="ajouter">Ajouter</button>
                <a href="<?= asset('competences/index') ?>" class="btn-cancel">Annuler</a>
            </section>
        </form>
    </main>

    <?php require "../app/views/footer.php"; ?>
</body>

</html>
