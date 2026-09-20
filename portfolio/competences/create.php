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
// TRAITEMENT DU FORMULAIRE
// ==============================

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter'])) {

  // ------------------------------
  // RÉCUPÉRATION DES DONNÉES
  // ------------------------------

  // Nettoyage des champs texte - supprime les espaces superflus
  $nom = trim($_POST['nom'] ?? '');
  $description = trim($_POST['description'] ?? '');

  

  // Slug qui servira à la fois pour l’URL et le nom du fichier photo
  // La fonction slug() transforme une chaîne en format compatible URL 
  // (par exemple : "Jean Dupont" → "jean-dupont")
  // On s’assure que ce slug est unique : si un enregistrement existe déjà,
  // un suffixe numérique sera ajouté pour créer un slug distinct
  $baseSlug = slug("$nom");
  $slug = $baseSlug;
  $i = 1;
  // Requête SQL avec paramètres nommés
  $sql = "SELECT * FROM competences WHERE slug = :slug";
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

  // Création du dossier s’il n’existe pas
  if (!is_dir($relDir . $photoDir)) {
    mkdir($relDir . $photoDir, 0755, true);
  } //if does not exist mkdir (make directory)
  // 0755 = Ce sont les permissions du dossier Linux/Unix.

  // Cas 1 : une photo a été uploadée
  if (
    isset($_FILES['photo']) &&
    is_uploaded_file($_FILES['photo']['tmp_name'])//tmp_name emplacement temporaire
  ) {

    // Récupération de l’extension du fichier (en minuscule)
    $extension = strtolower(
      pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION)
    );

    // Nom final du fichier photo
    $photo = "{$photoDir}{$slug}.{$extension}";

    // Déplacement du fichier temporaire vers le dossier photos
    move_uploaded_file(
      $_FILES['photo']['tmp_name'],
      "{$relDir}{$photo}"
    );

    // Cas 2 : aucune photo envoyée → image par défaut
  } else {

    // Nom de la photo par défaut
    $photo = "{$photoDir}{$slug}.png";

    // Copie de l’image générique
    copy(
      "{$relDir}{$photoDir}photo.png",
      "{$relDir}{$photo}"
    );
  }



  // ------------------------------
  // REDIRECTION
  // ------------------------------

  // Redirection après succès (évite la resoumission du formulaire)
  header('location:../competences/index.php');
  exit;
}

// ==============================
// VARIABLES POUR LA VUE
// ==============================

$page_base = '../';
$page_title = 'Ajouter une compétence';
$page_styles = ['projets'];
?>

<!DOCTYPE html>
<html lang='fr'>

<?php require "$page_base/head.php" ?>

<body>
  <?php require "$page_base/header.php" ?>
  <main>
    <h1>Ajouter</h1>
    <form action='' method='post' enctype='multipart/form-data'>
      <fieldset>
        <legend>Compétence</legend>
        <ul>
          <li>
            <label for="nom">Nom</label>
            <input type='text' name='nom' id='nom'>
          </li>


          <li>
            <label for="Description">Description</label>
            <input type='text' name='description' id='description'>
          </li>
        </ul>
      </fieldset>
      <fieldset>
        <legend>Photo</legend>
        <ul>
          <li>
            <label for="photo">Photo</label>
            <input type='file' name='photo' id='photo'>
          </li>

        </ul>
      </fieldset>

      <section class="form-buttons">
        <button type="submit" name="ajouter">Ajouter</button>
        <a href="competences/index.php" class="btn-cancel">Annuler</a>
      </section>

    </form>
  </main>
  <?php require "$page_base/footer.php" ?>
</body>

</html>