	var antisantiApp = angular.module('antisantiApp', ["ui.bootstrap","ngRoute","angularFileUpload"]);

	
	antisantiApp.config(function($routeProvider) {
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