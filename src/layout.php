<?php require __DIR__ . '/vendor/autoload.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ? "$title | Ordna" : 'Ordna' ?></title>
    <link rel="icon" href="favicon.svg">
    <link rel="stylesheet" href="./styles/style.css" />
    <script src="scripts/modal.js" defer></script>
    <script src="scripts/input-preview.js" defer></script>
    <script src="scripts/back.js" defer></script>
</head>

<body>
    <?php echo $content ?? '' ?>
    <div id="overlay" class="overlay hidden"></div>
    <?php
    require_once __DIR__ . '/components/add-list-modal.php';
    require_once __DIR__ . '/components/add-task-modal.php';
    ?>
</body>

</html>