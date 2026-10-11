<?php

// permet de générer un slug à partir d'une chaîne de caractères
// un slug doit être url-friendly, c'est à dire sans espaces ni caractères spéciaux
// ex: "Jean Dupont" → "jean-dupont"
function slug(string $string): string
{
    // Supprimer les espaces inutiles
    $string = trim($string);

    // Convertir en minuscules (UTF-8 compatible)
    $string = mb_strtolower($string, 'UTF-8');

    // Remplacer les caractères accentués
    $string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);

    // Remplacer tout ce qui n’est pas lettre ou chiffre par un tiret
    $string = preg_replace('/[^a-z0-9]+/', '-', $string);

    // Supprimer les tirets multiples
    $string = preg_replace('/-+/', '-', $string);

    // Supprimer les tirets en début et fin
    return trim($string, '-');
}

// permet d'afficher une ou plusieurs variables de manière lisible dans le navigateur
function dumpVar(mixed $data): void
{
    if (is_null($data)) {
        echo '<span class="dump-null">null</span>';
        return;
    }

    if (is_bool($data)) {
        echo '<span class="dump-bool">' . ($data ? 'true' : 'false') . '</span>';
        return;
    }

    if (is_int($data) || is_float($data)) {
        echo '<span class="dump-number">' . $data . '</span>';
        return;
    }

    if (is_string($data)) {
        echo '<span class="dump-string">"' . htmlspecialchars($data) . '"</span>';
        return;
    }

    if (is_array($data)) {
        echo '<details open>';
        echo '<summary class="dump-type">array: ' . count($data) . '</summary>';

        foreach ($data as $key => $value) {
            echo '<div>';
            echo '<span class="dump-key">' . htmlspecialchars((string)$key) . '</span> => ';
            dumpVar($value);
            echo '</div>';
        }

        echo '</details>';
        return;
    }

    if (is_object($data)) {
        echo '<details open>';
        echo '<summary class="dump-type">object: ' . get_class($data) . '</summary>';
        dumpVar(get_object_vars($data));
        echo '</details>';
        return;
    }

    var_dump($data);
}

function dump(mixed ...$data): void
{
    echo "<style>
.dump-wrapper {
    background: #2d2d2d;
    color: #f8f8f2;
    font-family: Consolas, Monaco, monospace;
    font-size: 14px;
    padding: 15px;
    border-radius: 6px;
    margin: 15px 0;
    overflow-x: auto;
}

.dump-wrapper hr {
    border: 0;
    border-top: 1px solid #444;
    margin: 10px 0;
}

.dump-wrapper details {
    margin-left: 15px;
}

.dump-wrapper summary {
    cursor: pointer;
    color: #66d9ef;
    font-weight: bold;
}

.dump-key {
    color: #a6e22e;
}

.dump-string {
    color: #e6db74;
}

.dump-number {
    color: #ae81ff;
}

.dump-bool {
    color: #fd971f;
}

.dump-null {
    color: #75715e;
    font-style: italic;
}

.dump-type {
    color: #66d9ef;
    font-style: italic;

}
</style>
<div class='dump-wrapper'>";

    foreach ($data as $item) {
        dumpVar($item);
        echo '<hr>';
    }
    echo '</div>';
}

function dd(mixed ...$data)
{
    dump(...$data);
    die;
}

function asset(string $path): string
{
    $basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

    return rtrim($basePath, '/') . '/' . ltrim($path, '/');
}