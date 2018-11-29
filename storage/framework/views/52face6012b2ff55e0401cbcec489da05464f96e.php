<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content animated fadeInRight" ng-controller="FamiliesController as vm" ng-init="vm.readCompanyList(<?php echo e($_COOKIE['userRole']); ?>, <?php echo e($_COOKIE['company_id']); ?>)">
        <div class="row">

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Nuevo Familia</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>                                                        
                        </div>
                    </div>                    

                    <div class="ibox-content">
                        <br>
                        <form class="form-horizontal" name="FrmFamilies" novalidate="novalidate" ng-submit="vm.create()">


                           <div class="form-group"><label class="col-lg-2 col-lg-offset-1 control-label">Compañía</label>
                                <div class="col-lg-6">                                                                    
                                    <select id="company" class="form-control" ng-options="company.name for company in vm.CompanyList track by company.id" ng-model="vm.company" required>
                                    </select>
                                </div>
                            </div>  

                            <div class="form-group"><label class="col-lg-2 col-lg-offset-1 control-label">Nombre de Familia</label>
                                <div class="col-lg-6"><input id="name" type="text" ng-model="vm.families.name" placeholder="Nombre de Familia" class="form-control" required>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label class="col-lg-2 col-lg-offset-1 control-label">Activo</label>
                                <input type="hidden" ng-model="vm.families.is_active" value="1"/>
                                <div class="col-lg-6">
                                    <toggle id="is_families" 
                                            ng-model="vm.toggleSelected" 
                                            onstyle="btn-success" on="Si" 
                                            offstyle="btn-danger" off="No">
                                    </toggle>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-6">
                                    <button class="btn btn-md btn-primary" type="submit" >Guardar</button>
                                    <a class="btn btn-md btn-warning" href="<?php echo e(url('/families')); ?>">Volver</a>
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