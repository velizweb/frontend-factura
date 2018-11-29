(function () {
    "use strict";

    angular
        .module("QuantumApp")
        .service("WarehouseService", WarehouseService);

    WarehouseService.$inject = ['$http', 'SERVER_CONFIG', 'API_ROUTE', 'API_ACTION'];

    function WarehouseService($http, SERVER_CONFIG, API_ROUTE, API_ACTION) {

        var API_HOST = SERVER_CONFIG.API_HOST + API_ROUTE.WAREHOUSE;

        this.create = function (entity) 
        {
            var request = $http({
                method: "post",
                url: API_HOST,
                params: entity,
                headers: {    
                    "Access-Control-Allow-Origin": true,                
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            });
            return request;
        };

        this.createEntryProduct = function (branch,invoiceNumber, invoiceObservation, entity, idCompany, warehouse, audit)
        {
            var param = {
                "company"   : idCompany,
                "branch" : branch,
                "warehouse" : warehouse,
                "products[]"  : entity,
                // "currentAmount" : entity.currentAmount,
                // "transferAmount" : entity.transferAmount,
                // "supplier"  : (!audit) ? entity.supplier.id : 0,
                "invoiceNumber" : invoiceNumber,
                // "invoiceAmount" : (!audit) ? entity.invoiceAmount : '',
                "observation"   : invoiceObservation,
                // "expiration_date" : (!audit) ? entity.expiration_date : '',
                "audit" : (!audit) ? 0 : 1,
                'type'      : (!audit) ? 1 : 8
            }

            var request = $http({
                method: "post",
                url: API_HOST+"/storeEntryProduct",
                params: param,
                headers: {    
                    "Access-Control-Allow-Origin": true,                
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            });
            return request;
        }

        this.createTransfer = function (entity)
        {
            var param = {
                "company"      : entity.company,
                "branch_origin": entity.branch_origin,
                "destination_branch": entity.destination_branch,
                "origin"       : entity.warehouse_origin,
                "destination"  : entity.destination_store,
                "document_num" : entity.document_num,
                "products[]"   : entity.items,
                "type"         : 3
            }

            var request = $http({
                method: "post",
                url: API_HOST+"/storeEntryTransfer",
                params: param,
                headers: {    
                    "Access-Control-Allow-Origin": true,                
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            });
            return request;
            
        }

        this.createOutputProduct = function (idCompany, branch, product, warehouse, quantity, observation, type)
        {
            var param = {
                "company"     : idCompany,
                "branch"      : branch,
                "product"     : product,
                "warehouse"   : warehouse,
                "quantity"    : quantity,
                "observation" : observation,
                "type"        : type
            }

            var request = $http({
                method: "post",
                url: API_HOST+"/storeEntryOutput",
                params: param,
                headers: {    
                    "Access-Control-Allow-Origin": true,                
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            });
            return request;
        }

        this.read = function (Id) 
        {
            var request = $http({
                method: "get",
                url: API_HOST+'/'+Id
            });
            return request;
        };

        this.readAll = function () 
        {
            var request = $http({
                method: "get",
                url: API_HOST
            });
            return request;
        };

        this.update = function (entity, Id) 
        {
            var params = { warehouse: entity};
            var request = $http.put(API_HOST+'/'+Id, entity);
            return request;
        }

        this.delete = function (Id) 
        {
            var request = $http({
                method: "delete",
                url: API_HOST + '/' + Id
            });
            return request;
        }

        this.getProducts = function (WId,CId,BId)
        {
            var request = $http({
                method: "get",
                url: API_HOST+'/products/'+WId+'/'+CId+'/'+BId
            });
            return request;
        }

        this.readWP = function(idCompany, idProduct, idWarehouse, idBranch)
        {
            var request = $http({
                method: "get",
                url: API_HOST+'/product/'+idCompany+'/'+idWarehouse+'/'+idProduct+'/'+idBranch
            });
            return request;
        }  

        this.getTransfer = function (doc_num)
        {
            var request = $http({
                method: "get",
                url: API_HOST+'/getTransfer/'+doc_num
            });
            return request;
        }      

        this.acceptTransfer = function (doc_num) 
        {
            var request = $http({
                method: "get",
                url: API_HOST+'/acceptTransfer/'+doc_num
            });
            return request;
        }
    }
})();