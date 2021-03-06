<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Integrated Campus Testing &amp; Scholarship System - Login</title>
  <link rel="icon" href="favicon.ico">	  
  <link rel="stylesheet" href="css/login.css">

</head>


<body background="" ng-app="appLogin" ng-controller="appLoginCtrl" keypress-events>
<hgroup>
  <img id="logo" src="images/logo-bak.png"><img id="logo" src="images/logo.png">
  <h1>Sign in to InCaTS</h1>
</hgroup>
<form name="view.frmLogin" autocomplete="off">
  <div class="group">
    <input type="text" name="username" ng-model="account.username" autofocus><span class="highlight"></span><span class="bar"></span>
    <label>Username</label>
  </div>
  <div class="group">
    <input type="password" name="password" ng-model="account.password"><span class="highlight"></span><span class="bar"></span>
    <label>Password</label>
  </div>
  <button type="button" class="button buttonBlue" ng-click="login()">Login
    <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
  </button>
  <div class="info" ng-show="view.incorrect">{{view.info}}</div>  
  <div class="register">Don't have an account yet? <a href="javascript:;" ng-click="register()">Register</a></div>
  <div class="forgot-password"><a href="javascript:;" ng-click="forgot()">Forgot Password?</a></div>
</form>
<footer>
  <p>InCaTS &copy; 2016-2017</p>
</footer>
  <script src="angularjs/angular.min.js"></script>
  <script src="assets/js/jquery.2.1.1.min.js"></script>

  <script src="js/index.js"></script>
  <script type="text/javascript">
	
	var app = angular.module('appLogin', []);
	
	app.service('loginService', function($http, $window) {
		
		this.login = function(scope) {
			
			scope.view.incorrect = false;			
			scope.view.info = '';
			
			$http({
			  method: 'POST',
			  url: 'account.php?r=login',
			  data: scope.account,
			  headers : {'Content-Type': 'application/x-www-form-urlencoded'}
			}).then(function mySucces(response) {
				if (response.data['id'] == "0") {
					scope.view.incorrect = true;
					scope.view.info = 'Username or password incorrect.';
				} else {
					if (response.data['is_activated'] == 0) {
						scope.view.incorrect = true;
						scope.view.info = 'Account is inactive. Please provide your activation code in your email to the guidance coordinator for account activation.';						
						return;
					}					
					scope.view.incorrect = false;
					$window.location.href = 'dashboard.php';
				}
			},
			function myError(response) {
				console.log(response);
			});
			
		}
		
	});
	
	app.directive('keypressEvents', function($document, $rootScope, loginService) {
		return {
		  restrict: 'A',
		  link: function(scope) {
			$document.bind('keypress', function(e) {	
				if (e.which == 13) {
					loginService.login(scope);
				}
				$rootScope.$broadcast('keypress', e);
				$rootScope.$broadcast('keypress:' + e.which, e);
			});
		  }
		};
	  }
	);	
	
	app.controller('appLoginCtrl', function($scope, $http, $window, loginService) {

		$scope.view = {};
		
		$scope.view.info = '';
		
		$scope.account = {
			username: '', password: ''
		}		

		$scope.view.incorrect = false;
		
		$scope.login = function() {
			
			loginService.login($scope);
			
		}

		$scope.register = function() {
			
			$window.location.href = 'register.php';
			
		}
		
		$scope.forgot = function() {
			
			$window.location.href = 'forgot-password.php';			
			
		}
		
	});
	
  </script>
</body>
</html>
