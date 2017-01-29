(function () {
    'use strict';

    angular
        .module('adminApp')
        .service('usersService', usersService);

    function usersService($resource) {
        var User = $resource('/api/users', {}, {
            update: {method: 'PUT'}
        });

        return {
            all: function(){
                return User.query({}).$promise;
            }
        };
    }
})();