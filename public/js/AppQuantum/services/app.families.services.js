(function () {
    "use strict";

    angular
        .module("QuantumApp")
        .service("FamiliesService", FamiliesService);

    FamiliesService.$inject = ['$http', 'SERVER_CONFIG', 'API_ROUTE', 'API_ACTION'];

    function FamiliesService($http, SERVER_CONFIG, API_ROUTE, API_ACTION) {

        var API_HOST = SERVER_CONFIG.API_HOST + API_ROUTE.FAMILIES;

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
            var params = { families: entity};
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

        
    }
})();