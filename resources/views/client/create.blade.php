@extends('layouts.app')

@section('content')
    <!--  -->
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Cliente</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/')}}">Inicio</a>
                </li>
                <li>
                    <a href="{{ url('/client')}}">Clientes</a>
                </li>
                <li class="active">
                    <strong>Nuevo Cliente</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight" ng-controller='ClientController as vm' ng-init="vm.readCompanyList({{$_COOKIE['userRole']}}, {{$_COOKIE['company_id']}})">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Nuevo Cliente</h5>
                        <div class="ibox-tools">
                        </div>
                    </div>                    

                    <div class="ibox-content">
                        <br>
                        <form class="form-horizontal" name="FrmClient" novalidate="novalidate" ng-submit="vm.create()">  

                            <div class="form-group"><label class="col-lg-2 col-lg-offset-1 control-label">Compañía</label>
                                <div class="col-lg-6">                                                                    
                                    <select id="company" class="form-control" ng-options="company.name for company in vm.CompanyList track by company.id" ng-model="vm.company" required>
                                    </select>
                                </div>
                            </div>         

                            <div class="form-group">
                                <label class="col-lg-2 col-lg-offset-1 control-label">Tipo de Documento</label>
                                <div class="col-lg-6">
                                    <select ng-model="vm.IdentificationTypeSelected" class="form-control" 
                                        ng-options="identification.name for identification in vm.IdentificationTypeList track by identification.id"
                                        ng-change="vm.selectIdentification(vm.IdentificationTypeSelected)"> 
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 col-lg-offset-1 control-label">Nro. Documento</label>
                                <div class="col-lg-6">
                                    <input id="nro_documento" type="text" 
                                        ng-model="vm.client.identification_number" placeholder="Nro. Documento" class="form-control" required ng-minlength="@{{vm.MinCharIdentification}}" ng-maxlength="@{{vm.MaxCharIdentification}}">  
                                </div>
                            </div>                
                            
                            <div class="form-group"><label class="col-lg-2 col-lg-offset-1 control-label">Nombre / Razon Social</label>
                                <div class="col-lg-6"><input id="social_reason" type="text" 
                                    ng-model="vm.client.social_reason" placeholder="Nombre / Razon Social" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group"><label class="col-lg-2 col-lg-offset-1 control-label">Nombre Comercial</label>
                                <div class="col-lg-6"><input id="comercial_name" type="text" 
                                    ng-model="vm.client.comercial_name" placeholder="Nombre Comercial" class="form-control">
                                </div>
                            </div>
                            
                            <div class="form-group"><label class="col-lg-2 col-lg-offset-1 control-label">Teléfono</label>
                                <div class="col-lg-6"><input id="phone" type="text" 
                                    ng-model="vm.client.phone" placeholder="Teléfono " class="form-control"></div>
                            </div>
                            
                            <div class="form-group"><label class="col-lg-2 col-lg-offset-1 control-label">Dirección</label>
                                <div class="col-lg-6"><input id="address" ng-model="vm.client.address" type="text" placeholder="Dirección " class="form-control">
                                </div>
                            </div>
                            
                            <div class="form-group"><label class="col-lg-2 col-lg-offset-1 control-label">Email</label>
                                <div class="col-lg-6"><input id="email" ng-model="vm.client.email" type="email" placeholder="Email" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 col-lg-offset-1 control-label">Activo</label>
                                <input type="hidden" ng-model="vm.client.is_active" value="1"/>
                                <div class="col-lg-6">
                                    <toggle id="is_client" 
                                            ng-model="vm.toggleSelected" 
                                            onstyle="btn-success" on="Si" 
                                            offstyle="btn-danger" off="No">
                                    </toggle>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-6">
                                    <button class="btn btn-md btn-primary" type="submit">Guardar</button>
                                    <a class="btn btn-md btn-warning" href="{{url('/client')}}">Volver</a>
                                </div>
                            </div>

                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
