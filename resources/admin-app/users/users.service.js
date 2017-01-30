(function () {
    'use strict';

    angular
        .module('adminApp')
        .service('usersService', usersService);

    /* @ngInject */
    function usersService($resource) {

        var User = $resource('/api/users', {}, {
            update: {method: 'PUT'}
        });

        return {
            all: all
        };




        function all() {
            return User.query({}).$promise;
        }
    }
})();