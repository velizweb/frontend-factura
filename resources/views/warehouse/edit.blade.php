@extends('layouts.app')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight" ng-controller="WarehouseController as vm" ng-init="vm.edit({{$id}})">
        <div class="row">

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Editar Almacen</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>                                                        
                        </div>
                    </div>                    

                    <div class="ibox-content">
                        <br>
                        <form class="form-horizontal" name="FrmWarehouse" novalidate="novalidate" ng-submit="vm.update()">
                            <input type="hidden" ng-model="vm.warehouse.id" value="{{$id}}" />
                            <div class="form-group"><label class="col-lg-2 col-lg-offset-1 control-label">Nombre de Almacen</label>
                                <div class="col-lg-6"><input id="name" type="text" ng-model="vm.warehouse.name" placeholder="Nombre de Al" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group"><label class="col-lg-2 col-lg-offset-1 control-label">Ubicación</label>
                                <div class="col-lg-6"><input id="name" type="text" ng-model="vm.warehouse.location" placeholder="Ubicación" class="form-control" required>
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label class="col-lg-2 col-lg-offset-1 control-label">Activo</label>
                                <input type="hidden" ng-model="vm.warehouse.is_active" value="1"/>
                                <div class="col-lg-6">
                                    <toggle id="is_warehouse" 
                                            ng-model="vm.toggleSelected" 
                                            onstyle="btn-success" on="Si" 
                                            offstyle="btn-danger" off="No">
                                    </toggle>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-6">
                                    <button class="btn btn-md btn-primary" type="submit" >Guardar</button>
                                    <a class="btn btn-md btn-warning" href="{{url('/warehouse')}}">Volver</a>
                                </div>
                            </div>

                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
