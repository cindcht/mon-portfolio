<!DOCTYPE html>
<html lang="fr">

<?php require "../app/views/head.php"; ?>

<body>
    <?php require "../app/views/header.php"; ?>

    <main>
        <section>
            <h1>Mes compétences</h1>

            <ul id="picsprojects">
                <?php foreach ($listeCompetences as $competence) : ?>
                    <li>
                        <?php
                        $card = [
                            'src' => $competence['photo'],
                            'alt' => $competence['nom'],
                            'href' => asset("competences/show?id={$competence['id']}")
                        ];

                        require "../app/views/components/card.php";
                        ?>

                        <a href="<?= asset("competences/update?id={$competence['id']}") ?>">
                            Modifier
                        </a>

                        <p>
                            <a href="<?= asset("competences/delete?id={$competence['id']}") ?>">
                                Supprimer
                            </a>
                        </p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section>
            <a href="<?= asset('competences/create') ?>">Ajouter</a>
        </section>
    </main>

    <?php require "../app/views/footer.php"; ?>
</body>

</html>