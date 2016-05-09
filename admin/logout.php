 <?php

 	if(isset($_SESSION['login_user'])) unset($_SESSION['login_user']);
 	header('Refresh: 1; URL = ?p=login');

 ?>