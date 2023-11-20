<?php 
	
	date_default_timezone_set('America/Lima');
	
	function calendar($month,$year,$diaActual) {	 
	#Obtenemos el dia de la semana del primer dia
	#Devuelve 0 para domingo, 6 para sabado
	$diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
	#Obtenemos el ultimo dia del mes
	$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));

			$salida = "<tr>";

					$last_cell=$diaSemana+$ultimoDiaMes;
					// hacemos un bucle hasta 42, que es el máximo de valores que puede
					// haber... 6 columnas de 7 dias
					for($i=1;$i<=42;$i++)
					{
						if($i==$diaSemana)
						{
							// determinamos en que dia empieza
							$day=1;
						}
						if($i<$diaSemana || $i>=$last_cell)
						{
							// celca vacia
							$salida .= "<td class='vacio'>&nbsp;</td>";
						}else{
							// m4daostra22mos el dia
							if($day==$diaActual)
								$salida .= "<td class='hoy'><a href=''>$day</a></td>";
							else
								$salida .= "<td><a href=''>$day</a></td>";
							$day++;
						}
						// cuando llega al final de la semana, iniciamos una columna nueva
						if($i%7==0)
						{
							$salida .= "</tr><tr>\n";
						}
					}

			return $salida;
	}
 ?>