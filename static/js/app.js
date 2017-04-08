(function(){
	var app = angular.module('ddcharL', []);
	app.controller('loginController', ['$http', '$window', function($http, $window){
		var logCont = this;
		this.login = {};
		this.loginFailed = false;
		this.tryLogin = function(){
			sendData = {
				'user_name': this.login.user_name,
				'password': this.login.password
			};
			$http.post('/index.php/login', sendData).success(function(data){
				if (data.success){
					$window.location.href = 'main';
				} else {
					console.log(data.error);
					logCont.loginFailed = true;
				}
			});
			this.login = {};
		};
	}]);
})();
