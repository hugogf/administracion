$("#btn-pago").on("click", function(){
			$("#form-pago").slideDown('slow');
});

$("#cerrar-pago").on("click",
	function(){
		$("#form-pago").slideUp('slow', function(){
			$("#cuerpo").fadeIn('slow');
		});
	})
$('#btn-baja').on('click', function(){
	$('#form-anular').slideDown('slow');
})
$('#no-baja').on('click', function(){
	$('#form-anular').slideUp('slow');
})

$('#btn-anular-pago').on('click', function(){
	$('#form-anular-pago').slideDown('slow');
})

$('#cerrar-form-anular-pago').on('click', function(){
	$('#form-anular-pago').slideUp('slow');
})

$('#no-baja').on('click', function(){
	$('#form-anular').slideUp('slow');
})
$("select[name=tipo]").on("click", function(){

	var tipo = $(this).val();
	
	if(tipo == "cheque")
		$("div.cheque").slideDown('slow');
	else
		$("div.cheque").slideUp('slow');

})

$('#enviar_pago').on("click", function(e){
	e.preventDefault();
	$(this).attr('disabled', 'disabled');
	var monto = $('input[name=monto]').val();
	var glosa = $('input[name=glosa]').val();
	var monto_escrito = $('input[name=monto_escrito]').val();
	var tipo = $('select[name=tipo]').val()
	var boleta = $('input[name=boleta]').val()
	var fecha = $('input[name=fecha]').val()
	var cuota = $('select[name=cuota]').val()
	var rut = $('input[name=rut]').val()

	if(tipo == 'cheque'){
		
		var nombre_cheque = $('input[name=nombre_cheque]').val()
		var direccion_cheque = $('input[name=direccion_cheque]').val()
		var cobro_cheque = $('input[name=cobro_cheque]').val()
		var telefono_cheque = $('input[name=telefono_cheque]').val()
		
		$('#msg_boleta').load('../controller/pagos_controller.php',
		{
			tipo   		     : tipo             ,
			boleta 		     : boleta           ,
			fecha  		     : fecha            ,
			cuota  		     : cuota            ,
			monto  		     : monto            ,
			glosa  		     : glosa            ,
			rut    		     : rut              ,
			nombre_cheque    : nombre_cheque    ,
			direccion_cheque : direccion_cheque ,
			cobro_cheque     : cobro_cheque     ,
			telefono_cheque  : telefono_cheque  ,
			boton		     : 'Ingresar'
		},

		function(){
			$(this).html("Pago generado recarga <a id='recargar'>AQUÍ</a> para ver los cambios");
		})
	}else{
	
		$('#msg_boleta').load('../controller/pagos_controller.php',
			{
				tipo   : tipo       ,
				boleta : boleta     ,
				fecha  : fecha      ,
				cuota  : cuota      ,
				monto  : monto      ,
				glosa  : glosa      ,
				rut    : rut        ,
				boton  : 'Ingresar'
	
			},
	
		function(){
			$(this).html("Pago generado recarga <a href='#' onclick='location.reload();'>AQUÍ</a> para ver los cambios");
		})
	}
	$("#boleta").css('display', 'block');
	$("#cantidad").html(monto_escrito);
	$("#total").html("$"+monto);
	$("#glosa").html(glosa);
	$("#boleta").printArea()
	$("#boleta").css('display', 'none');
/*	$(this).delay(4000, function(){
		location.reload();

	})*/




})