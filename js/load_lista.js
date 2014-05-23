$(function(){
	
	$(".puntaje").focus( function(){
		var alumno = $(this).attr('id');
		$("#td_"+alumno).empty();
		$("#td_"+alumno).html("Editando");
	})

	$(".puntaje").focusout(function(){
		
		var alumno = $(this).attr('id');
		var examen = $(this).attr('data-examen');
		var resultado = $(this).val();

		$("#td_"+alumno).load("../controller/examenes_controller.php", 
		{
			boton: 'resultado',
			alumno: alumno,
			examen: examen,
			resultado: resultado
		},
		function()
		{
			$("#td_"+alumno).empty();
			$("#td_"+alumno).html("Actualizado");
		})

		console.log(alumno);
		console.log(examen);
		console.log("#td_"+alumno);


	})
})