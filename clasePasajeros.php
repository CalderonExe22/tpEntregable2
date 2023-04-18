<?php

/*Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos nombre, apellido, numero de documento y teléfono.
 El viaje ahora contiene una referencia a una colección de objetos de la clase Pasajero. También se desea guardar la información de la persona 
 responsable de realizar el viaje, para ello cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido.
  La clase Viaje debe hacer referencia al responsable de realizar el viaje.

Volver a implementar las operaciones que permiten modificar el nombre, apellido y teléfono de un pasajero. Luego implementar la operación que agrega los pasajeros al viaje, 
solicitando por consola la información de los mismos. Se debe verificar que el pasajero no este cargado mas de una vez en el viaje. De la misma forma cargue la información del
 responsable del viaje.

Nota: Recuerden que deben enviar el link a la resolución en su repositorio en GitHub.*/

class pasajeros{

    private $nombre;
    private $apellido;
    private $dni;
    private $telefono;

    public function __construct($nombreP, $apellidoP, $dniP, $telefonoP){

        $this->nombre = $nombreP;
        $this->apellido = $apellidoP;
        $this->dni = $dniP;
        $this->telefono = $telefonoP;

    }
/************************metodos get de la clase*************************************** */
    public function get_nombre_pasajero (){
        return $this->nombre;
    }

    public function get_apellido_pasajero (){
        return $this->apellido;
    }

    public function get_dni_pasajero (){
        return $this->dni;
    }

    public function get_telefono_pasajero (){
        return $this->telefono;
    }
/************************metodos set de la clase************************************** */
    public function set_nombre_pasajero ($nombre){
       $this->nombre = $nombre; 
    }

    public function set_apellido_pasajero ($apellido){
        $this->apellido = $apellido; 
    }

    public function set_dni_pasajero ($dni){
        $this->dni = $dni; 
    }

    public function set_telefono_pasajero($telefono){
        $this->telefono = $telefono; 
    }
/****************************************************************** */


    public function __toString( ){
        return "nombre del pasajero: ".$this->get_nombre_pasajero()."\n".
               "apellido del pasajero: ". $this->get_apellido_pasajero()."\n".
               "dni del pasajero: ". $this->get_dni_pasajero()."\n".
               "numero de telefono del pasajero: ". $this->get_telefono_pasajero()."\n";
    }
    
}