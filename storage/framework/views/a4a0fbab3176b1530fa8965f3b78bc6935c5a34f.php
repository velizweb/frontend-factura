<?php $__env->startSection('content'); ?>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Compañia</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo e(url('/')); ?>">Inicio</a>
                </li>
                <li>
                    <a href="<?php echo e(url('/company')); ?>">Compañías</a>
                </li>
                <li class="active">
                    <strong>Listar Compañías</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
        </div>
    </div>
    <div id="company" class="wrapper wrapper-content animated fadeInRight" ng-controller="CompanyController as vm">
        <div class="row">

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Lista de Compañía</h5>
                        <div class="ibox-tools">
                            <a href="<?php echo e(url('/company/create')); ?>" class="btn btn-xs btn-primary"><span class="fa fa-plus-circle"></span> Nueva Compañía</a>
                        </div>
                    </div>                    

                    <div class="ibox-content" >
                        <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap" style="width: 98%">

                    <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="myTable" aria-describedby="DataTables_Table_0_info" role="grid" >
                    
                        <thead>
                        
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Nombre</center></th>

                                <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 20%;"><center>Nombre Comercial</center></th>

                                <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 5%;"><center>Cód. Emisión</center></th>

                                <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 5%;"><center>Período Fiscal</center></th>

                                <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 10%;"><center>Url Sitio</center></th>

                                <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 10%;"><center>Teléfono</center></th>

                                <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 10%;"><center>Contabilidad</center></th>

                                <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 10%;"><center>Estado</center></th>

                                <th class="sorting" rowspan="1" colspan="1" style="width: 10%;"><center>Acciones</center>   </th>
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

        <script>            

            <?php if($_COOKIE['userRole'] == env('ROLE_SUPERADMIN', NULL)): ?>
                var apiUrl =  '<?php echo e(env('API_HOST', NULL)); ?>/companyDtAll';
            <?php else: ?>
                var apiUrl =  '<?php echo e(env('API_HOST', NULL)); ?>/companyDt/<?php echo e($_COOKIE['company_id']); ?>';
            <?php endif; ?>                    
            
            $(document).ready( function () {
                $('#myTable').DataTable({
                    "processing" : false,
                    "serverSide" : true,
                    "language": {
                                  "url": "/js/spanish.json"
                                },
                    'ajax'       : {
                        url: apiUrl,
                        dataType: 'json',
                        type: 'get',                    
                        contentType: 'application/json',                                                    
                    },
                    'columns'    : [
                        {data: 'name'},
                        {data: 'comercial_name'},
                        {
                            data: 'emission_code',
                            className: "text-center"
                        },
                        {
                            data: 'tax_year',
                            className: "text-center"
                        },
                        {
                            data: 'url',
                            className: "text-center"
                        },
                        {
                            data: 'phone',
                            className: "text-center"
                        },
                        {
                            data: 'is_accounting',
                            render: function(status){
                                let estado = '<center><span class="label label-primary">SI</span></center>';

                                if(status=="0"){
                                    estado = '<center><span class="label label-danger">NO</span></center>';
                                }

                                return estado;
                            }    
                        },
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
                                         + '<a href="<?php echo e(url("company/edit")); ?>/'+data.id+'" class="btn btn-xs btn-default" style="margin-right:3px"><i class="fa fa-pencil"></i></a>'
                                         + '<button onclick="deleteElement(' + data.id + ')" class="btn btn-xs btn-danger"> <i class="fa fa-trash"></i></button>';
                                         // + '<button ng-click="vm.delete(' + data.id+ ')" class="btn btn-xs btn-danger"> <i class="fa fa-trash"></i></button>';

                                return actions;
                            }

                        }
                    ]
                });
            } );

            /*
            Esta función se usa como helper para ejecutar la función delete del controlador de AngularJs
            */
            function deleteElement(id){            
                angular.element(document.getElementById('company')).scope().vm.delete(id);
            }
        
        </script>
    </div>    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>