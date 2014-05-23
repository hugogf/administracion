$(function(){
	
	$(".dialog-noticia").css("display", "none");
	
	$("#crear-noticia").on("click",function(e){
		e.preventDefault();
		$("input[name=titulo]").attr('value', '');
		$("input[name=id_noticia]").attr('value', '');
		$("textarea").empty();
		$("input[name=boton]").attr('value', "Crear noticia");
		$(".dialog-noticia").slideToggle();
		tinymce.init({selector:'textarea'});
	})
	$(".btn-editar-noticia").on("click",function(){
		var contenido = $(this).attr('data-contenido');
		var id = $(this).attr('data-value');
		var titulo = $(this).attr('data-titulo');

		$("input[name=titulo]").attr('value', titulo);
		$("input[name=id_noticia]").attr('value', id);
		$("textarea").text(contenido);
		$("input[name=boton]").attr('value', "Editar noticia");
		tinymce.init({selector:'textarea'});
		$(".dialog-noticia").slideDown();


	})

	$("#cerrar-crear").on("click",function(){
		$(".dialog-noticia").slideToggle();
	})

})