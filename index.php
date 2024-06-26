<?php
	include('database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
		<h2>Welcome to xequemarte podcast</h2>
		username:<br>
		<input type="text" name="username"><br>
		password:<br>
		<input type="password" name="password"><br>
		<input type="submit" name="submit" value="enter">
	</form>
	<a href="signup.php">sign up</a>
</body>
</html>

<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

		if (empty($username)) {
			echo 'plese enter a username';
		}
		elseif (empty($password)) {
			echo 'plese enter a password';			
		} else {
			$hash = password_hash($password, PASSWORD_DEFAULT);
			$sql = "SELECT username, password FROM public.users WHERE username = '{$username}' AND password = '{$hash}'";
					
			try {
			$result = pg_query($conn, $sql);
			}
			catch(DependencyException $e) {
				echo 'error';
			}
			if (pg_num_rows($result) == 0) {
				echo "0 records";
		   	}
			else {
				echo 'hello';
			}
			//if (!$result) header("Refresh: 3; URL=http://localhost:8000/homepage.html");
		}
	}

	pg_close($conn);
?>
