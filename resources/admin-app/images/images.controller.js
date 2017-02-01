(function(){
    'use strict';

    angular
        .module('adminApp')
        .controller('ImagesController', ImagesController);

    /* @ngInject */
    function ImagesController(FileUploader, $auth, $scope) {
        var vm = this;

        vm.image = {
            full: undefined,
            cropped: undefined
        };

        var isCropping = false;

        vm.uploadCropped = uploadCropped;
        
        function uploadCropped() {
            if(vm.uploader.queue.length === 0) {
                alert('error loading cropped image!');
                return;
            }
            var croppedFileName = vm.uploader.queue[0]._file.name.split('.');
            croppedFileName = croppedFileName[0] + '_cropped.png';

            vm.uploader.queue[0]._file = dataURItoBlob(vm.image.cropped);
            vm.uploader.queue[0]._file.name = croppedFileName;
            isCropping = true;
            vm.uploader.queue[0].upload();
        }

        vm.uploader = new FileUploader({
            url: '/api/images',
            method: 'POST',
            headers: {'Authorization': 'Bearer ' + $auth.getToken()},
            onError: function(){
                console.log('onError');
                console.log(arguments);
                console.log('-------');
            },
            onSuccessItem: function (item, result) {
                if(isCropping) {
                    vm.uploader.clearQueue();
                    isCropping = false;
                }
                else {
                    vm.image.cropped = '';
                    vm.image.full = result.fileName;
                }
                alert('Success!');
            },
            filters: [ ], //Here can be something
            onAfterAddingFile: function(item){
                item.upload();
            },
            onBeforeUploadItem: function(item){
                if(isCropping)
                    item.formData.push({'file_alias': 'file', 'action': 'cropp'});
                else
                    item.formData.push({'file_alias': 'file', 'action': 'resize'});
            },
        });

        function dataURItoBlob(dataURI) {
            var binary = atob(dataURI.split(',')[1]);
            var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
            var array = [];
            for(var i = 0; i < binary.length; i++) {
                array.push(binary.charCodeAt(i));
            }
            return new Blob([new Uint8Array(array)], {type: mimeString});
        }
    }
})();