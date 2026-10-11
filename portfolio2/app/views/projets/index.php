<!DOCTYPE html>
<html lang="fr">

<?php require "../app/views/head.php"; ?>

<body>
    <?php require "../app/views/header.php"; ?>

    <main>
        <section>
            <h1>Mes projets</h1>

            <ul id="picsprojects">
                <?php foreach ($listeProjets as $projet) : ?>
                    <li>
                        <?php
                        $card = [
                            'src' => $projet['photo'],
                            'alt' => $projet['nom'],
                            'href' => asset("projets/show?id={$projet['id']}")
                        ];

                        require "../app/views/components/card.php";
                        ?>

                        <a href="<?= asset("projets/update?id={$projet['id']}") ?>">
                            Modifier
                        </a>

                        <p>
                            <a href="<?= asset("projets/delete?id={$projet['id']}") ?>">
                                Supprimer
                            </a>
                        </p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section>
            <a href="<?= asset('projets/create') ?>">Ajouter</a>
        </section>
    </main>

    <?php require "../app/views/footer.php"; ?>
</body>

</html>