$(function(){

	$('.rut').focusout(function(){
		var rut = $(this).val();
		var largo = rut.length;
		var digito;
		var contador = largo -7;
		var resultado = 0;
		var resto;

		for (var i = 0; i < rut.length ; i++) {
				
				if(rut[i] != "-"){
					digito = rut[i];
				}
				else if(digito == "."){
					alert("No se pueden utilizar puntos en el rut, ej: 17115248-8");
					$(".rut").val('');
					break;
				}else{
					digito = rut[i+1];
					break;
				}

				if(digito >= 0 && digito <= 9)
				{
					if(contador < 2)
						contador = 7;

					resultado = (digito * contador) + resultado;
					contador = contador - 1;
				}
			}
		
		resto = resultado % 11;
		resto = 11-resto;

		if(resto == 10)
		{
			resto = 'k';
		}else if(resto == 11){
			resto = 0;
		}


		if(digito != resto){
			alert("Rut incorrecto, ej: 17115248-8, recuerde que k es minúscula");
			$(".rut").val('');
		}

	})
})