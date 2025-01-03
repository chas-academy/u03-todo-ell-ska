<?php
require_once __DIR__ . '/lib/auth.php';
require_once __DIR__ . '/utils/handle-error.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  Auth::login($_POST['username'], $_POST['password']);
}

$title = 'Log in';
ob_start();
?>

<main class="auth">
  <section>
    <h1>Welcome back!</h1>
    <form method="post">
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