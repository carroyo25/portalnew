<?php
    date_default_timezone_set('America/Lima');

    require_once("connect.inc.php");

    if (isset($_POST['funcion'])){
        if ($_POST['funcion'] == "login")
            echo json_encode(login($pdo,$_POST['username'],$_POST['password']));
        if ($_POST['funcion'] == "register")
            echo json_encode(register($pdo,$_POST['correo'],$_POST['codigo']));
        if ($_POST['funcion'] == "changePass")
            echo json_encode(changePass($pdo,$_POST['correo'],$_POST['documento'],$_POST['clave']));
    }

    function login($pdo,$username,$password){
        $respuesta = false;
        $mensaje = 'Usuario o clave incorrectos';
        $clase = 'msj_error';

        try {
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
                $mensaje = "El usuario no esta registrado";
                $clase = 'msj_error';
                $nro_doc = null;
                $pagina = "";
            }

            return array('username' => $username, 'password' =>$password, 'respuesta'=>$respuesta, 'mensaje'=>$mensaje, 'clase'=>$clase, 'nro_doc'=>$nro_doc, 'pagina'=>$pagina);

        } catch (PDOException $th) {
            echo "Error: " . $th->getMessage;
        }
    }

    function register($pdo,$usermail,$usercode){
        require_once "../libs/PHPMailer/PHPMailerAutoload.php";
        
        try {
            $estadoEnvio = true;//code...
            $registrado = false;
            $mensaje = "No se pudo registrar o ha sido cesado, comunicarse con el Area de R.R.H.H";
            $clase = "msj_error";

            $busqueda = buscarUsuario($pdo,$usercode);

            if ($busqueda > 0){
                $mensaje = "Ya se encuentra, registrado... cambiar su clave";
                $clase = "msj_error";
            }else{
                $url = "http://sicalsepcon.net/api/loginApi.php?codigo=".$usercode;
                $api = file_get_contents($url);
            
                $datos =  json_decode($api);
                $nreg = count($datos);
                $registrado = $nreg > 0 ? true: false;

                if($nreg){
                    $token = "x6Jw8Gd8";
                    $mensaje = "Se ha enviado un mensaje de correo a la cuenta indicada";
                    $clase = "msj_info";

                    $u = explode(' ',$datos[0]->nombres);
                    $usuario = count($u) > 1 ? substr($u[0],0,1).substr($u[1],0,1).$datos[0]->paterno:substr($datos[0]->nombres,0,1).$datos[0]->paterno;
                    $clave = generatePassword(8);

                    $rptaBase = registrarAquarius($pdo,$datos,$clave,$usuario,$usermail);

                    if($rptaBase){
                        $rptaCorreo = enviarCorreoRegistro($usermail,$datos[0]->nombres,$clave,$token,$usuario);
                    }
                }
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

    function registrarAquarius($pdo,$datos,$clave,$usuario,$correo){
        try {
            $rptaBD = false;

            $sql = "INSERT INTO tabla_aquarius 
                            SET internal=?,dni=?,apellidos=?,nombres=?,
                                estado=?,dsede=?,clave=?,
                                cambio=?,usuario=?,correo=?,dcargo=?,cut=?,
                                acceso=?";
            
            $internal = uniqid('pe_');

            $statement = $pdo->prepare($sql);
            $statement -> execute(array($internal,$datos[0]->dni,$datos[0]->paterno.' '.$datos[0]->materno,$datos[0]->nombres,
                                        'AC',$datos[0]->sucursal,SHA1($clave),0,$usuario,$correo,$datos[0]->cargo,$datos[0]->cut,0));
            $results = $statement ->fetchAll();
            $rowaffect = $statement->rowCount($sql);

            if ($rowaffect > 0) {
                $rptaBD = true;
            }

            return $rptaBD;

        } catch (PDOException $th) {
            echo "Error: " . $th->getMessage;
            $respuesta = false;
        }
    }

    function enviarCorreoRegistro($correo,$nombre,$clave,$token,$usuario){
        require_once "../libs/PHPMailer/PHPMailerAutoload.php";

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = 'mail.sepcon.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'documentos_rrhh@sepcon.net';
        $mail->Password = $token;
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => false
            )
        );

        $usuario_origen = "Administrador RRHH";
        $correo_origen = "documentos_rrhh@sepcon.net";

        $mail->setFrom($correo_origen,$usuario_origen);
        $mail->addAddress($correo,$nombre);

        $subject = utf8_decode("Registro de usuario portal RRHH Sepcon");
        $messaje= '<div style="width:100%;display: flex;flex-direction: column;justify-content: center;align-items: center; font-family: Futura, Arial, sans-serif;">
                        <div style="width: 50%;border: 1px solid #c2c2c2;background: gold">
                            <h1 style="text-align: center;">Registro de Sistema</h1>
                        </div>
                        <div style="width: 50%;
                                    border-left: 1px solid #c2c2c2;
                                    border-right: 1px solid #c2c2c2;
                                    border-bottom: 1px solid #c2c2c2;
                                    border-radius: 8px">
                            <p style="padding:.5rem"><strong style="font-style: italic;">Estimado(a):</strong></p>
                            <p style="padding:.5rem;line-height: 1rem;">El presente mensaje electrónico, es para confirmar el registro de su usuario en el portal de RRHH, tener presente e cambiar la clave, al momento de ingresar al portal</p>
                            
                            <p style="padding:.5rem"><strong>Datos para el acceso :</strong></p>
                            <p style="padding:.5rem"><a href="https://rrhhperu.sepcon.net/portal/">Portal de Recursos Humanos</a></p>
                            <p style="padding:.5rem">Usuario :'.$usuario.'</p>
                            <p style="padding:.5rem">Clave : '.$clave.'</p>
                            <p style="padding:.5rem">Fecha de registro : '. date("d/m/Y h:i:s") .'</p>
                            <p style="font-size:.6rem; color:#0364B8; font-style:italic;">No responda este correo</p>
                        </div>
                    </div>';
        
            $mail->Subject = $subject;
            $mail->msgHTML(utf8_decode($messaje));
       
            if (!$mail->send()) {
                return array("mensaje"=>"Hubo un error, en el envio","clase"=>"mensaje_error");
            }
                            
            $mail->clearAddresses();

    }

    function buscarUsuario($pdo,$codigo){
        try {
            $sql = "SELECT COUNT(*) AS nregistros FROM tabla_aquarius WHERE tabla_aquarius.cut = ? AND tabla_aquarius.estado = ?";
            $statement = $pdo->prepare($sql);
            $statement -> execute(array($codigo,'AC'));
            $results = $statement ->fetchAll();

            return $results[0]['nregistros'];

        } catch (PDOException $th) {
            echo "Error: " . $th->getMessage;
            $respuesta = false;
        }
    }

    function buscarUsuarioDocumento($pdo,$nrodoc){
        try {
            $sql = "SELECT tabla_aquarius.usuario FROM tabla_aquarius WHERE tabla_aquarius.dni = ? LIMIT 1";
            $statement = $pdo->prepare($sql);
            $statement -> execute(array($nrodoc));
            $results = $statement ->fetchAll();

            return $results[0]['usuario'];

        } catch (PDOException $th) {
            echo "Error: " . $th->getMessage;
            $respuesta = false;
        }
    }

    function changePass($pdo,$correo,$documento,$clave){
        try {
            $mensaje = "No se cambio la clave.. verifique el N° de documento";
            $clase = "msj_error";
            $usuario = "";
            $respuesta = false;
            
            $sql = "UPDATE tabla_aquarius SET clave = ? WHERE dni=? LIMIT 1";
            $statement = $pdo->prepare($sql);
            $statement -> execute(array(SHA1($clave),$documento));
            $rowCount = $statement ->rowCount();

            if ($rowCount > 0){
                $token = "x6Jw8Gd8";

                $mensaje = "Clave actualizada...";
                $clase = "msj_correct";
                $respuesta = true;
                $usuario = buscarUsuarioDocumento($pdo,$documento);

                enviarCorreoCambioPassword($correo,$clave,$token,$usuario);
            }

            return array("respuesta"=>$respuesta,"mensaje"=>$mensaje,"clase"=>$clase);
            

        } catch (PDOException $th) {
            echo "Error: " . $th->getMessage;
            $respuesta = false;
        }
    }

    function enviarCorreoCambioPassword($correo,$clave,$token,$usuario){
        require_once "../libs/PHPMailer/PHPMailerAutoload.php";

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = 'mail.sepcon.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'documentos_rrhh@sepcon.net';
        $mail->Password = $token;
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => false
            )
        );

        $usuario_origen = "Administrador RRHH";
        $correo_origen = "documentos_rrhh@sepcon.net";

        $mail->setFrom($correo_origen,$usuario_origen);
        $mail->addAddress($correo,$usuario);

        $subject = utf8_decode("Cambio de clave de usuario portal RRHH Sepcon");
        $messaje= '<div style="width:100%;display: flex;flex-direction: column;justify-content: center;align-items: center; font-family: Futura, Arial, sans-serif;">
                        <div style="width: 50%;border: 1px solid #c2c2c2;background: cornflowerblue">
                            <h1 style="text-align: center;">Cambio de Clave</h1>
                        </div>
                        <div style="width: 50%;
                                    border-left: 1px solid #c2c2c2;
                                    border-right: 1px solid #c2c2c2;
                                    border-bottom: 1px solid #c2c2c2;
                                    border-radius: 8px">
                            <p style="padding:.5rem"><strong style="font-style: italic;">Estimado(a):</strong></p>
                            <p style="padding:.5rem;line-height: 1rem;">El presente mensaje electrónico, es para confirmar el registro de su usuario en el portal de RRHH, tener presente e cambiar la clave, al momento de ingresar al portal</p>
                            
                            <p style="padding:.5rem"><strong>Datos para el acceso :</strong></p>
                            <p style="padding:.5rem"><a href="https://rrhhperu.sepcon.net/portal/">Portal de Recursos Humanos</a></p>
                            <p style="padding:.5rem">Usuario :'.$usuario.'</p>
                            <p style="padding:.5rem">Clave : '.$clave.'</p>
                            <p style="padding:.5rem">Fecha de registro : '. date("d/m/Y h:i:s") .'</p>
                            <p style="font-size:.6rem; color:#0364B8; font-style:italic;">No responda este correo</p>
                        </div>
                    </div>';
        
            $mail->Subject = $subject;
            $mail->msgHTML(utf8_decode($messaje));
       
            if (!$mail->send()) {
                return array("mensaje"=>"Hubo un error, en el envio","clase"=>"mensaje_error");
            }
                            
            $mail->clearAddresses();

    }
?>