'use strict';

app.controller('examsCtrl', ['$scope', 'examService', '$state', '$stateParams' , function($scope, examService, $state, $stateParams){
	
	$scope.getall = function(){
		var exams = examService.read();
		exams.then(function(response){
			$scope.exams = response.data;
		});
	};
        
    $scope.error = false;    
    $scope.examinfo = $stateParams.exam;
	//add exam
	$scope.add = function(){
		var addexam = examService.create($scope.exam);
		addexam.then(function(response){
			if(response.data.error){
				$scope.error = true;
				$scope.message = response.data.message;
			}
			else{
				console.log(response);
                $state.go('exams');
			}
		});
	};
    
	//delete exam
	$scope.delete = function(){
		var delexam = examService.delete($scope.examinfo);
		delexam.then(function(response){
			if(response.data.error){
				$scope.error = true;
				$scope.message = response.data.message;
			}
			else{
				console.log(response);
				$state.go('exams');
			}
		});
	};
	
	//Update exam

    $scope.update = function(){
		var updateexam = examService.update($scope.examinfo);
		updateexam.then(function(response){
			console.log(response);
			if(response.data.error){
				$scope.error = true;
				$scope.message = response.data.message;
			}
			else{
				console.log(response);
				$state.go('exams');
			}
		});
	}
}]);

