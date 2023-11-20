<?php 

	date_default_timezone_set('America/Lima');

	require_once ("../inc/calendar.inc.php");
	
	$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",	"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	$month=date("n");
	$year=date("Y");
	$diaActual=date("j");

	$calendario = calendar($month,$year,$diaActual);

	$random = rand(0,999999);

	
 ?>
 <!DOCTYPE html>
<html lang="es">
<head>
	<title>Ejemplo de un simple calendario en PHP</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/calendar.css?v<?php echo $random; ?>">
</head>
 
<body>
	<form action="" method="post0">
		<input type="hidden" id="mesactual" name="mesactual" value=" <?php echo $month ?>">
		<input type="hidden" id="anoactual" name="anoactual" value=" <?php echo $year ?>">
	</form>

<table id="calendar">
	<caption>
		<div>
			<a href="" id="ant" class="botones">-</a>
				<span class="cabecera"><?php echo $meses[$month]." ".$year?></span>
			<a href="" id="sig" class="botones">+</a>
		</div>
	</caption>
	<thead>
		<tr>
			<th>Lun</th>
			<th>Mar</th>
			<th>Mie</th>
			<th>Jue</th>
			<th>Vie</th>
			<th>Sab</th>
			<th>Dom</th>
		</tr>
	</thead>
	<tbody id="calendario">
		<?php echo $calendario ?>
	</tbody>
</table>
</body>
</html>