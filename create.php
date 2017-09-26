<?PHP
	ob_start();
	include_once 'config/database.php';

	if ($_POST['submit'] && $_POST['login'] && $_POST['email'] && $_POST['passwd'] && $_POST['confirm'])
	{
		if ($_POST['passwd'] == $_POST['confirm'] && strlen($_POST['passwd']) > 7)
		{
			if (preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['login']) === $_POST['login']) {
				$login = htmlspecialchars($_POST['login'], ENT_QUOTES);
				$username = htmlspecialchars($_POST['email'], ENT_QUOTES);
				$password = hash('sha512', $_POST['passwd']);
	    		$query = $pdo->query("SELECT * FROM Users WHERE email = '$username'");
	    		$query2 = $pdo->query("SELECT * FROM Users WHERE login = '$login'");
			    if ($query->rowCount() > 0 || $query2->rowCount() > 0) {
			        header("Location: register.php?error=already_used");
			    }
			    else {
	        	  $link = uniqid();
			      $req = $pdo->prepare('INSERT INTO Users(email, login, password, token, date) VALUES(:email, :login, :password, :token, :date)');
				    $req->execute(array(
				    'password' => $password,
				    'email' => $username,
				    'login' => $login,
	        		'token' => $link,
				    'date' => date('Y-m-d H:i:s',time())));
				    $to = $username;
	  				$object = 'Mail de confirmation';
	  				$message = "$login,<br>Merci de t'etre inscrit sur camagru42, voici ton lien de confirmation:<br><a href='http://localhost:8080/confirmation.php?token=$link'>Confirme ton compte ici</a>";
	  				$headers  = 'From: jkeuleya@student.42.fr'."\r\n";
	  				$headers .= 'Reply-To: jkeuleya@student.42.fr'."\r\n";
	  				$headers .= 'MIME-Version: 1.0' . "\r\n";
	  				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	  				mail($to, $object, $message, $headers);
	  			  header('Location: index.php?info=register_success');
			    }
			}
			else 
				header('Location: register.php?error=sanitize');
		}
		else
			header('Location: register.php?error=pwd');
	}
	else
		header('Location: register.php?error=yes');
?>