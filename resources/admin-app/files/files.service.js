(function () {
    'use strict';

    angular
        .module('adminApp')
        .service('filesService', filesService);

    /* @ngInject */
    function filesService($resource) {

        var File = $resource('/files', {}, {
            get: {url: '/files/:id'}
        });

        return {
            all: all
        };




        function all() {
            return File.query({}).$promise;
        }
    }
})();