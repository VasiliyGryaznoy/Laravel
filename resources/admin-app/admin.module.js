(function () {
    'use strict';

    angular.module('adminApp', [
        'ui.router',
        'ui.router.stateHelper',
        'ngResource',
        'satellizer',
        'validation',
        'validation.rule',
        'angularFileUpload',
        'ngImgCrop'
    ]);
})();