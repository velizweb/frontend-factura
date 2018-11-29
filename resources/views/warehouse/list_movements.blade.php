@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Transferencias</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/home')}}">Inicio</a>
                </li>
                <li>
                    <a href="{{ url('/warehouse')}}">Almacen</a>
                </li>
                <li class="active">
                    <strong>Listados de movimientos</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
        </div>
    </div>

    <div id="warehouse" class="wrapper wrapper-content animated fadeInRight" ng-controller="WarehouseController as vm">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Listados de movimientos</h5>
                    </div>

                    <div class="ibox-content">
                        <ul class="nav nav-tabs tabs-up" id="movements">
                            <li>
                              <a href="{{env('API_HOST', NULL)}}/warehouseMov/1" data-target="#Entradas" data-table="1" class="media_node span" id="Entradas_tab" data-toggle="tabajax" rel="tooltip"><i class="fa fa-share" aria-hidden="true"></i> ENTRADAS </a>
                            </li>
                            <li>
                              <a href="{{env('API_HOST', NULL)}}/warehouseMov/output" data-target="#Salidas" data-table="2" class="media_node span" id="Salida_tab" data-toggle="tabajax" rel="tooltip"><i class="fa fa-reply" aria-hidden="true"></i> SALIDAS </a>
                            </li>
                            <li>
                              <a href="{{env('API_HOST', NULL)}}/warehouseMov/3" data-target="#Transferencias" data-table="3" class="media_node span" id="Transferencias_tab" data-toggle="tabajax" rel="tooltip"><i class="fa fa-exchange" aria-hidden="true"></i> TRANSFERENCIAS </a>
                            </li>
                            <li>
                              <a href="{{env('API_HOST', NULL)}}/warehouseMov/7" data-target="#TransferenciasP" data-table="4" class="media_node span" id="TransferenciasP_tab" data-toggle="tabajax" rel="tooltip"><i class="fa fa-exchange" aria-hidden="true"></i> TRANSFERENCIAS PENDIENTES</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane ibox-content" id="Entradas">
                                <div class="table-responsive">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap" style="width: 98%">
                                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="myTableEntradas" aria-describedby="DataTables_Table_0_info" role="grid" >
                                        
                                            <thead>
                                            
                                                <tr role="row">
                                                
                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Almacen</center></th>

                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Producto</center></th>
                                                    
                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Tipo</center></th>
    
                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Fecha Ingreso</center></th>

                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Fecha Vencimiento</center></th>
                                                    
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 15%;"><center>Cant Inicial</center></th>

                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 15%;"><center>Cant Ingresada</center></th>

                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 15%;"><center>Cant Final</center></th>

                                                </tr>
                                            
                                            </thead>

                                            <tbody>
                                            </tbody>    
                                        </table>                            
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane ibox-content" id="Salidas">
                                <div class="table-responsive">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap" style="width: 98%">
                                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="myTableSalidas" aria-describedby="DataTables_Table_0_info" role="grid" >
                                        
                                            <thead>
                                            
                                                <tr role="row">
                                                
                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Almacen</center></th>

                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Producto</center></th>
                                                    
                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Tipo</center></th>
    
                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Fecha Salida</center></th>

                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Fecha Vencimiento</center></th>
                                                    
                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 15%;"><center>Cant Inicial</center></th>

                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 15%;"><center>Cant Saliente</center></th>

                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 15%;"><center>Cant Final</center></th>

                                                </tr>
                                            
                                            </thead>

                                            <tbody>
                                            </tbody>    
                                        </table>                            
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane ibox-content" id="Transferencias">
                                <div class="table-responsive">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap" style="width: 98%">
                                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="myTableTransferencias" aria-describedby="DataTables_Table_0_info" role="grid" >
                                        
                                            <thead>
                                            
                                                <tr role="row">
                                                
                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Origen</center></th>

                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Destino</center></th>
                                                    
                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Producto</center></th>

                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Documento</center></th>

                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Fecha Transferencia</center></th>
                                                    
                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Fecha Recepción</center></th>

                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 15%;"><center>Cant Ini Destino</center></th>

                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 15%;"><center>Cant Transferida</center></th>

                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 15%;"><center>Cant Final Destino</center></th>

                                                </tr>
                                            
                                            </thead>

                                            <tbody>
                                            </tbody>    
                                        </table>                            
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane ibox-content" id="TransferenciasP">
                                <div class="table-responsive">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap" style="width: 98%">
                                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="myTableTransferenciasP" aria-describedby="DataTables_Table_0_info" role="grid" >
                                        
                                            <thead>
                                            
                                                <tr role="row">
                                                
                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Origen</center></th>

                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Destino</center></th>
                                                    
                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Producto</center></th>

                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>N° Documento</center></th>

                                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 15%;"><center>Cant Transferida</center></th>

                                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Fecha Transferencia</center></th>

                                                </tr>
                                            
                                            </thead>

                                            <tbody>
                                            </tbody>    
                                        </table>                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script> 
            
            $(document).ready( function () {
                var firstUrl = $('.nav-tabs a:first').attr('href');
                //var firstTable = $("table:first").attr('id');
               /* $("#"+firstTable).DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "language": {
                                  "url": "/js/spanish.json"
                                },
                    'ajax'       : {
                        url: firstUrl,
                        dataType: 'json',
                        type: 'get',                    
                        contentType: 'application/json',                                                    
                    },
                    'columns'    : [
                        {data: 'name'},
                        {data: 'location'},
                        {
                            data: 'is_active',
                            render: function(status){
                                let estado = '<center><span class="label label-primary">Activo</span></center>';

                                if(status=="0"){
                                    estado = '<center><span class="label label-danger">Inactivo</span></center>';
                                }

                                return estado;
                            }    
                        },
                        {
                            name:       'actions',
                            data:       null,
                            sortable:   false,
                            searchable: false,
                            render: function (data){
                                let actions = '';
                                actions += '<center>'
                                         + '<a href="{{url("warehouse/edit")}}/'+data.id+'" class="btn btn-xs btn-default" style="margin-right:3px"><i class="fa fa-pencil"></i></a>'
                                         + '<button onclick="deleteElement(' + data.id + ')" class="btn btn-xs btn-danger"> <i class="fa fa-trash"></i></button>'
                                          + '<button ng-click="vm.delete(' + data.id+ ')" class="btn btn-xs btn-danger"> <i class="fa fa-trash"></i></button>';

                                return actions;
                            }

                        }
                    ]
                });*/
                loadDataTable(firstUrl);

                $('#movements a:first').tab('show') // Select first tab

                $('[data-toggle="tabajax"]').click(function(e) {
                    e.preventDefault();
                    var $this = $(this),
                    loadurl = $this.attr('href'),
                    table = $this.attr('data-table');
                    
                    if (table == 1) {
                        loadDataTable(loadurl);
                    } else if (table == 2) {
                        loadDataTable2(loadurl);
                    } else if(table == 3){
                        loadDataTable3(loadurl);
                    } else {
                        loadDataTable4(loadurl);
                    }

                    $this.tab('show');
                    return false;
                });
            } );

            /*
            Esta función se usa como helper para ejecutar la función delete del controlador de AngularJs
            */
            function deleteElement(id){            
                angular.element(document.getElementById('warehouse')).scope().vm.delete(id);
            }


            function loadDataTable(loadurl) {
                $("#myTableEntradas").dataTable().fnDestroy();
                var table = $("#myTableEntradas").DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "language": {
                                  "url": "/js/spanish.json"
                                },
                    'ajax'       : {
                        url: loadurl,
                        dataType: 'json',
                        type: 'get',                    
                        contentType: 'application/json',                                                    
                    },
                    'columns'    : [
                        {data: 'warehouse_origin.name'},
                        {data: 'product.name'},
                        {data: 'types'},
                        {data: 'created_at'},
                        {data: 'expiration_date'},
                        {data: 'target_amount'}, 
                        {data: 'amount_send'},
                        {data: 'current_destination_quantity'},
                    ]
                });
                table.ajax.reload();
            }

            function loadDataTable2(loadurl) {
                $("#myTableSalidas").dataTable().fnDestroy();
                var table = $("#myTableSalidas").DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "language": {
                                  "url": "/js/spanish.json"
                                },
                    'ajax'       : {
                        url: loadurl,
                        dataType: 'json',
                        type: 'get',                    
                        contentType: 'application/json',                                                    
                    },
                    'columns'    : [
                        {data: 'warehouse_origin.name'},
                        {data: 'product.name'},
                        {data: 'types'},
                        {data: 'created_at'},
                        {data: 'expiration_date'},
                        {data: 'quantity_origin'}, 
                        {data: 'amount_send'},
                        {data: 'current_origin_quantity'}
                    ]
                });
                table.ajax.reload();
            }

            function loadDataTable3(loadurl) {
                $("#myTableTransferencias").dataTable().fnDestroy();
                var table = $("#myTableTransferencias").DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "language": {
                                  "url": "/js/spanish.json"
                                },
                    'ajax'       : {
                        url: loadurl,
                        dataType: 'json',
                        type: 'get',                    
                        contentType: 'application/json',                                                    
                    },
                    'columns'    : [
                        {data: 'warehouse_origin.name'},
                        {data: 'destination_store.name'},
                        {data: 'product.name'},
                        {data: 'document_number'},
                        {data: 'created_at'},
                        {data: 'reception_date'},
                        {data: 'target_amount'}, 
                        {data: 'amount_send'},
                        {data: 'current_destination_quantity'},
                    ]
                });
                table.ajax.reload();
            }

            function loadDataTable4(loadurl) {
                $("#myTableTransferenciasP").dataTable().fnDestroy();
                var table = $("#myTableTransferenciasP").DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "language": {
                                  "url": "/js/spanish.json"
                                },
                    'ajax'       : {
                        url: loadurl,
                        dataType: 'json',
                        type: 'get',                    
                        contentType: 'application/json',                                                    
                    },
                    'columns'    : [
                        {data: 'warehouse_origin.name'},
                        {data: 'destination_store.name'},
                        {data: 'product.name'},
                        {data: 'document_number'},
                        {data: 'amount_send'},
                        {data: 'created_at'}
                    ]
                });
                table.ajax.reload();
            }
        
        </script>  

@endsection
