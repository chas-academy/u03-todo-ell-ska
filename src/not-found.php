<?php
$title = 'Page not found';
ob_start();
?>

<main class="not-found">
    <div>
        <h1>404</h1>
        <p>Oops! The page you are looking for can't be found.</p>
        <a href="/">Go back home</a>
    </div>
</main>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
