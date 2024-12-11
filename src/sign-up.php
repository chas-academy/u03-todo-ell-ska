<?php
require_once 'lib/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  Auth::register($_POST['username'], $_POST['password']);
}

$title = 'Sign up';
ob_start();
?>

<main class="auth">
  <section>
    <h1>Welcome to Ordna!</h1>
    <form method="post">
      <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="Enter your username" required>
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>
      </div>
      <button type="submit">Sign up</button>
    </form>
  </section>
  <a href="/log-in.php">Already have an account? Log in.</a>
</main>

<?php
$content = ob_get_clean();
require 'layout.php'
?>