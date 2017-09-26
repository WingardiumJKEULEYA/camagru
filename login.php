<?PHP
	ob_start();
	include_once 'config/database.php';
	include "auth.php";
	$login = $_POST['login'];
	$passwd = $_POST['passwd'];
	if (auth($login, $passwd, $pdo))
	{
		$req = $pdo->prepare('SELECT `admin` FROM Users WHERE login = :login');
		$req->execute(array('login' => $login));
		$result = $req->fetch(PDO::FETCH_ASSOC);
		$_SESSION['loggued_on_user'] = $login;
		$_SESSION['user_admin'] = $result['admin'];
		header('Location: cam.php');
	}
	else
	{
		$_SESSION['loggued_on_user'] = "";
		header("Location: index.php?error=login");
	}
?>