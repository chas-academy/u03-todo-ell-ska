<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $title ? "$title | Ordna" : 'Ordna' ?></title>
  <link rel="stylesheet" href="./styles/style.css" />
  <script src="scripts/modal.js" defer></script>
</head>

<body>
  <?= $content ?? '' ?>
</body>

</html>