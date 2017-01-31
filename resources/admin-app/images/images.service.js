(function () {
    'use strict';

    angular
        .module('adminApp')
        .service('imagesService', imagesService);

    /* @ngInject */
    function imagesService($resource) {

        var Image = $resource('/images', {}, {
            get: {url: '/images/:id'}
        });

        return {
            all: all
        };



        function all() {
            return Image.query({}).$promise;
        }
    }
})();