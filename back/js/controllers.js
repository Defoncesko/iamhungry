	
		
	
	iamhungryAppAdmin.controller('newrecipeController', function($scope, $http, $modal, $log) {
		
		$scope.countingr = 0;

		$scope.rate = 7;
		$scope.max = 10;
		$scope.isReadonly = false;

		$scope.hoveringLeave = function(value) {
			console.log(value);
		   $scope.rate = value;

		};

		$scope.countries = [
	      {name:'France'},
	      {name:'Mexique'},
	      {name:'Argantine'},
	      {name:'Allemagne'},
	      {name:'USA'}
	    ];
					
	});
	


	iamhungryAppAdmin.controller('modifyrecipeController', function($scope, $modal, $fileUploader,$http) {
			

	});