angular.module('lock-screen-module',['bootstrap-modal','block-ui']).directive('lockScreen', function($http,blockUI) {

	return {
	   restrict: 'A',
	   link: function(scope, element, attrs) {	

			var idleTime = 0;
			var idleInterval = setInterval(timerIncrement, 60000);

			$(this).mousemove(function (e) {
				idleTime = 0;
			});
			$(this).keypress(function (e) {
				idleTime = 0;
			});

			function timerIncrement() {
				idleTime = idleTime + 1;
				if (idleTime > 0) {
					blockUI.login(scope);
					idleTime = 0;
					clearInterval(idleInterval);
				}
			}
			
			scope.lockLogin = function() {
				
				$http({
				  method: 'POST',
				  data: {pw: scope.lockPw},
				  url: 'modules/accounts.php?r=lock'
				}).then(function mySucces(response) {			
					
					if (response.data == 0) {
						scope.lockPwInvalid = true;
					} else {
						idleInterval = setInterval(timerIncrement, 1000);
						scope.lockPw = '';
						blockUI.hide();
					}
					
				}, function myError(response) {
					 
				  // error
					
				});				
				
			}

	   }
	};

});