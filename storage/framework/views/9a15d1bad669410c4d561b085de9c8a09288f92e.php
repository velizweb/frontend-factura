<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                    <img alt="image" class="img-circle" src="<?php echo e(asset('img/user.png')); ?> " />
                     </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"></strong>
                     </span> <span class="text-muted text-xs block" style="color: white; font-weight: bold"><?php echo e(ucwords(Cookie::get('user'))); ?> <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="#">Perfil</a></li>
                        <li><a href="#">Contactos</a></li>
                        <li><a href="#">Buzón Correo</a></li>
                        <li class="divider"></li>
                        <li><a id="logOut" href="<?php echo e(url('/logout')); ?>">Cerrar Sesión</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                  
                </div>
            </li>
            <li>
                <a href="<?php echo e(url('/home')); ?>"><i class="fa fa-home"></i> <span class="nav-label">Inicio</span> </a>
            </li>
            <?php if(env('ROLE_SUPERADMIN', NULL) <> $_COOKIE['userRole']): ?>

            <li class="">
                <a href="#"><i class="fa fa-file-o"></i> <span class="nav-label">Procesos</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo e(url('/invoice/prefactura')); ?>">Listar Prefacturas</a></li>
                    <li><a href="<?php echo e(url('/invoice')); ?>">Listar Facturas</a></li>
                    <li><a href="<?php echo e(url('/taxdocument')); ?>">Listar Retenciones</a></li>
                    <li><a href="<?php echo e(url('/creditnote')); ?>">Listar Notas de Crédito</a></li>
                    <li><a href="<?php echo e(url('/remission')); ?>">Listar Guías de Remisión</a></li>
                </ul>
            </li>
            <?php endif; ?>

            <li>
                <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Configuración</span>  <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                 <?php if(env('ROLE_SUPERADMIN', NULL) == $_COOKIE['userRole']): ?>
                    <li><a href="<?php echo e(url('/entitymasterdata')); ?>">Datos Maestros</a></li>
                    <li><a href="<?php echo e(url('/mailconfiguration')); ?>">Servidor de Correo</a></li>
                    <li><a href="<?php echo e(url('/company')); ?>">Compañias</a></li>
                 <?php endif; ?>
                    <li><a href="<?php echo e(url('/branch')); ?>">Sucursales</a></li>
                 <?php if(env('ROLE_SUPERADMIN', NULL) <> $_COOKIE['userRole']): ?>
                    <li><a href="<?php echo e(url('/client')); ?>">Clientes</a></li>
                    <li><a href="<?php echo e(url('/supplier')); ?>">Proveedores</a></li>
                    <li><a href="<?php echo e(url('/dispatcher')); ?>">Transportistas</a></li>
                    <li><a href="<?php echo e(url('/families')); ?>">Familias</a></li>
                    <li><a href="<?php echo e(url('/product')); ?>">Productos</a></li>
                    <li><a href="<?php echo e(url('/countrytax')); ?>">Impuestos</a></li>
                 <?php endif; ?>
                </ul>
            </li>
         <?php if(env('ROLE_SUPERADMIN', NULL) == $_COOKIE['userRole']): ?>

            <li>
                <a href="#"><i class="fa fa-bank"></i> <span class="nav-label">Administración</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo e(url('/plan')); ?>">Planes</a></li>
                    <li><a href="<?php echo e(url('/companyplan')); ?>">Planes por Compañia</a></li>
                </ul>
            </li>

         <?php endif; ?>

            <li>
                <a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Inventario</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo e(url('/warehouse')); ?>">Almacenes</a></li>
                    <li><a href="<?php echo e(url('/warehouse/product_entry')); ?>">Entradas de Productos</a></li>
                    <li><a href="<?php echo e(url('/warehouse/createOutput')); ?>">Salidas de Productos</a></li>
                    <li><a href="<?php echo e(url('/warehouse/createTransfer')); ?>">Transferencias de Productos</a></li>
                    <li><a href="<?php echo e(url('/warehouse/searchTransfer')); ?>">Recepción de Transferencia</a></li>
                    <li><a href="<?php echo e(url('/warehouse/movements')); ?>">Movimientos</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-lock"></i> <span class="nav-label">Seguridad</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo e(url('/user')); ?>">Gestion de Usuarios</a></li>
                    <?php if(env('ROLE_SUPERADMIN', NULL) == $_COOKIE['userRole']): ?>
                    <li><a href="<?php echo e(url('/permission')); ?>">Permisología de Roles</a></li>
                    <?php endif; ?>
                    <?php if(env('ROLE_DEVADMIN', NULL) == $_COOKIE['userRole']): ?>
                        <li><a href="<?php echo e(url('/audit')); ?>">Información de Compañias</a></li>
                    <?php endif; ?>
                </ul>
            </li>

            
        </ul>

    </div>
</nav>

<script>
    $("#logOut").click(function(event){
        var href = this.href;
        event.preventDefault();
        sessionStorage.clear();
        window.location = href;
    });
</script>
