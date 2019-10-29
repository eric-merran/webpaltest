var app = angular.module('app', ['ui.router','ui.bootstrap','datatables']);

app.config(function($stateProvider, $urlRouterProvider) {
    
  
    $stateProvider
        .state('students', {
            url: '/students',
            templateUrl: 'views/users.html',
            controller: 'usersCtrl'
        })

         .state('addstud', {
            url: '/addstud',
            templateUrl: 'views/useradd.html',
            controller: 'usersCtrl'
        })
         .state('delstud', {
            url: '/delstud/',
            params: {user: null},
            templateUrl: 'views/userdel.html',
            controller: 'usersCtrl'
        })
        
        .state('editstud', {
            url: '/editstud/',
            params: {user: null},
            templateUrl: 'views/userupd.html',
            controller: 'usersCtrl'
        })
       
        .state('exams', {
            url: '/exams',
            templateUrl: 'views/exams.html',
            controller: 'examsCtrl'
        })
         .state('addexam', {
            url: '/examadd',
            templateUrl: 'views/examadd.html',
            controller: 'examsCtrl'
        })
         .state('delexam', {
            url: '/delexam/',
            params: {exam: null},
            templateUrl: 'views/examdel.html',
            controller: 'examsCtrl'
        })
        
        .state('editexam', {
            url: '/editexam/',
            params: {exam: null},
            templateUrl: 'views/examupd.html',
            controller: 'examsCtrl'
        })

        .state('grades', {
            url: '/grades',
            params: {user: null},
            templateUrl: 'views/grades.html',
            controller: 'gradesCtrl'
        })

         .state('addgrade', {
            url: '/addgrade',
            params: {user: null},
            templateUrl: 'views/gradead.html',
            controller: 'gradesCtrl'
        })

         .state('delgrade', {
            url: '/delgrade/',
            params: {grade: null,
                     user: null
        },
            templateUrl: 'views/gradedel.html',
            controller: 'gradesCtrl'
        })
        
        .state('editgrade', {
            url: '/editgrade/',
            params: {grade: null,
                     user: null
             },
            templateUrl: 'views/gradeupd.html',
            controller: 'gradesCtrl'
        })
      
        
})

    
.controller('MainCtrl',['$scope','$rootScope', 'globalService', function($scope,$rootScope,globalService) {
                  
   }]);
