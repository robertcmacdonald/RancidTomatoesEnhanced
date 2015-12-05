<form action="controller.php" method="post">
	Username: <input type="text" name="username" required>
	Password: <input type="password" name="password" required>
	<input type="submit" name="login" value="Login">
	<?php
      session_start ();
      echo $_SESSION ['loginError'];
	?>
</form>