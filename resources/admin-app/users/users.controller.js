(function(){
    'use strict';

    angular
        .module('adminApp')
        .controller('UsersCtrl', UsersCtrl);

    /* @ngInject */
    function UsersCtrl(users) {
        var vm = this;

        vm.users = users;
    }
})();