<?php
require "../Auth.php";

use \SimpleAuth\Auth;

$auth = Auth::getInstance();

$action = $_GET['action'];
switch ($action) {
    case 'login': 
        $auth->login(['name' => 'Fernando']);
        break;
    case 'logout':
        $auth->logout();
        break;
}
?>
<html>
<head>
    <title>SimpleAuth Example</title>
</head>
<body>

<input type="button" value="login" onclick="location.href='?action=login';" />
<input type="button" value="logout" onclick="location.href='?action=logout'" />
<input type="button" value="refresh page" onclick="location.href='index.php';" />

<br /><br />

<?php
   if ($auth->isLogged()) {
      echo 'The user <strong>' . $auth->getValue('name') . '</strong> is logged.';
   } else {
      echo "The user is not logged yet.";
   }
?>

</body>
</html>

