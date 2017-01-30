(function(){
    'use strict';

    angular
        .module('adminApp')
        .controller('UsersController', UsersController);

    /* @ngInject */
    function UsersController(users) {
        var vm = this;

        vm.users = users;
    }
})();