(function(){
    'use strict';

    angular
        .module('adminApp')
        .config(function(stateHelperProvider, $urlRouterProvider, $authProvider) {
        $authProvider.storageType = 'localStorage';
        $authProvider.loginUrl = '/api/authenticate';
        $authProvider.signupUrl = '/api/signup';

            stateHelperProvider
                .state({
                    name: 'login',
                    url: '/login',
                    templateUrl: '../views/admin/login.html',
                    controller: 'LoginCtrl',
                    controllerAs: 'vm',
                })
                .state({
                    name: 'signup',
                    url: '/signup',
                    templateUrl: '../views/admin/signup.html',
                    controller: 'SignupCtrl',
                    controllerAs: 'vm',
                })
                .state({
                    name: 'logout',
                    url: '/logout'
                })
                .state({
                    name: 'dashboard',
                    url: '/dashboard',
                    templateUrl: '../views/admin/dashboard.html',
                    controller: 'DashboardCtrl',
                    controllerAs: 'vm',
                })
                .state({
                    name: 'users',
                    url: '/users',
                    templateUrl: '../views/admin/users.html',
                    controller: 'UsersCtrl',
                    controllerAs: 'vm'
                });
            $urlRouterProvider.otherwise('/login');
        });
})();