<script src="js/ajax.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/Combobox.css">
<link href="css/Estilo.css" rel="stylesheet" type="text/css"/>

<script LANGUAGE="JavaScript">
function ValidarRequeridos(){
	
	divResultado 		= document.getElementById('resultado');
	var txtNombre 		= document.clientes.txtNombre.value;
	var txtApellidos	= document.clientes.txtApellidos.value;
	var txtRut 			= document.clientes.txtRut.value;
	var txtDireccion 	= document.clientes.txtDireccion.value;
	var plan		    = document.clientes.plan.value;
	var txtTelefono		= document.clientes.txtTelefono.value;
	ajax = newAjax();	
	
	ajax.open("POST", "Configuracion/GuardaClientes.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("txtNombre="+txtNombre+"&txtApellidos="+txtApellidos+"&txtRut="+txtRut+"&txtDireccion="+txtDireccion+"&plan="+plan+"&txtTelefono="+txtTelefono);
	
}
</script>
<?php
	include('DibujaVentana.php');
	include('ScreenCatalogo_Seguridad.php');
	include('Conexion_Abrir.php');
	include('DataExtra.php');
	$estatus = PermisosUsuario($_SESSION['USERCORE'],3,$conexion);
	if($estatus==0){
		echo '<br/><div class="error-box round">Error: No Tiene Permisos de Acceso. Contacte el Administrador</div>';
		exit;
	}
	Cabecera("Nuevo Cliente");
	$boton		= "salvar";
	$javascript	= "";
	echo '<form name="clientes" id="clientes" method="post" action="" onsubmit="ValidarRequeridos(); return false">';
	echo '<center>';
	echo '<table border=0>';
	echo '<tr><td colspan="2"><div id="resultado"></div></td></tr>';
	echo '<tr>';
	echo '	<td><strong>Nombre:</strong></td>';
	echo '	<td><input type="text" name="txtNombre" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>Apellidos:</strong></td>';
	echo '	<td><input type="text" name="txtApellidos" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td align="left"><strong>Rut:</strong></td>';
	echo '	<td><input type="text" name="txtRut" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td align="left"><strong>Telefono:</strong></td>';
	echo '	<td><input type="text" name="txtTelefono" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>Direccion:</strong></td>';
	echo '	<td><input type="text" name="txtDireccion" class="CajaTexto" size="40" x-webkit-speech="true"/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '	<td><strong>Plan:</strong></td>';
	echo '	<td>';
	
    echo '<div class="dropdown">';
    echo '<select name="plan" class="dropdown-select">';
    echo '<option value="0">Seleccione Opcion</option>';
	$sql = "SELECT * FROM planes ORDER BY DESCRIPCION";
	$rs  = mysql_query($sql,$conexion);
	if(mysql_num_rows($rs)!=0){
		while($row = mysql_fetch_assoc($rs)){
			 echo '<option value="'.$row['DESCRIPCION'].' '.$row['COST'].'">"'.$row['DESCRIPCION'].' '.$row['COST'].'"</option>';
		}
	}
    echo '</select>';
    echo '</div>';
    
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '</center>';
	Pie($boton,$javascript);
	echo '</form>';
?>
