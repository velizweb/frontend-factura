(function () {
    "use strict";

    angular
        .module('QuantumApp')
        .controller('FamiliesController', FamiliesController);

    FamiliesController.$inject = ['$scope', '$http', 'FamiliesService','CompanyService','ENTITY', '$rootScope', 'toastr', 'HOST_ROUTE', 'SweetAlert'];

    function FamiliesController($scope, $http,FamiliesService,CompanyService,ENTITY, $rootScope, toastr, HOST_ROUTE, SweetAlert) {
        
        var vm = this;

        vm.FamiliesList = [];
        vm.CompanyList = [];
        vm.company = {};
        vm.families = [];
        vm.checked = false;


        vm.create = function(){
            if(vm.toggleSelected==true)
                vm.families.is_active=1;
            else 
                vm.families.is_active=0;

            vm.families.company_id = vm.company.id;            

            var promise = FamiliesService.create(vm.families);
            promise.then(function(pl){
                var retorno = pl.data;
                toastr.success("La familia fué creada satisfactoriamente");
                window.location = HOST_ROUTE.FAMILIES;
            }),
            function (errorPl) {
                toastr.error("Ocurrió un error al crear la familia" + errorPl);
            };
        }

           vm.create = function(redir = true){
            if(vm.toggleSelected == true)
                vm.families.is_active = 1;
            else 
                vm.families.is_active = 0;
            
            vm.families.company_id = vm.company.id;            

            var promise = FamiliesService.create(vm.families);
            promise.then(function(pl){
                var retorno = pl.data;
                toastr.success("La familia fue creada satisfactoriamente");
                if(redir)
                    window.location = HOST_ROUTE.FAMILIES;
                else{
                    //$rootScope.$emit("refreshClientList");
                    angular.element('#myModal').modal('hide');
                }
            }),
            function (errorPl) {
                toastr.error("Ocurrió un error al crear el proveedor" + errorPl);
            };
        }

        vm.update = function(){
            if(vm.toggleSelected==true)
                vm.families.is_active=1;
            else 
                vm.families.is_active=0;
            var promise = FamiliesService.update(vm.families, vm.families.id);
            promise.then(function(pl){
                var retorno = pl.data;
                toastr.success("La familia fué actualizada satisfactoriamente");
                window.location = HOST_ROUTE.FAMILIES;
            }),
            function (errorPl) {
                toastr.error("Ocurrió un error al actualizar familia" + errorPl);
            };
        }  

        vm.delete = function(id){
            SweetAlert.swal({
                  title: 'Eliminar registro',
                  text: "¿Está seguro que desea eliminar el registro?",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si',
                  cancelButtonText: 'No',
                  confirmButtonClass: 'btn btn-success',
                  cancelButtonClass: 'btn btn-danger',
                  buttonsStyling: false
            }, function (dismiss) {
              if (dismiss === true) {
                var promise = FamiliesService.delete(id);
                promise.then(function(pl){
                    toastr.success("El registro fue eliminado satisfactoriamente");
                    window.location = HOST_ROUTE.FAMILIES;    
                });
              }
            }); 

        }   

        vm.edit = function(id){
            var promise = FamiliesService.read(id);
            promise.then(function(pl){
                vm.families = pl.data;
                if(vm.families.is_active===1) 
                    vm.toggleSelected = true;
                else
                    vm.toggleSelected = false;
            });
        }

        vm.readAll = function(){
            var promise = FamiliesService.readAll();
            promise.then(function(pl){
                vm.FamiliesList = pl.data;
            }); 
        }

        vm.readCompanyList = function(UserRoleId, CompanyId){
            var promise = CompanyService.readAll();
            promise.then(function(pl){
                if(UserRoleId===1)// SuperAdministrador
                   vm.CompanyList = pl.data;
                else
                {
                   var datos = pl.data;
                   angular.forEach(datos, function(company, key){
                        if(company.id===CompanyId){
                            vm.CompanyList.push(company);
                            vm.company = company;
                            vm.fillBranch(CompanyId);
                        }
                   });
                }
            });    
        }
    }
})();