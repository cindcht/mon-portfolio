
<a href="<?= htmlspecialchars($card['href'], ENT_QUOTES, 'UTF-8') ?>">
    <figure class="projets">
        <img
            class="imgprojets"
            src="<?= asset($card['src']) ?>"
            alt="<?= htmlspecialchars($card['alt'], ENT_QUOTES, 'UTF-8') ?>"
        >

        <figcaption>
            <?= htmlspecialchars($card['figcaption'] ?? '', ENT_QUOTES, 'UTF-8') ?>
        </figcaption>
    </figure>
</a>
