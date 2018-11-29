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
                    <strong>Salida de Producto</strong>
                </li>
            </ol>
        </div>        
    </div>

    <div class="wrapper wrapper-content animated fadeInRight" ng-controller='WarehouseController as vm' ng-init="vm.getAllBranchOffice({{$_COOKIE['userRole']}}, {{$_COOKIE['company_id']}}, {{$_COOKIE['branch_office_id']}})">
        <div class="row">

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Nueva salida de producto</h5>                        
                    </div>                    

                    <div class="ibox-content">
                        <br>
                        <form class="form-horizontal" name="FrmProductOutput" novalidate="novalidate" ng-submit="vm.addOutputProduct({{$_COOKIE['company_id']}})">   

                            <div class="form-group">
                                <label class="col-lg-2 col-lg-offset-1 control-label">Sucursal</label>
                                    
                                <div class="col-lg-5">
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
                                <label class="col-lg-2 col-lg-offset-1 control-label">Almacen</label>
                                <div class="col-lg-5">
                                    <select chosen
                                          data-placeholder="Seleccione el Almacen"
                                          no-results-text="'Almacen no encontrado'"
                                          ng-model="vm.warehouseSelected"
                                          ng-options="warehouse.name for warehouse in vm.WarehousesList track by warehouse.id"
                                          ng-change="vm.selectOrigin({{$_COOKIE['company_id']}}, {{$_COOKIE['branch_office_id']}})" 
                                          required>
                                          <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-lg-offset-1 control-label">Producto</label>
                                <div class="col-lg-5">
                                    <select chosen
                                          data-placeholder="Seleccione Producto"
                                          no-results-text="'Producto no encontrado'"
                                          ng-model="vm.productSelected"
                                          ng-options="product.name for product in vm.ProductsList track by product.id"
                                          ng-change="vm.selectProduct({{$_COOKIE['company_id']}}, {{$_COOKIE['branch_office_id']}})">
                                          <option></option>
                                    </select>
                                </div>
                            </div>    
                            <div class="form-group">
                                <label class="col-lg-2 col-lg-offset-1 control-label">Cantidad actual</label>
                                <div class="col-lg-5">
                                    <input class="form-control centrarInput" type="number" min="0" ng-model="vm.Product.currentAmount" readonly="readonly">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 col-lg-offset-1 control-label">Cantidad de Salida</label>
                                <div class="col-lg-5">
                                    <input class="form-control centrarInput" type="number" min="0" ng-model="vm.Product.transferAmount" ng-disabled="!vm.productSelected>0">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-2 col-lg-offset-1 control-label">Tipo Salida</label>
                                <div class="col-lg-5">
                                    <select chosen
                                          ng-model="vm.typeOutput"
                                          ng-options="type.name for type in vm.typeOutputs track by type.type"
                                          required>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <label class="control-label">Observaciones</label>
                                    <textarea ng-model="vm.Product.observation" style="width: 100%; padding: 5px;margin-top: 10px;" cols="30" rows="10" placeholder="Observaciones"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-9">
                                    <button class="btn btn-md btn-primary" type="submit">Guardar</button>
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
