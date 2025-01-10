<?php
require_once __DIR__ . '/utils/handle-error.php';

$title = 'Log in';
ob_start();
?>

<main class="auth">
    <section>
        <h1>Welcome back!</h1>
        <form action="/actions/auth.php" method="post">
            <input type="hidden" name="action" value="log-in">
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter your username">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password">
            </div>
            <button type="submit">Log in</button>
        </form>
    </section>
    <a href="/sign-up.php">Don't have an account? Sign up.</a>
</main>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php'
?>