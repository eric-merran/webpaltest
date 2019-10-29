'use strict';

app.controller('usersCtrl', ['$scope', 'userService', '$state', '$stateParams' , function($scope, userService, $state, $stateParams){
	//fetch users
	$scope.getall = function(){
		var users = userService.read();
		users.then(function(response){
			$scope.users = response.data;
		});
	};
        
      $scope.error = false;    
      $scope.userinfo = $stateParams.user;
	//add user
	$scope.add = function(){
		var adduser = userService.create($scope.user);
		adduser.then(function(response){
			if(response.data.error){
				$scope.error = true;
				$scope.message = response.data.message;
			}
			else{
				console.log(response);
                $state.go('students');
			}
		});
	};

    
	//delete user
	$scope.delete = function(){
		var deluser = userService.delete($scope.userinfo);
		deluser.then(function(response){
			if(response.data.error){
				$scope.error = true;
				$scope.message = response.data.message;
			}
			else{
				console.log(response);
				$state.go('students');
			}
		});
	};
	
	//update user
        $scope.update = function(){
		var updateuser = userService.edit($scope.userinfo);
		updateuser.then(function(response){
			console.log(response);
			if(response.data.error){
				$scope.error = true;
				$scope.message = response.data.message;
			}
			else{
				console.log(response);
				$state.go('students');
			}
		});
	}
}]);

