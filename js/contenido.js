$(function(){
	$(".edit-contenido").css("display","none");
	$(".btn-edit-contenido").on("click", function(e){
	e.preventDefault();
		var contenido = $(this).attr('data-value');
		$("#"+contenido).dialog({modal: true});
		console.log
	})

	$("#btn-add-contenido").on("click", function(e){
		e.preventDefault();
		var curso = $("input[name=curso-contenido]").val();
		var titulo = $("input[name=titulo-contenido]").val();
		var descripcion = $("textarea[name=descripcion-contenido]").val();
		var fecha = $("input[name=fecha-contenido]").val();
		
		if(titulo == "" || fecha == "" || descripcion == "")
		{
			$(".msg-contenido").empty();
			$(".msg-contenido").html("Error, rellene todos los campos");
			$(".msg-contenido").fadeIn();

		}
		else			
			{

			$(".msg-contenido").empty();
			$(".msg-contenido").html("Item agregado con exito");


			$(".table-contenido").load('../controller/contenidos_controller.php',
							{
								boton: "Agregar Contenido",
								curso: curso,
								descripcion: descripcion,
								titulo: titulo,
								fecha: fecha
			}, function(){ console.log("correcto");})}
	})

	$(".eliminar-contenido").on("click", function(e){
		e.preventDefault();
		var fila = $(this).attr('data-value');
		console.log(fila);

		$("#"+fila+"_tr").load("../controller/contenidos_controller.php",
			{
				boton: "Remover",
				contenido: fila
			},

			function(){
				$(this).remove();
			})

	})

	$(".btn-eliminar-material").on("click", function(e){
		
		e.preventDefault();

		var material = $(this).attr('data-value');

		console.log(material);

		$(this).load("../controller/materiales_controller.php",
			{
				boton: "Eliminar",
				material: material
			},

			function(){
				$("#"+material+"_contenido_fila").remove();			
			})

	})

	$(function() {
	$(".fecha").datepicker();
	});

	$(function($){
	$.datepicker.regional['es'] = {
	    closeText: 'Cerrar',
	    prevText: '<Ant',
	    nextText: 'Sig>',
	    currentText: 'Hoy',
	    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	    monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	    dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
	    weekHeader: 'Sm',
	    dateFormat: 'yy-mm-dd',
	    firstDay: 1,
	    isRTL: false,
	    showMonthAfterYear: false,
	    yearSuffix: ''
	};
	$.datepicker.setDefaults($.datepicker.regional['es']);
	});
})
