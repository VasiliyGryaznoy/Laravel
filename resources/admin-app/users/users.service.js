(function () {
    'use strict';

    angular
        .module('adminApp')
        .service('usersService', usersService);

    /* @ngInject */
    function usersService($resource) {

        var User = $resource('/users', {}, {
            update: {method: 'PUT'},
            get: {url: '/users/:id'}
        });

        return {
            all: all,
            getCurrentUser: getCurrentUser
        };




        function all() {
            return User.query({}).$promise;
        }

        function getCurrentUser() {
            return User.get({id: -1}).$promise;
        }
    }
})();