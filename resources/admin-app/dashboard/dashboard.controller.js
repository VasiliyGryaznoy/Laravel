(function(){
    'use strict';

    angular
        .module('adminApp')
        .controller('DashboardCtrl', DashboardCtrl);

    DashboardCtrl.$inject = [];

    function DashboardCtrl() {
        var vm = this;

        vm.hello = 'Hi there!';

    }
})();