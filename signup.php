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
		<h2>Sign up</h2>
		First Name:<br>
		<input type="text" name="firstname"><br>
		Last Name:<br>
		<input type="text" name="lastname"><br>
		E-mail:<br>
		<input type="email" name="email"><br>
		username:<br>
		<input type="text" name="username"><br>
		password:<br>
		<input type="password" name="password"><br>
		password:<br>
		<input type="password" name="checkpassword"><br>
		<input type="submit" name="submit" value="Register">
	</form>
</body>
</html>

<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$firstName = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
		$lastName = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
		$checkPassword = filter_input(INPUT_POST, 'checkpassword', FILTER_SANITIZE_SPECIAL_CHARS);

		if ($password != $checkPassword || empty($password)) {
			echo 'password does not match, please try again';
		} else {		
			if (empty($firstName) || empty($lastName) || empty($email) || empty($username)) {
				echo 'please fill all input';			
				} else {
					$hash = password_hash($password, PASSWORD_DEFAULT);
					$sql = "INSERT INTO public.users (firstname, lastname, email, username, password)
							VALUES ('$firstName', '$lastName', '$email', '$username', '$hash')";
							
					try {
					$result = pg_query($conn, $sql);
					echo 'you are logged';
					}
					catch(DependencyException $e) {
						echo 'error';
					}
				}
			}
		}

	pg_close($conn);
?>
