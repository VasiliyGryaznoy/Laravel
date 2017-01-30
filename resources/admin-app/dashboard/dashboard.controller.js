(function(){
    'use strict';

    angular
        .module('adminApp')
        .controller('DashboardController', DashboardController);

    /* @ngInject */
    function DashboardController() {
        var vm = this;

        vm.hello = 'Hi there!';

    }
})();