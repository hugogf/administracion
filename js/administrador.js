$(function(){
	$(".form-plan").css("display", "none");
	$(".div-new-usuario").css("display", "none");
	

	$(".btn-new").on('click', function(){
		$(".div-new-usuario").slideDown('slow');
	})
	$("#cerrar-new").on('click', function(){
		$(".div-new-usuario").slideUp('slow');
	})
	$(".editar").on('click', function(){
		var id = $(this).attr('data-valor');
		$("#"+id).dialog({modal: true});
	})
	$(".editar-usr").on('click', function(){
		var id = $(this).attr('data-valor');
		var select = $(this).attr('data-rol');
		$('option[value='+select+']').attr('selected','selected');
		console.log(select);
		$("#"+id).dialog({modal: true, width: '550'});
	})

	$(".editar-cursos").on('click', function(){
		var id = $(this).attr('data-valor');
		var plan = $(this).attr('data-plan');
		var profesor = $(this).attr('data-profesor');
		var categoria = $(this).attr('data-plan');

		$('select[name=categoria_editar] option[value='+categoria+']').attr('selected', 'selected');
		$('select[name=profesor_editar] option[value='+profesor+']').attr('selected', 'selected');
		$('select[name=plan_editar] option[value='+plan+']').attr('selected', 'selected');
		
		$("#"+id).dialog({modal: true});
	})

	$('.msg').css("display", "none");
	$('.msg').css("color", "red");

	$('input[name=clave2]').focusout(function(){
		console.log($('input[name=clave]').val());
		if ( $(this).val() == $('input[name=clave]').val()){
			console.log($(this).val());
			$('input[type=submit]').attr("disabled", false);
			$('.msg').slideUp('slow');}
		else{
			$('input[type=submit]').attr("disabled", "disabled");
			$('.msg').slideDown('slow');
		}

	})
})