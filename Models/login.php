 <?php
	class login {
 	private $conexion;


 	function identificar( $username, $password ) {
 		require_once( 'conexion.php' );
 		$this->conexion = new conexion( "172.18.55.6", "comandato", "comandato123", "Biggestion" );
 		$this->conexion->conectar();
 		$this->conexion->conexion->set_charset( 'utf8' );


 		//$pass=sha1($password);
 		$sql = "SELECT 
   
    Biggestion.AGENTES.EXTENSION,
    Biggestion.AGENTES.NOMBRES,
    Biggestion.AGENTES.APELLIDOS,
    Biggestion.AGENTES.CAMPANA,
    Biggestion.campania.nom_camp,
   
    Biggestion.AGENTES.ROL
FROM
    Biggestion.AGENTES,
    Biggestion.campania
WHERE
    Biggestion.AGENTES.CAMPANA = Biggestion.campania.idcampania
        AND Biggestion.AGENTES.EXTENSION = '$username'
        AND Biggestion.AGENTES.PASSWORD = '$password'";
 		$resulatdos = $this->conexion->conexion->query( $sql );
 		if ( $resulatdos->num_rows > 0 ) {
 			$r = $resulatdos->fetch_array();
 		} else {
 			$r[ 0 ] = 0;
 		}
 		return $r;
 		$this->conexion->cerrar();
 	}
		}



 ?>