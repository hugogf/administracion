$(function(){

	$(".btn-eliminar-examen").on("click", function(e){
			e.preventDefault();
			var examen = $(this).attr('data-value');
			console.log(examen);
			$(this).load("../controller/examenes_controller.php",
				{
					boton: "eliminar",
					examen: examen
				}, function(){
					$("#lista_examenes_"+examen).remove();
					console.log("eliminado");
				})

		})
	$(".ver").on("click", function(){
		var examen = $(this).attr('data-value');
		console.log(examen);
		$("#table").load("../controller/examenes_controller.php",
			{
				boton: "Alumnos",
				examen: examen
			}, function(){
				console.log("Listado de alumnos terminado");
			});

	})
	
})
