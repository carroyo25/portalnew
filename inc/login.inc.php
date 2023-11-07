<?php
    date_default_timezone_set('America/Lima');

    require_once("connect.inc.php");

    if (isset($_POST['funcion'])){
        if ($_POST['funcion'] == "login")
            echo json_encode(login($pdo,$_POST['username'],$_POST['password']));
        if ($_POST['funcion'] == "register")
            echo json_encode(register($pdo,$_POST['correo'],$_POST['codigo']));
    }

    function login($pdo,$username,$password){
        $respuesta = false;
        $mensaje = 'Usuario o clave incorrectos';
        $clase = 'msj_error';

        $sql = "SELECT
					tabla_aquarius.internal,
                    tabla_aquarius.dni,
                    tabla_aquarius.nombres,
                    tabla_aquarius.correo
				FROM
					tabla_aquarius
				WHERE
					tabla_aquarius.usuario = ?
					AND tabla_aquarius.clave = SHA1(?)
					AND estado = 'AC'
				LIMIT 1";
        
        $statement = $pdo->prepare($sql);
		$statement -> execute(array($username,$password));
        $results = $statement ->fetchAll();
		$rowaffect = $statement->rowCount($sql);

    
        if ($rowaffect > 0) {
            $respuesta = true;
            $mensaje = "Bienvenido a la intranet de SEPCON";
            $clase = 'msj_correct';
            $nro_doc = $results[0]['dni'];
            $pagina = "php/panel.php";
        }else {
            $respuesta  = false;
            $mensaje = "Voy a buscar en la otra base de datos";
            $clase = 'msj_info';
            $nro_doc = null;
            $pagina = "php/register.php";
        }

        try {
            $respuesta = true;
        } catch (PDOException $th) {
            echo "Error: " . $th->getMessage;
            $respuesta = false;
        }

        return array('username' => $username, 'password' =>$password, 'respuesta'=>$respuesta, 'mensaje'=>$mensaje, 'clase'=>$clase, 'nro_doc'=>$nro_doc, 'pagina'=>$pagina);
    }

    function register($pdo,$usermail,$usercode){
        require_once "../libs/PHPMailer/PHPMailerAutoload.php";
        
        try {
            $estadoEnvio = true;//code...
            $registrado = false;
            $url = "http://sicalsepcon.net/api/loginApi.php?codigo=".$usercode;
            $api = file_get_contents($url);
            $mensaje = "No se encuentra registrado o ha sido cesado, comunicarse con el Area de R.R.H.H";
            $clase = "msj_error";
           
            $datos =  json_decode($api);
            $nreg = count($datos);
            $registrado = $nreg > 0 ? true: false;

            $u = explode(' ',$datos[0]->nombres);
            $usuario = count($u) > 1 ? substr($u[0],0,1).substr($u[1],0,1).$datos[0]->paterno:substr($datos[0]->nombres,0,1).$datos[0]->paterno;
            $clave = generatePassword(8);

            if($nreg){
                $mensaje = "Se ha enviado un mensaje de correo a la cuenta indicada";
                $clase = "msj_info";
            }
            
            return array('respuesta'=>$registrado,'mensaje'=>$mensaje,"clase"=>$clase);

        } catch (PDOException $th) {
            echo "Error: " . $th->getMessage;
            $respuesta = false;
        }
    }

    function generatePassword($length){
        $key = "";
        $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
        $max = strlen($pattern)-1;
        for($i = 0; $i < $length; $i++){
            $key .= substr($pattern, mt_rand(0,$max), 1);
        }
        return $key;
    }
?>