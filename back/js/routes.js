	var iamhungryAppAdmin = angular.module('iamhungryAppAdmin', ["ui.bootstrap","ngRoute","angularFileUpload","ngSanitize"]);

	
	iamhungryAppAdmin.config(function($routeProvider) {
		$routeProvider

			.when('/', {
				templateUrl : 'pages/newrecipe.html',
				controller  : 'newrecipeController'
			})
			.when('/modifyrecipe', {
				templateUrl : 'pages/modifyrecipe.html',
				controller  : 'modifyrecipeController'
			})
	});