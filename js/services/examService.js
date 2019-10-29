'use strict';

app.factory('examService', function($http){
	return{
		read: function(){
			var read = $http.get('api/getallexams.php');
			return read;
		},
		create: function(exam){
			var add = $http.post('api/addexam.php', exam);
			return add;
		},
		update: function(exam){
			var edit = $http.post('api/updexam.php', exam);
			return edit;
		},
		delete: function(exam){
			var del = $http.post('api/delexam.php', exam);
			return del;
		},

		remain: function(user){
			var rem = $http.post('api/getremainingexams.php', user);
			return rem;
		}
	}
});


