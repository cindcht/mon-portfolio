
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= asset('css/stylesheet.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/colours.css') ?>">
    <?php var_dump(asset('css/stylesheet.css')); ?>

    <title><?= htmlspecialchars($page_title ?? 'Accueil') ?></title>

    <?php foreach (($page_styles ?? []) as $style) : ?>
        <link rel="stylesheet" href="<?= asset("css/{$style}.css") ?>">
    <?php endforeach; ?>
</head>
