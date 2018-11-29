@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Inventario</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('home') }}">Inicio</a>
                </li>
                <li>
                    <a href="{{ url('/warehouse') }}">Almacen</a>
                </li>
                <li class="active">
                    <strong>Entrada de Producto</strong>
                </li>
            </ol>
        </div>        
    </div>

    <div class="wrapper wrapper-content animated fadeInRight" ng-controller='WarehouseController as vm' ng-init="vm.getAllBranchOffice({{$_COOKIE['userRole']}}, {{$_COOKIE['company_id']}}, {{$_COOKIE['branch_office_id']}})">
        <div class="row">

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Nueva entrada de producto</h5>                        
                    </div>                    

                    <div class="ibox-content">
                        <br>
                        <form class="form-horizontal" name="FrmProductEntry" novalidate="novalidate" ng-submit="vm.addEntryProduct({{$_COOKIE['company_id']}})">  
                            <div class="form-group">
                                <div class="col-lg-3">
                                    <label>Sucursal</label>
                                    <div></div>
                                </div>
                                <div class="col-lg-4">
                                    <select chosen
                                          data-placeholder="Seleccione Sucursal"
                                          no-results-text="'Sucursales no encontrada'"
                                          ng-model="vm.branchOffice"
                                          ng-options="branch.name for branch in vm.BranchOfficesList track by branch.id"
                                          ng-change="vm.readWarehouseList({{$_COOKIE['userRole']}}, {{$_COOKIE['branch_office_id']}})">
                                          <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-3">
                                    <label>Almacen</label>
                                    <div></div>
                                </div>
                                <div class="col-lg-4">
                                    <select chosen
                                          data-placeholder="Seleccione Almacen"
                                          no-results-text="'Almacenes no encontrados'"
                                          ng-model="vm.warehouseSelected"
                                          ng-options="warehouse.name for warehouse in vm.WarehousesList track by warehouse.id">
                                          <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-3">
                                    <label>¿Es entrada por auditoria?</label>
                                    <div></div>
                                </div>
                                <div class="col-lg-3">
                                    <toggle id="is_default" 
                                        ng-model="vm.auditSelected" 
                                        ng-change="vm.audit()"
                                        onstyle="btn-success" on="Si" 
                                        offstyle="btn-danger" off="No">
                                    </toggle>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-4">
                                    <label>N° de Factura</label>
                                    <input 
                                        class="form-control centrarInput" 
                                        type="text" 
                                        ng-model="vm.invoiceNumber" 
                                        ng-change="vm.invoiceUpperCase('', 'invoiceNumber')" 
                                        placeholder="Ingrese N° de Factura"
                                        ng-disabled="vm.auditSelected">
                                </div>
                            </div>
                            
                           <!--  <div class="form-group">
                                <label class="col-lg-1 control-label">Almacen</label>
                                <div class="col-lg-5">
                                    <select ng-value="1" chosen
                                          data-placeholder="Seleccione el Almacen"
                                          no-results-text="'Almacen no encontrado'"
                                          ng-model="vm.warehouseSelected"
                                          ng-options="warehouse.name for warehouse in vm.WarehousesList track by warehouse.id"
                                          ng-change="vm.selectWarehouse()"
                                          required>
                                          <option></option>
                                    </select>
                                </div>
                            </div> -->
                           
                            <!--<div class="form-group">
                                <label class="col-lg-1 control-label">Producto</label>
                                <div class="col-lg-4">
                                    <select chosen
                                          data-placeholder="Seleccione Producto"
                                          no-results-text="'Producto no encontrado'"
                                          ng-model="vm.productSelected"
                                          ng-options="product.name for product in vm.ProductsList track by product.id"
                                          ng-change="vm.selectProduct({{$_COOKIE['company_id']}}, vm.productSelected)">
                                          <option></option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <input class="form-control centrarInput" type="text" ng-model="vm.Product.currentAmount" placeholder="Cantidad Actual" ng-readonly="true">
                                </div>
                                <label class="col-lg-2 control-label">Cantidad a Ingresar</label>
                                <div class="col-lg-3">
                                    <input class="form-control centrarInput" placeholder="Cantidad a Ingresar" type="number" min="0" ng-model="vm.Product.transferAmount" ng-disabled="!vm.productSelected>0">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-1 control-label">Proveedor</label>
                                <div class="col-lg-3">
                                    <select chosen
                                          data-placeholder="Seleccione Proveedor"
                                          no-results-text="'Proveedor no encontrado'"
                                          ng-model="vm.Product.supplier"
                                          ng-options="supplier.comercial_name for supplier in vm.SuppliersList track by supplier.id">
                                          <option></option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <input class="form-control centrarInput" type="text" ng-model="vm.Product.invoiceNumber" ng-change="vm.invoiceUpperCase(vm.Product, 'invoiceNumber')" placeholder="N° Factura" ng-disabled="!vm.Product.supplier>0">
                                </div> 
                                <label class="col-lg-1 control-label">Monto</label>
                                <div class="col-lg-2">
                                    <input class="form-control centrarInput" type="number" ng-model="vm.Product.invoiceAmount" min="0" placeholder="Monto Factura" ng-disabled="!vm.Product.supplier>0">
                                </div>
                                <label class="col-lg-2 control-label">Fecha Vcto</label>
                                <div class="col-lg-3">
                                    <input class="form-control centrarInput" type="date" ng-model="vm.Product.expiration_date" ng-disabled="!vm.Product.supplier>0">
                                </div>
                            </div> -->
                            
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Productos</h5>              
                                        </div>    
                                        <div class="ibox-content">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <table class="table table-responsive">
                                                        <!-- <thead>
                                                            <tr>
                                                                <th style="width: 35%"><center>Producto</center></th>
                                                                
                                                                <th style="width: 15%"><center>Cantidad a Ingresar</center></th>
                                                                <th style="width: 5%"><center>Acción</center></th>
                                                            </tr>
                                                        </thead> -->
                                                        <tbody>
                                                            <tr ng-repeat="itemLine in vm.Items">
                                                                <td>
                                                                    <b>Producto:</b> @{{itemLine.product.name}}@{{itemLine.product.principal_code}} 
                                                                    &nbsp;&nbsp;
                                                                    <b>Descripción:</b> @{{itemLine.product.description}}
                                                                    <br/>
                                                                    <b>Proveedor:</b> @{{itemLine.product.supplierName}}
                                                                    &nbsp;&nbsp;
                                                                    <b>Monto Factura:</b> @{{itemLine.product.invoiceAmount}}
                                                                    <br/>
                                                                    <b>Fecha Vencimiento:</b> @{{itemLine.product.expiration_date | date:'dd-MM-yyyy '}}
                                                                    <div ng-show="itemLine.product.laboratory !== ''">           
                                                                        <b>Genérico:</b> @{{itemLine.product.generic}} 
                                                                        <br>
                                                                        <b>Ubicación:</b> @{{itemLine.product.location}}
                                                                        <br>
                                                                        <b>Labatorio:</b> @{{itemLine.product.laboratory}} - <b>F. caducidad:</b> @{{itemeLine.product.expired_date}}     
                                                                    </div>
                                                                </td>
                                                                <!-- <td class="center"><input class="form-control centrarInput" type="text" ng-model="itemLine.currentAmount" ng-readonly="true"></td> -->
                                                                <td class="center col-lg-2">
                                                                    <label>Cantidad a Ingresar</label>
                                                                    <input class="form-control centrarInput" type="text" ng-model="itemLine.transferAmount">
                                                                </td>
                                                                <td><button type="button" class="btn btn-md btn-danger" style="margin-top:25px;" ng-click="vm.deleteItemLine(itemLine)"> <i class="fa fa-trash"></i></button>  </td>
                                                            </tr>
                                                            <tr>
                                                                <!-- <td>
                                                                    <select chosen
                                                                          data-placeholder="Seleccione Producto"
                                                                          no-results-text="'Producto no encontrado'"
                                                                          ng-model="vm.productSelected"
                                                                          ng-options="product.name for product in vm.ProductsList track by product.id"
                                                                          ng-change="vm.selectProduct({{$_COOKIE['company_id']}}, vm.productSelected)">
                                                                          <option></option>
                                                                    </select>
                                                                </td>
                                                                <td><input class="form-control centrarInput" type="text" ng-model="vm.Product.currentAmount" ng-readonly="true"></td>
                                                                <td><input class="form-control centrarInput" type="number" ng-model="vm.Product.transferAmount"  value="0"></td>
                                                                <td><button type="button" class="btn btn-md btn-success" ng-click="vm.addItemLine(vm.Product, 2)" ng-disabled="!vm.warehouseSelected>0"> <i class="fa fa-plus"></i></button></td> -->
                                                                <td colspan="2">
                                                                    <div class="form-group">
                                                                        <div class="col-lg-6">
                                                                            <label class="control-label">Seleccionar Producto</label>
                                                                            <select chosen
                                                                                  data-placeholder="Seleccione Producto"
                                                                                  no-results-text="'Producto no encontrado'"
                                                                                  ng-model="vm.productSelected"
                                                                                  ng-options="product.name for product in vm.ProductsList track by product.id"
                                                                                  ng-change="vm.selectProduct({{$_COOKIE['company_id']}}, vm.productSelected)">
                                                                                  <option></option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-lg-3">
                                                                            <label class="control-label">Cantdad Actual</label>
                                                                            <input class="form-control centrarInput" type="text" ng-model="vm.Product.currentAmount" placeholder="Cantidad Actual" ng-readonly="true">
                                                                        </div>
                                                                        <label class="control-label">Cantidad a Ingresar</label>
                                                                        <div class="col-lg-3">
                                                                            <input class="form-control centrarInput" placeholder="Cantidad a Ingresar" type="number" min="0" ng-model="vm.Product.transferAmount" ng-disabled="!vm.productSelected>0">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        
                                                                        <div class="col-lg-6">
                                                                            <label class="control-label">Proveedor</label>
                                                                            <select chosen
                                                                                  no-results-text="'Proveedor no encontrado'"
                                                                                  ng-model="vm.Product.supplier"
                                                                                  ng-options="supplier.comercial_name for supplier in vm.SuppliersList track by supplier.id">
                                                                                  <option></option>
                                                                            </select>
                                                                        </div>
                                                                        <!-- <div class="col-lg-2">
                                                                            <input class="form-control centrarInput" type="text" ng-model="vm.Product.invoiceNumber" ng-change="vm.invoiceUpperCase(vm.Product, 'invoiceNumber')" placeholder="N° Factura" ng-disabled="!vm.Product.supplier>0">
                                                                        </div> -->
                                                                        
                                                                        <div class="col-lg-3">
                                                                            <label class="control-label">Monto Factura</label>
                                                                            <input class="form-control centrarInput" type="number" ng-model="vm.Product.invoiceAmount" min="0" placeholder="Monto Factura" ng-disabled="!vm.Product.supplier>0">
                                                                        </div>
                                                                        
                                                                        <div class="col-lg-3">
                                                                            <label>Fecha Vencimiento</label>
                                                                            <input class="form-control centrarInput" id="date" type="date" ng-model="vm.Product.expiration_date" ng-disabled="!vm.Product.supplier>0">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><button type="button" class="btn btn-md btn-success" style="margin-top:25px;" ng-click="vm.addItemLine(vm.Product, 2)" ng-disabled="!vm.SuppliersList>0"> <i class="fa fa-plus"></i></button></td>
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
                                <div class="col-lg-12">
                                    <label class="control-label">Observaciones</label>
                                    <textarea ng-model="vm.invoiceObservation" ng-disabled="!vm.auditSelected" style="width: 100%; padding: 5px;margin-top: 10px;" cols="30" rows="10" placeholder="Observaciones"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-9">
                                    <button class="btn btn-md btn-primary" ng-disabled="!vm.Items.length > 0" type="submit">Guardar</button>
                                    <a class="btn btn-md btn-warning" href="{{url('/branch')}}">Volver</a>
                                </div>
                            </div>

                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <script>
        
    </script>
@endsection
