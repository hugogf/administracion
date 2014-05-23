<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/planes_model.php");

function buscar_plan($id){
	$plan = new plan();
	$planes = $plan->buscar($id); 
	return $planes->fetch_assoc();	
}
function listar_planes (){
	$plan = new plan();
	$planes = $plan->listar(); 
	return $planes;
}

if(isset($_POST['boton'])){

	if($_POST['boton'] == 'Crear'){

		$plan = new plan();
		$plan->save($_POST);

	}
	if($_POST['boton'] == 'Editar')
	{
		$plan = new plan();
		$plan->editar($_POST);
	}

}

if(isset($_GET['delete'])){
	$plan = new plan();
	$plan->delete($_GET);	
} 


 ?>