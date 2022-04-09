<?php
if (isset($_COOKIE['user'])) {
	setcookie("user", "", time() - 3600, "/");
	echo "<script>window.location.href='../'</script>";
}
?>