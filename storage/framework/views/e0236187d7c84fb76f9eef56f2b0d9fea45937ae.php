<?php $__env->startSection('content'); ?>
	<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Inventario</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo e(url('home')); ?>">Inicio</a>
                </li>
                <li>
                    <a href="#">Inventario</a>
                </li>
                <li class="active">
                    <strong>Transferencia de Producto</strong>
                </li>
            </ol>
        </div>        
    </div>
	<div class="wrapper wrapper-content animated fadeInRight" ng-controller="WarehouseController as vm" ng-init="vm.readWarehouseList(<?php echo e($_COOKIE['userRole']); ?>, <?php echo e($_COOKIE['company_id']); ?>)">
        <div class="row">

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <!-- <div class="ibox-title">
                        <h5>Transferencia entre Almacenes</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>                                                        
                        </div>
                    </div> -->                    

                    <div class="ibox-content">
                        <br>
                        <form class="form-horizontal" name="FrmWareTransfer" novalidate="novalidate" ng-submit="vm.createTransfer(<?php echo e($_COOKIE['company_id']); ?>)">


                            <div class="form-group">
                           		<label class="col-lg-2 col-lg-offset-1 control-label">Almacen Origen</label>
                                <div class="col-lg-6">                                
                                    <select chosen
                                        no-results-text="'Almacen no encontrado'"
                                    	id="wahehouseOrigin" 
                                    	class="form-control" 
                                    	ng-options="warehouse.name for warehouse in vm.WarehousesList track by warehouse.id" 
                                    	ng-model="vm.warehouseSelected"
                                    	ng-change="vm.selectOrigin(vm.warehouseSelected, <?php echo e($_COOKIE['company_id']); ?>)" 
                                    	required>
                                    	<option></option>
                                    </select>
                                </div>
                            </div>  

                            <div class="form-group">
                           		<label class="col-lg-2 col-lg-offset-1 control-label">Almacen Destino</label>
                                <div class="col-lg-6">
                                    <select chosen
                                    	no-results-text="'Almacen no encontrado'"
                                    	id="destinationStore" 
                                    	class="form-control" 
                                    	ng-options="warehouse.name for warehouse in vm.WarehousesList track by warehouse.id" 
                                    	ng-model="vm.destinationStore"
                                        ng-change="vm.validateWarehouse()" 
                                    	required>
                                    	<option></option>
                                    </select>
                                </div>
                            </div>  
                        	
                        	<div class="row">
	                            <div class="col-xs-12">
	                                <div class="ibox float-e-margins">
	                                    <div class="ibox-title">
	                                        <h5>Items</h5>              
	                                    </div>    
	                                    <div class="ibox-content">
	                                        <div class="row">
	                                            <div class="col-lg-12">
	                                                <table class="table table-responsive">
	                                                    <thead>
	                                                        <tr>
	                                                            <th style="width: 35%"><center>Producto</center></th>
	                                                            <th style="width: 10%"><center>Cantidad Actual</center></th>
	                                                            <th style="width: 15%"><center>Cantidad a Transferir</center></th>
	                                                            <th style="width: 5%"><center>Acción</center></th>
	                                                        </tr>
	                                                    </thead>
	                                                    <tbody>
	                                                        <tr ng-repeat="itemLine in vm.Items">
	                                                        	<td>
	                                                                <b>Producto:</b> {{itemLine.product.name}}{{itemLine.product.principal_code}} 
	                                                                <br/> 
	                                                                <b>Descripción:</b> {{itemLine.product.description}}
	                                                                <div ng-show="itemLine.product.laboratory !== ''">           
	                                                                    <b>Genérico:</b> {{itemLine.product.generic}} 
	                                                                    <br>
	                                                                    <b>Ubicación:</b> {{itemLine.product.location}}
	                                                                    <br>
	                                                                    <b>Labatorio:</b> {{itemLine.product.laboratory}} - <b>F. caducidad:</b> {{itemeLine.product.expired_date}}     
	                                                                </div>
	                                                            </td>
	                                                            <td class="center"><input class="form-control centrarInput" type="text" ng-model="itemLine.currentAmount" ng-readonly="true"></td>
	                                                            <td class="center"><input class="form-control centrarInput" type="text" ng-model="itemLine.transferAmount"></td>
	                                                            <td><button type="button" class="btn btn-md btn-danger" ng-click="vm.deleteItemLine(itemLine)"> <i class="fa fa-trash"></i></button>  </td>
	                                                        </tr>
	                                                        <tr>
	                                                            <td>
	                                                                <select chosen
	                                                                      data-placeholder="Seleccione Producto"
	                                                                      no-results-text="'Producto no encontrado'"
	                                                                      ng-model="vm.productSelected"
	                                                                      ng-options="product.name for product in vm.ProductsList track by product.id"
	                                                                      ng-change="vm.selectProduct(<?php echo e($_COOKIE['company_id']); ?>)">
	                                                                      <option></option>
	                                                                </select>
	                                                            </td>
	                                                            <td><input class="form-control centrarInput" type="text" ng-model="vm.Product.currentAmount" ng-readonly="true"></td>
	                                                            <td><input class="form-control centrarInput" type="text" ng-model="vm.Product.transferAmount" ng-change="vm.validateAmountTransfer(vm.Product)" value="0"></td>
	                                                            <td><button type="button" class="btn btn-md btn-success" ng-click="vm.addItemLine(vm.Product)" ng-disabled="!vm.destinationStore>0"> <i class="fa fa-plus"></i></button></td>
	                                                        </tr>
	                                                    </tbody>
	                                                </table>
	                                            </div>                                   
	                                        </div>                                  
	                                    </div>
	                                </div>
	                            </div>
	                        </div>

                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-6">
                                    <button class="btn btn-md btn-primary" type="submit" >Transferir</button>
                                    <a class="btn btn-md btn-warning" href="<?php echo e(url('/warehouse')); ?>">Volver</a>
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