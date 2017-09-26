<?PHP
  ob_start();
  function auth($login, $passwd, $pdo)
  {
    $passwd = hash('sha512', $passwd);
    $req = $pdo->prepare('SELECT * FROM Users WHERE login = :login AND password = :password');
    $req->execute(array(
        'login' => htmlspecialchars($login, ENT_QUOTES),
        'password' => $passwd));
    $user = $req->fetch(PDO::FETCH_ASSOC);
    if ($req->rowCount() == 0 || !$user['confirmation'])
        return (FALSE);
    else
      return (TRUE);
  }
?>