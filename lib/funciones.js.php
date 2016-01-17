<?php

/********************************indice de funciones*****************************************/
//function javascript($javascript)//ejecutar javascript
//function mensaje($mensaje)//mensaje en javascript
//function abrir($url,$target)//abrir_ventana en javascript 
//function getMes($nMes)//devuelve mes en caracter
//function to_moneda_sp($string)//convierte moneda sin puntos de miles
//function gettime()//fecha_actual
//function fecha($fec)// yyyy/mm/dd to dd/mm/yyyy
//function fecha_bd($fec)// dd/mm/yyyy to yyyy/mm/dd
//function moneda($moneda)//elimina en moneda el caracter '$'
//function to_moneda_bd($string)//convierte moneda a formato bd
//function to_moneda($string)//convierte en formato moneda
//function vacio($valor)//valida variable definida y contenido
/*********************************************************************************************/
function validar_vacio($valor)//valida variable definida y contenido
{
	if (isset($valor))
	{
		if ($valor=='')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}





function to_moneda($string)//convierte en formato moneda
{
$Negative = 0;

//check to see if number is negative
if(preg_match("/^\-/",$string))
{
//setflag
$Negative = 1;
//remove negative sign
$string = preg_replace("|\-|","",$string);
}


//look for commas in the string and remove them.
$string = preg_replace("|\,|","",$string);

//split the string into two First and Second
// First is before decimal, second is after First.Second
$Full = split("[\.]",$string);

$Count = count($Full);

if($Count > 1)
{
$First = $Full[0];
$Second = $Full[1];
$NumCents = strlen($Second);
if($NumCents == 2)
{
//do nothing already at correct length
}
else if($NumCents < 2)
{
//add an extra zero to the end
$Second = $Second . "0";
}
else if($NumCents > 2)
{
//either string off the end digits or round up
// I say string everything but the first 3 digits and then round
// since it is rare that anything after 3 digits effects the round
// you can change if you need greater accurcy, I don't so I didn't
// write that into the code.
$Temp = substr($Second,0,3);
$Rounded = round($Temp,-1);
$Second = substr($Rounded,0,2);

}

}
else
{
//there was no decimal on the end so add to zeros
$First = $Full[0];
$Second = "00";
}

$length = strlen($First);

if( $length <= 3 )
{
//To Short to add a comma
$string = $First . "," . $Second;

// if negative flag is set, add negative to number
if($Negative == 1)
{
$string = "-" . $string;
}

return $string;
}
else
{
$loop_count = intval( ( $length / 3 ) );
$section_length = -3;
for( $i = 0; $i < $loop_count; $i++ )
{
$sections[$i] = substr( $First, $section_length, 3 );
$section_length = $section_length - 3;
}

$stub = ( $length % 3 );
if( $stub != 0 )
{
$sections[$i] = substr( $First, 0, $stub );
}
$Done = implode( ".", array_reverse( $sections ) );
$Done = $Done . "," . $Second;

// if negative flag is set, add negative to number
if($Negative == 1)
{
$Done = "-" . $Done;
}

return $Done;

}
}
/***********************************************************************/

function to_moneda_bd($string)//convierte moneda a formato bd
{
$Negative = 0;

//check to see if number is negative
if(preg_match("/^\-/",$string))
{
//setflag
$Negative = 1;
//remove negative sign
$string = preg_replace("|\-|","",$string);
}


//look for commas in the string and remove them.
$string = preg_replace("|\.|","",$string);

//split the string into two First and Second
// First is before decimal, second is after First.Second
$Full = split("[\,]",$string);

$Count = count($Full);

if($Count > 1)
{
$First = $Full[0];
$Second = $Full[1];
$NumCents = strlen($Second);
if($NumCents == 2)
{
//do nothing already at correct length
}
else if($NumCents < 2)
{
//add an extra zero to the end
$Second = $Second . "0";
}
else if($NumCents > 2)
{
//either string off the end digits or round up
// I say string everything but the first 3 digits and then round
// since it is rare that anything after 3 digits effects the round
// you can change if you need greater accurcy, I don't so I didn't
// write that into the code.
$Temp = substr($Second,0,3);
$Rounded = round($Temp,-1);
$Second = substr($Rounded,0,2);

}

}
else
{
//there was no decimal on the end so add to zeros
$First = $Full[0];
$Second = "00";
}

$length = strlen($First);

if( $length <= 3 )
{
//To Short to add a comma
$string = $First . "." . $Second;

// if negative flag is set, add negative to number
if($Negative == 1)
{
$string = "-" . $string;
}

return $string;
}
else
{
$loop_count = intval( ( $length / 3 ) );
$section_length = -3;
for( $i = 0; $i < $loop_count; $i++ )
{
$sections[$i] = substr( $First, $section_length, 3 );
$section_length = $section_length - 3;
}

$stub = ( $length % 3 );
if( $stub != 0 )
{
$sections[$i] = substr( $First, 0, $stub );
}
$Done = implode( "", array_reverse( $sections ) );
$Done = $Done . "." . $Second;

// if negative flag is set, add negative to number
if($Negative == 1)
{
$Done = "-" . $Done;
}

return $Done;

}
}
/***********************************************************************/
function moneda($moneda)//elimina en moneda el caracter '$'
{
$valor=''; 
$a=1;
$i=0; 
$str_valor=$moneda;
while ($a<>0)

{ 
	if (isset($str_valor[$i]))
	{
	if ($str_valor[$i]<>'$')
	{
	$valor.=$str_valor[$i]; 
	}
	$i=$i+1;
	} 
	else 
	{
	 $a=0;
	 }
  } 
 $moneda=$valor;
return ($moneda);

}


function punto($moneda)
{
$valor=''; 
$a=1;
$i=0; 
$str_valor=$moneda;
while ($a<>0)

{ 
	if (isset($str_valor[$i]))
	{
	if ($str_valor[$i]<>'.')
	{
	$valor.=$str_valor[$i]; 
	}
	$i=$i+1;
	} 
	else 
	{
	 $a=0;
	 }
  } 
 $moneda=$valor;
return ($moneda);

}


function fecha_bd($fec)// dd/mm/yyyy to yyyy/mm/dd
{

$day='';
$mes='';
$ano='';

for ($i=0;$i<10;$i++)
{
	if ($i<2)
	{
	$day.=$fec[$i];
	}

	if (($i>2) and ($i<5))
	{
	$mes.=$fec[$i];
	
	}

	if (($i>5) and ($i<10))
	{
	$ano.=$fec[$i];
	}
}
$fecha=$ano.'-'.$mes.'-'.$day;

return ($fecha);
}

function fecha($fec)// yyyy/mm/dd to dd/mm/yyyy
{

$day='';
$mes='';
$ano='';

for ($i=0;$i<10;$i++)
{
	if ($i<4)
	{
	$ano.=$fec[$i];
	}

	if (($i>4) and ($i<7))
	{
	$mes.=$fec[$i];
	
	}

	if (($i>7) and ($i<10))
	{
	$day.=$fec[$i];
	}
}
$fecha=$day.'/'.$mes.'/'.$ano;
return ($fecha);
}


function gettime()//fecha_actual
{
$ano=strftime("%Y");
$mes=strftime("%m");
$dia=strftime("%d");

$fe=$ano.'-'.$mes.'-'.$dia;
return($fe);
}



function to_moneda_Txt($moneda)
{
	
	if (isset($moneda))
	{
		$valor=moneda(to_moneda_bd(to_moneda($moneda)));
	}
	else
	{
		$valor="0.00";
	}	
	
	return $valor;
	
}//moneda


/*************/
function to_moneda_sp($string)//convierte moneda sin puntos de miles
{
$Negative = 0;

//check to see if number is negative
if(preg_match("/^\-/",$string))
{
//setflag
$Negative = 1;
//remove negative sign
$string = preg_replace("|\-|","",$string);
}


//look for commas in the string and remove them.
$string = preg_replace("|\,|","",$string);

//split the string into two First and Second
// First is before decimal, second is after First.Second
$Full = split("[\.]",$string);

$Count = count($Full);

if($Count > 1)
{
$First = $Full[0];
$Second = $Full[1];
$NumCents = strlen($Second);
if($NumCents == 2)
{
//do nothing already at correct length
}
else if($NumCents < 2)
{
//add an extra zero to the end
$Second = $Second . "0";
}
else if($NumCents > 2)
{
//either string off the end digits or round up
// I say string everything but the first 3 digits and then round
// since it is rare that anything after 3 digits effects the round
// you can change if you need greater accurcy, I don't so I didn't
// write that into the code.
$Temp = substr($Second,0,3);
$Rounded = round($Temp,-1);
$Second = substr($Rounded,0,2);

}

}
else
{
//there was no decimal on the end so add to zeros
$First = $Full[0];
$Second = "00";
}

$length = strlen($First);

if( $length <= 3 )
{
//To Short to add a comma
$string = $First . "," . $Second;

// if negative flag is set, add negative to number
if($Negative == 1)
{
$string = "-" . $string;
}

return $string;
}
else
{
$loop_count = intval( ( $length / 3 ) );
$section_length = -3;
for( $i = 0; $i < $loop_count; $i++ )
{
$sections[$i] = substr( $First, $section_length, 3 );
$section_length = $section_length - 3;
}

$stub = ( $length % 3 );
if( $stub != 0 )
{
$sections[$i] = substr( $First, 0, $stub );
}
$Done = implode( "", array_reverse( $sections ) );
$Done = $Done . "," . $Second;

// if negative flag is set, add negative to number
if($Negative == 1)
{
$Done = "-" . $Done;
}

return $Done;

}
}

function getMes($nMes)//devuelve mes en caracter
{
	switch($nMes)       
	{
		case "01":
			return "Enero";
			break;
			
		case "02":
			return "Febrero";
			break;	
			
		case "03":
			return "Marzo";
			break;
			
		case "04":
			return "Abril";
			break;
			
		case "05":
			return "Mayo";
			break;
			
		case "06":
			return "Junio";
			break;
			
		case "07":
			return "Julio";
			break;
			
		case "08":
			return "Agosto";
			break;
			
		case "09":
			return "Septiembre";
			break;
			
		case "10":
			return "Octubre";
			break;
			
		case "11":
			return "Noviembre";
			break;
			
		case "12":
			return "Diciembre";
			break;
			
		default: 
			echo("Mes No Válido"); 
			return "Mes no Válido"; 
			break;
			
	}//switch
	
}//getMes

//****************/
function mensaje($mensaje)//mensaje en javascript
{
	echo"<script languaje=\"javascript\">
	alert('".$mensaje."');
	</script>";
}

function abrir($url,$target)//abrir_ventana en javascript
{
	echo"<script languaje=\"javascript\">
	window.open('".$url."','".$target."');
	</script>";
}

function javascript($javascript)//ejecutar javascript
{
echo"<script languaje=\"javascript\">
".$javascript."
</script>";
}
function ceros($valor)
{
$valor_listo='';
$cant_ceros=8-strlen($valor);
	for ($i=1;$i<=$cant_ceros;$i++)
	{
		$valor_listo.='0';
	}

$valor_listo.=$valor;
return $valor_listo;
}
function comparar_fechas($mayor,$menor)//dd/mm/yyyy mayor=actual
{
$mayor_anho=$mayor[6].$mayor[7].$mayor[8].$mayor[9];
$mayor_mes=$mayor[3].$mayor[4];
$mayor_dia=$mayor[0].$mayor[1];

$menor_anho=$menor[6].$menor[7].$menor[8].$menor[9];
$menor_mes=$menor[3].$menor[4];
$menor_dia=$menor[0].$menor[1];
	if ($menor_anho>$mayor_anho)
	{
		return  $mayor;	
	}
	if ($menor_anho<$mayor_anho)
	{
		return  $menor;	
	}
	if ($menor_anho==$mayor_anho)
	{
		if ($menor_mes>$mayor_mes)
		{
			return $mayor;		
		}
		if ($menor_mes<$mayor_mes)
		{
			return $menor;		
		}
		if ($menor_mes==$mayor_mes)
		{
			
			if ($menor_dia>$mayor_dia)	
			{
				return $mayor;				
			}	
			
			if ($menor_dia<=$mayor_dia)	
			{
				return $menor;
			}
		}
					
	}
}

?>