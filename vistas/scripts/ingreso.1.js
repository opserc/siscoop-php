
let botonesVue = Vue.extend({
    props: ['meses'],
    methods: {
        payment(mes,semanas){
            semanaActual = document.getElementsByName("semana[]");
            //semanaActual[1].value = 15;
            alert('El mes de '+mes+' tiene '+semanas+' semanas ' )
        }
    },
    template: `<div>
                <slot name="mes" v-for="mes in meses">
                   <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                       <input type="checkbox" v-model="check" v-bind:true-value="a" v-bind:false-value="b" v-on:click="payment(mes.id,mes.value)" :name="mes.id" :id="mes.id" :value="mes.value">
                        <label :for="mes.id">{{ mes.nombre }}</label>
                   </div>
                </slot>
              </div>`
})

Vue.component('boton-vue', botonesVue);

new Vue({
    
    el: '#app',
    data: {
        checked:'',
        mes: [
            { id: 'enero', value:'4', nombre: 'Enero'},
            { id: 'febrero', value:'4', nombre: 'Febrero'},
            { id: 'marzo', value:'5', nombre: 'Marzo'},
            { id: 'abril', value:'4', nombre: 'Abril'},
            { id: 'mayo', value:'4', nombre: 'Mayo'},
            { id: 'junio', value:'5', nombre: 'Junio'},
            { id: 'julio', value:'4', nombre: 'Julio'},
            { id: 'agosto', value:'4', nombre: 'Agosto'},
            { id: 'septiembre', value:'5', nombre: 'Septiembre'},
            { id: 'octubre', value:'4', nombre: 'Octubre'},
            { id: 'noviembre', value:'4', nombre: 'Noviembre'},
            { id: 'diciembre', value:'5', nombre: 'Diciembre'},
        ]
    },
    methods: {
        month: function(semanas) {
            alert('Tiene' + semanas)
        }
    }
});
var tabla;
var socioID;
var contratoId;

 
//Función que se ejecuta al inicio
function init(){
    mostrarform(false);
    mostrarformVista(false);
    mostrarmeses(false);
    listar();
 
    $("#formulario").on("submit",function(e)
    {
        guardaryeditar(e);  
    });
    //Cargamos los items al select socio
    $.post("../ajax/ingreso.php?op=selectSocio", function(r){
                $("#idsocio").html(r);
                $('#idsocio').selectpicker('refresh');
    });
    
    
}

/*
**************************************************************************
******** SELECCIONAR EL MES A CANCELAR ***********************************
**************************************************************************
*/

$("#enero").change(function(){
    if ($("#enero").is(":checked")) {  
        // checkbox is checked 
        $sem=$("#enero").val();
        var sem = parseInt($sem)
        modificarSubototales(sem)
    } else {
        // checkbox is not checked 
        $sem=$("#enero").val();
        modificarSubototales($sem*(-1))
    }
    
})

$("#febrero").change(function(){
    if ($("#febrero").is(":checked")) {  
        // checkbox is checked 
        $sem=$("#febrero").val();
        var sem = parseInt($sem)
        modificarSubototales(sem)
    } else {
        // checkbox is not checked 
        $sem=$("#febrero").val();
        modificarSubototales($sem*(-1))
    }
    
})
$("#marzo").change(function(){
    if ($("#marzo").is(":checked")) {  
        // checkbox is checked 
        $sem=$("#marzo").val();
        var sem = parseInt($sem)
        modificarSubototales(sem)
    } else {
        // checkbox is not checked 
        $sem=$("#marzo").val();
        modificarSubototales($sem*(-1))
    }
    
})
$("#abril").change(function(){
    if ($("#abril").is(":checked")) {  
        // checkbox is checked 
        $sem=$("#abril").val();
        var sem = parseInt($sem)
        modificarSubototales(sem)
    } else {
        // checkbox is not checked 
        $sem=$("#abril").val();
        modificarSubototales($sem*(-1))
    }
    
})
$("#mayo").change(function(){
    if ($("#mayo").is(":checked")) {  
        // checkbox is checked 
        $sem=$("#mayo").val();
        var sem = parseInt($sem)
        modificarSubototales(sem)
    } else {
        // checkbox is not checked 
        $sem=$("#mayo").val();
        modificarSubototales($sem*(-1))
    }
    
})
$("#junio").change(function(){
    if ($("#junio").is(":checked")) {  
        // checkbox is checked 
        $sem=$("#junio").val();
        var sem = parseInt($sem)
        modificarSubototales(sem)
    } else {
        // checkbox is not checked 
        $sem=$("#junio").val();
        modificarSubototales($sem*(-1))
    }
    
})
$("#julio").change(function(){
    if ($("#julio").is(":checked")) {  
        // checkbox is checked 
        $sem=$("#julio").val();
        var sem = parseInt($sem)
        modificarSubototales(sem)
    } else {
        // checkbox is not checked 
        $sem=$("#julio").val();
        modificarSubototales($sem*(-1))
    }
    
})
$("#agosto").change(function(){
    if ($("#agosto").is(":checked")) {  
        // checkbox is checked 
        $sem=$("#agosto").val();
        var sem = parseInt($sem)
        modificarSubototales(sem)
    } else {
        // checkbox is not checked 
        $sem=$("#agosto").val();
        modificarSubototales($sem*(-1))
    }
    
})
$("#septiembre").change(function(){
    if ($("#septiembre").is(":checked")) {  
        // checkbox is checked 
        $sem=$("#septiembre").val();
        var sem = parseInt($sem)
        modificarSubototales(sem)
    } else {
        // checkbox is not checked 
        $sem=$("#septiembre").val();
        modificarSubototales($sem*(-1))
    }
    
})
$("#octubre").change(function(){
    if ($("#octubre").is(":checked")) {  
        // checkbox is checked 
        $sem=$("#octubre").val();
        var sem = parseInt($sem)
        modificarSubototales(sem)
    } else {
        // checkbox is not checked 
        $sem=$("#octubre").val();
        modificarSubototales($sem*(-1))
    }
    
})
$("#noviembre").change(function(){
    if ($("#noviembre").is(":checked")) {  
        // checkbox is checked 
        $sem=$("#noviembre").val();
        var sem = parseInt($sem)
        modificarSubototales(sem)
    } else {
        // checkbox is not checked 
        $sem=$("#noviembre").val();
        modificarSubototales($sem*(-1))
    }
    
})
$("#diciembre").change(function(){
    if ($("#diciembre").is(":checked")) {  
        // checkbox is checked 
        $sem=$("#diciembre").val();
        var sem = parseInt($sem)
        modificarSubototales(sem)
    } else {
        // checkbox is not checked 
        $sem=$("#diciembre").val();
        modificarSubototales($sem*(-1))
    }
    
})

/*
**************************************************************************
******** FIN PARA SELECCIONAR EL MES A CANCELAR **************************
**************************************************************************
*/


$("#idsocio").change(function(){
    $socioId=$("#idsocio").val();
    mostrarContratos($socioId);
})

$("#idcontrato").change(function(){
    $resp = $('select[name="idcontrato"] option:selected').text();
    $ncontrato = parseInt($resp)
    mostrarSemanas($ncontrato);
    mostrarmeses(true);
})

//Funcion mostrarContratos
function mostrarContratos(idsocio)
{
    $.post("../ajax/ingreso.php?op=selectContratos&idsocio="+idsocio, function(r){
			$("#idcontrato").html(r);
            $('#idcontrato').selectpicker('refresh');
    });
}

//Funcion mostrarSemanas
function mostrarSemanas(ncontrato)
{
    $.post("../ajax/ingreso.php?op=selectSemanas&ncontrato="+ncontrato, function(r){
        console.log(r)
        if (r == '') {
            $("#semanas").val(0);
        }else{
            $("#semanas").val(r);
        }   
        
    });

}
 
//Función limpiar
function limpiar()
{
    $("#idsocio").val("");
    $("#socio").val("");
    $("#num_comprobante").val("");
 
    $("#total_ingreso").val("");
    $(".filas").remove();
    $("#total").html("0");
     
    //Obtenemos la fecha actual
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#fecha_hora').val(today);
}

//Función mostrar los meses
function mostrarmeses(flag)
{
    
    if (flag)
    {
        $("#app").show();
    }
    else
    {
        $("#app").hide();
    }
 
}

//Función mostrar formulario
function mostrarform(flag)
{
    limpiar();
    if (flag)
    {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        
        //$("#btnGuardar").prop("disabled",false);
        $("#btnagregar").hide();
        listarPlanc();
 
        $("#btnGuardar").hide();
        $("#btnCancelar").show();
        detalles=0;
        $("#btnAgregarPlanc").show();
        agregarDetalle(3,'AHORRO');
        agregarDetalle(4,'FDO. APOYO ADMINISTRATIVO');
        agregarDetalle(5,'SALUD');
    }
    else
    {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
 
}
function mostrarformVista(flag)
{
    limpiar();
    if (flag)
    {
        $("#listadoregistros").hide();
        $("#formulariovista").show();

        $("#btnGuardar").hide(); 
        $("#btnCancelar").show();
        $("#btnagregar").hide();
        detalles=0;
    }
    else
    {
        $("#listadoregistros").show();
        $("#formulariovista").hide();
        $("#btnagregar").show();
    }
 
}
 
//Función cancelarform
function cancelarform()
{
    limpiar();
    mostrarform(false);
    mostrarformVista(false);
}
 
//Función Listar
function listar()
{
    tabla=$('#tbllistado').dataTable(
    {
        "aProcessing": true,//Activamos el procesamiento del datatables
        "aServerSide": true,//Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip',//Definimos los elementos del control de tabla
        buttons: [                
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdf'
                ],
        "ajax":
                {
                    url: '../ajax/ingreso.php?op=listar',
                    type : "get",
                    dataType : "json",                      
                    error: function(e){
                        console.log(e.responseText);    
                    }
                },
        "bDestroy": true,
        "iDisplayLength": 5,//Paginación
        "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
    }).DataTable();
}
 
 
//Función ListarPlanc
function listarPlanc()
{
    tabla=$('#tblplanc').dataTable(
    {
        "aProcessing": true,//Activamos el procesamiento del datatables
        "aServerSide": true,//Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip',//Definimos los elementos del control de tabla
        buttons: [                
                     
                ],
        "ajax":
                {
                    url: '../ajax/ingreso.php?op=listarPlanc',
                    type : "get",
                    dataType : "json",                      
                    error: function(e){
                        console.log(e.responseText);    
                    }
                },
        "bDestroy": true,
        "iDisplayLength": 5,//Paginación
        "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
    }).DataTable();
}
//Función para guardar o editar
 
function guardaryeditar(e)
{
    e.preventDefault(); //No se activará la acción predeterminada del evento
    //$("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);
 
    $.ajax({
        url: "../ajax/ingreso.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
 
        success: function(datos)
        {                    
              bootbox.alert(datos);           
              mostrarform(false);
              listar();
        }
 
    });
    limpiar();
}
 
function mostrar(idingreso)
{
    $.post("../ajax/ingreso.php?op=mostrar",{idingreso : idingreso}, function(data, status)
    {
        data = JSON.parse(data); 
        //mostrarform(true);
        mostrarformVista(true);
        
 
        $("#idsocioVista").val(data.socio);
        $("#idcontratoVista").val(data.ncontrato);
        $("#num_comprobanteVista").val(data.num_comprobante);
        $("#fecha_horaVista").val(data.fecha);
        $("#idingresoVista").val(data.idingreso);
 
        //Ocultar y mostrar los botones
        $("#btnGuardar").hide();
        $("#btnCancelar").show();
        $("#btnAgregarPlanc").hide();
    });
 
    $.post("../ajax/ingreso.php?op=listarDetalle&id="+idingreso,function(r){
            $("#detallesVista").html(r);
    });
}
 
//Función para anular registros
function anular(idingreso)
{
    bootbox.confirm("¿Está Seguro de anular el ingreso?", function(result){
        if(result)
        {
            $.post("../ajax/ingreso.php?op=anular", {idingreso : idingreso}, function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            }); 
        }
    })
}
 
//Declaración de variables necesarias para trabajar con las compras y
//sus detalles
var cont=0;
var detalles=0;
//$("#guardar").hide();
$("#btnGuardar").hide();
 
function agregarDetalle(idplanc,planc)
  {
    var semana=0;
    var cantidad_ingreso=1000;
 
    if (idplanc!="")
    {
        var subtotal=semana*cantidad_ingreso;
        var fila='<tr class="filas" id="fila'+cont+'">'+
        '<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
        '<td><input type="hidden" name="idplanc[]" value="'+idplanc+'">'+planc+'</td>'+
        '<td><input type="number" readonly name="semana[]" id="semana[]" value="'+semana+'"></td>'+
        '<td><input type="number" readonly name="cantidad_ingreso[]" value="'+cantidad_ingreso+'"></td>'+
        '<td><span name="subtotal" id="subtotal'+cont+'">'+subtotal+'</span></td>'+
        '</tr>';
        
        cont++;
        detalles=detalles+1;
        $('#detalles').append(fila);
        modificarSubototales(0);
    }
    else
    {
        alert("Error al ingresar el detalle, revisar los datos del plan de cuentas");
    }
  }
 
  function modificarSubototales($sem)
  {
    var semana = document.getElementsByName("semana[]");
    var cantidad_ingreso = document.getElementsByName("cantidad_ingreso[]");
    var sub = document.getElementsByName("subtotal");
    
 
    for (var i = 0; i <semana.length; i++) {
        var valor = semana[i].value
        var valorNum = parseInt(valor)
        var suma = valorNum + $sem;
        semana[i].value = suma;
        var inpC=semana[i];
        var inpP=cantidad_ingreso[i];
        var inpS=sub[i];
 
        inpS.value=inpC.value * inpP.value;
        document.getElementsByName("subtotal")[i].innerHTML = inpS.value;
    }
    calcularTotales();
 
  }
  function calcularTotales(){
    var sub = document.getElementsByName("subtotal");
    var total = 0.0;
 
    for (var i = 0; i <sub.length; i++) {
        total += document.getElementsByName("subtotal")[i].value;
    }
    $("#total").html("S/. " + total);
    $("#total_ingreso").val(total);
    evaluar();
  }
 
  function evaluar(){
    if (detalles>0)
    {
      $("#btnGuardar").show();
    }
    else
    {
      $("#btnGuardar").hide(); 
      cont=0;
    }
  }
 
  function eliminarDetalle(indice){
    $("#fila" + indice).remove();
    calcularTotales();
    detalles=detalles-1;
    evaluar();
  }
 
init();