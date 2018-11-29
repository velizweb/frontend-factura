<?php $__env->startSection('content'); ?>
	<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Inventario</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo e(url('home')); ?>">Inicio</a>
                </li>
                <li>
                    <a href="<?php echo e(url('/warehouse')); ?>">Inventario</a>
                </li>
                <li class="active">
                    <strong>Busqueda de Transferencia</strong>
                </li>
            </ol>
        </div>        
    </div>
	<div class="wrapper wrapper-content animated fadeInRight" ng-controller="WarehouseController as vm">
        <div class="row">

            <div class="col-lg-12">
                <div class="ibox float-e-margins">    
                    <div class="ibox-title">
                        <h5>Busqueda de Transferencia</h5>                        
                    </div>       
                    <div class="ibox-content">
                        <form class="form-horizontal" name="FrmSearchTransfer" novalidate="novalidate" ng-submit="vm.acceptTransfer()">
                            
                            <div class="form-group">
                           		<label class="col-lg-2 col-lg-offset-1 control-label">N° de Documento</label>
                                <div class="col-lg-4">                                
                                    <input class="form-control centrarInput" type="text" ng-model="vm.Product.document_number" ng-change="vm.invoiceUpperCase(vm.Product, 'document_number')" value="" placeholder="Ingrese N° de Documento">
                                </div>
                                <div class="col-lg-2">                                
                                    <button type="button" class="btn btn-md btn-success" ng-click="vm.getTransfer()"><i class="fa fa-search"></i></button>
                                </div>
                            </div>  
    
                            <div class="form-group">
                                <label class="col-lg-2 col-lg-offset-1 control-label">Almacen Origen</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control centrarInput" readonly="" ng-model="vm.dataTransfer.warehouse_origin">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-lg-offset-1 control-label">Producto</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control centrarInput" readonly="" ng-model="vm.dataTransfer.product">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-lg-offset-1 control-label">Cantidad</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control centrarInput" readonly="" ng-model="vm.dataTransfer.amount_send">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-lg-offset-1 control-label">Fecha</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control centrarInput" readonly="" ng-model="vm.dataTransfer.created_at">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-6">
                                    <button class="btn btn-md btn-primary" type="submit" ng-disabled="!vm.btn_accept">Transferir</button>
                                    <a class="btn btn-md btn-warning" href="<?php echo e(url('/warehouse/transfers')); ?>">Volver</a>
                                </div>
                            </div>

                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>