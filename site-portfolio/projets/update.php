<?php
// ==============================
// CONNEXION À LA BASE DE DONNÉES
// ==============================
$db = require '../bdd.php';

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

// Requête SQL avec paramètre nommé
$sql = 'SELECT * FROM projets WHERE id = :id';

// Préparation de la requête (protection contre les injections SQL)
$statement = $db->prepare($sql);

// Exécution de la requête en liant le paramètre :id
$statement->execute(['id' => $id]);

// Récupération de l’utilisateur sous forme de tableau associatif
$projet = $statement->fetch();

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
    $baseSlug = slug("$prenom-$nom");
    $slug = $baseSlug;

    $i = 1;
    // Requête SQL avec paramètres nommés
    $sql = "SELECT * FROM projets WHERE slug = :slug";
    // Préparation de la requête (sécurité contre les injections SQL)
    $stmt = $db->prepare($sql);
    // Exécution de la requête avec le slug actuel
    $stmt->execute(['slug' => $slug]);
    // Tant qu’un enregistrement existe avec ce slug, on ajoute un suffixe numérique
    while ($stmt->fetch()) {
        $slug = "{$baseSlug}_{$i}";
        $stmt->execute(['slug' => $slug]);
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
    $photo = $utilisateur['photo'];

    // Création du dossier s’il n’existe pas
    if (!is_dir($relDir . $photoDir)) {
        mkdir($relDir . $photoDir, 0755, true);
    }

    // Chemin complet de l’ancienne photo
    $oldPathPhoto = "{$relDir}{$photo}";

    // ------------------------------
    // RENOMMAGE DE LA PHOTO SI SLUG MODIFIÉ
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

    // Requête UPDATE avec paramètres nommés
    $sql = "UPDATE projets 
            SET nom = :nom,
                photo = :photo,
                url = :url,
                slug = :slug,
            WHERE id = :id";

    // Préparation de la requête
    $statement = $db->prepare($sql);

    // Exécution de la requête
    // compact() crée un tableau associatif :
    // ['nom' => $nom, 'prenom' => $prenom, ...]
    $statement->execute(
        compact('nom', 'photo', 'url', 'slug', 'id')
    );

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
<html lang='en'>

<?php require '../head.php' ?>

<body>
    <?php require '../header.php' ?>

    <main>
        <h1>Modifier</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <fieldset>
                <?php
                 $card = [
                        
                     
                        'src'=> $projet['photo'], 
                        'alt'=> $projet['nom'],
                        'href'=> "projets/show.php?id={$projet['id']}"

                        ]
              
                ?>
                <?php require $page_base."components/card.php"?>

                <label for="photo">Modifier la photo</label>
                <input type="file" name="photo" id="photo">
            </fieldset>
            <fieldset>
                <ul>
                    <li>
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" value="<?= $projet['nom'] ?>">
                    </li>
                    <li>
                        <label for="prenom">Description</label>
                        <input type="text" name="description" value="<?= $projet['url'] ?>">
                    </li>
                </ul>
            </fieldset>

            <section class="form-buttons">
                <button type="submit" name="modifier">Confirmer la modification</button>
                <a href="projets/index.php">Annuler</a>
            </section>
        </form>


    </main>

    <?php require '../footer.php' ?>
</body>

</html>