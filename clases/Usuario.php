<?php 

class Usuario{
	private $nidacceso;
	private $snombre;
	private $susuario;
	private $sclave;
	
	function __construct($snom,$susr,$sclave){
		$this->snombre=$snom;
		$this->susuario=$susr;
		$this->sclave=md5($sclave);
	}
	public function getNombre(){
		return $this->snombre;
	}
        function getSusuario() {
            return $this->susuario;
        }
        function setSusuario($susuario) {
            $this->susuario = $susuario;
        }

        function setSclave($sclave) {
            $this->sclave = $sclave;
        }

                function getNidacceso() {
            return $this->nidacceso;
        }

        function getSnombre() {
            return $this->snombre;
        }

        function setNidacceso($nidacceso) {
            $this->nidacceso = $nidacceso;
        }

        function setSnombre($snombre) {
            $this->snombre = $snombre;
        }

        function getSclave() {
            return $this->sclave;
        }

        public function getIdacceso(){
		return $this->nidacceso;
	}
	
	function VerificaUsuario(){
		$db=dbconnect();
		/*Definici�n del query que permitira ingresar un nuevo registro*/
		$sqlsel="select nombre from acceso
		where nomusuario=:usr";

		/*Preparaci�n SQL*/
		$querysel=$db->prepare($sqlsel);

		/*Asignaci�n de parametros utilizando bindparam*/
		$querysel->bindParam(':usr',$this->susuario);
		
		$datos=$querysel->execute();
		
		if ($querysel->rowcount()==1)return true; else return false;

	}

	function VerificaAcceso(){
		$db=dbconnect();
		/*Definici�n del query que permitira ingresar un nuevo registro*/
		$sqlsel="select nombre,idacceso from acceso
		where nomusuario=:usr and pwdusuario=:pwd";

		/*Preparaci�n SQL*/
		$querysel=$db->prepare($sqlsel);

		/*Asignaci�n de parametros utilizando bindparam*/
		$querysel->bindParam(':usr',$this->susuario);
		$querysel->bindParam(':pwd',$this->sclave);

		$datos=$querysel->execute();

		if ($querysel->rowcount()==1){
                        $registro = $querysel->fetch();
			$this->snombre=$registro["nombre"];
			$this->nidacceso=$registro["idacceso"];
                        
			
			return true;
		}
		else{
			return false;
		}


	}
	function ActualizaClave($snewpwd){
		$db=dbconnect();
		/*Definici�n del query que permitira actualizar la clave*/
		$sqlupd="update acceso
					set pwdusuario=:pwd
					where idacceso=:id";
	
		/*Preparaci�n SQL*/
		$querysel=$db->prepare($sqlupd);
	
		/*Asignaci�n de parametros utilizando bindparam*/
		$querysel->bindParam(':pwd',$snewpwd);
		$querysel->bindParam(':id',$this->nidacceso);
		

		$valaux=$querysel->execute();
	
		return $valaux;
	}

}
?>