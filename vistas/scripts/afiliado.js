var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	//Cargamos los items al select contrato
	$.post("../ajax/afiliado.php?op=selectContrato", function(r){
        $("#idcontrato").html(r);
        $('#idcontrato').selectpicker('refresh');

});
}

//Función limpiar
function limpiar()
{
	$("#nombre").val("");
	$("#num_documento").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
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
					url: '../ajax/afiliado.php?op=listar',
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
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/afiliado.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idafiliado)
{
	$.post("../ajax/afiliado.php?op=mostrar",{idafiliado : idafiliado}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idcontrato").val(data.idcontrato);
        $('#idcontrato').selectpicker('refresh');
        $("#tipo_persona").val(data.tipo_persona);
        $('#tipo_persona').selectpicker('refresh');
        $("#tipo_documento").val(data.tipo_documento);
        $('#tipo_documento').selectpicker('refresh');
        $("#condicion").val(data.condicion);
		$('#condicion').selectpicker('refresh');
        $("#nombre").val(data.nombre);
        $("#num_documento").val(data.num_documento);
 		$("#idafiliado").val(data.idafiliado);

 	})
}


init();