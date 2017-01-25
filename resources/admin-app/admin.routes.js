(function(){
    'use strict';

    angular
        .module('adminApp')
        .config(function(stateHelperProvider, $urlRouterProvider) {
            $urlRouterProvider.otherwise('/dashboard');
//        $locationProvider.html5Mode({
//            enabled: true,
//            requireBase: false,
//            hashPrefix: ""
//        });

            stateHelperProvider
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
        });
})();