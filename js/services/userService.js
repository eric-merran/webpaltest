'use strict';

app.factory('userService', function($http){
	return{
		read: function(){
			var read = $http.get('api/getallusers.php');
			return read;
		},
		create: function(user){
			var add = $http.post('api/adduser.php', user);
			return add;
		},
		edit: function(user){
			var edit = $http.post('api/upduser.php', user);
			return edit;
		},
		delete: function(user){
			var del = $http.post('api/deluser.php', user);
			return del;
		}
	}
});


