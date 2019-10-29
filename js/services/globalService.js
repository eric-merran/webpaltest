'use strict';

app.factory('globalService', function($http){
	return{
		getstatus: function(){
			var allStatus = $http.get('api/getstatus.php');
			return allStatus;
		},
		getregies: function(){
			var allregies = $http.get('api/getallregies.php');
			return allregies;
		}
	}
});
