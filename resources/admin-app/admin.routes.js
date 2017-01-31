(function(){
    'use strict';

    angular
        .module('adminApp')
        .config(function(stateHelperProvider, $urlRouterProvider) {
            stateHelperProvider
                .state({
                    name: 'login',
                    url: '/login',
                    templateUrl: '/views/admin/login.html',
                    controller: 'LoginController',
                    controllerAs: 'vm',
                })
                .state({
                    name: 'signup',
                    url: '/signup',
                    templateUrl: '/views/admin/signup.html',
                    controller: 'SignupController',
                    controllerAs: 'vm',
                })
                .state({
                    name: 'dashboard',
                    url: '/dashboard',
                    templateUrl: '/views/admin/dashboard.html',
                    controller: 'DashboardController',
                    controllerAs: 'vm',
                })
                .state({
                    name: 'users',
                    url: '/users',
                    templateUrl: '/views/admin/users.html',
                    controller: 'UsersController',
                    controllerAs: 'vm',                 //What the hell???
                    resolve: {
                        users: function(usersService){
                            return usersService.all();
                        }
                    }
                })
                .state({
                    name: 'files',
                    url: '/files',
                    templateUrl: '/views/admin/files.html',
                    controller: 'FilesController',
                    controllerAs: 'vm',                 //What the hell???
                    resolve: {
                        files: function(filesService){
                            return filesService.all();
                        }
                    }
                })
                .state({
                    name: 'images',
                    url: '/images',
                    templateUrl: '/views/admin/images.html',
                    controller: 'ImagesController',
                    controllerAs: 'vm',                 //What the hell???
                });
            $urlRouterProvider.otherwise('/login');
        });
})();