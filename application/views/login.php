<?php $this->load->view("includes/header.php"); ?>
<body>
	<br />
	<br />
	<div ng-controller="loginController as logCont">
		<form id="loginForm" name="loginForm" ng-submit="loginForm.$valid && logCont.tryLogin()" novalidate>
			<br />
			<p><label for="user_name">Username:</label><input type="text" name="user_name" ng-model="logCont.login.user_name" required/></p>
			<p><label for="password">Password:</label><input type="password" name="password" ng-model="logCont.login.password" required/></p>
			<br />
			<button type="submit" name="submit">Login</button>
		</form>
	</div>
</body>
</html>
