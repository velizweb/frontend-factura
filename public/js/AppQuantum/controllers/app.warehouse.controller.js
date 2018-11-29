(function () {
    "use strict";

    angular
        .module('QuantumApp')
        .controller('WarehouseController', WarehouseController);

    WarehouseController.$inject = ['$scope', '$http', 'WarehouseService','ProductService','CompanyService','SupplierService','BranchService','EntityMasterDataService','ENTITY', '$rootScope', 'toastr', 'HOST_ROUTE', 'SweetAlert'];

    function WarehouseController($scope, $http,WarehouseService,ProductService,CompanyService,SupplierService,BranchService,EntityMasterDataService,ENTITY, $rootScope, toastr, HOST_ROUTE, SweetAlert) {
        
        var vm = this;

        vm.WarehousesList = [];
        vm.CompanyList = [];
        vm.BranchOfficesList = [];
        vm.company = {};
        vm.branchOffice = {};
        vm.branchOfficeDes = {};
        vm.warehouse = [];
        vm.checked = false;
        vm.warehouseOrigin = 0;
        vm.destinationStore = 0;
        vm.Items = [];
        vm.Product = [];
        vm.document_number = '';
        vm.auditSelected = false;
        vm.invoiceNumber = "";
        vm.invoiceObservation = "";
        vm.dataTransfer = [{
            "warehouse_origin": "",
            "product": "",
            "amount_send": "",
            "created_at": "",
        }];

        vm.transfer = [{
            "company" : "",
            "warehouse_origin" : "",
            "destination_store" : "",
            "branch_origin" : "",
            "destination_branch" : "",
            "items[]" : []
        }];

        vm.btn_accept = false;

        vm.ProductsList = [];
        vm.SuppliersList = [];

        vm.typeOutputs = [
                {name:'Vencimiento de Producto', type:4},
                {name:'Donación de Producto', type:5},
                {name:'Devolución a Proveedor', type:6},
                {name:'Auditoria', type:9}
        ];
    
        vm.create = function(redir = true){
            if(vm.toggleSelected == true)
                vm.warehouse.is_active = 1;
            else 
                vm.warehouse.is_active = 0;
            
            vm.warehouse.company_id = vm.company.id; 
            vm.warehouse.branch_id = vm.branchOffice.id; 

            var promise = WarehouseService.create(vm.warehouse);
            promise.then(function(pl){
                var retorno = pl.data;
                toastr.success("El almacen fue creada satisfactoriamente");
                if(redir)
                    window.location = HOST_ROUTE.WAREHOUSE;
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
                vm.warehouse.is_active=1;
            else 
                vm.warehouse.is_active=0;
            var promise = WarehouseService.update(vm.warehouse, vm.warehouse.id);
            promise.then(function(pl){
                var retorno = pl.data;
                toastr.success("El almacen fué actualizado satisfactoriamente");
                window.location = HOST_ROUTE.WAREHOUSE;
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
                var promise = WarehouseService.delete(id);
                promise.then(function(pl){
                    toastr.success("El registro fue eliminado satisfactoriamente");
                    window.location = HOST_ROUTE.WAREHOUSE;    
                });
              }
            }); 

        }   

        vm.edit = function(id){
            var promise = WarehouseService.read(id);
            promise.then(function(pl){
                vm.warehouse = pl.data;
                if(vm.warehouse.is_active===1) 
                    vm.toggleSelected = true;
                else
                    vm.toggleSelected = false;
            });
        }

        vm.readAll = function(){
            var promise = WarehouseServices.readAll();
            promise.then(function(pl){
                vm.WarehousesList = pl.data;
            }); 
        }

        vm.readCompanyList = function(UserRoleId, CompanyId, BranchId = null){
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
                            vm.getAllBranchOffice(UserRoleId,CompanyId,BranchId);
                        }
                   });
                }
            });    
        }

        vm.readWarehouseList = function(UserRoleId, BranchId){
            var promise = WarehouseService.readAll();
            promise.then(function(pl){
                if(UserRoleId===1 || UserRoleId ===2)// SuperAdministrador || SuperAdminInventario
                   vm.WarehousesList = pl.data;
                else
                {
                   var datos = pl.data;
                   angular.forEach(datos, function(warehouse, key){
                        if(warehouse.branch_id===BranchId){
                            vm.WarehousesList.push(warehouse);
                        }
                   });
                }
            });    
        }

        vm.readWarehouseDestinationList = function(UserRoleId, BranchId){
            var promise = WarehouseService.readAll();
            promise.then(function(pl){
                if(UserRoleId===1 || UserRoleId ===2)// SuperAdministrador || SuperAdminInventario
                   vm.WarehousesDestinationList = pl.data;
                else
                {
                   var datos = pl.data;
                   angular.forEach(datos, function(warehouse, key){
                        if(warehouse.branch_id===BranchId){
                            vm.WarehousesDestinationList.push(warehouse);
                        }
                   });
                }
            });    
        }

        vm.selectOrigin = function(CompanyId, BranchId){
            var promise = WarehouseService.getProducts(vm.warehouseSelected.id, CompanyId, BranchId);
            promise.then(function(pl){
                vm.ProductsList = pl.data;
            });
        }

        // vm.selectWarehouse = function() {
        //     vm.getAllProducts();
        // }

        vm.deleteItemLine = function(itemLine){
            var index = vm.Items.indexOf(itemLine);
            vm.Items.splice(index, 1);
        }

        vm.selectProduct = function(idCompany, BranchId){
            //console.log(idCompany, vm.productSelected);
            // var promise = WarehouseService.readWP(idCompany, vm.productSelected.id, vm.warehouseSelected.id);
            var promise = WarehouseService.readWP(idCompany, vm.productSelected.id, vm.warehouseSelected.id, BranchId);
            promise.then(function(pl){
                var n =  new Date();

                if(pl.data == 0){
                    vm.Product.product_id  = vm.productSelected.id;
                    vm.Product.name        = vm.productSelected.name;
                    vm.Product.description = vm.productSelected.description;
                    vm.Product.transferAmount = 0; 
                    vm.Product.currentAmount = 0;
                    vm.Product.invoiceAmount = 0;
                    vm.Product.expiration_date = new Date(n.getFullYear(),n.getMonth(),n.getDate()); 
                    
                    vm.Product.laboratory   = vm.productSelected.laboratory;
                    vm.Product.location     = vm.productSelected.location;
                    vm.Product.expired_date = vm.productSelected.expired_date;
                    vm.Product.generic      = vm.productSelected.generic;
                } else {
                    vm.Product.product_id  = vm.productSelected.id;
                    vm.Product.name        = pl.data.product.name;
                    vm.Product.description = pl.data.product.description;
                    vm.Product.transferAmount = 0; 
                    vm.Product.invoiceAmount = 0;
                    vm.Product.currentAmount = pl.data.quantity;
                    vm.Product.expiration_date = new Date(n.getFullYear(),n.getMonth(),n.getDate()); 
                    
                    if(pl.data.product.laboratory   !== null) vm.Product.laboratory   = pl.data.product.laboratory;
                    if(pl.data.product.location     !== null) vm.Product.location     = pl.data.product.location;
                    if(pl.data.product.expired_date !== null) vm.Product.expired_date = pl.data.product.expired_date;
                    if(pl.data.product.generic      !== null) vm.Product.generic      = pl.data.product.generic;
                }

            });

            if (!vm.auditSelected) {
                vm.suppliers();
            }
        }

        vm.getAllProducts = function(idCompany){
            var promise = ProductService.readAll(idCompany);
            promise.then(function(pl){
                vm.ProductsList = pl.data;
            }); 
        }

        vm.getAllBranchOffice = function(UserRoleId, idCompany, branchId = null){
            var promise = BranchService.readByCompany(idCompany);
            promise.then(function(pl){
                if(UserRoleId===1 || UserRoleId ===2)// SuperAdministrador || SuperAmdinInventario
                   vm.BranchOfficesList = pl.data;
                else
                {
                   var datos = pl.data;
                   angular.forEach(datos, function(branch, key){
                        if(branch.id===branchId){
                            vm.BranchOfficesList.push(branch);
                        }
                   });
                }
            });
            vm.getAllProducts(); 
        }

        vm.addItemLine = function(product, option){
            var itemLine = {};
            
            vm.Items = vm.Items || [];

            if(option === 1){
                if(product.transferAmount<=0){
                    SweetAlert.swal("Cantidad incorrecta!", "La Cantidad a transferir debe ser mayor a cero!", "warning"); 
                    return;
                }
                if(isNaN(parseInt(product.transferAmount)) && option === 1){
                    SweetAlert.swal("Cantidad incorrecta!", "La Cantidad a transferir acepta solo valores numericos!", "warning"); 
                    return;
                }

                itemLine.product = {
                    product_id   : product.product_id,
                    principal_code : product.product_id.principal_code,
                    name         : product.name,
                    description  : product.description,
                    document_number : product.documentNumber,
                    laboratory   : product.product_id.laboratory ? product.product_id.laboratory : "",
                    location     : product.product_id.location ? product.product_id.location : "",
                    generic      : product.product_id.generic ? product.product_id.generic : ""
                };
            } else {
                if(product.product_id==="" || product.product_id===undefined){
                    SweetAlert.swal("Entrada de Producto!", "Debe seleccionar un producto!", "warning"); 
                    return;
                }
                if(product.transferAmount<=0){
                    SweetAlert.swal("Cantidad incorrecta!", "La Cantidad a ingresar debe ser mayor a cero!", "warning");
                    return;
                }
                if(isNaN(parseInt(product.transferAmount))){
                    SweetAlert.swal("Cantidad incorrecta!", "La Cantidad a ingresar acepta solo valores numericos!", "warning"); 
                    return;
                }

                if(!vm.auditSelected){
                    if(product.supplier === undefined){
                        SweetAlert.swal("Entrada de producto!", "Debe de seleccionar un Proveedor!", "warning"); 
                        return;
                    }
                    if(product.invoiceAmount<=0){
                        SweetAlert.swal("Entrada de producto!", "El Monto de la Factura debe ser mayor a cero!", "warning");
                        return;
                    }
                }

                if(!vm.auditSelected){
                    itemLine.product = {
                         product_id   : product.product_id,
                         principal_code : product.product_id.principal_code,
                         name         : product.name,
                         description  : product.description,
                         supplier_id  : product.supplier.id,
                         supplierName : product.supplier.social_reason,
                         invoiceAmount : product.invoiceAmount,
                         document_number : product.documentNumber,
                         expiration_date : product.expiration_date,
                         laboratory   : product.product_id.laboratory ? product.product_id.laboratory : "",
                         location     : product.product_id.location ? product.product_id.location : "",
                         generic      : product.product_id.generic ? product.product_id.generic : ""
                    };
                } else {
                    itemLine.product = {
                         product_id   : product.product_id,
                         principal_code : product.product_id.principal_code,
                         name         : product.name,
                         description  : product.description,
                         supplier_id : "",
                         supplierName : "",
                         invoiceAmount : "",
                         document_number : "",
                         expiration_date : "",
                         laboratory   : product.product_id.laboratory ? product.product_id.laboratory : "",
                         location     : product.product_id.location ? product.product_id.location : "",
                         generic      : product.product_id.generic ? product.product_id.generic : ""
                    };
                }
            }
            
            //itemLine.product_id = product.product_id;
            itemLine.currentAmount = product.currentAmount;
            itemLine.transferAmount = product.transferAmount;
            
            vm.Items.push(itemLine);
            vm.resetItemLine();
        }

        vm.resetItemLine = function(){
            vm.Product = [];
            vm.productSelected = "";
        }

        vm.addEntryProduct = function (idCompany) {

                if(!vm.auditSelected){
                    if(vm.invoiceNumber === '' || vm.invoiceNumber === undefined){
                        SweetAlert.swal("Enrada de producto!", "El número de factura debe ser ingresado!", "warning"); 
                        return;
                    }
                }
            // if(vm.Product.transferAmount === 0){
            //     SweetAlert.swal("Linea de Ingreso!", "La cantidad a ingresar debe ser mayor a 0!", "warning"); 
            //     return;
            // }

            // if (!vm.auditSelected) {
            //     if(vm.Product.invoiceNumber === '' || vm.Product.invoiceNumber === undefined){
            //         SweetAlert.swal("Linea de Ingreso!", "El número de factura debe ser ingresado!", "warning"); 
            //         return;
            //     }

            //     if(vm.Product.invoiceAmount === 0 || vm.Product.invoiceAmount === undefined){
            //         SweetAlert.swal("Linea de Ingreso!", "El monto de factura debe ser ingresada!", "warning"); 
            //         return;
            //     }

            //     if(vm.Product.expiration_date === undefined){
            //         SweetAlert.swal("Linea de Ingreso!", "La fecha de factura debe ser ingresada!", "warning"); 
            //         return;
            //     }
            // }

            // var promise = WarehouseService.createEntryProduct(vm.Product, vm.warehouseSelected, vm.auditSelected);
           
            var promise = WarehouseService.createEntryProduct(vm.branchOffice.id,vm.invoiceNumber, vm.invoiceObservation, vm.Items, idCompany, vm.warehouseSelected.id, vm.auditSelected);
            promise.then(function(pl){
                var retorno = pl.data;
                if(retorno == 1){
                    toastr.success("Los productos han sido registrado satisfactoriamente");
                    window.location = HOST_ROUTE.WAREHOUSE+'/product_entry';
                } else {
                    toastr.error("Los productos no han sido registrado satisfactoriamente");
                }
            });
        }

        vm.addOutputProduct = function (idCompany) {
            if(vm.Product.transferAmount === 0){
                SweetAlert.swal("Linea de Salida!", "La cantidad de salida debe ser mayor a 0!", "warning"); 
                return;
            }

            var promise = WarehouseService.createOutputProduct(idCompany,vm.branchOffice.id,vm.productSelected.id,vm.warehouseSelected.id,vm.Product.transferAmount,vm.Product.observation, vm.typeOutput.type);
            promise.then(function(pl){
                var retorno = pl.data;
                if(retorno == 1){
                    toastr.success("La salida del producto ha sido registrada satisfactoriamente");
                    window.location = HOST_ROUTE.WAREHOUSE+'/createOutput';
                } else {
                    toastr.error("La salida del producto no ha sido registrada satisfactoriamente");
                }
            });
        }

        vm.validateAmountTransfer = function (product) {
            if(product.transferAmount > product.currentAmount){
                SweetAlert.swal("Linea de Transferencia!", "La cantidad a transferir es mayor que la cantidad actual del producto!", "warning"); 
                product.transferAmount = 0;
            }
        }

        vm.validateWarehouse = function () {
            if(vm.destinationStore.id == vm.warehouseSelected.id){
                SweetAlert.swal("Linea de Transferencia!", "El almacen destino no pude ser igual al origen!", "warning"); 
                vm.destinationStore = '';
            }
        }

        vm.branchOfficeValidate = function (UserRoleId) {
            // if (vm.branchOffice.id == vm.branchOfficeDes.id) {
            //     SweetAlert.swal("Linea de Transferencia!", "La sucursal destino no pude ser igual al origen!", "warning"); 
            //     vm.branchOfficeDes = {};
            // } else {
                vm.readWarehouseDestinationList(UserRoleId,vm.branchOfficeDes.id);
            // }
        }
        vm.createTransfer = function (idCompany) {
            vm.transfer.company = idCompany;
            vm.transfer.warehouse_origin = vm.warehouseSelected.id;
            vm.transfer.destination_store = vm.destinationStore.id;
            vm.transfer.branch_origin = vm.branchOffice.id;
            vm.transfer.destination_branch = vm.branchOfficeDes.id;
            vm.transfer.items = vm.Items;
            vm.transfer.document_num = vm.document_number;

            // var promise = WarehouseService.createTransfer(idCompany, vm.warehouseSelected.id, vm.destinationStore.id, vm.Items);
            var promise = WarehouseService.createTransfer(vm.transfer);
            promise.then(function(pl){
                var retorno = pl.data;
                if(retorno == 1){
                    toastr.success("Los productos han sido transferidos satisfactoriamente");
                    window.location = HOST_ROUTE.WAREHOUSE+'/createTransfer';
                } else {
                    toastr.error("Los productos no han sido transferidos satisfactoriamente");
                }
            })
        }

        vm.suppliers = function () {
            var promise = SupplierService.readAll();
            promise.then(function(pl){
                vm.SuppliersList = pl.data;
            })
        }

        vm.invoiceUpperCase = function (property){  
            if(property == 'invoiceNumber'){
                vm.invoiceNumber = vm.invoiceNumber.toUpperCase();
            } else {
                vm.document_number = vm.document_number.toUpperCase();
            }
        }

        vm.getTransfer = function () {
            var promise = WarehouseService.getTransfer(vm.Product.document_number);
            promise.then(function(pl){
                if(pl.data.length == 0){
                    toastr.error("El documneto de transferencia no existe.");
                    vm.Product.document_number = '';
                    vm.dataTransfer.warehouse_origin = "";
                    vm.dataTransfer.product = "";
                    vm.dataTransfer.amount_send = "";
                    vm.dataTransfer.created_at = "";
                    vm.btn_accept = !vm.btn_accept;
                } else {
                    vm.dataTransfer.warehouse_origin = pl.data.warehouse_origin.name;
                    vm.dataTransfer.product = pl.data.product.name;
                    vm.dataTransfer.amount_send = pl.data.amount_send;
                    vm.dataTransfer.created_at = pl.data.created_at;
                    vm.btn_accept = !vm.btn_accept;
                }
            })
        }
        
        vm.acceptTransfer = function () {
            var promise = WarehouseService.acceptTransfer(vm.Product.document_number);
            promise.then(function(pl){
                if(pl.data == 1){
                    vm.dataTransfer.warehouse_origin = "";
                    vm.dataTransfer.product = "";
                    vm.dataTransfer.amount_send = "";
                    vm.dataTransfer.created_at = "";
                    vm.btn_accept = !vm.btn_accept;
                    toastr.success("El inventario ha sido actualizado satisfactoriamente");
                    window.location = HOST_ROUTE.WAREHOUSE+'/searchTransfer';
                } else {
                    toastr.error("Error en el sistema al momento de actualizar el inventario.");
                }
            })
        }

        vm.audit = function () {
            if (vm.auditSelected) {
                vm.SuppliersList = [];
                vm.Items = [];
            } else {
                vm.suppliers();
                vm.Items = [];
            }
        }
    }
})();