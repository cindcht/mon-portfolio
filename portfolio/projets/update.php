<?php
// ==============================
// CONNEXION À LA BASE DE DONNÉES
// ==============================
 require '../model.php';

// ==============================
// INCLUSION HELPERS
// ==============================
require '../helpers.php';

// ==============================
// RÉCUPÉRATION DE L’ID 
// ==============================
$id = (int) ($_GET['id'] ?? 0);

// ==============================
// RÉCUPÉRATION DE L’UTILISATEUR
// ==============================

$projet = find('projets', $id);


// Si aucun utilisateur n’est trouvé, redirection vers la liste
if (!$projet) {
    header('location:../projets/index.php');
    exit;
}

// ==============================
// TRAITEMENT DU FORMULAIRE
// ==============================
// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifier'])) {

    // Sauvegarde de l’ancien slug (utile pour renommer la photo)
    $oldSlug = $projet['slug'];

    // Récupération et nettoyage des champs du formulaire
    $nom = trim($_POST['nom'] ?? '');
    $description = trim($_POST['description'] ?? '');


    // ------------------------------
    // Génération du slug à partir du prénom et du nom
    // ------------------------------
     $baseSlug = slug("$nom");
    $slug = $baseSlug;

    $i = 1;
    // Tant qu’un enregistrement existe avec ce slug, on ajoute un suffixe numérique
    while (where('projets', ['slug' => $slug])) {
        $slug = "{$baseSlug}_{$i}";
        $i++;
    }

    

   // ------------------------------
    // GESTION DE LA PHOTO
    // ------------------------------

    // Dossier relatif de stockage des photos
    // par rapport à la racine du projet
    $relDir =  '../';
    // Dossier de stockage des photos
    $photoDir = 'images/photos/';

    // Par défaut, on conserve la photo existante
    $photo = $projet['photo'];

    // Création du dossier s’il n’existe pas
    if (!is_dir($relDir . $photoDir)) {
        mkdir($relDir . $photoDir, 0755, true);
    }

    // Chemin complet de l’ancienne photo
    $oldPathPhoto = "{$relDir}{$photo}";

    // ------------------------------ 
    // RENOMMAGE DE LA PHOTO SI LE SLUG A CHANGÉ 
    // ------------------------------

    // Si le slug a changé et que la photo existe
    if ($oldSlug !== $slug && is_file($oldPathPhoto)) {

        // Récupération de l’extension du fichier
        $extension = pathinfo($oldPathPhoto, PATHINFO_EXTENSION);

        // Nouveau nom de fichier
        $photo = "{$photoDir}{$slug}.{$extension}";

        // Renommage du fichier sur le serveur
        rename($oldPathPhoto, "{$relDir}{$photo}");
    }

    // ------------------------------
    // UPLOAD D’UNE NOUVELLE PHOTO
    // ------------------------------

    // Vérifie qu’un fichier a bien été envoyé
    if (
        isset($_FILES['photo']) &&
        is_uploaded_file($_FILES['photo']['tmp_name'])
    ) {

        // Suppression de la photo si elle existe
        if (is_file("{$relDir}{$photo}")) {
            unlink("{$relDir}{$photo}");
        }

        // Récupération de l’extension de la nouvelle photo
        $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

        // Nouveau nom de fichier
        $photo = "{$photoDir}{$slug}.{$extension}";

        // Déplacement du fichier temporaire vers le dossier photos
        move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            "{$relDir}{$photo}"
        );
    }

    // ------------------------------
    // MISE À JOUR EN BASE DE DONNÉES
    // ------------------------------
 // Exécution de la requête
    // compact() crée un tableau associatif :
    // ['nom' => $nom, 'prenom' => $prenom, ...]
    update('projets', compact('nom', 'photo', 'url', 'slug','id'));

    // Redirection après succès
    header('location:../projets/index.php');
    exit;
}

// ==============================
// VARIABLES POUR LA VUE
// ==============================

$page_base = '../';
$page_title = "Modifier-{$projet['nom']}";
$page_styles = ['projets'];
?>
<!DOCTYPE html>
<html lang='fr'>

<?php require '../head.php' ?>

<body>
    <?php require '../header.php' ?>

    <main>
        <h1>Modifier</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <fieldset>
                <?php
                $card = [
                    'src' => $projet['photo'],
                    'alt'=> $projet['nom'],
                    'href'=> "projets/show.php?id={$projet['id']}"
                ];
                require('../components/card.php');
                ?>

                <label for="photo">Modifier la photo</label>
                <input type="file" name="photo">
            </fieldset>
            <fieldset>
                <ul>
                    <li>
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" value="<?= $projet['nom'] ?>">
                    </li>
                    <li>
                        <label for="description">Description</label>
                        <input type="text" name="description"  value="<?= $projet['url'] ?>">
                    </li>
                </ul>
            </fieldset>

            <section class="form-buttons">
                <button type="submit" name="modifier">Confirmer la modification</button>
                <a href="projets/index.php" class="btn-cancel">Annuler</a>
            </section>
        </form>


    </main>

    <?php require '../footer.php' ?>
</body>

</html>