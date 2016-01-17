<? if ($_SESSION["id_grupos"]<=2){?>
<ul class="nav nav-second-level">


<li><a  href="../sis_grupos/sis_grupos.php" >Grupos</a></li>	
<li><a  href="../sis_usuarios/usuarios.php" ><i class="fa fa-user fa-fw"></i> Usuarios</a></li>
<li><a  href="../sis_permisos/permisos.php" >Permisos</a></li>

<? } ?>

<? if ($_SESSION["id_grupos"]==1){?>

<li><a  href="../sis_main/sis_main.php" >1.-Crear Menu</a></li>
<li><a  href="../sis_tablas/sis_tablas.php" >2.-Crear Formularios</a></li>
<li><a  href="../sis_create_views/sis_create_relaciones.php" target="_blank" ><span class="menu-text">3.-Buscar Relaciones entre Tablas(OPCIONAL)</span></a></li>
<li><a  href="../sis_relaciones/sis_relaciones.php" >4.Crear Relaciones entre Tablas</a></li>
<li><a  href="../sis_create_views/sis_create_views.php" target="_blank"  ><span class="menu-text">5.-Ver Views Automaticas(OPCIONAL)</span></a></li>
<li><a  href="../sis_create_views/sis_create_views_auto.php" ><span class="menu-text">6.-Crear Views Automaticas SIS_VIEWS</span></a></li>
<li><a  href="../sis_orden/sis_orden.php" ><span class="menu-text">7.-Ordenar SIS_VIEWS</span></a></li>
<li><a  href="../sis_create_views/sis_create_views_auto_ejecutar.php" ><span class="menu-text">8.-Generar Vistas de SIS_VIEWS en BD</span></a></li>
<li><a  href="../_gen_formulario/vst.php" >9.-Generar Formularios</a></li>
<li><a  href="../sis_modulos/sis_modulos.php" >M&oacute;dulos</a></li>
<li><a  href="../_gen_menu/vst.php" >Generar Menu</a></li>
<li><a  href="../sis_cargar_sql/sis_cargar_sql.php" >Importar Sql</a></li>
<? } ?>

</ul>
