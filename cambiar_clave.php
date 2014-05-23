<?php	require_once($_SERVER['DOCUMENT_ROOT']."/administracion/models/login_model.php"); ?>

<div class="mensaje">
<?php if(isset($_POST["password"]))
	{
		if($_POST['pass']==md5($_POST['password']) && $_POST['password2']==$_POST['password3'])
		{
			$new = new login();
			$new->cambio_clave($_SESSION['id'], $_POST['password2']);
			$_SESSIOM['PASSWORD']=md5($_POST['password']);
			echo "Cambio realizado con exito";
		}else{
			echo "Error, clave incorrecta";
		}
	}
?>
</div>

<form action="configuracion.php" class="form" method="POST">
	<h3>Formulario para cambio de clave</h3>
	<div class="campo-formulario">
		<label>Ingrese su clave</label>
		<input type="password" name="password">
		<input type="hidden" name="pass" value="<?php echo $_SESSION['PASSWORD']; ?>">
	</div>
	<div class="campo-formulario">
		<label>Nueva clave</label>
		<input type="password" name="password2">
	</div>
	<div class="campo-formulario">
		<label>repita clave</label>
		<input type="password" name="password3">
		<input type="submit" name="boton" value="Cambiar" disabled>
	</div>
</form>
<script>
	$(function(){
		$('input[name=password2]').change(function(){

			var clave1 = $('input[name=password]').val();
			var clave3 = $('input[name=password3]').val();
			var clave2 = $(this).val();

			if(clave2 == clave3){
				$('input[value=Cambiar]').attr('disabled', false)
				console.log("vamos bien");
			}else{
				$('input[value=Cambiar]').attr('disabled', true)
				console.log("vamos mal");
			}

		})

		$('input[name=password3]').change(function(){
			
			var clave1 = $('input[name=password]').val();
			var clave2 = $('input[name=password2]').val();
			var clave3 = $(this).val();

			if(clave2 == clave3){
				$('input[value=Cambiar]').attr('disabled', false)
				console.log("vamos bien");
			}else{
				$('input[value=Cambiar]').attr('disabled', true)
				console.log("vamos mal");
			}

		})
	})
</script>