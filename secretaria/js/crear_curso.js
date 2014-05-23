$(function(){
	
	$(".agregar").css("display", "none");

	$("select[name=plan]").change(function(){
		var plan = $('select[name=plan]').val();
		$("select[name=curso]").load('cursos_plan.php',{plan: plan, boton: "Cursos"} , function(){
			console.log("datos cargados con exito");
		});
	})

	$("select[name=curso]").change(function(){
		var curso = $('select[name=curso]').val();
		console.log(curso);
		$(".contenido").load('cursos_plan.php',{curso: curso, boton: "Alumnos"} , function(){
			var contenido = $(".contenido").html();
			$("#table").append(contenido);
		})
	})

	
	$('#agregar_alumno').on('click', function(e){
		
		e.preventDefault();

		var curso = $('select[name=curso]').val();
		var rut = $('input[name=alumno_agregar]').val();
		var plan = $('select[name=plan]').val();

		if(plan.length == 0 || curso.length == 0 || rut.length == 0)
		{
			$("#msg").empty();
			$(".contenido").prepend("<div id='msg'> Rellene todos los campos</div> ");

		} else {
			
			$("#msg").empty();
			$("#alert").remove();
			$(".agregar").load('../controller/alumnos_controller.php', {rut: rut, boton:'Agregar', plan: plan, curso: curso}, function(){

				var contenido = $(".agregar").html();
				$(".table").append(contenido);
				$("#alert").dialog({modal: true});
				$("#alert").remove();

						
				})
			}

			})		
})	