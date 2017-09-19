<?php
Class link_reservas{
	public function getRoomData()
	{
		$query = "select * from room_type";
		$result = $this->setConnection($query);
		$rows = array();
		while($r = mysqli_fetch_assoc($result))
		{
    			$rows[] = $r;
		}
		$response= json_encode($rows);
		return $response;
	}

	public function ingresarReserva($nombre, $id_nmr, $pers_nmr, $dias_nmr, $tipo_hab, $fecha_in)
	{
		$query1 = "Select id from info_reserva order by id desc limit 1";
		if(!isset($nombre) or !isset($id_nmr))
		{
			die ("datos personales necesarios para la reserva");
		}
		else if(!isset($pers_nmr) or !isset($dias_nmr) or !isset($tipo_hab) or !isset($fecha_in))
		{
			die("faltan datos de reserva");
		}
		else
		{
			$ult_res = $this->setConnection($query1);
			$r1=mysqli_fetch_array($ult_res,MYSQLI_NUM);
			$query = "INSERT INTO info_reserva (name, id_nmr, cant_pers, cant_dias, tipo_hab, fecha_in) VALUES('$nombre','$id_nmr',$pers_nmr,$dias_nmr,'$tipo_hab', '$fecha_in')";
			$result = $this->setConnection($query);
			$new_res = $this->setConnection($query1);
			$r2=mysqli_fetch_array($new_res,MYSQLI_NUM);
			if($r1[0] == $r2[0])
			{
				return 0;
			}
			else
			{
				return $r2[0];
			}
		}
	}

	public function setConnection($con_query)
	{
		//echo $con_query;
		$config = parse_ini_file('../private/config.ini');
		$con = mysqli_connect($config['hostname'],$config['username'],$config['password']) or die("ERROR no se puede conectar");
		mysqli_select_db($con,$config['dbname']) or die("ERROR no existe esa bd");
		$result=mysqli_query($con,$con_query) or die ("ERROR> request erroneo");
		mysqli_close($con);
		return $result;
	}
}
?>

