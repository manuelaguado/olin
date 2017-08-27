<?php if ( ! defined( 'URL_APP' ) ) { exit; } ?>
	<?php
	if(
		($this->tiene_permiso('Usuarios|index')) OR
		($this->tiene_permiso('Controllers|index')) OR
		($this->tiene_permiso('Usuarios|logueados')) OR
		($this->tiene_permiso('Catalogo|index'))
	)
	{
	?>
                            <li class="heading">
                                <h3 class="uppercase">Framedev</h3>
                            </li>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-cogs"></i>
                                    <span class="title">Configuración</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
								
									<?php
									if($this->tiene_permiso('Usuarios|index')){
									?>									
										<li class="nav-item  ">
											<a href="javascript:void(0)" onclick="carga_archivo('contenedor_principal','<?=URL_APP?>usuarios');" class="nav-link ">
												<i class="fa fa-users"></i>
												<span class="title">Control de usuarios</span>
											</a>
										</li>
									<?php
									}
									?>
									
									<?php
									if($this->tiene_permiso('Controllers|index')){
									?>									
										<li class="nav-item  ">
											<a href="javascript:void(0)" onclick="carga_archivo('contenedor_principal','<?=URL_APP?>controllers');" class="nav-link ">
												<i class="fa fa-gamepad"></i>
												<span class="title">Controladores</span>
											</a>
										</li>
									<?php
									}
									?>
									
									<?php
									if($this->tiene_permiso('Usuarios|logueados')){
									?>									
										<li class="nav-item  ">
											<a href="javascript:void(0)" onclick="carga_archivo('contenedor_principal','<?=URL_APP?>usuarios/logueados');" class="nav-link ">
												<i class="fa fa-sign-in"></i>
												<span class="title">Control de logins</span>
											</a>
										</li>
									<?php
									}
									?>
									
									<?php
									if($this->tiene_permiso('Catalogo|index')){
									?>									
										<li class="nav-item  ">
											<a href="javascript:void(0)" onclick="carga_archivo('contenedor_principal','<?=URL_APP?>catalogo');" class="nav-link ">
												<i class="fa fa-list"></i>
												<span class="title">Catálogo</span>
											</a>
										</li>
									<?php
									}
									?>
									
                                </ul>
                            </li>
	<?php
	}
	?>