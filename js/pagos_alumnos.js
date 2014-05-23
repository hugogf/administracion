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