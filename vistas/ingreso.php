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

if ($_SESSION['colecta']==1)
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
                         <h1 class="box-title">Colecta Diaria <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right"></div>
                    </div> <!-- /.box-header -->

                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Socio</th>
                            <th>Usuario</th>
                            <th>N° de Contrato</th>
                            <th>Total Ingreso</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Socio</th>
                            <th>Usuario</th>
                            <th>N° de Contrato</th>
                            <th>Total Ingreso</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                  </div> <!-- end Box -->

                  <div class="panel-body" id="formularioregistros">                      
                        <form name="formulario" id="formulario" method="POST">
                          <div class="col-md-8">
                            <div class="box">
                              <div class="box-header with-border">
                                <h1 class="box-title">Datos del movimiento</h1>
                                <div class="box-tools pull-right"></div>
                              </div>
                              <div class="panel-body">
                                <div class="row">
                                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>Número de Comprobante:</label>
                                    <input type="text" class="form-control" name="num_comprobante" id="num_comprobante" maxlength="10" placeholder="Número" required="">
                                  </div>

                                  <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Fecha(*):</label>
                                    <input type="date" class="form-control" name="fecha_hora" id="fecha_hora" required="">
                                  </div>

                                </div><!-- end Row -->
                                
                                <div class="row">
                                  <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Socio(*):</label>
                                    <input type="hidden" name="idingreso" id="idingreso">
                                    <select id="idsocio" name="idsocio" class="form-control selectpicker" data-live-search="true" required></select>
                                  </div>

                                  <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Contrato(*):</label>
                                    <select id="idcontrato" name="idcontrato" class="form-control selectpicker" data-live-search="true" required></select>
                                  </div>

                                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>Semanas canceladas:</label>
                                    <input type="text" class="form-control" readonly name="semanas" id="semanas">
                                  </div>

                                </div><!-- end Row -->
                              </div> <!-- end Panel Body -->
                            </div> <!-- end Box -->
                          </div> <!-- /.col -->
                          <div class="col-md-4">
                            <div class="box">
                              <div class="box-header with-border">
                                <h1 class="box-title">Datos del pago</h1>
                                <div class="box-tools pull-right"></div>
                              </div>
                              <div class="panel-body">
                                <div class="row">
                                  

                                </div><!-- end Row -->
                                
                                <div class="row">
                                  

                                </div><!-- end Row -->
                              </div> <!-- end Panel Body -->
                            </div> <!-- end Box -->
                          </div> <!-- /.col -->
                          <div class="col-md-12">
                            <div class="box">
                              <div class="box-header with-border">
                                <h1 class="box-title">Detalles del pago</h1>
                                <!-- BOTON PARA GREGAR MAS CUENTAS --
                                  <a data-toggle="modal" href="#myModal">           
                                    <button id="btnAgregarPlanc" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span> Agregar Cuenta</button>
                                  </a>  -->
                                <div class="box-tools pull-right"></div>
                              </div>
                              <div class="panel-body">
                                <div class="row">
                                  <div class="form-group checks col-lg-12 col-md-12 col-sm-12 col-xs-12">                            
                                    
                                    <div id="app" class="form-group checks col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                      <div class="row">
                                        <div class="box-header with-border">
                                          <h1 class="box-title">Selecciona los mes a cancelar</h1>
                                            
                                        </div>
                                      </div>
                                      <div class="row" style="margin-top: 15px;">
                                        <boton-vue :meses="mes"></boton-vue>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                      <thead style="background-color:#A9D0F5">
                                        <th>Opciones</th>
                                        <th>Cuenta</th>
                                        <th>Semana</th>
                                        <th>Cantidad Ingreso</th>
                                        <th>Subtotal</th>
                                      </thead>
                                        <tbody>
                                        </tbody>
                                      <tfoot>
                                        <th>TOTAL</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th><h4 id="total">S/. 0.00</h4><input type="hidden" name="total_ingreso" id="total_ingreso"></th> 
                                      </tfoot>
                                        <tbody>
                                        </tbody>
                                    </table>
                                  </div>

                                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                                    <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                                  </div>
                                </div><!-- end Row -->
                              </div> <!-- end Panel Body -->
                            </div> <!-- end Box -->
                          </div> <!-- /.col -->
                        </form> <!-- End Formulario -->
                  </div> <!-- Fin Formulario Registro -->

                  <div class="panel-body" id="formulariovista">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Socio(*):</label>
                            <input type="hidden" name="idingresoVista" id="idingresoVista">
                            <input type="text" class="form-control" readonly name="idsocioVista" id="idsocioVista" value="">                             
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Contrato(*):</label>
                            <input type="text" class="form-control" readonly name="idcontratoVista" id="idcontratoVista">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Fecha(*):</label>
                            <input type="text" class="form-control" readonly name="fecha_horaVista" id="fecha_horaVista" required="">
                          </div>                          
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Número:</label>
                            <input type="text" class="form-control" readonly name="num_comprobanteVista" id="num_comprobanteVista" maxlength="10" placeholder="Número" required="">
                          </div>

                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <table id="detallesVista" class="table table-striped table-bordered table-condensed table-hover">
                              <thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Cuenta</th>
                                    <th>Semana</th>
                                    <th>Cantidad Ingreso</th>
                                    <th>Subtotal</th>
                                </thead>
                                <tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total">S/. 0.00</h4><input type="hidden" name="total_ingreso" id="total_ingreso"></th> 
                                </tfoot>
                                <tbody>
                                  
                                </tbody>
                            </table>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            
                            <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Salir</button>
                          </div>
                        </form>
                  </div> <!-- Fin Formulario Mostrar -->
                  <!--Fin centro -->

        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
<!--Fin-Contenido-->

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccione una Cuenta</h4>
        </div>
        <div class="modal-body">
          <table id="tblplanc" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Opciones</th>
                <th>Nombre</th>
                <th>Código</th>
            </thead>
            <tbody>           
              
            </tbody>
            <tfoot>
              <th>Opciones</th>
                <th>Nombre</th>
                <th>Código</th>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->

 

<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="./scripts/vue.js"></script>
<script type="text/javascript" src="./scripts/axios.min.js"></script>
<script type="text/javascript" src="scripts/ingreso.js"></script>
<?php 
}
ob_end_flush();
?>


