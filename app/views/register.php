<?php 

$config = require __DIR__ . '/../../config/config.php';

if (isset($error)) echo "<p>$error</p>"; 

?>
<form method="post" action="<?=$config['site_url']?>?action=register">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Password confirmation" required>
    <button type="submit">Register</button>
</form>
