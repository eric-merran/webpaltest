'use strict';

app.controller('gradesCtrl', ['$scope', 'gradeService','examService', '$state', '$stateParams' , function($scope, gradeService, examService, $state, $stateParams){
    
    $scope.error = false;    
    $scope.userinfo = $stateParams.user;
    $scope.gradeinfo = $stateParams.grade;
  
    //fetch all grades from users
	$scope.getall = function(){
		var grades = gradeService.read($scope.userinfo);
		grades.then(function(response){
			$scope.grades = response.data;
		});
	};
        
    $scope.listexams = function(){
		var exams = examService.remain($scope.userinfo);
		exams.then(function(response) {
			$scope.exams = response.data;
		});
	};

	//add grade
	$scope.add = function(){
        $scope.grade.user_id = $scope.userinfo.user_id;
        $scope.grade.exam_id= $scope.selectedexam.exam_id;
		var addgrade = gradeService.create($scope.grade);
		addgrade.then(function(response){
			if(response.data.error){
				$scope.error = true;
				$scope.message = response.data.message;
			}
			else{
				console.log(response);
                $state.go('grades',{user: $scope.userinfo});
			}
		});
	};

    
	//delete grade
	$scope.delete = function(){
		var delgrade = gradeService.delete($scope.gradeinfo);
		delgrade.then(function(response){
			if(response.data.error){
				$scope.error = true;
				$scope.message = response.data.message;
			}
			else{
				console.log(response);
				$state.go('grades',{user: $scope.userinfo});
			}
		});
	};
	
	//update user
        $scope.update = function(){
		var updategrade = gradeService.update($scope.gradeinfo);
		updategrade.then(function(response){
			console.log(response);
			if(response.data.error){
				$scope.error = true;
				$scope.message = response.data.message;
			}
			else{
				console.log(response);
				$state.go('grades',{user: $scope.userinfo});
			}
		});
	}
}]);