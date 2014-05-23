$(function(){
	$('input[type=radio]').attr("disabled", true)
	$('input[name=grupo_cs]').attr("disabled", true)
	$('input[name=grupo_elect_cs]').attr("disabled", true)
	$('input[name=grupo_hist]').attr("disabled", true)
	var costo;
	
	$('select[name=programa]').change(function(){
		$('.valor-plan').empty();
		var id = $(this).val();
		costo = $("#plan_"+id).attr('data-valor');
		console.log($("#plan_"+id).attr('data-valor'));
		// $('.valor-plan').html(costo);
		$('.valor-plan').append(costo);
		$('input[name=valor_plan]').attr('value',costo);
	});

	$("input[name=ciencias]").on("click", function(){

		if($('input[name=ciencias]').is(":checked"))
			$('input[type=radio]').attr("disabled", false)
		else
			$('input[type=radio]').attr("disabled", true)	
		
	});



	$("input[name=valor_matricula]").attr("disabled", false)


	$("input[name=matricula]").on("click", function(){

		if($("input[name=matricula]").is(":checked"))
			$("input[name=valor_matricula]").attr("disabled", true)
		else
			$("input[name=valor_matricula]").attr("disabled", false)

	});
	
	var ver_cuotas = function(){
			
			var cuotas = $("input[name=cuotas]").val();
			var costo = parseInt($(".valor-plan").html());
			var matricula = $("input[name=valor_matricula]").val();
			var descuento = $("input[name=descuento]").val();
			var dia = $("input[name=dia_pago]").val().substr(8,2);
			var mes = $("input[name=dia_pago]").val().substr(5,2);
			var anio = $("input[name=dia_pago]").val().substr(0,4);
			var fecha_matricula = $("input[name=fecha]").val();
			console.log(dia);
			var resto = costo%cuotas;
			var valor = (costo - resto)/cuotas;
			resto = (valor%10)*cuotas + resto;
			valor = (costo - resto)/cuotas;
			var num = 0;
			var valor_dscto = valor - descuento;

			
			$("#cuotas_total").remove();
			$("div.table").append("<h3>Detalle de cuotas</h3><table class='table table-hover' id='cuotas_total'><tr class='warning'><th>N° Cuota</th><th>Valor Neto</th><th>Descuento</th><th>Valor Con Descuento</th><th>Fecha de Pago</th></tr></table>");
			if(!$("input[name=matricula]").is(":checked"))
				$("#cuotas_total").append("<tr id='cuota' class='danger'><th>Matricula</th><td>"+ matricula +"</td><td></td><td></td><td>"+ fecha_matricula +"</td></tr>");
			for(num ; num<=cuotas - 1 ; num++){
				if(num==cuotas)
				$("#cuotas_total").append("<tr id='cuota' class='success'><th>Cuota"+ num + "</th><td>"+(valor+resto)+"</td><td>"+descuento+"</td><td>"+(valor-descuento)+"</td><td>"+dia+"-"+(parseInt(mes)+parseInt(num))+"-"+anio+"</td></tr>");
				else
				$("#cuotas_total").append("<tr id='cuota' class='success'><th>Cuota"+ num + "</th><td>"+valor+"</td><td>"+descuento+"</td><td>"+(valor-descuento)+"</td><td>"+dia+"-"+(parseInt(mes)+parseInt(num))+"-"+anio+"</td></tr>");
			}

		}

	$("#generar").on("click", function(e){
		e.preventDefault();
		ver_cuotas();
	})
	
	$("input[name=direccion]").keyup(function(){
		$("input[name=direccion_ap]").attr("value", $("input[name=direccion]").val());
	})

	$("input[name=telefono]").keyup(function(){
		$("input[name=telefono_ap]").attr("value", $("input[name=telefono]").val());
	})

	$("#desabilitar").change(function(){
		console.log("lo chequeo");
		if($("#desabilitar").is(":checked")){
					$(".ap_apoderado").attr("disabled", true);
					$(".ap_apoderado").fadeOut();}
		else
		{	$(".ap_apoderado").attr("disabled", false);
					$(".ap_apoderado").fadeIn();}
	})

})
