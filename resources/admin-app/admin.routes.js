(function(){
    'use strict';

    angular
        .module('adminApp')
        .config(function(stateHelperProvider, $urlRouterProvider, $authProvider) {
        $authProvider.storageType = 'localStorage';
        $authProvider.loginUrl = '/api/authenticate';
            stateHelperProvider
                .state({
                    name: 'login',
                    url: '/login',
                    templateUrl: '../views/admin/auth.html',
                    controller: 'AuthCtrl',
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