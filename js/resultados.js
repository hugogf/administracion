$(function(){
	$(".agregar").css("display", "none");
	$(".contenido").css("display", "none");

	$("select[name=plan]").change(function(){
		$("#table").empty();
		$(".lista-examenes").empty();
		var plan = $(this).val();
		$("select[name=curso]").load('cursos_plan.php',{plan: plan, boton: "Cursos"} , function(){
			console.log("datos cargados con exito");
		});
	})

	$("select[name=curso]").change(function(){

		$("#table").empty();
		var curso = $(this).val();
		console.log('si aca si entre');
		$('.lista-examenes').load('../controller/examenes_controller.php',
			{
				boton: 'listar',
				curso: curso
			}, 
			function(){
				console.log("listo");
			})				
		})
	
	$("select[name=nuevo_plan_examen]").change(function(){
		var plan = $(this).val();

		$("select[name=nuevo_curso_examen]").load('cursos_plan.php',{plan: plan, boton: "Cursos"} , function(){
			console.log("datos cargados con exito");
		});
	})
	
	$('input[name=btn-examen]').on("click", function(e){
		e.preventDefault();
		var nombre = $("input[name=nuevo_nombre_examen]").val();
		var fecha = $("input[name=nuevo_fecha_examen]").val();
		var curso = $("select[name=nuevo_curso_examen]").val();

		if(nombre=="" || fecha=="" || curso =="")
			{$(".contenido").html("Rellene todos los campos");
			 $(".contenido").fadeIn();
			}else{
		
				$(".contenido").fadeOut();

				$(".lista-examenes").load('../controller/examenes_controller.php',
				{
					boton: "crear",
					fecha: fecha,
					nombre: nombre,
					curso: curso
				}, function(){
					$(this).fadeIn('slow');
					$(".contenido").html("Examen creado");
					$(".contenido").dialog({modal: true});
				})
		}
	})
})