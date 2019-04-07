<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';
if ($_SESSION['asociados']==1)
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Listado de Afiliados <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button> <a href="../reportes/Gcontrato.php" target="_blank"><button class="btn btn-info">Reporte</button></a></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Numero de Contrato</th>
                            <th>Afiliado</th>
                            <th>Documento de Identidad</th>
                            <th>Fecha de Inscripción</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Numero de Contrato</th>
                            <th>Afiliado</th>
                            <th>Documento de Identidad</th>
                            <th>Fecha de Inscripción</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Numero de Contrato(*):</label>
                            <input type="hidden" name="idafiliado" id="idafiliado">
                            <select id="idcontrato" name="idcontrato" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo de Persona:</label>
                            <select class="form-control select-picker" name="tipo_persona" id="tipo_persona" required>
                              <option value="Persona Natural">Persona Natural</option>
                              <option value="Juridica">Juridica</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombres y Apellidos(*):</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombres y Apellidos" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo de Documento:</label>
                            <select class="form-control select-picker" name="tipo_documento" id="tipo_documento" required>
                              <option value="Cedula de Identidad">Cedula de Identidad</option>
                              <option value="Rif">Rif</option>
                              <option value="Pasaporte">Pasaporte</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Numero de Documento(*):</label>
                            <input type="text"  class="form-control" name="num_documento" id="num_documento" placeholder="Numero de Documento" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Condición:</label>
                            <select class="form-control select-picker" name="condicion" id="condicion" required>
                              <option value="Activo">Activo</option>
                              <option value="Renovacion">Renovación</option>
                              <option value="Eliminado">Eliminado</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="scripts/afiliado.js"></script>
<?php 
}
ob_end_flush();
?>