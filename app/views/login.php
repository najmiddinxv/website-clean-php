<?php 
$config = require __DIR__ . '/../../config/config.php';
if (isset($error)) echo "<p>$error</p>"; 
?>
<form method="post" action="<?=$config['site_url']?>?action=login">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
<div>
    or <a href="?action=register">register</a>
</div>
