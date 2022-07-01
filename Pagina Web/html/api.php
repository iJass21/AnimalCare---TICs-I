
<?php
include "../inc/dbinfo.inc"; 

$coneccion = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
$database = mysqli_select_db($coneccion, DB_DATABASE);

if ($coneccion->coneccion_error) {
    die("Error al conectar : " . $coneccion->connection_error);
}//} else { /*echo "Conectado a BDD MySQL. "; }

date_default_timezone_set('America/Santiago');

//print("Esta es la api...");

$pagina_corriente = $_SERVER['REQUEST_URI'];
/*echo ('</br>');
print($pagina_corriente);*/

$ruta = explode("/", $pagina_corriente);
/*echo ('</br>');
print_r($ruta);*/
header('Content-Type: application/json');

session_start();




switch($ruta[2])
{
    case "usuarios":
        //print("Este es el caso usuarios");
        if($ruta[3] == "registrar")
        {
            $data = array();            
            
            if($_POST['password'] == $_POST['password2'])
            {
                if(!empty($_POST['nombre']) && !empty($_POST['email']) && !empty($_POST['password']))
                {
                    $nombre = (string)$_POST['nombre'];
                    $email = (string)$_POST['email'];
                    $password = (string)$_POST['password'];
                    
                    $sql = "INSERT INTO usuario(nombre, email, contrasenia) VALUES ('$nombre', '$email', '$password')";
                    
                    if ($coneccion->query($sql) === TRUE) 
                    {
                        print_r(json_encode(true, JSON_PRETTY_PRINT));
                        //echo "Se insertaron los valores en la tabla.";
                    } else {
                        print_r(json_encode(false, JSON_PRETTY_PRINT));
                        //echo "Error : " . $sql . "<br>" . $coneccion->error;
                    }
                }else{
                    print_r(json_encode(false, JSON_PRETTY_PRINT));
                    //print("Rellenar todos los campos....");
                }
            }else{
                //header('location: /ingresar.php?pass=incorrect');
                print_r(json_encode(false, JSON_PRETTY_PRINT));
            }

            

            return json_encode($data);
            $coneccion->close();

        }else if( $ruta[3] == "ingresar")
        {
            if(!empty($_POST['email']) && !empty($_POST['contrasenia'])) 
            {

                $usuario = $_POST['email'];
                $contra = $_POST['contrasenia'];
                $result = Array();
                //$result = mysqli_query($coneccion, "SELECT email FROM usuario WHERE (email = '$usuario') AND (contrasenia = '$contra')");
                if ($result = mysqli_query($coneccion, "SELECT nombre,email FROM usuario WHERE (email = '$usuario') AND (contrasenia = '$contra')")) {
                    if(mysqli_num_rows($result) > 0)
                    {
                        $rows = mysqli_fetch_assoc($result);
                        //print($rows['email']."\n");
                        //print($rows['rut']."\n");
                        //print($rows['nombre']."\n");
                        
                        
                        $_SESSION['nombre'] = $rows['nombre'];
                        $_SESSION['email'] = $rows['email'];
						
						

                        /********FUNCIONA (: */
                        /*$sqlc = "SELECT * FROM usuario WHERE (email = '$usuario')";

                        $result = mysqli_query($coneccion,$sqlc);


                        while($rows = mysqli_fetch_assoc($result)){
                            //print("while");
                            print($rows['nombre']."\n");
                            //echo $row[0]; 
                            //print_r($result."\n");
                            //print_r($row."\n");
                            //print_r($rows."\n");
                        }*/
                            
                        

                        //print_r($result['nombre']);
                        //print("algo");
                        /*session_start();
                        $_SESSION['nombre'] =*/ 

                        //$coneccion->close();
                        print_r(json_encode(true, JSON_PRETTY_PRINT));
                    }else{
                        $coneccion->close();
                        print_r(json_encode(false, JSON_PRETTY_PRINT));
                    }
                }else{
                    $coneccion->close();
                    print_r(json_encode(false, JSON_PRETTY_PRINT));
                }                               
                
            }else{
                $coneccion->close();
                print_r(json_encode(false, JSON_PRETTY_PRINT));
            } 
        }
		else if ($ruta[3] == "agregar_perfil") {
			if(!empty($_POST['especie']) && !empty($_POST['nombre']) && !empty($_POST['especie']) && !empty($_POST['id_dispositivo'])) {
				$email_usuario = (string)$_POST['email'];
				$nombre = (string)$_POST['nombre'];
				$especie = (int)$_POST['especie'];
				$id_dispositivo = (int)$_POST['id_dispositivo'];
				
				$sql = "INSERT INTO perfil_animal(email_usuario, nombre, id_animal, id_dispositivo) VALUES ('".$email_usuario."', '".$nombre."', '".$especie."', '".$id_dispositivo."')";
				
				if ($coneccion->query($sql) === TRUE) 
				{
					print_r(json_encode(true, JSON_PRETTY_PRINT));
					//echo "Se insertaron los valores en la tabla.";
				} else {
					print_r(json_encode(false, JSON_PRETTY_PRINT));
					//echo "Error : " . $sql . "<br>" . $coneccion->error;
				}
			}
		}else if($ruta[3] == "logout"){
			session_destroy();
			print_r(json_encode(true, JSON_PRETTY_PRINT));
			
			/*if(isset($_SESSION['nombre'])){
				print_r(json_encode(false, JSON_PRETTY_PRINT));
			}				
			else{
				print_r(json_encode(true, JSON_PRETTY_PRINT));
			}*/
				
		}

    break;

    case "animal":
		if($ruta[3] == "obtener_data")
		{
			//print("obteniendo data....");
			
			$sqlc = "SELECT * FROM registro, perfil_animal WHERE registro.id_perfil=perfil_animal.id and perfil_animal.email_usuario='".$_SESSION['email']."' ORDER BY registro.id DESC LIMIT 8";
			$result = mysqli_query($coneccion, $sqlc);
			
			if(mysqli_num_rows($result) > 0) {
				$valores = array();
				
				while($rows = mysqli_fetch_row($result)) {
					array_push($valores, Array(
						'fecha'=> $rows[2],
						'temp'=> (int)$rows[3],
						'luz' => (int)$rows[4],
						'humedad' => (int)$rows[5],
						'uv' => (int)$rows[6]));
				}
			}
			
			//print($temp);
			print_r(json_encode($valores, JSON_PRETTY_PRINT));
		}
		
		
        
    break;

    default:
        print("Ruta incorrecta...");
    break;



}





?>


