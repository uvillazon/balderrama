<?php
function buscarplanillaempresa($idalmacen,$callback, $_dc, $return= 'true'){
    $dev['mensaje'] = "";
    $dev['error']   = "";
       $fechatoday = Date("Y-m-d");
$sqlcol = "
SELECT idkardex,mesrango,fechainicio FROM administrakardex where estado='pendiente' and idalmacen='$idalmacen'";

$result1 = findBySqlReturnCampoUnique($sql2, true, true, "mesrango");
    $mesplanilla = $result1['resultado'];
    $result1 = findBySqlReturnCampoUnique($sql2, true, true, "idkardex");
    $noplanillla = $result1['resultado'];

$sql = "SELECT idkardex,mesrango,fechainicio,'$fechatoday' AS fechafin,idalmacen FROM administrakardex WHERE estado='pendiente' and idalmacen='$idalmacen'";
  //echo $sql;
    if($idalmacen != null)
    {
        if($link=new BD)
        {
            if($link->conectar())
            {
                if($re = $link->consulta($sql))
                {
                    if($fi = mysql_fetch_array($re))
                    {
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            $value{mysql_field_name($re, $i)}= $fi[$i];

                        }


                        $dev['mensaje'] = "Existen resultados";
                        $dev['error']   = "true";
                        $dev['resultado'] = $value;
                    }
                    else
                    {
                        $dev['mensaje'] = "No se encontro datos en la consulta";
                        $dev['error']   = "false";
                        $dev['resultado'] = "";
                    }

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "No se pudo conectar a la BD";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else
        {
            $dev['mensaje'] = "No se pudo crear la conexion a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else
    {
        $dev['mensaje'] = "El codigo de usuario es nulo";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    $dev['totalCount'] = 1;

    if($return == true)
    {
        return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
}

function HabilitarParCaja($codigobarra,$idvendedor){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen = $_SESSION['idalmacen'];

 $sql3 = "SELECT kp.idalmacen FROM kardexdetallepar kp,modelo m where kp.idmodelo=m.idmodelo and m.idvendedor='$idvendedor' and kp.codigobarra='$codigobarra' and kp.saldocantidad='0' group by kp.codigobarra ";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idalmacen');
         $idalmacenorigen = $saldocantidadA1['resultado'];

$fecha = Date("Y-m-d");
  $sql32 = "SELECT Min(kp.idkardexunico) as numeropar FROM kardexdetallepar kp,modelo m where kp.idmodelo=m.idmodelo and m.idvendedor='$idvendedor' and kp.codigobarra='$codigobarra' and kp.saldocantidad='0' group by kp.codigobarra ";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql32,true, true, 'numeropar');
        $parminimo = $saldocantidadA1['resultado'];

        if($parminimo ==null || $parminimo==""){
        $sql31 = "SELECT SUM(kp.saldocantidad) as pares FROM kardexdetallepar kp,modelo m where kp.idmodelo=m.idmodelo and m.idvendedor='$idvendedor' and kp.codigobarra='$codigobarra' and kp.saldocantidad='1' group by kp.codigobarra ";
         $saldocantidadA1 = findBySqlReturnCampoUnique($sql31,true, true, 'pares');
         $cantidadexiste = $saldocantidadA1['resultado'];


     if($cantidadexiste > '0'){
            $mensaje= " Ya tiene cantidad: $cantidadexiste no requiere habilitacion";
      }else{
           $sql3 = "SELECT kp.idalmacen FROM kardexdetallepar kp,modelo m where kp.idmodelo=m.idmodelo and kp.codigobarra='$codigobarra' and kp.saldocantidad='0' and and kp.idalmacen!='$idalmacen' group by kp.codigobarra";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idalmacen');
         $idalmacenorigen = $saldocantidadA1['resultado'];

            $sql3 = "SELECT nombrecompleto FROM almacenes where idalmacen='$idalmacenorigen'";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'nombrecompleto');
         $nombrecompleto = $saldocantidadA1['resultado'];
          $mensaje= "Este par no se traspaso correctamente desde $nombrecompleto";
      }

           $dev['mensaje'] = "$mensaje";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;



       }else{

     
 $sql3 = "SELECT kp.* FROM kardexdetallepar kp,modelo m where kp.idmodelo=m.idmodelo and m.idvendedor='$idvendedor' and kp.codigobarra='$codigobarra' and kp.saldocantidad='0' and kp.idkardexunico='$parminimo'  ";

      $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idkardexunico');
         $idkardexunico = $saldocantidadA1['resultado'];
          $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idkardex');
         $idkardex = $saldocantidadA1['resultado'];
          $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idmodelo');
         $idmodelo = $saldocantidadA1['resultado'];
          $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'talla');
         $talla = $saldocantidadA1['resultado'];
          $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'preciounitario');
         $preciounitario = $saldocantidadA1['resultado'];

          $sql3 = "SELECT * FROM modelo where idmodelo='$idmodelo'";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idmarca');
         $idmarca = $saldocantidadA1['resultado'];
          $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idvendedor');
         $idvendedor = $saldocantidadA1['resultado'];

          $sql3 = "SELECT COUNT(kp.idkardexunico) as pares FROM kardexdetallepar kp,modelo m where kp.idmodelo=m.idmodelo and m.idvendedor='$idvendedor' and
   kp.idmodelo='$idmodelo' and kp.idkardex='$idkardex' and kp.saldocantidad='0' ";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'pares');
         $pares = $saldocantidadA1['resultado'];

$sql[] =getSqlNewPareshabilitados($idkardexunico, $fecha, $idkardex, $idmodelo, $talla, $idmarca, $idvendedor, $pares, $preciounitario, $preciototal,  false);
//$sql[] =getSqlNewBitacoradeleteventa($iditemventa, $idventa, $idkardex, $idkardexunico, $idmodelo, $cantidad, $talla, $preciofinal, $precioventa, $descuento, $descuentoporcentaje, $total, $estado, $devolucion, $tipomuestra, $idcliente, $fechacompra, $fecha, $hora, $idvendedor, $idalmacen, $boleta,  false);
$sql[] = "UPDATE kardexdetallepar kp,modelo m SET kp.saldocantidad='1',kp.idoperacion='no' WHERE kp.idmodelo=m.idmodelo and m.idvendedor='$idvendedor' and
   kp.idmodelo='$idmodelo' and kp.idkardex='$idkardex' and kp.saldocantidad='0'; ";

// MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se registro correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error";
        $dev['error'] = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
 }
}

function HabilitarPar($codigobarra,$idvendedor){
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $idalmacen = $_SESSION['idalmacen'];

// $sql3 = "SELECT kp.idalmacen FROM kardexdetallepar kp,modelo m where kp.idmodelo=m.idmodelo and m.idvendedor='$idvendedor' and kp.codigobarra='$codigobarra' and kp.saldocantidad='0' group by kp.codigobarra ";
//        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idalmacen');
//         $idalmacenorigen = $saldocantidadA1['resultado'];

        $sql32 = "SELECT Min(kp.idkardexunico) as numeropar FROM kardexdetallepar kp,modelo m where kp.idmodelo=m.idmodelo and m.idvendedor='$idvendedor' and kp.codigobarra='$codigobarra' and kp.saldocantidad='0' group by kp.codigobarra ";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql32,true, true, 'numeropar');
        $parminimo = $saldocantidadA1['resultado'];
       
        if($parminimo ==null || $parminimo==""){

         $sql31 = "SELECT SUM(kp.saldocantidad) as pares FROM kardexdetallepar kp,modelo m where kp.idmodelo=m.idmodelo and m.idvendedor='$idvendedor' and kp.codigobarra='$codigobarra' and kp.saldocantidad='1' group by kp.codigobarra ";
         $saldocantidadA1 = findBySqlReturnCampoUnique($sql31,true, true, 'pares');
         $cantidadexiste = $saldocantidadA1['resultado'];

     
     if($cantidadexiste > '0'){
            $mensaje= " Ya tiene cantidad: $cantidadexiste no requiere habilitacion";
      }else{
           $sql3 = "SELECT kp.idalmacen FROM kardexdetallepar kp,modelo m where kp.idmodelo=m.idmodelo and kp.codigobarra='$codigobarra' and kp.saldocantidad='0' and and kp.idalmacen!='$idalmacen' group by kp.codigobarra";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idalmacen');
         $idalmacenorigen = $saldocantidadA1['resultado'];
          
            $sql3 = "SELECT nombrecompleto FROM almacenes where idalmacen='$idalmacenorigen'";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'nombrecompleto');
         $nombrecompleto = $saldocantidadA1['resultado'];
          $mensaje= "Este par no se traspaso correctamente desde $nombrecompleto";
      }

           $dev['mensaje'] = "$mensaje";
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
            exit;



        }else{

$fecha = Date("Y-m-d");


        $sql3 = "SELECT kp.* FROM kardexdetallepar kp,modelo m where kp.idmodelo=m.idmodelo and m.idvendedor='$idvendedor' and kp.codigobarra='$codigobarra' and kp.saldocantidad='0' and kp.idkardexunico='$parminimo' group by kp.codigobarra ";
          $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idkardexunico');
         $idkardexunico = $saldocantidadA1['resultado'];
          $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idkardex');
         $idkardex = $saldocantidadA1['resultado'];
          $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idmodelo');
         $idmodelo = $saldocantidadA1['resultado'];
          $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'talla');
         $talla = $saldocantidadA1['resultado'];
          $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'preciounitario');
         $preciounitario = $saldocantidadA1['resultado'];

          $sql3 = "SELECT * FROM modelo where idmodelo='$idmodelo'";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idmarca');
         $idmarca = $saldocantidadA1['resultado'];
          $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'idvendedor');
         $idvendedor = $saldocantidadA1['resultado'];

          $sql3 = "SELECT COUNT(kp.idkardexunico) as pares FROM kardexdetallepar kp,modelo m where kp.idmodelo=m.idmodelo and m.idvendedor='$idvendedor' and
   kp.idmodelo='$idmodelo' and kp.idkardex='$idkardex' and kp.saldocantidad='0' and kp.idkardexunico='$parminimo'";
        $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'pares');
         $pares = $saldocantidadA1['resultado'];

$sql[] =getSqlNewPareshabilitados($idkardexunico, $fecha, $idkardex, $idmodelo, $talla, $idmarca, $idvendedor, $pares, $preciounitario, $preciototal,  false);
//$sql[] =getSqlNewBitacoradeleteventa($iditemventa, $idventa, $idkardex, $idkardexunico, $idmodelo, $cantidad, $talla, $preciofinal, $precioventa, $descuento, $descuentoporcentaje, $total, $estado, $devolucion, $tipomuestra, $idcliente, $fechacompra, $fecha, $hora, $idvendedor, $idalmacen, $boleta,  false);
$sql[] = "UPDATE kardexdetallepar kp,modelo m SET kp.saldocantidad='1',kp.idoperacion='no' WHERE kp.idmodelo=m.idmodelo and m.idvendedor='$idvendedor' and
   kp.idmodelo='$idmodelo' and kp.idkardex='$idkardex' and kp.codigobarra='$codigobarra' and kp.saldocantidad='0' and kp.idkardexunico='$parminimo' ; ";
         //ojito
 //MostrarConsulta($sql);
    if(ejecutarConsultaSQLBeginCommit($sql))
    {
        $dev['mensaje'] = "Se registro correctamente";
        $dev['error'] = "true";
        $dev['resultado'] = "";
    }
    else
    {
        $dev['mensaje'] = "Ocurrio un error";
        $dev['error'] = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {
        $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
  }
// }
}
function txNewEliminarModelo($resultado,$return)
{$fechaf = Date("Y-m-d");
      $idusuario = $_SESSION['idusuario'];
    $idalmacen = $_SESSION['idalmacen'];
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $ingreso = $resultado->ingreso;
    $idmarca = $ingreso->idmarca;
    //$idkardex = $ingreso->idkardex;
    $fecha = $ingreso->fecharegistro;
$usuario = $_SESSION['idusuario'];
    $fechareal = date("Y-m-d");
    $estado = "ACTIVO";
    $hora = date("H:i:s");
    $fecha = date("Y-m-d");
    $responsable = $_SESSION['idusuario'];
    $idalmacen = $_SESSION['idalmacen'];
    $sqlmarca = "SELECT mar.opcion,mar.opcionb,mar.pedido,mar.formatomayor FROM marcas mar WHERE mar.idmarca = '$idmarca'";
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcion");
    $opcion = $opcionA['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "pedido");
    $opcionpedido = $opcionA1['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "formatomayor");
    $formatomayor = $opcionA1['resultado'];

$calzados = $resultado->calzados;

    for($j=0;$j<count($calzados);$j++){
        $calzado = $calzados[$j];
        $idmodelo = $calzado->idmodelo;
    //   function getSqlNewBitacoradeletemodelo($idmodelo, $idkardexcaja, $idalmacen, $cantidad, $preciounitario, $preciototal, $estado, $fecha, $hora, $usuario, $idingreso, $return){
    $sqlmarca = "SELECT sum(saldocantidad) as cantidad,idkardex,idalmacen,preciounitario,idingreso FROM kardexdetallepar WHERE idmodelo = '$idmodelo' and saldocantidad!='0' group by idmodelo";
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "cantidad");
    $cantidad = $opcionA['resultado'];
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "idkardex");
    $idkardexcaja = $opcionA['resultado'];
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "idalmacen");
    $idalmacen = $opcionA['resultado'];
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "preciounitario");
    $preciounitario = $opcionA['resultado'];
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "idingreso");
    $idingreso = $opcionA['resultado'];
    $preciototal = $cantidad * $preciounitario;

$sql[] =getSqlNewBitacoradeletemodelo($idmodelo, $idkardexcaja, $idalmacen, $cantidad, $preciounitario, $preciototal, $estado, $fechareal, $hora, $idusuario, $idingreso,false);

$sql[] = "UPDATE kardexdetallepar SET saldocantidad='0' WHERE idmodelo='$idmodelo';";

  }
 $sql[] = "UPDATE color_marca SET existe='$estado' WHERE idcolor='col-308';";
//MostrarConsulta($sql);

  if(ejecutarConsultaSQLBeginCommit($sql)){
        $dev['mensaje'] = "Se eliminaron los modelos";
        $dev['error'] = "true";
        $dev['resultado'] = "edicion exitosa";
   }
   else
   {
        $dev['mensaje'] = "No existen cambios para guardar";
        $dev['error'] = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {   $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
}

function txNewUpdateDatosDetalleIngresoInventario($resultado,$return)
{$fechaf = Date("Y-m-d");
      $idusuario = $_SESSION['idusuario'];
    $idalmacen = $_SESSION['idalmacen'];
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $ingreso = $resultado->ingreso;
    $idmarca = $ingreso->idmarca;
    $idkardex = $ingreso->idkardex;
    $fecha = $ingreso->fecharegistro;
    $totalpares = $ingreso->totalpares;
    $totalbs = $ingreso->totalbs;
    $totalcajas = $ingreso->totalcaja;
    $fechareal = date("Y-m-d");
    $estado = "ACTIVO";
    $hora = date("H:i:s");
    $fecha = date("Y-m-d");
    $responsable = $_SESSION['idusuario'];
    $idalmacen = $_SESSION['idalmacen'];
    $sqlmarca = "SELECT mar.opcion,mar.opcionb,mar.pedido,mar.formatomayor FROM marcas mar WHERE mar.idmarca = '$idmarca'";
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcion");
    $opcion = $opcionA['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "pedido");
    $opcionpedido = $opcionA1['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "formatomayor");
    $formatomayor = $opcionA1['resultado'];

$calzados = $resultado->calzados;
 $numeroD = findUltimoID("adiciondetalleingreso", "numero", true);
    $numerodetalle = $numeroD['resultado'] +1;
     $numerokardexA = findUltimoID("adicionkardextienda", "numero", true);
    $numerokardex = $numerokardexA['resultado']+1;
    
    $numeromovimientokardexA = findUltimoID("adicionmovimientokardextienda", "numero", true);
    $numeromovimientokardex = $numeromovimientokardexA['resultado']+1;
    $cantidadvendido='0';
$calzados = $resultado->calzados;
 $numerokardexA1 = findUltimoID("kardexdetalle", "numero", true);
    $numerokardexdetalle = $numerokardexA1['resultado']+1;
    for($j=0;$j<count($calzados);$j++){
        $calzado = $calzados[$j];
        $idmodelo = $calzado->idmodelo;
        $codigo = $calzado->codigo;
        $color = $calzado->color;
        $material = $calzado->material;
        $cliente = $calzado->cliente;
        $vendedor = $calzado->vendedor;
       $fechaingreso = $calzado->fechai;
        $precioventa = $calzado->precio;
        $preciounitario = $calzado->preciounitario;
        $preciooficina = $calzado->preciooficina;
         $preciototalcaja = $calzado->totalparesbs;
        $numeroparesfila = $calzado->totalpares;
        $totalparescaja = $calzado->totalparescaja;
        $numerocajas = $calzado->totalcajas;
 $formatear1 = explode( '-' , $vendedor);
$nombrev = $formatear1[0];
$apellidov = $formatear1[1];
$sql1= "SELECT idempleado FROM empleados WHERE nombres='$nombrev' AND apellidos='$apellidov'";
$result1 = findBySqlReturnCampoUnique($sql1, true, true, "idempleado");
  $idvendedor = $result1['resultado'];
  $iddetalleingreso =$iddetalleingresonuevo;
  $tiporegistro = "nuevo";

 $planillaanterior= split("/",$cliente);
 $almacen=$planillaanterior[0];
$codciudad=$planillaanterior[1];
$sqlMarca = "SELECT * FROM almacenes WHERE nombre = '$almacen'";
    $codigomarcaA =findBySqlReturnCampoUnique($sqlMarca, true, true, "idalmacen");
    $iddestinoalmacen = $codigomarcaA['resultado'];
  if($iddestinoalmacen==null || $iddestinoalmacen==''){

  $sqlMarca = "SELECT idcliente FROM clientes WHERE codigo = '$almacen'";
    $codigomarcaA =findBySqlReturnCampoUnique($sqlMarca, true, true, "idcliente");
    $iddestinoalmacen = $codigomarcaA['resultado'];
  $idcliente = $iddestinoalmacen;
}else{
   $idcliente = $iddestinoalmacen;
}

$codigo = strtoupper($codigo);
$color = strtoupper($color);
$material = strtoupper($material);
if($color==null){$color="-";}
if($material==null){$material="-";}
$preciooficinaunidad=$preciooficina/12;

  $sql3 =" SELECT * FROM modelo WHERE idmodelo= '$idmodelo' ";
  $result1 = findBySqlReturnCampoUnique($sql3, true, true, "idvendedor");
  $idvendedor = $result1['resultado'];
  $result1 = findBySqlReturnCampoUnique($sql3, true, true, "idmarca");
  $idmarca = $result1['resultado'];
  $result1 = findBySqlReturnCampoUnique($sql3, true, true, "idingreso");
  $idingreso = $result1['resultado'];
  $result1 = findBySqlReturnCampoUnique($sql3, true, true, "generado");
  $generado = $result1['resultado'];
  $result1 = findBySqlReturnCampoUnique($sql3, true, true, "idcoleccion");
  $idcoleccion = $result1['resultado'];
  $idcliente = findBySqlReturnCampoUnique($sql3, true, true, "talla");
  $tipotalla = $result1['resultado'];
   $idcliente = findBySqlReturnCampoUnique($sql3, true, true, "precioventa");
  $precioventaanterior = $result1['resultado'];
   $idcliente = findBySqlReturnCampoUnique($sql3, true, true, "preciounitario");
  $precioventaunitarioanterior = $result1['resultado'];
  
 $sql3 =" SELECT SUM(saldocantidad) as pares,preciounitario FROM kardexdetallepar WHERE idmodelo= '$idmodelo' group by idmodelo";
  $result1 = findBySqlReturnCampoUnique($sql3, true, true, "pares");
  $sumpares = $result1['resultado'];
 
   $result1 = findBySqlReturnCampoUnique($sql3, true, true, "preciounitario");
  $ipreciou = $result1['resultado'];
  $precioanterior =$ipreciou*$sumpares;
   $precionuevo=$preciounitario*$sumpares;
  $diferencia= $precioanterior - $precionuevo;
$sql3 =" SELECT * FROM kardexcajas WHERE idmodelo= '$idmodelo' ";
$result1 = findBySqlReturnCampoUnique($sql3, true, true, "idkardex");
  $idkardex = $result1['resultado'];
$sql[] =getSqlNewKardexrebaja($idmodelo, $sumpares, $precioanterior, $precionuevo, $diferencia, $idvendedor, $idmarca, $idalmacen, $fecha, $idusuario,false);

//$sql[] = "UPDATE modelo SET codigo='$codigo',color='$color',material='$material',cliente='$cliente',idcliente='$idcliente',fechaingreso='$fechaingreso' WHERE idmodelo = '$idmodelo'; ";
$sql[] = "UPDATE modelo SET precioventa='$precioventa',preciounitario='$preciounitario',preciooficina='$preciooficina' ,preciobs='$preciooficinaunidad' WHERE idmodelo = '$idmodelo'; ";

$sql[] = "UPDATE kardexcajas SET precioventa='$precioventa',preciounitario='$preciounitario' WHERE idmodelo = '$idmodelo'; ";
$sql[] = "UPDATE kardexdetalle SET preciounitario='$preciounitario' WHERE idmodelo = '$idmodelo'; ";
$sql[] = "UPDATE kardexdetallepar SET preciounitario='$preciounitario',preciounitariobs='$preciooficinaunidad' WHERE idmodelo = '$idmodelo'; ";
 $sqlMarca = "SELECT precioventa FROM ventaitem WHERE idmodelo = '$idmodelo' group by idmodelo";
    $codigomarcaA =findBySqlReturnCampoUnique($sqlMarca, true, true, "precioventa");
    $precioventadet = $codigomarcaA['resultado'];
if($precioventadet=='0.00' || $precioventadet==0.00){
   $sql[] = "UPDATE ventaitem SET precioventa='$preciounitario',preciofinal='$preciounitario',total='$total',montoventafinal='$preciounitario' WHERE idmodelo = '$idmodelo'; ";
 
  }
  }
 $sql[] = "UPDATE color_marca SET existe='$estado' WHERE idcolor='col-308';";
//MostrarConsulta($sql);
  if(ejecutarConsultaSQLBeginCommit($sql)){
        $dev['mensaje'] = "Se guardaron y los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "edicion exitosa";
   }
   else
   {
        $dev['mensaje'] = "No existen cambios para guardar";
        $dev['error'] = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {   $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
}



function txNewUpdateDatosDetalleIngresoInventarioFeria($resultado,$return)
{$fechaf = Date("Y-m-d");
      $idusuario = $_SESSION['idusuario'];
    $idalmacen = $_SESSION['idalmacen'];
    $dev['mensaje'] = "";
    $dev['error'] = "false";
    $dev['resultado'] = "";
    $ingreso = $resultado->ingreso;
    $idmarca = $ingreso->idmarca;
    $idkardex = $ingreso->idkardex;
    $fecha = $ingreso->fecharegistro;
    $totalpares = $ingreso->totalpares;
    $totalbs = $ingreso->totalbs;
    $totalcajas = $ingreso->totalcaja;
    $fechareal = date("Y-m-d");
    $estado = "ACTIVO";
    $hora = date("H:i:s");
    $fecha = date("Y-m-d");
    $responsable = $_SESSION['idusuario'];
    $idalmacen = $_SESSION['idalmacen'];
    $sqlmarca = "SELECT mar.opcion,mar.opcionb,mar.pedido,mar.formatomayor FROM marcas mar WHERE mar.idmarca = '$idmarca'";
    $opcionA = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcion");
    $opcion = $opcionA['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "pedido");
    $opcionpedido = $opcionA1['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "formatomayor");
    $formatomayor = $opcionA1['resultado'];

$calzados = $resultado->calzados;
 $numeroD = findUltimoID("adiciondetalleingreso", "numero", true);
    $numerodetalle = $numeroD['resultado'] +1;
     $numerokardexA = findUltimoID("adicionkardextienda", "numero", true);
    $numerokardex = $numerokardexA['resultado']+1;

    $numeromovimientokardexA = findUltimoID("adicionmovimientokardextienda", "numero", true);
    $numeromovimientokardex = $numeromovimientokardexA['resultado']+1;
    $cantidadvendido='0';
$calzados = $resultado->calzados;
 $numerokardexA1 = findUltimoID("kardexdetalle", "numero", true);
    $numerokardexdetalle = $numerokardexA1['resultado']+1;
    for($j=0;$j<count($calzados);$j++){
        $calzado = $calzados[$j];
        $idmodelo = $calzado->idmodelo;
       
        $preciooficinaregistro = $calzado->preciooficina;
       
  $sql3 =" SELECT * FROM modelo WHERE idmodelo= '$idmodelo' ";
  $result1 = findBySqlReturnCampoUnique($sql3, true, true, "idvendedor");
  $idvendedor = $result1['resultado'];
  $result1 = findBySqlReturnCampoUnique($sql3, true, true, "idmarca");
  $idmarca = $result1['resultado'];
  $result1 = findBySqlReturnCampoUnique($sql3, true, true, "idingreso");
  $idingreso = $result1['resultado'];
  $result1 = findBySqlReturnCampoUnique($sql3, true, true, "generado");
  $generado = $result1['resultado'];
  $result1 = findBySqlReturnCampoUnique($sql3, true, true, "idcoleccion");
  $idcoleccion = $result1['resultado'];
  $idcliente = findBySqlReturnCampoUnique($sql3, true, true, "talla");
  $tipotalla = $result1['resultado'];
   $idcliente = findBySqlReturnCampoUnique($sql3, true, true, "precioventa");
  $precioventaanterior = $result1['resultado'];
   $idcliente = findBySqlReturnCampoUnique($sql3, true, true, "preciounitario");
  $precioventaunitarioanterior = $result1['resultado'];

 $sql3 =" SELECT SUM(saldocantidad) as pares,preciounitario FROM kardexdetallepar WHERE idmodelo= '$idmodelo' group by idmodelo";
  $result1 = findBySqlReturnCampoUnique($sql3, true, true, "pares");
  $sumpares = $result1['resultado'];

 
  $preciooficinabs =$preciooficinaregistro* $sumpares;
  $preciooficinaunidad = $preciooficinaregistro;
$sql[] = "UPDATE modelo SET preciooficina='$preciooficinabs' ,preciobs='$preciooficinabs' WHERE idmodelo = '$idmodelo'; ";
$sql[] = "UPDATE kardexdetallepar SET preciounitariobs='$preciooficinaunidad' WHERE idmodelo = '$idmodelo'; ";

  }
 $sql[] = "UPDATE color_marca SET existe='$estado' WHERE idcolor='col-308';";
//MostrarConsulta($sql);
  if(ejecutarConsultaSQLBeginCommit($sql)){
        $dev['mensaje'] = "Se guardaron y los datos";
        $dev['error'] = "true";
        $dev['resultado'] = "edicion exitosa";
   }
   else
   {
        $dev['mensaje'] = "No existen cambios para guardar";
        $dev['error'] = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {   $json = new Services_JSON();
        $output = $json->encode($dev);
        print($output);
    }
}
function editarparesportalla($idmarca ,$idcoleccion, $idmodelo,$idkardex,$idkardexdetalle,$tallakardex,$tallafin,$i,$cantidad1,$preciounitario,$idingreso,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
for($l=1;$l<=$cantidad1;$l++){
   $codigoregistrado = editarcodigoporpar($idmarca ,$idcoleccion, $idmodelo,$idkardex,$idingreso,$i,$preciounitario,$idkardexdetalle,$tallafin,$l,true);
    $codigoregistrado = $codigoregistrado['resultado'];
}

    $sql[] = "UPDATE colores SET codigo='1' WHERE idcolor = 'col-1';";
//MostrarConsulta($sql);
ejecutarConsultaSQLBeginCommit($sql);

}
function editarcodigoporpar($idmarca ,$idcoleccion, $idmodelo,$idkardex,$idingreso,$tallakardex,$preciounitario,$idkardexdetalle,$tallafin,$l,$return){
    $dev['error'] = "false";
    $dev['mensaje'] = "";
$tallaverifica=$tallakardex;
 $idalmacen = $_SESSION['idalmacen'];
 $codigobarraA = ObtenerCodigoBarraMarcaPar($idmarca ,$idcoleccion,$tallafin,$idmodelo,$idkardex, true);
    $codigobarracaja = $codigobarraA['resultado'];
    $codigobarraprevio =$codigobarracaja;
    //echo $codigobarraprevio;
     $sqlMarca = "SELECT idgrupo,opcionb frOM marcas WHERE idmarca = '$idmarca'";
    $codigomarcaA =findBySqlReturnCampoUnique($sqlMarca, true, true, "idgrupo");
    $idgrupo = $codigomarcaA['resultado'];
 $codigomarcaA =findBySqlReturnCampoUnique($sqlMarca, true, true, "opcionb");
    $opcionb = $codigomarcaA['resultado'];
    if($idgrupo=='1'){
     $codigobarraean13 = $codigobarraprevio.$tallakardex;
      }else{
        $codigobarraean13 = $codigobarraprevio.$tallafin;
      }

                $codigobarra1 = ean($codigobarraean13);
                $codigobarra = $codigobarraean13.$codigobarra1;
                if($opcionb=="2"){
                  switch ($tallakardex){
    case "34" :
     $order = "U";
    break;
   case "35" :
    $order = "XS";
    break;
      case "36" :
    $order = "S";
    break;
    case "37" :
    $order = "P";
    break;
    case "38" :
    $order = "M";
    break;
    case "39" :
    $order = "L";
    break;
     case "40" :
    $order = "XL";
    break;
    default:
      $order = $tallakardex;
        }
 $tallakardex=$order;
                }
            else{
                $tallakardex=$tallakardex;
            }
 $sqlA[] =getSqlNewKardexdetallepar($idkardexunico, $idkardex, $idkardexdetalle, $idmodelo, $idingreso, $codigobarra, '1', $tallakardex, $numero, $preciounitario, $idoperacion, $codigobarraean13, $generado, $unido, $fallado, $idperiodo, $idimpresion,$idalmacen,false);
//MostrarConsulta($sqlA);

ejecutarConsultaSQLBeginCommit($sqlA);

}

function actualizarsoloparesnulosmin($idkardex,$tallafin,$tallafinal1,$cantidad1,$iddetalleingreso,$idmodelodetalle,$return = false ){
  //  echo "entroooooo";

//$sqlA[] = "UPDATE adiciondetalleingresotalla SET cantidad='0', WHERE iddetalleingreso='$iddetalleingreso' AND talla='$tallafinal1';";
   $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='0',cantidad='0',generado='0'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND (talla='$tallafin' OR talla='$tallafinal1');";
  $sqlA[] = "UPDATE historialkardextienda SET saldocantidad='0',cantidad='0',generado='0'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' and idperiodo='3' AND (talla='$tallafin' OR talla='$tallafinal1');";

//MostrarConsulta($sqlA);
ejecutarConsultaSQLBeginCommit($sqlA);

}
function borrarrepetidosvaloresin($idmodelodetalle,$iddetalleingreso,$cantidadm,$iddetalleingreso,$tallafin,$tallafinal1,$talla1,$return = false ){
  //  $sql[] = "UPDATE adicionkardextienda SET precio2bs='$precionuevo' WHERE idcalzado = '$iddetalleingreso'; ";
 //$sql[] = "UPDATE historialkardextienda SET precio2bs='$precionuevo' WHERE idcalzado = '$iddetalleingreso'; ";
   $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='$cantidadm',cantidad='$cantidadm',generado='0' ,fallado='1'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND (talla='$tallafin' OR talla='$tallafinal1');";

//MostrarConsulta($sqlA);
  ejecutarConsultaSQLBeginCommit($sqlA);
}

function borrarrepetidosin($idmodelodetalle,$iddetalleingreso,$cantidad1,$iddetalleingreso,$tallafin,$tallafinal1,$return = false ){
  $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='$cantidad1',cantidad='$cantidad1',generado='0' ,fallado='1' WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafin';";
//  $sqlA[] = "UPDATE historialkardextienda SET saldocantidad='$cantidad1',cantidad='$cantidad1',generado='0',fallado='1'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafin';";

//$sqlA[] ="DELETE FROM adicionkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafin';";
//$sqlA[] ="DELETE FROM historialkardextienda WHERE idmodelodetalle= '$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafin';";

//$sqlA[] ="DELETE FROM adiciondetalleingresotalla WHERE iddetalleingreso='$iddetalleingreso' AND talla='$tallafinal1';";

//MostrarConsulta($sqlA);
  ejecutarConsultaSQLBeginCommit($sqlA);
}
function actualizarsoloparesnulossinmin($idkardex,$tallafinal,$tallafinal1,$cantidad1,$iddetalleingreso,$idmodelodetalle,$return = false ){
//$sqlA[] = "UPDATE adiciondetalleingresotalla SET cantidad='0', WHERE iddetalleingreso='$iddetalleingreso' AND talla='$tallafinal1';";
   $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='0',cantidad='0',generado='0'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafinal';";
  $sqlA[] = "UPDATE historialkardextienda SET saldocantidad='0',cantidad='0',generado='0'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafinal' and idperiodo='3';";

//MostrarConsulta($sqlA);
ejecutarConsultaSQLBeginCommit($sqlA);
}

function actualizarsoloparesmvaloresin($idkardex,$tallafinal1,$tallafinal,$cantidad1,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,$return = false ){
//($talla1,$tallam,$cantidadm,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,
//$sqlA[] = "UPDATE adiciondetalleingresotalla SET cantidad='$cantidad1' WHERE iddetalleingreso='$iddetalleingreso' AND talla='$tallafinal1';";
//   $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='$cantidad1',cantidad='$cantidad1',generado='0'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafinal';";
  $sqlA[] = "UPDATE historialkardextienda SET saldocantidad='$cantidad1',cantidad='$cantidad1',generado='0'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafinal' and idperiodo='3';";

   $sqlmarca = " SELECT tabla,mesrango,idperiodo,fechainicio,fechafin FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
    $tabla = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
    $mesrango = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
    $idperiodo = $opcionkardex['resultado'];
      $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechainicio");
    $fechain = $opcionkardex['resultado'];
     $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechafin");
    $fechafin = $opcionkardex['resultado'];
    if($fechafin==null ||$fechafin == ""){
    $fechaf = Date("Y-m-d");}

$select1 = "SUM(i.cantidad) AS Pares";
    $from1 = "itemventa i,adicionkardextienda k, ventasdetalle vent";
    $where1 = "k.idcalzado = '$iddetalleingreso' AND i.idventa=vent.idventadetalle AND i.idkardextienda=k.idkardextienda AND
k.talla='$talla' AND vent.fecha >= '$fechain'AND vent.fecha <= '$fechaf' and i.estado!='cambiado' ";
     $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1;
     $almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'Pares');
    $pares1 = $almacenA1['resultado'];
     if($pares1==NULL || $pares1 =='' || $pares1 == ""){ $pares1="0"; }
 if($pares1=='0' ||$pares1==0){
   //$sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='$cantidad1',cantidad='$cantidad1',generado='0'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafinal';";

     $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='$cantidad1',cantidad='$cantidad1' WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$talla';";

 } else{

 $cantidad1=$cantidad1-$pares1;
   $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='$cantidad1',cantidad='$cantidad1',generado='0'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafinal';";

// $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='$cantidad1',cantidad='$cantidad1' WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$talla';";
}


//MostrarConsulta($sqlA);
  ejecutarConsultaSQLBeginCommit($sqlA);

}

function actualizarsoloparesnulosin($idkardex,$talla,$cantidad1,$iddetalleingreso,$idmodelodetalle,$return = false ){
//$sqlA[] = "UPDATE adiciondetalleingresotalla SET cantidad='$cantidad1' WHERE iddetalleingreso='$iddetalleingreso' AND talla='$talla';";
   $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='$cantidad1',cantidad='$cantidad1' WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$talla';";
  $sqlA[] = "UPDATE historialkardextienda SET saldocantidad='$cantidad1',cantidad='$cantidad1' WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$talla' and idperiodo='3';";

//MostrarConsulta($sqlA);
 ejecutarConsultaSQLBeginCommit($sqlA);
}
function actualizarsoloparesin($idkardex,$talla,$cantidad1,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,$return = false ){
//$sqlA[] = "UPDATE adiciondetalleingresotalla SET cantidad='$cantidad1' WHERE iddetalleingreso='$iddetalleingreso' AND talla='$talla';";

 // $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='$cantidad1',cantidad='$cantidad1' WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$talla';";
 $sqlA[] = "UPDATE historialkardextienda SET saldocantidad='$cantidad1',cantidad='$cantidad1' WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$talla' and idperiodo='3';";
     $sqlmarca = " SELECT tabla,mesrango,idperiodo,fechainicio,fechafin FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
    $tabla = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
    $mesrango = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
    $idperiodo = $opcionkardex['resultado'];
      $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechainicio");
    $fechain = $opcionkardex['resultado'];
     $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechafin");
    $fechafin = $opcionkardex['resultado'];
    if($fechafin==null ||$fechafin == ""){
    $fechaf = Date("Y-m-d");}

$select1 = "SUM(i.cantidad) AS Pares";
    $from1 = "itemventa i,adicionkardextienda k, ventasdetalle vent";
    $where1 = "k.idcalzado = '$iddetalleingreso' AND i.idventa=vent.idventadetalle AND i.idkardextienda=k.idkardextienda AND
k.talla='$talla' AND vent.fecha >= '$fechain'AND vent.fecha <= '$fechaf' and i.estado!='cambiado' ";
     $sql21 = "SELECT ".$select1." FROM ".$from1. " WHERE ".$where1;
     $almacenA1 =  findBySqlReturnCampoUnique($sql21, true, true, 'Pares');
    $pares1 = $almacenA1['resultado'];
     if($pares1==NULL || $pares1 =='' || $pares1 == ""){ $pares1="0"; }
 if($pares1=='0' ||$pares1==0){

     $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='$cantidad1',cantidad='$cantidad1' WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$talla';";

 } else{

 $cantidad1=$cantidad1-$pares1;
  $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='$cantidad1',cantidad='$cantidad1' WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$talla';";
}
//MostrarConsulta($sqlA);
ejecutarConsultaSQLBeginCommit($sqlA);

}
function ListarDetallePedidoLineaModeloColorinventario($start, $limit, $sort, $dir, $callback, $_dc, $idmarca,$idestilo,$idkardex, $return = false){

    if($start == null)
    {
        $start = 0;
    }
    if($limit == null)
    {
        $limit = 100;
    }
    if($sort != null)
    {
        $order = "ORDER BY $sort ";
        if($dir != null)
        {
            $order .= " $dir ";
        }
    }
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
 $sqlmarca = "
SELECT
  mar.talla,mar.opcionb
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
         $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];
     if($talla == "14-38"){
      $opcion = "2";

    }
      if($talla == "33-45"){
      $opcion = "2";
    }
      if($talla == "1-12"){
      $opcion = "1";
    }

    $sqlmarca = " SELECT tabla,mesrango,idperiodo,fechainicio,fechafin FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
    $tabla = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
    $mesrango = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
    $idperiodo = $opcionkardex['resultado'];
   // echo $tabla;
if($tabla=="historialkardextienda"){

          if($opcionb=="3"){


$sql ="
SELECT dtp.iddetalleingreso,mdd.codigo AS codigo, l.codigo AS linea,dtp.opciont, sum(k.saldocantidad)AS totalpares, dtp.totalbs AS precio, dtp.material,dtp.color, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp,historialkardextienda k, modelos mdd, coleccion col, lineas l, estilos es
WHERE dtp.idmodelo = mdd.idmodelo and dtp.iddetalleingreso=k.idcalzado
AND mdd.idcoleccion = col.idcoleccion
AND mdd.stylename = es.idestilo
AND mdd.idlinea = l.idlinea
AND mdd.idmarca = '$idmarca'
AND mdd.stylename = '$idestilo' AND dtp.inventario='0' AND k.idperiodo='$idperiodo' group by dtp.iddetalleingreso ORDER BY l.codigo ASC,CAST( `mdd`.`codigo` AS SIGNED) ASC,dtp.opciont ASC
";
   }else{
   $sql ="
SELECT dtp.iddetalleingreso,mdd.codigo AS codigo, l.codigo AS linea, sum(k.saldocantidad)AS totalpares, dtp.totalbs AS precio, dtp.material,dtp.color, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp, modelos mdd, historialkardextienda k,coleccion col, lineas l, estilos es
WHERE dtp.idmodelo = mdd.idmodelo and dtp.iddetalleingreso=k.idcalzado
AND mdd.idcoleccion = col.idcoleccion
AND mdd.stylename = es.idestilo
AND mdd.idlinea = l.idlinea
AND mdd.idmarca = '$idmarca'
AND mdd.stylename = '$idestilo' AND dtp.inventario='0' AND k.idperiodo='$idperiodo' group by dtp.iddetalleingreso ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC
";
   }
}else{
 if($opcionb=="3"){


$sql ="
SELECT dtp.iddetalleingreso,mdd.codigo AS codigo, l.codigo AS linea,dtp.opciont, sum(k.saldocantidad)AS totalpares, dtp.totalbs AS precio, dtp.material,dtp.color, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp,adicionkardextienda k, modelos mdd, coleccion col, lineas l, estilos es
WHERE dtp.idmodelo = mdd.idmodelo and dtp.iddetalleingreso=k.idcalzado
AND mdd.idcoleccion = col.idcoleccion
AND mdd.stylename = es.idestilo
AND mdd.idlinea = l.idlinea
AND mdd.idmarca = '$idmarca'
AND mdd.stylename = '$idestilo' AND dtp.inventario='0' AND  k.unido='no' group by dtp.iddetalleingreso ORDER BY l.codigo ASC,CAST( `mdd`.`codigo` AS SIGNED) ASC,dtp.opciont ASC
";
   }else{
   $sql ="
SELECT dtp.iddetalleingreso,mdd.codigo AS codigo, l.codigo AS linea, sum(k.saldocantidad)AS totalpares, dtp.totalbs AS precio, dtp.material,dtp.color, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp, modelos mdd,adicionkardextienda k,coleccion col, lineas l, estilos es
WHERE dtp.idmodelo = mdd.idmodelo and dtp.iddetalleingreso=k.idcalzado
AND mdd.idcoleccion = col.idcoleccion
AND mdd.stylename = es.idestilo
AND mdd.idlinea = l.idlinea
AND mdd.idmarca = '$idmarca'
AND mdd.stylename = '$idestilo' AND dtp.inventario='0' AND  k.unido='no' group by dtp.iddetalleingreso ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC
";
   }
}
  
         //  echo $sql;
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
                    $dev['totalCount'] = mysql_num_rows($re);
                    $ii = 0;
                    do{

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {

                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                            if(mysql_field_name($re, $i) == "iddetalleingreso"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];
if($tabla=="historialkardextienda"){
                                $sqld = "
SELECT ta.talla, ad.saldocantidad AS cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN historialkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN historialkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL
     ";
}else{
                                   $sqld = "
SELECT ta.talla, ad.saldocantidad AS cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN adicionkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN adicionkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL
     ";

}

                                //                                 $value{$ii}{mysql_field_name($re, $i)}= '222';

                                  //                            echo   $sqld;
                                if($re1 = $link->consulta($sqld))
                                {

                                    if($fi1 = mysql_fetch_array($re1))
                                    {
                                        //                                         echo "jla";
                                        //                                        $tallas = mysql_num_rows($re1)."ll";
                                        //                                        echo $tallas;
                                        do{

                                            for($j = 0; $j< mysql_num_fields($re1); $j++)
                                            {
                                                //                                                echo ".".$j;
                                                $value{$ii}{$fi1[0]}= $fi1[1];
                                                //                                               $value{$ii}{mysql_field_name($re1, $j)}= '222';
                                            }
                                        }while($fi1 = mysql_fetch_array($re1));



                                    }
                                    //                            $id
                                    //                            $value{$ii}{mysql_field_name($re, $i)}= '222';

                                }
                            }
                        }

                        $ii++;
                    }while($fi = mysql_fetch_array($re));
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $value;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "No existe un usuario con estos datos";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else
        {
            $dev['mensaje'] = "No se pudo conectar a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else
    {
        $dev['mensaje'] = "No se pudo crear la conexion a la BD";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {

        if($callback == null || $callback == "")
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }


    }
}
function ListarDetallePedidoMaterialinventario($start, $limit, $sort, $dir, $callback, $_dc, $idmarca,$idestilo,$idkardex, $return = false){

    if($start == null)
    {
        $start = 0;
    }
    if($limit == null)
    {
        $limit = 100;
    }
    if($sort != null)
    {
        $order = "ORDER BY $sort ";
        if($dir != null)
        {
            $order .= " $dir ";
        }
    }
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

 $sqlmarca = "
SELECT
  mar.talla,mar.opcionb
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];

     if($talla == "14-38"){
      $opcion = "2";
    }
      if($talla == "33-45"){
      $opcion = "2";
    }
      if($talla == "1-12"){
      $opcion = "1";
    }
    //echo $opcion;WESTCOAST
$sqlmarca = " SELECT tabla,mesrango,idperiodo,fechainicio,fechafin FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
    $tabla = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
    $mesrango = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
    $idperiodo = $opcionkardex['resultado'];

if($tabla=="historialkardextienda"){

$sql ="
SELECT dtp.iddetalleingreso,mdd.codigo AS codigo, sum(k.saldocantidad)AS totalpares,  dtp.totalbs AS precio,dtp.color, dtp.material, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp,historialkardextienda k, modelos mdd, coleccion col, estilos es
WHERE dtp.iddetalleingreso=k.idcalzado and dtp.idmodelo = mdd.idmodelo
AND mdd.idcoleccion = col.idcoleccion
AND mdd.stylename = es.idestilo
AND mdd.idmarca = '$idmarca'
AND mdd.stylename = '$idestilo' AND dtp.inventario='0' AND  k.unido='no' AND k.idperiodo='$idperiodo' group by dtp.iddetalleingreso ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC
";

}else{
$sql ="
SELECT dtp.iddetalleingreso,mdd.codigo AS codigo, sum(k.saldocantidad)AS totalpares,  dtp.totalbs AS precio,dtp.color, dtp.material, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp,adicionkardextienda k, modelos mdd, coleccion col, estilos es
WHERE dtp.iddetalleingreso=k.idcalzado and dtp.idmodelo = mdd.idmodelo
AND mdd.idcoleccion = col.idcoleccion
AND mdd.stylename = es.idestilo
AND mdd.idmarca = '$idmarca'
AND mdd.stylename = '$idestilo' AND dtp.inventario='0' AND  k.unido='no'group by dtp.iddetalleingreso ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC
";

}
  

      //      echo $sql;
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
                    $dev['totalCount'] = mysql_num_rows($re);
                    $ii = 0;
                    do{

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {

                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                            if(mysql_field_name($re, $i) == "iddetalleingreso"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];
       if($tabla=="historialkardextienda"){
if($opcionb=="7"){
$sqld = "  SELECT ta.talla, ad.saldocantidad AS cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN historialkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso' GROUP BY ta.talla
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN historialkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL ";
}else{
      $sqld = "  SELECT ta.talla, ad.saldocantidad AS cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN historialkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN historialkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL";
}
       }else{
           if($opcionb=="7"){
$sqld = "  SELECT ta.talla, ad.saldocantidad AS cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN adicionkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso' GROUP BY ta.talla
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN adicionkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL ";
}else{
      $sqld = "  SELECT ta.talla, ad.saldocantidad AS cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN adicionkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN adicionkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL";
}
       }
//echo $sqld;
              if($re1 = $link->consulta($sqld))
                                {

                                    if($fi1 = mysql_fetch_array($re1))
                                    {
                                        //                                         echo "jla";
                                        //                                        $tallas = mysql_num_rows($re1)."ll";
                                        //                                        echo $tallas;
                                        do{

                                            for($j = 0; $j< mysql_num_fields($re1); $j++)
                                            {
                                                //                                                echo ".".$j;
                                                $value{$ii}{$fi1[0]}= $fi1[1];
                                                //                                               $value{$ii}{mysql_field_name($re1, $j)}= '222';
                                            }
                                        }while($fi1 = mysql_fetch_array($re1));



                                    }
                                    //                            $id
                                    //                            $value{$ii}{mysql_field_name($re, $i)}= '222';

                                }
                            }
                        }

                        $ii++;
                    }while($fi = mysql_fetch_array($re));
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $value;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "No existe un usuario con estos datos";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else
        {
            $dev['mensaje'] = "No se pudo conectar a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else
    {
        $dev['mensaje'] = "No se pudo crear la conexion a la BD";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {

        if($callback == null || $callback == "")
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }


    }
}

function ListarDetallePedidoinventario($start, $limit, $sort, $dir, $callback, $_dc, $idmarca,$idestilo,$idkardex, $return = false){

    if($start == null)
    {
        $start = 0;
    }
    if($limit == null)
    {
        $limit = 100;
    }
    if($sort != null)
    {
        $order = "ORDER BY $sort ";
        if($dir != null)
        {
            $order .= " $dir ";
        }
    }
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

 $sqlmarca = "
SELECT
  mar.talla,mar.opcionb
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];

     if($talla == "14-38"){
      $opcion = "2";
    }
      if($talla == "33-45"){
      $opcion = "2";
    }
      if($talla == "1-12"){
      $opcion = "1";
    }
    //echo $opcion;WESTCOAST
$sqlmarca = " SELECT tabla,mesrango,idperiodo,fechainicio,fechafin FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
    $tabla = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
    $mesrango = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
    $idperiodo = $opcionkardex['resultado'];

if($tabla=="historialkardextienda"){

    $sql ="
SELECT dtp.iddetalleingreso,mdd.codigo AS codigo, sum(k.saldocantidad)AS totalpares,  dtp.totalbs AS precio,dtp.color, dtp.material, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp,historialkardextienda k, modelos mdd, coleccion col, estilos es
WHERE dtp.iddetalleingreso=k.idcalzado and dtp.idmodelo = mdd.idmodelo
AND mdd.idcoleccion = col.idcoleccion
AND mdd.stylename = es.idestilo
AND mdd.idmarca = '$idmarca'
AND mdd.stylename = '$idestilo' AND dtp.inventario='0' AND k.idperiodo='$idperiodo' group by dtp.iddetalleingreso ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC
";

}else{
 $sql ="
SELECT dtp.iddetalleingreso,mdd.codigo AS codigo, sum(k.saldocantidad)AS totalpares,  dtp.totalbs AS precio,dtp.color, dtp.material, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp,adicionkardextienda k, modelos mdd, coleccion col, estilos es
WHERE dtp.iddetalleingreso=k.idcalzado and dtp.idmodelo = mdd.idmodelo
AND mdd.idcoleccion = col.idcoleccion
AND mdd.stylename = es.idestilo
AND mdd.idmarca = '$idmarca'
AND mdd.stylename = '$idestilo' AND dtp.inventario='0' group by dtp.iddetalleingreso ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC
";
}

 


             // echo $sql;
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
                    $dev['totalCount'] = mysql_num_rows($re);
                    $ii = 0;
                    do{

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {

                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                            if(mysql_field_name($re, $i) == "iddetalleingreso"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];
if($tabla=="historialkardextienda"){
if($opcionb=="7"){
$sqld = "  SELECT ta.talla, SUM(ad.saldocantidad) AS cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN historialkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso' GROUP BY ta.talla
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN historialkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL ";
}else{
      $sqld = "  SELECT ta.talla, ad.saldocantidad AS cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN historialkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN historialkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL";
}
}else{
  if($opcionb=="7"){
$sqld = "  SELECT ta.talla, SUM(ad.saldocantidad) AS cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN adicionkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso' GROUP BY ta.talla
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN adicionkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL ";
}else{
      $sqld = "  SELECT ta.talla, ad.saldocantidad AS cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN adicionkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN adicionkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL";
}

}
//echo $sqld;
              if($re1 = $link->consulta($sqld))
                                {

                                    if($fi1 = mysql_fetch_array($re1))
                                    {
                                        //                                         echo "jla";
                                        //                                        $tallas = mysql_num_rows($re1)."ll";
                                        //                                        echo $tallas;
                                        do{

                                            for($j = 0; $j< mysql_num_fields($re1); $j++)
                                            {
                                                //                                                echo ".".$j;
                                                $value{$ii}{$fi1[0]}= $fi1[1];
                                                //                                               $value{$ii}{mysql_field_name($re1, $j)}= '222';
                                            }
                                        }while($fi1 = mysql_fetch_array($re1));



                                    }
                                    //                            $id
                                    //                            $value{$ii}{mysql_field_name($re, $i)}= '222';

                                }
                            }
                        }

                        $ii++;
                    }while($fi = mysql_fetch_array($re));
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $value;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "No existe un usuario con estos datos";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else
        {
            $dev['mensaje'] = "No se pudo conectar a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else
    {
        $dev['mensaje'] = "No se pudo crear la conexion a la BD";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {

        if($callback == null || $callback == "")
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }


    }
}
function ListarDetallePedidoMaterialColorinventario($start, $limit, $sort, $dir, $callback, $_dc, $idmarca,$idalm,$idkardex,$modelo,$idcliente,$idvendedor,$item, $return = false){
//echo $idmarca;
  $idalmacen = $_SESSION['idalmacen'];
    if($start == null)
    {
        $start = 0;
    }
    if($limit == null)
    {
        $limit = 100;
    }
    if($sort != null)
    {
        $order = "ORDER BY $sort ";
        if($dir != null)
        {
            $order .= " $dir ";
        }
    }
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
//$gestion,$idcliente,$idvendedor,
 $sqlmarca = "
SELECT
  mar.talla
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
     if($talla == "14-38"){ $opcion = "2";  }
      if($talla == "33-45"){$opcion = "2"; }
      if($talla == "33-42"){$opcion = "2";  }
      if($talla == "1-12"){ $opcion = "1";  }
   
    $idalmacen = $_SESSION['idalmacen'];
 $sqlmarca = " SELECT mar.opcionb,mar.formatomayor,mar.idgrupo FROM marcas mar WHERE mar.idmarca = '$idmarca' ";
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];
   $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "formatomayor");
    $formatomayor = $opcionA1['resultado'];
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "idgrupo");
    $idgrupo = $opcionA1['resultado'];

    $sqlmarca = " SELECT tabla,mesrango,idperiodo,fechainicio,fechafin FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
    $tabla = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
    $mesrango = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
    $idperiodo = $opcionkardex['resultado'];

   //  String[] nombreCaso52Columns = {"idmodelo", "codigo", "material","cliente", "totalcajas","precio",yy "-" MM "-" DD "preciounitario","talla","5", "5m", "6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12",  "totalpares","totalparescaja",  "totalparesbs"};

switch($formatomayor){
  case '7':
        $select ="mdd.idmodelo,mdd.preciooficina,  mdd.codigo,CONCAT( e.nombres, '-', e.apellidos) AS vendedor,
 mdd.color,mdd.material,mdd.cliente,mdd.talla,  mdd.precioventa AS precio, mdd.numerocajas as totalcajas,SUM( kp.preciounitario * kp.saldocantidad ) AS totalparesbs, SUM( kp.saldocantidad ) AS totalparescaja, SUM( kp.saldocantidad ) AS totalpares,kp.preciounitario,mdd.fechaingreso as fecha,mdd.talla";
$from = "modelo mdd,kardexdetallepar kp,empleados e";
 $where = "kp.idmodelo=mdd.idmodelo and mdd.idvendedor=e.idempleado
AND mdd.idmarca = '$idmarca'
AND mdd.estado ='Activo' AND mdd.idalmacen='$idalmacen' ";
  if($idcliente!=null || $idcliente!=""){
     $sqlmarca = " SELECT i.boleta FROM modelo mdd,kardexdetallepar kp,ingresoalmacen i,almacenes a WHERE kp.idmodelo=mdd.idmodelo and kp.idingreso=i.idingreso and i.idalmacen=a.idalmacen
     AND mdd.idmarca = '$idmarca' and i.boleta='$idcliente' GRoup by i.idingreso";
     $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "boleta");
     $boletaalmacen = $opcionkardex['resultado'];
     if($boletaalmacen !=null || $boletaalmacen!=""){
     $from .= ",ingresoalmacen ing";
     $where .= "and mdd.idingreso=ing.idingreso and ing.boleta='$idcliente'";
     }else{
     $from .= ",proformas p";
     $where .= "and mdd.boleta=p.id_proforma and p.nombre='$idcliente'";
      }
  }
    if($idvendedor!=null || $idvendedor!=""){
     $where .= "and mdd.idvendedor='$idvendedor'";
  }
  if($modelo!=null || $modelo!=""){
     $where .= "and mdd.codigo LIKE '%".$modelo."%'";
  }
  if($item!=null || $item!=""){
     $where .= "and mdd.cliente ='$item'";
  }
 $order = " GROUP by kp.idmodelo HAVING SUM( kp.saldocantidad ) >0 ORDER BY mdd.talla,mdd.codigo,mdd.color ASC";
   break;

   case '11':
          $select ="mdd.idmodelo,mdd.preciooficina, mdd.codigo,CONCAT( e.nombres, '-', e.apellidos) AS vendedor,
 mdd.color,mdd.material,mdd.cliente,mdd.talla,  mdd.precioventa AS precio, mdd.numerocajas as totalcajas,SUM( kp.preciounitario * kp.saldocantidad ) AS totalparesbs, SUM( kp.saldocantidad ) AS totalparescaja, SUM( kp.saldocantidad ) AS totalpares,kp.preciounitario,mdd.fechaingreso as fecha,mdd.talla";
$from = "modelo mdd,kardexdetallepar kp,empleados e";
 $where = "kp.idmodelo=mdd.idmodelo and mdd.idvendedor=e.idempleado
AND mdd.idmarca = '$idmarca'
AND mdd.estado ='Activo' AND mdd.idalmacen='$idalmacen' ";

 if($idcliente!=null || $idcliente!=""){
     $sqlmarca = " SELECT i.boleta FROM ingresoalmacen i, kardexdetallepar kp WHERE
 i.idingreso = kp.idingreso AND i.idmarca = '$idmarca' and i.boleta='$idcliente' GRoup by kp.idingreso";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "boleta");
    $boletaalmacen = $opcionkardex['resultado'];
    if($boletaalmacen !=null || $boletaalmacen!=""){
         $from .= ",ingresoalmacen ing";
     $where .= "and mdd.idingreso=ing.idingreso and ing.boleta='$idcliente'";
     }else{
  
         $from .= ",proformas p";
     $where .= "and mdd.boleta=p.id_proforma and p.nombre='$idcliente'";
      }
  }

    if($idvendedor!=null || $idvendedor!=""){
     $where .= "and mdd.idvendedor='$idvendedor'";
  }

    if($modelo!=null || $modelo!=""){
     $where .= "and mdd.codigo LIKE '%".$modelo."%'";
  }
  if($item!=null || $item!=""){
     $where .= "and mdd.cliente ='$item'";
  }
   $order = " GROUP by kp.idmodelo HAVING SUM( kp.saldocantidad ) >0 ORDER BY mdd.talla,mdd.codigo,mdd.color ASC";
    break;
//aqui
   default:

$select ="mdd.idmodelo, mdd.preciooficina,mdd.codigo,CONCAT( e.nombres, '-', e.apellidos) AS vendedor,
 mdd.color,mdd.material,mdd.cliente,mdd.talla,  mdd.precioventa AS precio, mdd.numerocajas as totalcajas,SUM( kp.preciounitario * kp.saldocantidad ) AS totalparesbs, SUM( kp.saldocantidad ) AS totalparescaja, SUM( kp.saldocantidad ) AS totalpares,kp.preciounitario,mdd.fechaingreso as fecha,mdd.talla";
$from = "modelo mdd,kardexdetallepar kp,empleados e";
 $where = "kp.idmodelo=mdd.idmodelo and mdd.idvendedor=e.idempleado
AND mdd.idmarca = '$idmarca'
AND mdd.estado ='Activo' AND mdd.idalmacen='$idalmacen' ";
   if($idcliente!=null || $idcliente!=""){
     $sqlmarca = " SELECT i.boleta FROM ingresoalmacen i, kardexdetallepar kp WHERE
 i.idingreso = kp.idingreso AND i.idmarca = '$idmarca' and i.boleta='$idcliente' GRoup by kp.idingreso";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "boleta");
    $boletaalmacen = $opcionkardex['resultado'];
    if($boletaalmacen !=null || $boletaalmacen!=""){
         $from .= ",ingresoalmacen ing";
     $where .= "and mdd.idingreso=ing.idingreso and ing.boleta='$idcliente'";
     }else{

         $from .= ",proformas p";
     $where .= "and mdd.boleta=p.id_proforma and p.nombre='$idcliente'";
      }
  }

    if($idvendedor!=null || $idvendedor!=""){
     $where .= "and mdd.idvendedor='$idvendedor'";
  }

  if($modelo!=null || $modelo!=""){
     $where .= "and mdd.codigo LIKE '%".$modelo."%'";
  }
  if($item!=null || $item!=""){
     $where .= "and mdd.cliente ='$item'";
  }
   $order = " GROUP by kp.idmodelo HAVING SUM( kp.saldocantidad ) >0 ORDER BY mdd.codigo ASC";
       break;
}
 //$sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where;
 $sql = "SELECT ".$select." FROM ".$from. " WHERE ".$where." ".$order;

//echo $sql;
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
                    $dev['totalCount'] = mysql_num_rows($re);
                    $ii = 0;
                    do{

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {

                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                            if(mysql_field_name($re, $i) == "idmodelo"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];

$sqle="SELECT  SUM(karp.saldocantidad) AS totalpares FROM `modelo` mdd,
kardexdetallepar karp WHERE karp.idmodelo = mdd.idmodelo
and mdd.idmodelo='$iddetalleingreso' ";
 $opcionA1 = findBySqlReturnCampoUnique($sqle, true, true, "totalpares");
    $pares= $opcionA1['resultado'];
    $sqle="SELECT mdd.numerocajas FROM `modelo` mdd WHERE mdd.idmodelo='$iddetalleingreso' ";
 $opcionA1 = findBySqlReturnCampoUnique($sqle, true, true, "numerocajas");
    $cajasram= $opcionA1['resultado'];

    if($idmarca=="mar-1"){
              $cajas = $cajasram;
              $caja=$cajas;
            if($pares > 9){
                $caja=$cajas;
            }else{
               $caja='1';
            }
    }else{
     $cajas = $pares /12;
    if($pares > 12){
        $caja =$cajas;
    }else{
       $caja='1';
    }
    }
   
   if($idgrupo=="2"){
//    $sqlmarca = " SELECT talla FROM modelo WHERE idmodelo = '$fi[$i]' ";
//      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
//    $talla = $opcionA1['resultado'];
  $sqld = "  SELECT ad.talla as tallakardex, ROUND((SUM(ad.saldocantidad)/$caja)) AS cantidad
FROM 
 kardexdetallepar ad where ad.idmodelo = '$fi[$i]' Group by ad.talla
";


}else{

if($idmarca=="mar-1"){
  $sqld = "  SELECT ad.talla as tallakardex, (SUM(ad.saldocantidad)/$caja) AS cantidad
FROM  kardexdetallepar ad where ad.idmodelo = '$fi[$i]' Group by ad.talla ";

    }else{
  $sqld = "  SELECT ad.talla as tallakardex, ROUND((SUM(ad.saldocantidad)/$caja)) AS cantidad
FROM kardexdetallepar ad where ad.idmodelo = '$fi[$i]' Group by ad.talla
";
    }

}


//echo $sqld;
         //       echo   $sqld; 6     (SUM(ad.saldocantidad)/$caja) AS cantidad
                                if($re1 = $link->consulta($sqld))
                                {

                                    if($fi1 = mysql_fetch_array($re1))
                                    {
                                        //                                         echo "jla";
                                        //                                        $tallas = mysql_num_rows($re1)."ll";
                                        //                                        echo $tallas;
                                        do{

                                            for($j = 0; $j< mysql_num_fields($re1); $j++)
                                            {
                                                //                                                echo ".".$j;
                                                $value{$ii}{$fi1[0]}= $fi1[1];
                                                //                                               $value{$ii}{mysql_field_name($re1, $j)}= '222';
                                            }
                                        }while($fi1 = mysql_fetch_array($re1));



                                    }
                                    //                            $id
                                    //                            $value{$ii}{mysql_field_name($re, $i)}= '222';

                                }
                            }
                        }

                        $ii++;
                    }while($fi = mysql_fetch_array($re));
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $value;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "No existe un usuario con estos datos";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else
        {
            $dev['mensaje'] = "No se pudo conectar a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else
    {
        $dev['mensaje'] = "No se pudo crear la conexion a la BD";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {

        if($callback == null || $callback == "")
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }


    }
}

function ListarDetallePedidoMaterialColorinventarioFiltrado($start, $limit, $sort, $dir, $callback, $_dc, $idmarca,$idalmacen,$idkardex,$gestion, $return = false){
//echo $idmarca;
    if($start == null)
    {
        $start = 0;
    }
    if($limit == null)
    {
        $limit = 100;
    }
    if($sort != null)
    {
        $order = "ORDER BY $sort ";
        if($dir != null)
        {
            $order .= " $dir ";
        }
    }
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

 $sqlmarca = "
SELECT
  mar.talla
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
     if($talla == "14-38"){
      $opcion = "2";
    }
      if($talla == "33-45"){
      $opcion = "2";
    }
      if($talla == "33-42"){
      $opcion = "2";
    }
      if($talla == "1-12"){
      $opcion = "1";
    }

    $idalmacen = $_SESSION['idalmacen'];
 $sqlmarca = " SELECT mar.opcionb FROM marcas mar WHERE mar.idmarca = '$idmarca' ";

    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];

      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "totalpares");
    $totalpares = $opcionA1['resultado'];

    $sqlmarca = " SELECT tabla,mesrango,idperiodo,fechainicio,fechafin FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
    $tabla = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
    $mesrango = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
    $idperiodo = $opcionkardex['resultado'];
    if($idmarca=="mar-3"){
$fechainicio=$gestion."-01-01";
    $ult = cal_days_in_month(CAL_GREGORIAN, "12", $gestion); // 31
    $fechafin=$gestion."-01-".$ult;

$sql ="
SELECT mdd.idmodelo, mdd.codigo AS codigo, mdd.color,mdd.material,mdd.cliente,mdd.talla, mdd.precioventa AS precio,
mdd.preciounitario, SUM(k.numeroparesfila) AS totalpares,SUM(k.numerocajas) AS totalcajas,
SUM(k.totalparescaja) As totalparescaja, SUM(k.preciounitario*k.numeroparesfila) As totalparesbs,date_format(mdd.fecha,'%M-%y') AS fecha
FROM modelo mdd, kardexcajas k
WHERE mdd.idmodelo=k.idmodelo
AND mdd.idmarca = '$idmarca'
AND mdd.estado ='Activo' AND mdd.idalmacen='$idalmacen' AND mdd.fecha >= '$fechainicio' AND mdd.fecha <= '$fechafin' GROUP by k.idmodelo ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC
";
    }else{
        $idcliente = $gestion;
        if($idmarca=="mar-32"){
        $sql ="
SELECT mdd.idmodelo, mdd.codigo AS codigo, mdd.color,mdd.material,mdd.cliente,mdd.talla, mdd.precioventa AS precio,
mdd.preciounitario, SUM(k.numeroparesfila) AS totalpares,SUM(k.numerocajas) AS totalcajas,
SUM(k.totalparescaja) As totalparescaja, SUM(k.preciounitario*k.numeroparesfila) As totalparesbs,date_format(mdd.fecha,'%M-%y') AS fecha
FROM modelo mdd, kardexcajas k
WHERE mdd.idmodelo=k.idmodelo
AND mdd.idmarca = '$idmarca'
AND mdd.estado ='Activo' AND mdd.idalmacen='$idalmacen' AND mdd.idcliente= '$idcliente' GROUP by k.idmodelo ORDER BY `mdd`.`codigo` ASC
";
    }else{
        $sql ="
SELECT mdd.idmodelo, mdd.codigo AS codigo, mdd.color,mdd.material,mdd.cliente,mdd.talla, mdd.precioventa AS precio,
mdd.preciounitario, SUM(k.numeroparesfila) AS totalpares,SUM(k.numerocajas) AS totalcajas,
SUM(k.totalparescaja) As totalparescaja, SUM(k.preciounitario*k.numeroparesfila) As totalparesbs,date_format(mdd.fecha,'%M-%y') AS fecha
FROM modelo mdd, kardexcajas k
WHERE mdd.idmodelo=k.idmodelo
AND mdd.idmarca = '$idmarca'
AND mdd.estado ='Activo' AND mdd.idalmacen='$idalmacen' AND mdd.idcliente= '$idcliente' GROUP by k.idmodelo ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC
";}
    }
 //echo $sql;

    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
                    $dev['totalCount'] = mysql_num_rows($re);
                    $ii = 0;
                    do{

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {

                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                            if(mysql_field_name($re, $i) == "idmodelo"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];



   if($opcion=="1"){

    $sqlmarca = " SELECT talla FROM modelo WHERE idmodelo = '$fi[$i]' ";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];
//    echo $talla;


 if($talla=="GS"){
 $sqld = "  SELECT ta.idtalla AS tallakardex, ad.cantidad
FROM tallasdetallem ta
STRAIGHT_JOIN kardexdetalle ad ON ta.tallakardex = ad.tallakardex
AND ad.idmodelo = '$fi[$i]' GROUP BY ad.tallakardex
UNION ALL
SELECT ta.idtalla AS tallakardex, 0 AS cantidad
FROM tallasdetallem ta
LEFT OUTER JOIN kardexdetalle ad ON ta.tallakardex = ad.tallakardex
AND ad.idmodelo = '$fi[$i]'
WHERE  ad.cantidad IS NULL
";
             //                           echo $sqld;
 }else{
 $sqld = "  SELECT ta.tallakardex, ad.cantidad
FROM tallasdetallem ta
STRAIGHT_JOIN kardexdetalle ad ON ta.tallakardex = ad.tallakardex
AND ad.idmodelo = '$fi[$i]' GROUP BY ad.tallakardex
UNION ALL
SELECT ta.tallakardex, 0 AS cantidad
FROM tallasdetallem ta
LEFT OUTER JOIN kardexdetalle ad ON ta.tallakardex = ad.tallakardex
AND ad.idmodelo = '$fi[$i]'
WHERE  ad.cantidad IS NULL
";}
}else{
    $sqld = "  SELECT ta.tallakardex, ad.cantidad
FROM tallasdetalle ta
STRAIGHT_JOIN kardexdetalle ad ON ta.tallakardex = ad.tallakardex
AND ad.idmodelo = '$iddetalleingreso'
UNION ALL
SELECT ta.tallakardex, 0 AS cantidad
FROM tallasdetalle ta
LEFT OUTER JOIN kardexdetalle ad ON ta.tallakardex = ad.tallakardex
AND ad.idmodelo = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL";
}



                //  echo   $sqld;
                                if($re1 = $link->consulta($sqld))
                                {

                                    if($fi1 = mysql_fetch_array($re1))
                                    {
                                        //                                         echo "jla";
                                        //                                        $tallas = mysql_num_rows($re1)."ll";
                                        //                                        echo $tallas;
                                        do{

                                            for($j = 0; $j< mysql_num_fields($re1); $j++)
                                            {
                                                //                                                echo ".".$j;
                                                $value{$ii}{$fi1[0]}= $fi1[1];
                                                //                                               $value{$ii}{mysql_field_name($re1, $j)}= '222';
                                            }
                                        }while($fi1 = mysql_fetch_array($re1));



                                    }
                                    //                            $id
                                    //                            $value{$ii}{mysql_field_name($re, $i)}= '222';

                                }
                            }
                        }

                        $ii++;
                    }while($fi = mysql_fetch_array($re));
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $value;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "No existe un usuario con estos datos";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else
        {
            $dev['mensaje'] = "No se pudo conectar a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else
    {
        $dev['mensaje'] = "No se pudo crear la conexion a la BD";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {

        if($callback == null || $callback == "")
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }


    }
}
function ListarDetallePedidoColorinventario($start, $limit, $sort, $dir, $callback, $_dc, $idmarca,$idestilo, $idkardex,$return = false){
$idalmacen= $_SESSION['idalmacen'];
    if($start == null)
    {
        $start = 0;
    }
    if($limit == null)
    {
        $limit = 100;
    }
    if($sort != null)
    {
        $order = "ORDER BY $sort ";
        if($dir != null)
        {
            $order .= " $dir ";
        }
    }
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

 $sqlmarca = "
SELECT
  mar.talla
FROM
  marcas mar
WHERE
  mar.idmarca = '$idmarca'
";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "talla");
    $talla = $opcionA1['resultado'];

     if($talla == "14-38"){
      $opcion = "2";
    }
      if($talla == "33-45"){
      $opcion = "2";
    }
      if($talla == "1-12"){
      $opcion = "1";
    }
  $sqlmarca = " SELECT tabla,mesrango,idperiodo,fechainicio,fechafin FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
    $tabla = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
    $mesrango = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
    $idperiodo = $opcionkardex['resultado'];
if($tabla=="historialkardextienda"){

 $sql ="
SELECT dtp.iddetalleingreso,mdd.codigo AS codigo,sum(k.saldocantidad)AS totalpares, dtp.totalbs AS precio,dtp.color, dtp.material, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp, modelos mdd, coleccion col, estilos es,historialkardextienda k
WHERE dtp.iddetalleingreso=k.idcalzado and dtp.idmodelo = mdd.idmodelo
AND mdd.idcoleccion = col.idcoleccion
AND mdd.stylename = es.idestilo
AND mdd.idmarca = '$idmarca'
AND mdd.stylename = '$idestilo' AND dtp.inventario='0' AND  k.unido='no' AND k.idperiodo='$idperiodo' group by dtp.iddetalleingreso and k.idperiodo ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC
";
}else{
 $sql ="
SELECT dtp.iddetalleingreso,mdd.codigo AS codigo,sum(k.saldocantidad)AS totalpares, dtp.totalbs AS precio,dtp.color, dtp.material, col.codigo AS coleccion, 1 AS totalcajas
FROM adiciondetalleingreso dtp, modelos mdd, coleccion col, estilos es,adicionkardextienda k
WHERE dtp.iddetalleingreso=k.idcalzado and dtp.idmodelo = mdd.idmodelo
AND mdd.idcoleccion = col.idcoleccion
AND mdd.stylename = es.idestilo
AND mdd.idmarca = '$idmarca'
AND mdd.stylename = '$idestilo' AND dtp.inventario='0' AND dtp.unido='no' group by dtp.iddetalleingreso ORDER BY CAST( `mdd`.`codigo` AS SIGNED) ASC
";
}
  
//AND mdd.stylename = '$idestilo' ORDER BY `col`.`anio` , `mdd`.`codigo` DESC dtp.inventario='0'

            //  echo $sql;
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
                    $dev['totalCount'] = mysql_num_rows($re);
                    $ii = 0;
                    do{

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {

                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                            if(mysql_field_name($re, $i) == "iddetalleingreso"){
                                $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];
                                $iddetalleingreso = $fi[$i];
//LEFT OUTER JOIN adiciondetalleingresotalla ad ON ta.talla = ad.talla
if($tabla=="historialkardextienda"){
 $sqld = "  SELECT ta.talla, ad.saldocantidad As cantidad
FROM tallasdetallem ta
STRAIGHT_JOIN historialkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetallem ta
LEFT OUTER JOIN historialkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL";
                                
}else{
  $sqld = "  SELECT ta.talla, ad.saldocantidad As cantidad
FROM tallasdetallem ta
STRAIGHT_JOIN adicionkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
UNION ALL
SELECT ta.talla, 0 AS cantidad
FROM tallasdetallem ta
LEFT OUTER JOIN adicionkardextienda ad ON ta.talla = ad.talla
AND ad.idcalzado = '$iddetalleingreso'
WHERE ta.idmodelo = '$opcion'
AND ad.cantidad IS NULL";


}
              if($re1 = $link->consulta($sqld))
                                {

                                    if($fi1 = mysql_fetch_array($re1))
                                    {
                                        //                                         echo "jla";
                                        //                                        $tallas = mysql_num_rows($re1)."ll";
                                        //                                        echo $tallas;
                                        do{

                                            for($j = 0; $j< mysql_num_fields($re1); $j++)
                                            {
                                                //                                                echo ".".$j;
                                                $value{$ii}{$fi1[0]}= $fi1[1];
                                                //                                               $value{$ii}{mysql_field_name($re1, $j)}= '222';
                                            }
                                        }while($fi1 = mysql_fetch_array($re1));



                                    }
                                    //                            $id
                                    //                            $value{$ii}{mysql_field_name($re, $i)}= '222';

                                }
                            }
                        }

                        $ii++;
                    }while($fi = mysql_fetch_array($re));
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $value;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "No existe un usuario con estos datos";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else
        {
            $dev['mensaje'] = "No se pudo conectar a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else
    {
        $dev['mensaje'] = "No se pudo crear la conexion a la BD";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {

        if($callback == null || $callback == "")
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }


    }
}

function actualizarsoloparesmin($idkardex,$tallafinal1,$tallafinal,$cantidad1,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,$return = false ){
//($talla1,$tallam,$cantidadm,$iddetalleingreso,$idmodelodetalle,$precionuevo,$lineanuevo,$colornuevo,$materialnuevo,
//$sqlA[] = "UPDATE adiciondetalleingresotalla SET cantidad='$cantidad1' WHERE iddetalleingreso='$iddetalleingreso' AND talla='$tallafinal1';";
   $sqlA[] = "UPDATE historialkardextienda SET saldocantidad='$cantidad1',cantidad='$cantidad1',generado='0'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafinal' and idperiodo='3';";
   $sqlA[] = "UPDATE adicionkardextienda SET saldocantidad='$cantidad1',cantidad='$cantidad1',generado='0'  WHERE idmodelodetalle='$idmodelodetalle' AND idcalzado='$iddetalleingreso' AND talla='$tallafinal';";

//MostrarConsulta($sqlA);
   if($return == true)
    {
        return $sqlA;
    }
    else
    {
        if(ejecutarConsultaSQLBeginCommit($sqlA))
        {
            $dev['mensaje'] = "Se guardo una transaccion correctamente";
            $dev['error'] = "true";
            $dev['resultado'] = "$idplanillaemitida";
        }
        else
        {
            $dev['mensaje'] = "Ocurrio un error al guardar una transaccion";
            $dev['error'] = "false";
            $dev['resultado'] = "$idplanillaemitida";
        }
    }
}
function CargarInventarioActual($callback, $_dc, $idmarca,$idalmacens,$idkardex, $modelo,$idcliente,$idvendedor,$return = false){
$idalmacen= $_SESSION['idalmacen'];
  $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
     $sqlmarca = " SELECT nombre FROM almacenes WHERE idalmacen = '$idalmacen' ";
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "nombre");
    $almacen = $opcionA1['resultado'];
    $value['almacen'] = $almacen;
$sqlmarca = " SELECT tabla,mesrango,idperiodo,fechainicio,fechafin FROM administrakardex WHERE idkardex = '$idkardex' ";
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "tabla");
    $tabla = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "mesrango");
    $mesrango = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "idperiodo");
    $idperiodo = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechainicio");
    $fechainicio = $opcionkardex['resultado'];
    $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "fechafin");
    $fechafin = $opcionkardex['resultado'];

if($fechafin==null ||$fechafin == ""){
    $fechafin = Date("Y-m-d");
}
  $cliente = ListarEmpleadoparamarca('', '', '', '', '', '',"$idmarca",true);
    if($cliente['error'] == true)
    {
        $value['empleados'] = "true";
        $value['empleadoM'] = $cliente['resultado'];

    }

 $cliente = ListarClienteParaMayorVenta('', '', '', '', '', '','',"$idmarca",true);
    if($cliente['error'] == true)
    {
        $value['clientes'] = "true";
        $value['clienteM'] = $cliente['resultado'];

    }

   $sqlmarca = " SELECT mar.opcionb FROM marcas mar WHERE mar.idmarca = '$idmarca' ";
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "opcionb");
    $opcionb = $opcionA1['resultado'];

    $select =" SUM(kp.saldocantidad) AS totalpares,SUM(kp.saldocantidad*kp.preciounitario) AS total";
$from = "modelo mdd, kardexdetallepar kp";
 $where = "mdd.idmodelo=kp.idmodelo AND mdd.idmarca = '$idmarca' and mdd.idalmacen='$idalmacen'";
  //if($idcliente!=null || $idcliente!=""){ $where .= "and mdd.idcliente='$idcliente'"; }
//    if($idcliente!=null || $idcliente!=""){
//         $from .= ",ingresoalmacen ing";
//     $where .= "and mdd.idingreso=ing.idingreso and ing.boleta='$idcliente'";
//  }
  if($idcliente!=null || $idcliente!=""){
     $sqlmarca = " SELECT i.boleta FROM modelo mdd,kardexdetallepar kp,ingresoalmacen i,almacenes a WHERE kp.idmodelo=mdd.idmodelo and kp.idingreso=i.idingreso and i.idalmacen=a.idalmacen
     AND mdd.idmarca = '$idmarca' and i.boleta='$idcliente' GRoup by i.idingreso";
     $opcionkardex = findBySqlReturnCampoUnique($sqlmarca, true, true, "boleta");
     $boletaalmacen = $opcionkardex['resultado'];
     if($boletaalmacen !=null || $boletaalmacen!=""){
     $from .= ",ingresoalmacen ing";
     $where .= "and mdd.idingreso=ing.idingreso and ing.boleta='$idcliente'";
     }else{
     $from .= ",proformas p";
     $where .= "and mdd.boleta=p.id_proforma and p.nombre='$idcliente'";
      }
  }
  if($idvendedor!=null || $idvendedor!=""){$where .= "and mdd.idvendedor='$idvendedor'"; }
  if($modelo!=null || $modelo!=""){$where .= "and mdd.codigo LIKE '%".$modelo."%'";  }
 $sqlmarca = "SELECT ".$select." FROM ".$from. " WHERE ".$where;

//      $sqlmarca = "SELECT SUM(kp.saldocantidad) AS totalpares FROM modelo mdd, kardexdetallepar kp WHERE
//  mdd.idmodelo=kp.idmodelo AND mdd.idmarca = '$idmarca' and mdd.idalmacen='$idalmacen'
//";
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "totalpares");
    $totalpares = $opcionA1['resultado'];
    $totalcajas=$totalpares/12;
      $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "total");
    $totalbs = $opcionA1['resultado'];

$sql ="
SELECT ma.idmarca,ma.formatomayor,ma.encargado AS responsable, ma.codigo, ma.nombre AS marca, ma.opcion, ma.opcionb,'$mesrango' AS mesrango,
 '$totalcajas' AS totalcajas,'$totalpares' AS totalpares, '$totalbs' AS totalsus
FROM marcas ma
WHERE ma.idmarca = '$idmarca'
";


   // echo $sql;
  if($idmarca != null)
    {
        if($link=new BD)
        {
            if($link->conectar())
            {
                if($re = $link->consulta($sql))
                {
                    if($fi = mysql_fetch_array($re))
                    {
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $value{mysql_field_name($re, $i)}= redondear($fi[$i]);
                            }
                            else
                            {
                                $value{mysql_field_name($re, $i)}= $fi[$i];
                            }
                        }
                        $dev['mensaje'] = "Existen resultados";
                        $dev['error']   = "true";
                        $dev['resultado'] = $value;
                    }
                    else
                    {
                        $dev['mensaje'] = "No se encontro datos en la consulta";
                        $dev['error']   = "false";
                        $dev['resultado'] = "";
                    }

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "No se pudo conectar a la BD";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else
        {
            $dev['mensaje'] = "No se pudo crear la conexion a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else
    {
        $dev['mensaje'] = "El codigo de producto es nulo";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }


    if($return == true)
    {
        return $dev;
    }
    else
    {

        if($callback == null || $callback == "")
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }


    }
}

function Cargardatoscliente($callback, $_dc, $idcliente,$return = false){
    $idalmacen= $_SESSION['idalmacen'];
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";

    $sqlmarca = " SELECT CONCAT(nombre,'-',apellido) AS codigo FROM clientes WHERE idcliente = '$idcliente' ";
    $opcionA1 = findBySqlReturnCampoUnique($sqlmarca, true, true, "codigo");
    $clientes = $opcionA1['resultado'];
    $value['cliente'] = $clientes;

    if($fechafin==null ||$fechafin == ""){
        $fechafin = Date("Y-m-d");
    }
    $cliente = ListarEmpleadoparaalmacen('', '', '', '', '', '','',true);
    if($cliente['error'] == true)
    {
        $value['empleados'] = "true";
        $value['empleadoM'] = $cliente['resultado'];

    }

    $categorias = ListarMarcas('', '', '', '', '', '',"",true);
    if($categorias['error'] == true)
    {
        $value['marcas'] = "true";
        $value['marcaM'] = $categorias['resultado'];
    }
    $sql3 = "SELECT fechainicio, fechafin FROM periodo where idalmacen = '$idalmacen' and estado = 'abierto'";
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'fechainicio');
    $value['fechainicio'] = $saldocantidadA1['resultado'];
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'fechafin');
    $value['fechafin'] = $saldocantidadA1['resultado'];

    $sql3 = "SELECT SUM(saldoact) total FROM creditomayor where idcliente = '$idcliente' and estadomes = 'activo'";
    $saldocantidadA1 = findBySqlReturnCampoUnique($sql3,true, true, 'total');
    $saldocliente = $saldocantidadA1['resultado'];

    $sql ="SELECT CONCAT(nombre,'-',apellido) AS codigo, '$saldocliente' as saldo
           FROM clientes WHERE idcliente = '$idcliente'";
   // echo $sql;
    if($idcliente != null)
    {
        if($link=new BD)
        {
            if($link->conectar())
            {
                if($re = $link->consulta($sql))
                {
                    if($fi = mysql_fetch_array($re))
                    {
                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            if(mysql_field_type($re, $i) == "real")
                            {
                                $value{mysql_field_name($re, $i)}= redondear($fi[$i]);
                            }
                            else
                            {
                                $value{mysql_field_name($re, $i)}= $fi[$i];
                            }
                        }
                        $dev['mensaje'] = "Existen resultados";
                        $dev['error']   = "true";
                        $dev['resultado'] = $value;
                    }
                    else
                    {
                        $dev['mensaje'] = "No se encontro datos en la consulta";
                        $dev['error']   = "false";
                        $dev['resultado'] = "";
                    }

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "No se pudo conectar a la BD";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else
        {
            $dev['mensaje'] = "No se pudo crear la conexion a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else
    {
        $dev['mensaje'] = "El codigo de producto es nulo";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }


    if($return == true)
    {
        return $dev;
    }
    else
    {

        if($callback == null || $callback == "")
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }


    }
}

function ListarEmpleadoparamarca($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){
 $idalmacen = $_SESSION['idalmacen'];
  if($start == null)
    {
        $start = 0;
    }
    if($limit == null)
    {
        $limit = 100;
    }
    if($sort != null)
    {
        $order = "ORDER BY $sort ";
        if($dir != null)
        {
            $order .= " $dir ";
        }
    }
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
     $sql ="SELECT  emp.idempleado,
  CONCAT(emp.nombres,'-',emp.apellidos) AS codigo
FROM
  empleados emp,empleadomarca em
WHERE
  emp.idempleado=em.idempleado and emp.numero!='0' and em.idmarca='$where'  and emp.idalmacen='$idalmacen' $order LIMIT $start,$limit
";

//            echo $sql;
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
                    $dev['totalCount'] = mysql_num_rows($re);
                    $ii = 0;
                    do{

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];

                        }

                        $ii++;
                    }while($fi = mysql_fetch_array($re));
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $value;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "No existe un usuario con estos datos";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else
        {
            $dev['mensaje'] = "No se pudo conectar a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else
    {
        $dev['mensaje'] = "No se pudo crear la conexion a la BD";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {

        if($callback == null || $callback == "")
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }


    }
}
function ListarEmpleadoparaalmacen($start, $limit, $sort, $dir, $callback, $_dc, $where = '', $return = false){
 $idalmacen = $_SESSION['idalmacen'];
  if($start == null)
    {
        $start = 0;
    }
    if($limit == null)
    {
        $limit = 100;
    }
    if($sort != null)
    {
        $order = "ORDER BY $sort ";
        if($dir != null)
        {
            $order .= " $dir ";
        }
    }
    //    $dev['totalCount'] = 0;
    $dev['mensaje'] = "";
    $dev['error']   = "";
    $dev['resultado'] = "";
     $sql ="SELECT emp.idempleado,
  CONCAT(emp.nombres,'-',emp.apellidos) AS codigo
FROM
  empleados emp,empleadomarca em
WHERE
  emp.idempleado=em.idempleado and emp.numero!='0' and emp.idalmacen='$idalmacen' group BY em.idempleado $order LIMIT $start,$limit
";

//            echo $sql;
    if($link=new BD)
    {
        if($link->conectar())
        {
            if($re = $link->consulta($sql))
            {

                if($fi = mysql_fetch_array($re))
                {
                    $dev['totalCount'] = mysql_num_rows($re);
                    $ii = 0;
                    do{

                        for($i = 0; $i< mysql_num_fields($re); $i++)
                        {
                            $value{$ii}{mysql_field_name($re, $i)}= $fi[$i];

                        }

                        $ii++;
                    }while($fi = mysql_fetch_array($re));
                    $dev['mensaje'] = "Existen resultados";
                    $dev['error']   = "true";
                    $dev['resultado'] = $value;

                }
                else
                {
                    $dev['mensaje'] = "No se encontro datos en la consulta";
                    $dev['error']   = "false";
                    $dev['resultado'] = "";
                }
            }
            else
            {
                $dev['mensaje'] = "No existe un usuario con estos datos";
                $dev['error']   = "false";
                $dev['resultado'] = "";
            }
        }
        else
        {
            $dev['mensaje'] = "No se pudo conectar a la BD";
            $dev['error']   = "false";
            $dev['resultado'] = "";
        }
    }
    else
    {
        $dev['mensaje'] = "No se pudo crear la conexion a la BD";
        $dev['error']   = "false";
        $dev['resultado'] = "";
    }
    if($return == true)
    {
        return $dev;
    }
    else
    {

        if($callback == null || $callback == "")
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            print($output);
        }
        else
        {
            $json = new Services_JSON();
            $output = $json->encode($dev);
            $output = substr($output, 1);
            $output = "$callback({".$output.");";
            print($output);
        }


    }
}
function getSqlNewKardexrebaja($idmodelo, $pares, $precioanterior, $precionuevo, $diferencia, $idvendedor, $idmarca, $idalmacen, $fecha, $idusuario, $return){
$setC[0]['campo'] = 'idmodelo';
$setC[0]['dato'] = $idmodelo;
$setC[1]['campo'] = 'pares';
$setC[1]['dato'] = $pares;
$setC[2]['campo'] = 'precioanterior';
$setC[2]['dato'] = $precioanterior;
$setC[3]['campo'] = 'precionuevo';
$setC[3]['dato'] = $precionuevo;
$setC[4]['campo'] = 'diferencia';
$setC[4]['dato'] = $diferencia;
$setC[5]['campo'] = 'idvendedor';
$setC[5]['dato'] = $idvendedor;
$setC[6]['campo'] = 'idmarca';
$setC[6]['dato'] = $idmarca;
$setC[7]['campo'] = 'idalmacen';
$setC[7]['dato'] = $idalmacen;
$setC[8]['campo'] = 'fecha';
$setC[8]['dato'] = $fecha;
$setC[9]['campo'] = 'idusuario';
$setC[9]['dato'] = $idusuario;
$sql2 = generarInsertValues($setC);
return "INSERT INTO kardexrebaja ".$sql2;
}
function getSqlNewPareshabilitados($idkardexunico, $fecha, $idkardex, $idmodelo, $talla, $idmarca, $idvendedor, $pares, $preciounitario, $preciototal, $return){
$setC[0]['campo'] = 'idkardexunico';
$setC[0]['dato'] = $idkardexunico;
$setC[1]['campo'] = 'fecha';
$setC[1]['dato'] = $fecha;
$setC[2]['campo'] = 'idkardex';
$setC[2]['dato'] = $idkardex;
$setC[3]['campo'] = 'idmodelo';
$setC[3]['dato'] = $idmodelo;
$setC[4]['campo'] = 'talla';
$setC[4]['dato'] = $talla;
$setC[5]['campo'] = 'idmarca';
$setC[5]['dato'] = $idmarca;
$setC[6]['campo'] = 'idvendedor';
$setC[6]['dato'] = $idvendedor;
$setC[7]['campo'] = 'pares';
$setC[7]['dato'] = $pares;
$setC[8]['campo'] = 'preciounitario';
$setC[8]['dato'] = $preciounitario;
$setC[9]['campo'] = 'preciototal';
$setC[9]['dato'] = $preciototal;
$sql2 = generarInsertValues($setC);
return "INSERT INTO pareshabilitados ".$sql2;
}

function getSqlNewBitacoradeletemodelo($idmodelo, $idkardexcaja, $idalmacen, $cantidad, $preciounitario, $preciototal, $estado, $fecha, $hora, $usuario, $idingreso, $return){
$setC[0]['campo'] = 'idmodelo';
$setC[0]['dato'] = $idmodelo;
$setC[1]['campo'] = 'idkardexcaja';
$setC[1]['dato'] = $idkardexcaja;
$setC[2]['campo'] = 'idalmacen';
$setC[2]['dato'] = $idalmacen;
$setC[3]['campo'] = 'cantidad';
$setC[3]['dato'] = $cantidad;
$setC[4]['campo'] = 'preciounitario';
$setC[4]['dato'] = $preciounitario;
$setC[5]['campo'] = 'preciototal';
$setC[5]['dato'] = $preciototal;
$setC[6]['campo'] = 'estado';
$setC[6]['dato'] = $estado;
$setC[7]['campo'] = 'fecha';
$setC[7]['dato'] = $fecha;
$setC[8]['campo'] = 'hora';
$setC[8]['dato'] = $hora;
$setC[9]['campo'] = 'usuario';
$setC[9]['dato'] = $usuario;
$setC[10]['campo'] = 'idingreso';
$setC[10]['dato'] = $idingreso;
$sql2 = generarInsertValues($setC);
return "INSERT INTO bitacoradeletemodelo ".$sql2;
}
?>