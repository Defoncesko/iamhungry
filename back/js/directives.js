//Directive that returns an element which adds buttons on click which show an alert on click
iamhungryAppAdmin.directive("addcategorieingr", function(){
	return {
		restrict: "E",
		template: "<button addcategorieingr>Click to add a category</button>"
	}
});

iamhungryAppAdmin.directive("addcategorieprep", function(){
	return {
		restrict: "E",
		template: "<button addcategorieprep>Click to add a category</button>"
	}
});


iamhungryAppAdmin.directive("addcategorieingr", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){

			scope.countingr++;
			var title = prompt("Please enter a title for this new category", "TITLE");
			console.log(title);

			if (title != null) {
				angular.element(document.getElementById('space-for-ingr')).append($compile("<label>Titre : </label><input type='text' value='"+title+"'  class='form-control' maxlength='32' name='recipe_cat"+scope.countingr+"' ng-model='recipe_cat"+scope.countingr+"'><br /><button addingr>Click to add an ingredient</button>")(scope));
		        //angular.element(document.getElementById('space-for-ingr')).append($compile("<input type='text' value='"+title+"' name='recipe_cat"+scope.countingr+"' class='form-control'  maxlength='32' ng-model='recipe_cat"+scope.countingr+"'  required ><!--<addoneingred></addoneingred>-->")(scope));
		    	//$scope.recipe_cat
		    }
			
		});
	};
});


iamhungryAppAdmin.directive("addingr", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
			element.remove();
			angular.element(document.getElementById('space-for-ingr')).append($compile("<div class='parent'><div class='col-xs-3'><input type='text' value=''  class='form-control' maxlength='32'></div><div class='col-xs-7'><input type='text' value=''  class='form-control' maxlength='32'></div><div class='col-xs-2'><button rmingr>Click to remove</button></div><br /><button addingr>Click to add an ingredient</button>")(scope));
		});
	};
});

iamhungryAppAdmin.directive("addcategorieprep", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){

			scope.countingr++;
			var title = prompt("Please enter a title for this new category", "TITLE");
			console.log(title);

			if (title != null) {
				angular.element(document.getElementById('space-for-prep')).append($compile("<label>Titre : </label><input type='text' value='"+title+"'  class='form-control' maxlength='32' name='recipe_cat"+scope.countprep+"' ng-model='recipe_cat"+scope.countprep+"'><br /><button addprep>Click to add a sentence</button>")(scope));
		    }
			
		});
	};
});

iamhungryAppAdmin.directive("rmingr", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){

			element.parent().parent().remove();
		});
	};
});

iamhungryAppAdmin.directive("addprep", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){
			element.remove();
			angular.element(document.getElementById('space-for-prep')).append($compile("<div class='parent'><div class='col-xs-10'><input type='text' value=''  class='form-control' maxlength='32'></div><div class='col-xs-2'><button rmprep>Click to remove</button></div><br /><button addprep>Click to add a sentence</button>")(scope));
		});
	};
});

iamhungryAppAdmin.directive("rmprep", function($compile){
	return function(scope, element, attrs){
		element.bind("click", function(){

			element.parent().parent().remove();

		});
	};
});
