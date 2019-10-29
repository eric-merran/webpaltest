'use strict';

app.factory('gradeService', function($http){
	return{
		read: function(user){
			var read = $http.post('api/getusergrades.php', user);
			return read;
		},
		
		create: function(grade){
			var add = $http.post('api/addgrade.php', grade);
			return add;
		},

		update: function(grade){
			var upd = $http.post('api/updgrade.php', grade);
			return upd;
		},

		delete: function(grade){
			var del = $http.post('api/delgrade.php', grade);
			return del;
		}
	}
});
