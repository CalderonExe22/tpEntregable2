<?php


include_once("claseVerificacion.php");
include_once("claseResponsable.php");
include_once("clasePasajeros.php");
include_once("claseViaje.php");


/*PROGRAMA VIAJE FELIZ*/
/*muestra un menu de opciones que nos permine agregar, modificar y visualizar los datos tanto de un viaje ingresado o un pasajero*/

/* int $opcion, int $elCodijo,$laCantMaxPasajeros, $laCantPasajeros, $modificador, $nuevoCodViaje, $nroPersona, $laOpcion,$laOpcion2,$laOpcion3,
$modificadorPers,$numeroDoc,$nuevaCantMaxPasaj,$nuevaCantPasaj.$nuevoDni,$elDniPasajero
string $elDestino, $nuevoDestino,  $nuevoNombre,$nuevoApellido  ,$elApellidoPasajero,$elNOmbrePasajeros
obj $datosViajes,  $verificador$pasajeros, $responsable*/ 


/* instanciamos la clase pasajeros con dos pasajeros dentro de la coleccion $pasajeros*/

$pasajeros =[
new pasajeros ( "rafael","fernandez",44863961,2944228916),
new pasajeros ( "mario","mendez",61819743,2945668489)
];
    
/**************************************************************************************/

$verificar = new verificacion();//instancia clase que verifica si es integ y string

echo "\n"."Ingrese el codigo del viaje: ";
$elCodijo = $verificar->soloInteg();/* para solo ingresar un valor tipo integ*/

echo "\n"."Ingrese el destino del viaje: ";

$elDestino = $verificar->esString();/*valida que sea un string*/

echo "\n"."Ingrese cantidad maxima de pasajeros a bordo: ";
$laCantMaxPasajeros = trim(fgets(STDIN));

/*instruccion para que el valor solo sea del tipo string y sea mayor a cero*/

while(is_numeric($laCantMaxPasajeros) && $laCantMaxPasajeros <= 0){
    echo "ingrese  un numero mayor a 0: ";
    $laCantMaxPasajeros = trim(fgets(STDIN));
    
}

$laCantPasajeros = count($pasajeros);/*indicamos la cantidad de pasajeros con un count*/

echo "INGRESE DATOS DEL RESPONSABLE DEL VIAJE: "."\n";

echo "ingrese nombre del responsable: ";
$nombreR = $verificar->esString();
echo "ingrese apellido del responsable: ";
$apellidoR = $verificar->esString();
echo "ingrese nro de empleado del responsable: ";
$nroEmpleadoR = $verificar->soloInteg();
echo "ingrese nro de licencia del responsable: ";
$nroLicenciaR =  $verificar->soloInteg();

$responsable = [new responsableV ( $nombreR,$apellidoR,$nroEmpleadoR,$nroLicenciaR),];/*instanciamos la coleccion de objetos con los datos de los responsables del viaje*/

$datosViajes = new viaje($elCodijo,$elDestino,$laCantMaxPasajeros,$laCantPasajeros,$pasajeros,$responsable);/*instanciar objeto datos agregados de un viaje*/

do{
    
    echo "\n"."HOLA BIENVENIDO AL PROGRAMA "."\n";
    echo "1) Modificar datos de pasajeros."."\n";
    echo "2) Agregar pasajero."."\n";
    echo "3) Modificar responsable del viaje."."\n";
    echo "4) Agregar otro responsable."."\n";
    echo "5) Modificar datos de viajes."."\n";
    echo "6) mostrar datos de viaje y pasajeros."."\n";
    echo "7) salir."."\n";
    echo "\n"."Ingrese alguna de las siguientes opciones: ";

    $opcion=trim(fgets(STDIN));

    /*esta instruccion evalua que el valor ingresado no sea un string y sea solamente un numero de las opciones*/
    while (!is_int($opcion) && !($opcion >= 1 && $opcion <= 7)) {
        echo "Debe ingresar un número entre 1 y 7: ";
        $opcion = trim(fgets(STDIN));
    }

    switch($opcion){
        
        case 1:
            
            echo "\n"."Ingrese el numero de documento de la persona a modificar: ";

            $numeroDoc = $verificar->soloInteg();//metodo que verifica que se un valor del tipo integ

            echo "\n"."ingrese el nuevo nombre de la persona: ";
                   
            $nuevoNombre = $verificar->esString();//metodo verifica que el valor sea solo tipo string

            echo "\n"."ingrese el nuevo apellido de la persona: ";
                    
            $nuevoApellido = $verificar->esString();//metodo verifica que el valor sea solo tipo string

            echo "\n"."ingrese el nuevo numero de documento de la persona: ";
            $nuevoDni = $verificar->soloInteg();//metodo que verifica que se un valor del tipo integ

            echo  "\n"."ingrese nuevo numero de telefono:";
            $nuevoTelefono = $verificar->soloInteg();//metodo que verifica que se un valor del tipo integ

            $modificacion = $datosViajes->modificarPasajero($nuevoNombre,$nuevoApellido,$nuevoDni,$nuevoTelefono,$numeroDoc); //retornara el indice donde se encuentra el pasajero dentro de la coleccion de pasajeros

            //usamos un una instruccion if para verificar si la modificacion se concreto o no
            if ( $modificacion >= 0 ){                         
                                                    
                echo "\n"."modificacion exitosa."."\n";
   
            }else{
                echo "no se encontro al pasajero."."\n";
            }

            break;

        case 2:

            echo "\n" ."ingrese nombre del pasajero: ";
            $nombre = $verificar->esString();
            echo "ingrese apellido del pasajero: ";
            $apellido = $verificar->esString();
            echo "ingrese nro de documento: ";
            $dni = $verificar->soloInteg();
            echo "ingrese numero de telefono: ";
            $telefono = $verificar->soloInteg();
            
            //instanciamos el objeto del nuevo pasajero con los datos ingresado por consola
            $objPasajeroAgregar = new pasajeros ( $nombre,$apellido,$dni,$telefono);
            
            $agregarPasajero = $datosViajes->agregarPasajero($objPasajeroAgregar);//metodo retorna un indice o -1 si no encontro indice en la coleccion de los pasajeros

            $contador = $datosViajes->get_cant_pasajeros();
            
            //con la instruccion if, verificamos si se pudo agregar al nuevo pasajero( el metodo agregarPasajero retorna -1 si el pasajero no se encuentra dentro de la coleccion)
            //por lo tanto si no esta en la lista se agregara al pasajero, y se retorna un indice de pasajero entonce no se agregara
            if ( $agregarPasajero == -1 && $contador < $datosViajes->get_cantMax_pasajeros()){
                echo "se agrego correctamente."."\n";
            }else{
                echo "ya se encuentra registrado o no hay lugares disponibles"."\n";
            }           

            break;

        case 3:

            echo "\n"."Ingrese el numero de empleado del responsable a modificar: ";

            $numeroEmpleado = $verificar->soloInteg();//metodo que verifica que se un valor del tipo integ

            echo "\n"."ingrese el nuevo nombre del responsable: ";
                   
            $nuevoNombre = $verificar->esString();//metodo verifica que el valor sea solo tipo string

            echo "\n"."ingrese el nuevo apellido del responsable: ";
                    
            $nuevoApellido = $verificar->esString();//metodo verifica que el valor sea solo tipo string

            echo "\n"."ingrese el nuevo numero de licencia del responsable: ";
            $nuevoNroLicencia = $verificar->soloInteg();//metodo que verifica que se un valor del tipo integ

            echo  "\n"."ingrese nuevo numero de empleado del responsable:";
            $nuevoNroEmpleado = $verificar->soloInteg();//metodo que verifica que se un valor del tipo integ

            $modificacion = $datosViajes->modificarResponsable($nuevoNroEmpleado,$nuevoNroLicencia,$nuevoNombre,$nuevoApellido,$numeroEmpleado); //retornara el indice donde se encuentra el pasajero dentro de la coleccion de pasajeros

            //usamos un una instruccion if para verificar si la modificacion se concreto o no

            if ( $modificacion >= 0 ){                         
                                                    
                echo "\n"."modificacion exitosa."."\n";
   
            }else{
                echo "no se encontro al responsable del viaje."."\n";
            }

            break;


        case 4:

            echo "\n" ."ingrese nombre del responsable: ";
            $nombre = $verificar->esString();
            echo "ingrese apellido del responsable: ";
            $apellido = $verificar->esString();
            echo "ingrese nro de empleado del responsable: ";
            $nroEmpleadoR = $verificar->soloInteg();
            echo "ingrese numero de licencia del responsable: ";
            $nroLicenciaR = $verificar->soloInteg();
            
            //instanciamos el objeto del nuevo pasajero con los datos ingresado por consola
            $objResponsableAgregar = new responsableV ( $nombre,$apellido,$nroEmpleadoR,$nroLicenciaR);
            
            $agregarResponsable = $datosViajes->agregarResponsable($objResponsableAgregar);//metodo retorna un indice o -1 si no encontro indice en la coleccion de los pasajeros

            $contador = $datosViajes->get_responsable_viaje ();
            
            //con la instruccion if, verificamos si se pudo agregar al nuevo pasajero( el metodo agregarPasajero retorna -1 si el pasajero no se encuentra dentro de la coleccion)
            //por lo tanto si no esta en la lista se agregara al pasajero, y se retorna un indice de pasajero entonce no se agregara
            if ( $agregarResponsable == -1 ){
                echo "se agrego correctamente."."\n";
            }else{
                echo "ya se encuentra registrado"."\n";
            }           

            break;


        case 5:

            echo "\n"."Ingrese el nuevo codigo de viaje: ";

            $nuevoCodViaje = $verificar->soloInteg();
           
            $datosViajes->set_codijo_viaje($nuevoCodViaje);//se usa el metodo set para actualizar los datos

            echo "\n"."Ingrese el nuevo destino del viaje: ";
                    
            $nuevoDestino =$verificar-> esString();

            $datosViajes->set_destino_viaje($nuevoDestino);//se usa el metodo set para actualizar los datos
                    

            echo "\n"."Ingrese una nueva cantidad maxima de pasajeros: ";
            $nuevaCantMaxPasaj = trim(fgets(STDIN));
            while(is_numeric($nuevaCantMaxPasaj) && $nuevaCantMaxPasaj <= 0){
                echo "ingrese  un numero mayor a 0: ";
                $nuevaCantMaxPasaj = trim(fgets(STDIN));
                        
            }

            $datosViajes->set_cantMax_pasajeros($nuevaCantMaxPasaj);//se usa el metodo set para actualizar los datos

            $nuevaCantPasaj = count($datosViajes->get_info_pasajeros ());

            $datosViajes->set_cant_pasajeros ($nuevaCantPasaj);//se usa el metodo set para actualizar los datos
                    
            break;

        case 6: 

                echo $datosViajes;/*metodo __toString*/

            break;
    }


}while($opcion != 7);

