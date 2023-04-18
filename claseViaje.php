<?php

/*Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos nombre, apellido, numero de documento y teléfono.
El viaje ahora contiene una referencia a una colección de objetos de la clase Pasajero. También se desea guardar la información de la persona 
responsable de realizar el viaje, para ello cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido.
La clase Viaje debe hacer referencia al responsable de realizar el viaje.

Volver a implementar las operaciones que permiten modificar el nombre, apellido y teléfono de un pasajero. Luego implementar la operación que agrega los pasajeros al viaje, 
solicitando por consola la información de los mismos. Se debe verificar que el pasajero no este cargado mas de una vez en el viaje. De la misma forma cargue la información del
responsable del viaje.

Nota: Recuerden que deben enviar el link a la resolución en su repositorio en GitHub.*/

class viaje{

    private $codigoViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $cantPasajeros;
    private $infoPasajeros;
    private $responsableViaje;


    public function __construct($codViaje,$dest,$maxPasaj,$cantDePasajeros,$laInfoPasajeros,$responsableViaje){
        /* int $codViaje,$dest,$maxPasaj,$cantDePasajeros
           string $dest*/

        $this->codigoViaje = $codViaje;
        $this->destino = $dest;
        $this->cantMaxPasajeros = $maxPasaj;
        $this->cantPasajeros = $cantDePasajeros;
        $this->infoPasajeros = $laInfoPasajeros;
        $this->responsableViaje = $responsableViaje;
        
    }

 /**************************metodo de retorno de valores de la clase***************************************** */

    public function get_codijo_viaje (){
        return $this->codigoViaje;
    }

    public function get_destino_viaje (){
        return $this->destino;
    }

    public function get_cantMax_pasajeros (){
        return $this->cantMaxPasajeros;
    }

    public function get_cant_pasajeros (){
        return $this->cantPasajeros;
    }

    public function get_info_pasajeros (){
        return $this->infoPasajeros;
    }

    public function get_responsable_viaje (){
        return $this->responsableViaje;
    }

 /*****************metodos de setiado de valores de la clase************************************** */

    public function set_codijo_viaje ($codigoViaje){
        $this->codigoViaje = $codigoViaje;
    }

    public function set_destino_viaje ($destino){
        $this->destino = $destino;
    }

    public function set_cantMax_pasajeros ($cantMax){
        $this->cantMaxPasajeros = $cantMax;
    }

    public function set_cant_pasajeros ($cant){
        $this->cantPasajeros = $cant;
    }

    public function set_info_pasajeros ($infoPasajeros){
        $this->infoPasajeros = $infoPasajeros;
    }

    public function set_responsable_viaje ($respViaje){
        $this->responsableViaje = $respViaje;
    }

/*********************************************************** */
    /**
     * busca a traves del dni ingresado por parametro, retorna el indice de la coleccion del objetos pasajeros con el mismo dni, si no lo encuentra retorna -1
     * @param int $nroDni
     * @return int $indicePasajero
     */
    public function buscarPasajero($nroDni){
    
        $pasajeros = $this->get_info_pasajeros();//coleccion de objetos de pasajeros

        $contador = count($pasajeros);

        $i = 0;

        $indicePasajero = -1;

        $seEncontro = false;

        while ( $i < $contador && !$seEncontro){

            $objPasajero = $pasajeros[$i];

            if ( $objPasajero->get_dni_pasajero () == $nroDni){

                $seEncontro = true;
                $indicePasajero = $i;

            }

            $i++;

        }

        return $indicePasajero;

    }

    /**
     * verifica primero si el dni se encuentra dentro de la coleccion de objetos pasajeros con el metodo buscarPasajero
     * y modifica los datos del pasajero en cuenstion usando el metodo set de la clase viaje(siempre y cuando el pasajero se encuentre en la coleccion).
     * y retorna el indice del pasajero modificado o -1 si no se pudo modificar
     * @param string $nombre,$apellido
     * @param int $dni,$telefono,$buscarDni
     * @return int $indice
     */
    public function  modificarPasajero($nombre,$apellido,$telefo,$dni,$buscarDni){

        $losPasajeros = $this->get_info_pasajeros();
        
        $contador = count($losPasajeros);


        $indice = $this->buscarPasajero($buscarDni);

        if ( $indice >= 0 ){

            $objPasajero = $losPasajeros[$indice];

            $objPasajero->set_nombre_pasajero($nombre);
            $objPasajero->set_apellido_pasajero($apellido);
            $objPasajero->set_dni_pasajero ($dni);
            $objPasajero->set_telefono_pasajero($telefo);

            $losPasajeros[$indice] = $objPasajero;
            
            $this->set_info_pasajeros($losPasajeros);

        }

        return $indice;

    }

    /**
     * agrega un objeto pasajero nuevo siempre y cuando este no se encuentre ya registrado(usamos tambien el metodo buscarPasajero para asegurar que el dni del pasajero que ingresemos
     * no este en la coleccion de pasajeros) . retorna -1 si el agregado fue exitoso o el indice del pasajero si este ya se encontraba registrado
     * @param objet $objPasajeroAniadir
     * @return int $indice
     */
    public function agregarPasajero($objPasajeroAniadir){

        $losPasajeros = $this->get_info_pasajeros();
        
        $contador = count($losPasajeros);
        
        $buscarPasajero = $objPasajeroAniadir->get_dni_pasajero();

        $indice = $this->buscarPasajero($buscarPasajero);

        if( $indice == -1 && $contador < $this->get_cantMax_pasajeros()){   

            $losPasajeros[] = $objPasajeroAniadir;

            $cantNueva = count($losPasajeros);

            $this->set_info_pasajeros($losPasajeros);

            $this->set_cant_pasajeros($cantNueva);

        }

        return $indice;

    }

    /**
     * usando el numero de empleado, se busca dentro de la coleccion de la clase responsable a algun responsable de viaje con 
     * el mismo numero de empleado, si se encuentra retorna el indice de la coleccion, sino retornara -1
     * @param int $nroEmpleadoR
     * @return int $indice
     */
    public function buscarResponsable($nroEmpleadoR){

        $responsables = $this->get_responsable_viaje();

        $contador = count($responsables);

        $i = 0;

        $encontro = false;

        $indice = -1;

        while ( $i < $contador && !$encontro){

            $objResponsable = $responsables[$i];

            if ( $objResponsable->get_nroEmpleado_responsable ( ) == $nroEmpleadoR){

                $encontro = true;
                $indice = $i;

            }

            $i++;
        }

        return $indice;

    }

    /**
     * modifica los datos del responsable con el mismo nro de empleado(para verificar el nro empleado se usa el metodo buscarResponsable).
     * si el responsable se encuentra dentro de la coleccion de la coleccion de objetos responsables, entonse se modifica los datos atraves del metodo set.
     * retorna el indice del responsable modificado, sino se pudo modificar, retorna -1
     * @param int $nroEmpleadoR,$nroLicencia,$buscarNroEmpleadoR
     * @param string $nombre, $apellido
     */
    public function modificarResponsable($nroEmpleadoR,$nroLicencia, $nombre, $apellido,$buscarNroEmpleadoR){

        $responsables = $this->get_responsable_viaje();

        $contador = count($responsables);

        $indice = $this->buscarResponsable($buscarNroEmpleadoR);

        if ( $indice >= 0){

            $objResponsable = $responsables[$indice];

            $objResponsable->set_nombre_responsable ($nombre);
            $objResponsable->set_apellido_responsable ( $apellido );
            $objResponsable->set_nroLicencia_responsable( $nroLicencia);
            $objResponsable->set_nroEmpleado_responsable ( $nroEmpleadoR);

            $responsables[$indice] = $objResponsable;

            $this->set_responsable_viaje($responsables);

        }

        return $indice;

    }

    /**
     * se ingresa un nuevo objeto responsable dentro de la coleccion de este mismo siempre y cuando no se encuentre ya registrado dentro de la coleccion , si el ingreso es exitoso 
     * retorna -1, sino retorna el indice del objeto responable
     */
    public function agregarResponsable($agregarResponsable){

        $responsables = $this->get_responsable_viaje();

        $indice = $agregarResponsable->get_nroEmpleado_responsable ( );

        $seEncuentra = $this->buscarResponsable($indice);

        if ( $seEncuentra == -1){

            $responsables[] = $agregarResponsable;
            
            $this->set_responsable_viaje($responsables);

        }

        return $seEncuentra;

    }


    public function __toString(){

        $losPasajeros = $this->get_info_pasajeros();
        $mostrarPasajeros = "";
        for( $i = 0; $i < count($losPasajeros); $i++){
            $mostrarPasajeros = $mostrarPasajeros. $losPasajeros[$i];
        }

        $losResponsables = $this->get_responsable_viaje();
        $mostrarResponsables = "";
        for( $i = 0; $i < count($losResponsables); $i++){
            $mostrarResponsables = $mostrarResponsables. $losResponsables[$i];
        }

        return

        "codijo del viaje: ". $this->get_codijo_viaje()."\n".
        "destino del viaje: ". $this->get_destino_viaje()."\n".
        "cantidad maxima de pasajeros: ". $this->get_cantMax_pasajeros()."\n".
        "cantidad de pasajeros: ". $this->get_cant_pasajeros()."\n".
        "*************DATOS DE LOS PASAJEROS************* " ."\n".$mostrarPasajeros."\n".
        "*************DATOS DE LOS RESPONSABLES*************"."\n". $mostrarResponsables."\n";

    }







}



