<?php
if (isset($_COOKIE['user'])) {
  echo "<script>
  window.location.href = 'dashboard.php';
  </script>";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/login.css">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
	<div class="screen">
		<div class="screen__content">
			<form class="login" method="post" action="../scripts/login.php">
				<div class="login__field">
					<i class="login__icon fa fa-user"></i>
					<input type="text" class="login__input" placeholder="User name / Email" name="username">
				</div>
				<div class="login__field">
					<i class="login__icon fa fa-lock"></i>
					<input type="password" class="login__input" placeholder="Password" name="password">
				</div>
				<button class="button login__submit">
					<span class="button__text">Log In Now</span>
					<i class="button__icon fa fa-chevron-right"></i>
				</button>				
			</form>
			
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
</body>
</html>