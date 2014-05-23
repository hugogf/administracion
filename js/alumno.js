$(function(){

	$(".row").fadeIn("slow");

	$(".mostrar-noticia").on("click",function(){
		var id = $(this).attr('data-value');
		console.log(id);
		$("#"+id).dialog({modal: true});
	})
})