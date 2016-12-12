<?php
session_name("balderrama");
session_start();
include("impl/Utils.php");
include("bd/bd.php");
require_once("impl/JSON.php");
////$dev['mensaje'] = "";
////$dev['error']   = "";
$dev['resultado'] = "";
if(permitido("fun8000", $_SESSION['codigo'])==true)
{
    $tipo = $_FILES["file"]["type"];
    //echo " tipo $tipo ";
    if (($_FILES["file"]["type"] == "application/csv")||($_FILES["file"]["type"] == "text/csv")||($_FILES["file"]["type"] == "text/comma-separated-values")||($_FILES["file"]["type"] == "application/vnd.ms-excel"))
    {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        }
        else
        {
            if(file_exists("C:/archivos") == false){
                mkdir('C:/archivos', 0777, true);
            }
            $mesanio = date("mY");
            $dirmesanio = "C:/archivos/".$mesanio;
            if(file_exists($dirmesanio) == false){
                mkdir($dirmesanio, 0777, true);
            }
            if(file_exists($dirmesanio)){
                $direccion = $dirmesanio."/".$_FILES["file"]["name"];
                //echo " direccion $direccion ";
                if (file_exists($direccion))
                {
                    //echo $_FILES["file"]["name"] . " Ya se proceso el archivo ";
                    //unlink($direccion);   revisar
                }
                //else
                //{
                    move_uploaded_file($_FILES["file"]["tmp_name"], $direccion);
                    echo "Se cargo correctamente el archivo ";
                    //echo $_FILES["file"]["tmp_name"] . $_FILES["file"]["name"] . "Se cargo correctamente el archivo";
                //}
                //$idmarca = "mar-34";
                //$marcaprocesar = "MOLECA";
                $idmarca = $_GET['idmarca'];
                $marcaprocesar = $_GET['marca'];
                $archivoprocesar = $direccion;
                $sql[] = "DELETE FROM proforma_archivo;";
                ejecutarConsultaSQLBeginCommit($sql);
                //echo " idmarca $idmarca marca $marcaprocesar archivo $archivoprocesar";
                //Abrir y recorrer todo el archivo para cargar a la Base de Datos tabla proforma_archivo
                $marcaexcel = ProcesarArchivoCSV($archivoprocesar, $idmarca, $marcaprocesar, $return);
                ////$marcaexcel = "Adr";                
                $todoOK = "no";
                if((($idmarca=="mar-34")||($idmarca=="mar-33")||($idmarca=="mar-48")||($idmarca=="mar-46")||($idmarca=="mar-35"))&&($marcaexcel!="0")){
                    //Datos de proforma_archivo cargar en archivos csv
                    $detalle = CrearArchivosMVB($marcaexcel, $return);
                    $todoOK = "si";
                }
                else{
                    if($marcaexcel!="0"){
                        switch($idmarca){
                            case "mar-1":
                                //Datos de proforma_archivo cargar en archivos csv
                                $detalle = CrearArchivosRAMARIM($marcaexcel, $return);
                                $todoOK = "si";
                                break;
                            case "mar-4":
                                //Datos de proforma_archivo cargar en archivos csv
                                $detalle = CrearArchivosKIDY($marcaexcel, $return);
                                $todoOK = "si";
                                break;
                            case "mar-49":
                                //Datos de proforma_archivo cargar en archivos csv
                                $detalle = CrearArchivosVIABEACH($marcaexcel, $return);
                                $todoOK = "si";
                                break;
                            case "mar-50":
                                //Datos de proforma_archivo cargar en archivos csv
                                $detalle = CrearArchivosVIABEACHNINO($marcaexcel, $return);
                                $todoOK = "si";
                                break;
                            case "mar-2":
                                //Datos de proforma_archivo cargar en archivos csv
                                $detalle = CrearArchivosWESTCOAST($marcaexcel, $return);
                                $todoOK = "si";
                                break;
                            case "mar-25":
                                //Datos de proforma_archivo cargar en archivos csv
                                $detalle = CrearArchivosCOCACOLA($marcaexcel, $return);
                                $todoOK = "si";
                                break;
                            case "mar-7":
                                //Datos de proforma_archivo cargar en archivos csv
                                $detalle = CrearArchivosCRAVOCANELA($marcaexcel, $return);
                                $todoOK = "si";
                                break;
                            case "mar-32":
                                //Datos de proforma_archivo cargar en archivos csv
                                $detalle = CrearArchivos361($marcaexcel, $return);     //Pendiente
                                $todoOK = "si";
                                break;
                            case "mar-51":
                                //Datos de proforma_archivo cargar en archivos csv
                                $detalle = CrearArchivosADRUM($marcaexcel, $return);
                                $todoOK = "si";
                                break;
                            default:
                                echo "Hubo un problema no existe la marca a procesar!! llame a sistemas ";
                        }
                    }
                    else{
                        echo "No se pudo Procesar el archivo";
                    }
                }
                if($todoOK=="si"){
                    $result = " Marca: $marcaprocesar $detalle ";
                   //// $dev['mensaje'] = "Se proceso todo correctamente ";
                    ////$dev['error'] = " ";
                    $dev['resultado'] = "Se proceso todo correctamente $result";
                    $json = new Services_JSON();
                    $output = $json->encode($dev);
                    print($output);
                }
            }
            else{
                echo "No existe el directorio archivos o no se lo pudo crear";
            }
        }
    }
    else
    {
        echo "El archivo no es valido solo se permiten archivos .CSV";
    }
}
else
{
    $dev['mensaje'] = "Ud no tiene privilegios para esta funcion";
    $dev['error'] = "false";
    $json = new Services_JSON();
    $output = $json->encode($dev);
    print($output);
}
function ProcesarArchivoProformas($farchivo){

    $file = fopen($archivo, "r");
    $fila = 1; $cont = 0; $valida = true;
    $iddetalle = 3314010;   $id_proforma = "2044";
    echo" Entro ";
    while (!feof($file)) {
        $linea = fgetcsv($file, 200, ";");
        $num = count($linea);
            $dato0 = $linea[0];
            $dato1 = $linea[1];
            $dato2 = $linea[2];
            $dato3 = $linea[3];
            $dato4 = $linea[4];
            $dato5 = $linea[5];
            $dato6 = $linea[6];
            $dato7 = $linea[7];
            $dato8 = $linea[8];
            $dato9 = $linea[9];
            $dato10 = $linea[10];
            $dato11 = $linea[11];
            $dato12 = $linea[12];
            $dato13 = $linea[13];
            $dato14 = $linea[14];
            $dato15 = $linea[15];
            $dato16 = $linea[16];
            $dato17 = $linea[17];
            $dato18 = $linea[18];
            $dato19 = $linea[19];
            $dato20 = $linea[20];
            $dato21 = $linea[21];
            $dato22 = $linea[22];
            $dato23 = $linea[23];
            $dato24 = $linea[24];
            $dato25 = $linea[25];
            $dato26 = $linea[26];
            $dato27 = $linea[27];
            $dato28 = $linea[28];
            $dato29 = $linea[29];
            $dato30 = $linea[30];
            $sql[] =getSqlNewDetallesProforma($iddetalle, $id_proforma, $cont, 0, $dato0, false);
            $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 1, $dato1, false);
            $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 2, $dato2, false);
            $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 3, $dato3, false);
            $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 4, $dato4, false);
            $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 5, $dato5, false);
            $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 6, $dato6, false);
            $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 7, $dato7, false);
            $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 8, $dato8, false);
            $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 9, $dato9, false);
            $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 10, $dato10, false);
            $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 11, $dato11, false);
            $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 12, $dato12, false);
            $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 13, $dato13, false);
            $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 14, $dato14, false);
            $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 15, $dato15, false);
            $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 16, $dato16, false);
            $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 17, $dato17, false);
            $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 18, $dato18, false);
            if($cont==0){
                $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 19, "CLIENTE", false);
            }else{
                $sql[] =getSqlNewDetallesProforma($id_detalle, $id_proforma, $cont, 19, $dato19, false);
            }
            $cont = $cont + 1;
        $fila++;
        $dato0 = ""; $dato1 = ""; $dato2 = ""; $dato3 = ""; $dato4 = ""; $dato5 = ""; $dato6 = ""; $dato7 = ""; $dato8 = ""; $dato9 = ""; $dato10 = "";
        $dato11 = ""; $dato12 = ""; $dato13 = ""; $dato14 = ""; $dato15 = ""; $dato16 = ""; $dato17 = ""; $dato18 = ""; $dato19 = ""; $dato20 = "";
        $dato21 = ""; $dato22 = ""; $dato23 = ""; $dato24 = ""; $dato25 = ""; $dato26 = ""; $dato27 = ""; $dato28 = ""; $dato29 = ""; $dato30 = "";
    }
    fclose($file);
    //mostrarconsulta($sql);
        if(ejecutarConsultaSQLBeginCommit($sql))
        {
            echo "Se proceso correctamente";
            return $proarch;
        }
        else
        {
            echo "Ocurrio un error, Avise a Sistemas!!!";
        }
}

function getSqlNewDetallesProforma($id_detalle,$id_proforma,$fila,$columna,$valor,$return){
    $setC[0]['campo'] = 'id_detalle';
    $setC[0]['dato'] = $io_detalle;
    $setC[1]['campo'] = 'id_proforma';
    $setC[1]['dato'] = $id_proforma;
    $setC[2]['campo'] = 'fila';
    $setC[2]['dato'] = $fila;
    $setC[3]['campo'] = 'columna';
    $setC[3]['dato'] = $columna;
    $setC[4]['campo'] = 'valor';
    $setC[4]['dato'] = $valor;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO detalles_proforma ".$sql2;
}

function ProcesarArchivoCSV($archivo, $idmar, $marcaproc, $return){

    $file = fopen($archivo, "r");
    $fila = 1; $cont = 0; $valida = true;
    while (!feof($file)) {
        if($cont==4){
            ////echo "d0 $dato0 d1 $dato1 d2 $dato2 ";
            break;
        }
        $linea = fgetcsv($file, 200, ";");
        $num = count($linea);
        ////echo "<p>uno $linea[0] dos $linea[1] tres $linea[3] campos $num fila $fila contador $cont: <br /></p>\n";
        if(($linea[0]!=null)&&($linea[1]!=null)&&($linea[3]==null)){
            $marca = $linea[0];
            $factura = $linea{1};
            if($cont==0){
                $proarch = substr($marca,0,3);
            }
            if($fila>2){
                $marcaproc = strtoupper($linea[0]);
            }
            //No funcionara si colocan el nombre de la marca diferente a como lo tenemos registrado en nombre de la marca
            $marcam = strtoupper($marca);
            if($marcam!=$marcaproc){
                echo "El archivo a procesar no corresponde a la marca que escogio o el nombre esta mal escrito $marcam debe ser $marcaproc";
                $valida = false;
                break;
            }
        }
        else{
            if($fila==1){
                echo "El archivo tiene una linea en blanco al inicio no se puede procesar $fila";
                $valida = false;
                break;
            }
            if(($linea[0]==null)&&($linea[1]==null)&&($linea[2]==null)){
                $cont = $cont +1;
            }
            if($fila==3){
                //echo " linea3 $linea[3] linea4 $linea[4] linea5 $linea[5] idmarca $idmar ";
                if(($idmar=="mar-2")||($idmar=="mar-4")||($idmar=="mar-25")||($idmar=="mar-49")||($idmar=="mar-51")){
                    if(($linea[3]==null)&&($idmar=="mar-4")){
                        echo "El archivo no tiene precio, no se puede procesar 2 ojo!!!!!! ";
                        $valida = false;
                        break;
                    }
                    else{
                        if(($linea[4]==null)&&($idmar!="mar-4")){
                            echo "El archivo no tiene precio, no se puede procesar 1 ojo!!!!!! ";
                            $valida = false;
                            break;
                        }
                    }
                }
                else{
                    if($linea[5]==null){
                        echo "El archivo no tiene precio, no se puede procesar 3 ojo!!!!!! ";
                        $valida = false;
                        break;
                    }
                }
            }
        }
        if(($fila>1)&&($linea[1]!=null)){
            $dato0 = $linea[0];
            $dato1 = $linea[1];
            $dato2 = $linea[2];
            $dato3 = $linea[3];
            $dato4 = $linea[4];
            $dato5 = $linea[5];
            $dato6 = $linea[6];
            $dato7 = $linea[7];
            $dato8 = $linea[8];
            $dato9 = $linea[9];
            $dato10 = $linea[10];
            $dato11 = $linea[11];
            $dato12 = $linea[12];
            $dato13 = $linea[13];
            $dato14 = $linea[14];
            $dato15 = $linea[15];
            $dato16 = $linea[16];
            $dato17 = $linea[17];
            $dato18 = $linea[18];
            $dato19 = $linea[19];
            $dato20 = $linea[20];
            $dato21 = $linea[21];
            $dato22 = $linea[22];
            $dato23 = $linea[23];
            $dato24 = $linea[24];
            $dato25 = $linea[25];
            $dato26 = $linea[26];
            $dato27 = $linea[27];
            $dato28 = $linea[28];
            $dato29 = $linea[29];
            $dato30 = $linea[30];
        }
        //echo " linea1 $linea[1] linea3 $linea[3] linea4 $linea[4] idmarca $idmar ";
        if(($linea[1]!=null)&&($linea[4]!=null)){
            $sql[] =getSqlNewProformaArchivo($idcorrelativo, $marca, $factura, $dato0, $dato1,$dato2,$dato3,$dato4,$dato5,$dato6,$dato7,$dato8,$dato9,$dato10,$dato11,$dato12,$dato13,$dato14,$dato15,$dato16,$dato17,$dato18,$dato19,$dato20,$dato21,$dato22,$dato23,$dato24,$dato25,$dato26,$dato27,$dato28,$dato29,$proarch, false);
            $cont = 0;
        }
        else{
            if((($linea[1]!=null)&&($linea[3]!=null))&&(($idmar=="mar-4")||($idmar=="mar-49"))){
                $sql[] =getSqlNewProformaArchivo($idcorrelativo, $marca, $factura, $dato0, $dato1,$dato2,$dato3,$dato4,$dato5,$dato6,$dato7,$dato8,$dato9,$dato10,$dato11,$dato12,$dato13,$dato14,$dato15,$dato16,$dato17,$dato18,$dato19,$dato20,$dato21,$dato22,$dato23,$dato24,$dato25,$dato26,$dato27,$dato28,$dato29,$proarch, false);
                $cont = 0;
            }
           // else{
           //     if($fila>1){
           //         echo "Hay un problema con el archivo, no se puede procesar el detalle ojo!!!!!! ";
          //          $valida = false;
          //          break;
          //      }
          //  }
        }
        $fila++;
        $dato0 = ""; $dato1 = ""; $dato2 = ""; $dato3 = ""; $dato4 = ""; $dato5 = ""; $dato6 = ""; $dato7 = ""; $dato8 = ""; $dato9 = ""; $dato10 = "";
        $dato11 = ""; $dato12 = ""; $dato13 = ""; $dato14 = ""; $dato15 = ""; $dato16 = ""; $dato17 = ""; $dato18 = ""; $dato19 = ""; $dato20 = "";
        $dato21 = ""; $dato22 = ""; $dato23 = ""; $dato24 = ""; $dato25 = ""; $dato26 = ""; $dato27 = ""; $dato28 = ""; $dato29 = ""; $dato30 = "";
    }
    fclose($file);
    //mostrarconsulta($sql);
    if($valida==true){
        if(ejecutarConsultaSQLBeginCommit($sql))
        {
            echo "Se proceso correctamente";
            return $proarch;
        }
        else
        {
            echo "Ocurrio un error, Avise a Sistemas!!!";
        }
    }
    else{
        return 0;
    }
}

function getSqlNewProformaArchivo($idcorrelativo,$marca,$factura,$dato0,$dato1,$dato2,$dato3,$dato4,$dato5,$dato6,$dato7,$dato8,$dato9,$dato10,$dato11,$dato12,$dato13,$dato14,$dato15,$dato16,$dato17,$dato18,$dato19,$dato20,$dato21,$dato22,$dato23,$dato24,$dato25,$dato26,$dato27,$dato28,$dato29,$dato30,$return){
    $setC[0]['campo'] = 'idproarchivo';
    $setC[0]['dato'] = $idcorrelativo;
    $setC[1]['campo'] = 'marca';
    $setC[1]['dato'] = $marca;
    $setC[2]['campo'] = 'factura';
    $setC[2]['dato'] = $factura;
    $setC[3]['campo'] = 'dato0';
    $setC[3]['dato'] = $dato0;
    $setC[4]['campo'] = 'dato1';
    $setC[4]['dato'] = $dato1;
    $setC[5]['campo'] = 'dato2';
    $setC[5]['dato'] = $dato2;
    $setC[6]['campo'] = 'dato3';
    $setC[6]['dato'] = $dato3;
    $setC[7]['campo'] = 'dato4';
    $setC[7]['dato'] = $dato4;
    $setC[8]['campo'] = 'dato5';
    $setC[8]['dato'] = $dato5;
    $setC[9]['campo'] = 'dato6';
    $setC[9]['dato'] = $dato6;
    $setC[10]['campo'] = 'dato7';
    $setC[10]['dato'] = $dato7;
    $setC[11]['campo'] = 'dato8';
    $setC[11]['dato'] = $dato8;
    $setC[12]['campo'] = 'dato9';
    $setC[12]['dato'] = $dato9;
    $setC[13]['campo'] = 'dato10';
    $setC[13]['dato'] = $dato10;
    $setC[14]['campo'] = 'dato11';
    $setC[14]['dato'] = $dato11;
    $setC[15]['campo'] = 'dato12';
    $setC[15]['dato'] = $dato12;
    $setC[16]['campo'] = 'dato13';
    $setC[16]['dato'] = $dato13;
    $setC[17]['campo'] = 'dato14';
    $setC[17]['dato'] = $dato14;
    $setC[18]['campo'] = 'dato15';
    $setC[18]['dato'] = $dato15;
    $setC[19]['campo'] = 'dato16';
    $setC[19]['dato'] = $dato16;
    $setC[20]['campo'] = 'dato17';
    $setC[20]['dato'] = $dato17;
    $setC[21]['campo'] = 'dato18';
    $setC[21]['dato'] = $dato18;
    $setC[22]['campo'] = 'dato19';
    $setC[22]['dato'] = $dato19;
    $setC[23]['campo'] = 'dato20';
    $setC[23]['dato'] = $dato20;
    $setC[24]['campo'] = 'dato21';
    $setC[24]['dato'] = $dato21;
    $setC[25]['campo'] = 'dato22';
    $setC[25]['dato'] = $dato22;
    $setC[26]['campo'] = 'dato23';
    $setC[26]['dato'] = $dato23;
    $setC[27]['campo'] = 'dato24';
    $setC[27]['dato'] = $dato24;
    $setC[28]['campo'] = 'dato25';
    $setC[28]['dato'] = $dato25;
    $setC[29]['campo'] = 'dato26';
    $setC[29]['dato'] = $dato26;
    $setC[30]['campo'] = 'dato27';
    $setC[30]['dato'] = $dato27;
    $setC[31]['campo'] = 'dato28';
    $setC[31]['dato'] = $dato28;
    $setC[32]['campo'] = 'dato29';
    $setC[32]['dato'] = $dato29;
    $setC[33]['campo'] = 'dato30';
    $setC[33]['dato'] = $dato30;
    $sql2 = generarInsertValues($setC);
    return "INSERT INTO proforma_archivo ".$sql2;
}

function CrearArchivosMVB($marcaexcel, $return){
    $mesanio = date("mY");
    if(file_exists("C:/proformas") == false){
        mkdir('C:/proformas', 0777, true);
    }
    $dirmesanio = "C:/proformas/".$mesanio;
    if(file_exists($dirmesanio) == false){
        mkdir($dirmesanio, 0777, true);
    }
    if(file_exists($dirmesanio)){
        //echo " entra $dirmesanio marca $marcaexcel ";
        $sql1 = "SELECT * FROM proforma_archivo where dato30 = '$marcaexcel' ORDER BY idproarchivo";
        $sql2 = getTablaToArrayOfSQL($sql1);
        $sql3 = $sql2['resultado'];
        $row1 = NumeroTuplas($sql1);
        $row11 = $row1['resultado'];
        for($i=0; $i<=$row11; $i++){
            $proforma = $sql3[$i];
            $marcap = $proforma['marca'];
            $facturap = $proforma['factura'];
            $dato0p = $proforma['dato0'];
            $dato1p = $proforma['dato1'];
            $dato2p = $proforma['dato2'];
            $dato3p = $proforma['dato3'];
            $dato4p = $proforma['dato4'];
            $dato5p = $proforma['dato5'];
            $dato6p = $proforma['dato6'];
            $dato7p = $proforma['dato7'];
            $dato8p = $proforma['dato8'];
            $dato9p = $proforma['dato9'];
            $dato10p = $proforma['dato10'];
            $dato11p = $proforma['dato11'];
            $dato12p = $proforma['dato12'];
            $dato13p = $proforma['dato13'];
            $dato14p = $proforma['dato14'];
            $dato15p = $proforma['dato15'];
            $dato16p = $proforma['dato16'];
            $dato17p = $proforma['dato17'];
            $dato18p = $proforma['dato18'];
            $dato19p = $proforma['dato19'];
            $dato20p = $proforma['dato20'];
            $dato21p = $proforma['dato21'];
            $dato22p = $proforma['dato22'];
            $dato23p = $proforma['dato23'];
            $dato24p = $proforma['dato24'];
            $dato25p = $proforma['dato25'];
            $dato26p = $proforma['dato26'];
            $dato27p = $proforma['dato27'];
            $dato28p = $proforma['dato28'];
            $dato29p = $proforma['dato29'];
            $dato30p = $proforma['dato30'];

            if(($dato0p=="STYLE")||($dato0p=="ARTICULO")||($dato0p=="CODIGO")){
                $dat = 0;
                //echo " dato5 $dato5p dato14 $dato14p ";
                if(($dato5p=="USD")&&(($dato14p=="PRS")||($dato14p=="PARES")||($dato14p=="TOTAL PRS")||($dato14p=="TOTAL PARES"))){
                    $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,"PARES","TOTAL","ESTADO");
                }
                else{
                    //echo " dato15 $dato15p ";
                    if(($dato5p=="USD")&&(($dato15p=="PRS")||($dato15p=="PARES")||($dato15p=="TOTAL PRS")||($dato15p=="TOTAL PARES"))){
                        $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,"PARES","TOTAL","ESTADO");
                        $dat = 1;
                    }
                    else{
                        //echo " dato16 $dato16p ";
                        if(($dato5p=="USD")&&(($dato16p=="PRS")||($dato16p=="PARES")||($dato16p=="TOTAL PRS")||($dato16p=="TOTAL PARES"))){
                            $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,"PARES","TOTAL","ESTADO");
                            $dat = 2;
                        }
                        else{
                            //echo " dato25 $dato25p ";
                            if(($dato5p=="USD")&&(($dato23p=="PRS")||($dato23p=="PARES")||($dato23p=="TOTAL PRS")||($dato23p=="TOTAL PARES"))){
                                $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,"PARES","TOTAL","ESTADO");
                                $dat = 3;
                            }
                            else{
                                if(($dato5p=="USD")&&(($dato24p=="PRS")||($dato24p=="PARES")||($dato24p=="TOTAL PRS")||($dato24p=="TOTAL PARES"))){
                                    $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$dato23p,"PARES","TOTAL","ESTADO");
                                    $dat = 4;
                                }
                                else{
                                    if(($dato5p=="USD")&&(($dato25p=="PRS")||($dato25p=="PARES")||($dato25p=="TOTAL PRS")||($dato25p=="TOTAL PARES"))){
                                        $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$dato23p,$dato24p,"PARES","TOTAL","ESTADO");
                                        $dat = 5;
                                    }
                                    else{
                                        if(($dato5p=="USD")&&(($dato22p=="PRS")||($dato22p=="PARES")||($dato22p=="TOTAL PRS")||($dato22p=="TOTAL PARES"))){
                                            $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,"PARES","TOTAL","ESTADO");
                                            $dat = 6;
                                        }
                                        else{
                                            echo "Existe un problema con la cabecera del archivo. Revise el archivo que subio y vuelva a procesar";
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                //echo"cabecera $datoscabecera";
                $j = $i;
                $proformaaux = $sql3[$j+1];
                $oficina = $proformaaux['dato3'];
                //echo"oficina $oficina";
                if($i<1){
                    $separafactura = explode( '/' , $facturap);
                    $nrofactura = $separafactura[0].$separafactura[1];
                    $nfactura = $separafactura[0];
                    $dirfactura = "C:/proformas/".$mesanio."/".$nfactura;
                    //echo " nfactura $nfactura dirfactura $dirfactura ";
                    if(file_exists($dirfactura) == false){
                        mkdir($dirfactura, 0777, true);
                    }
                }
                $ofic = null;
                $separaofic = null;
                $separaofic = explode( '/' , $oficina);
                $ofic = $separaofic[1];
                //echo"ofic $ofic";
                if($ofic==null){
                    $nomarch = $marcap.$nrofactura.$oficina.$fecha;
                }
                else{
                    $ofic = substr($separaofic[0],0,2);
                    $nomarch = $marcap.$nrofactura.$ofic.$fecha;
                }
                //echo "nombre archivo $nomarch";
                $archivo = "C:\\proformas\\$mesanio\\$nfactura\\$nomarch.csv";
                $detalle = $detalle." Oficina: ".$ofic." Total Cajas: ";
                //echo "direccion archivo $archivo";
                $totcajas = 0;   $totpares = 0;   $totpreciov = 0;
                $file = fopen($archivo, "w");
                fputcsv($file,$datoscabecera,";");
            }
            else{
                //echo"oficina $oficina dato3p $dato3p ";
                if((substr($oficina,0,2)==substr($dato3p,0,2))&&($dato3p!=null)){   // revisar es innecesario la segunda condiciom
                    $cantcajas = 0;   $tpares = 0;   $preciov = 0;
                    // dividir el precio entre la cantidad de pares
                    $preciounitario = $dato5p/12;
                    $preciounitario = number_format($preciounitario,4,'.',',');
                    $preciov = $dato5p;
                    $tpares = 12;
                    //echo"dato4p $dato4p cantcajas $cantcajas ";
                    while($dato4p>$cantcajas){
                        if($dat==1){
                            $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$tpares,$preciov,"0");
                        }
                        else{
                            if($dat==2){
                                $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$tpares,$preciov,"0");
                            }
                            else{
                                if($dat==3){
                                    $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$tpares,$preciov,"0");
                                }
                                else{
                                    if($dat==4){
                                        $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$dato23p,$tpares,$preciov,"0");
                                    }
                                    else{
                                        if($dat==5){
                                            $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$dato23p,$dato24p,$tpares,$preciov,"0");
                                        }
                                        else{
                                            if($dat==6){
                                                $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$tpares,$preciov,"0");
                                            }
                                            else{
                                                $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$tpares,$preciov,"0");
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        //echo"datos1 $linea[1]";
                        fputcsv($file,$linea,";");
                        $cantcajas = $cantcajas + 1;
                        $totcajas = $totcajas + 1;
                        $totpares = $totpares + $tpares;
                        $totpreciov = $totpreciov + $preciov;
                    }
                }
                else{
                    //echo "file $file ";
                    $detalle = $detalle.$totcajas." Total Pares: ".$totpares." Total Precio: ".$totpreciov." ".strtoupper($marcap);
                    $totcajas = 0;  $totpares = 0;  $totpreciov = 0;
                    if($file!=null){
                        fclose($file);
                    }
                    $file = null;
                    $oficina = $dato3p;
                    if($dato3p!=null){
                        $ofic = null;
                        $separaofic = null;
                        $separaofic = explode( '/' , $dato3p);
                        //$ofic = $separaofic[0].$separaofic[1];
                        $ofic = $separaofic[1];
                        //echo"ofic $ofic";
                        if($ofic==null){
                            //$ofic = substr($dato3p,0,2);
                            $ofic = substr($separaofic[0],0,2);
                            if($ofic=="JL"){
                                $ofic = substr($separaofic[0],0,3);
                                $nomarch = $marcap.$nrofactura.$ofic.$fecha;
                            }
                            else{
                               $nomarch = $marcap.$nrofactura.$dato3p.$fecha;
                            }
                        }
                        else{
                            $ofic = substr($separaofic[0],0,2);
                            if($ofic=="JL"){
                                $ofic = substr($separaofic[0],0,3);
                            }
                            $nomarch = $marcap.$nrofactura.$ofic.$fecha;
                        }
                        //echo "nombre archivo $nomarch";
                        $archivo = "C:\\proformas\\$mesanio\\$nfactura\\$nomarch.csv";
                        //if($i>5){
                        //    $detalle = strtoupper($marcap)." ".$detalle." Oficina: ".$ofic." Total Cajas: ";
                        //}else {
                            $detalle = $detalle." Oficina: ".$ofic." Total Cajas: ";
                        //}

                        //$detalle = $detalle." Oficina: ".$ofic." Total Cajas: ";
                        //echo "direccion archivo $archivo ";
                        $totcajas = 0;
                        $file = fopen($archivo, "w");
                        fputcsv($file,$datoscabecera,";");
                        $cantcajas = 0;
                        $tpares = 0;
                        $preciov = 0;
                        // dividir el precio entre la cantidad de pares
                        $preciounitario = $dato5p/12;
                        $preciounitario = number_format($preciounitario,4,'.',',');
                        $preciov = $dato5p;
                        $tpares = 12;
                        while($dato4p>$cantcajas){
                            if($dat==1){
                                $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$tpares,$preciov,"0");
                            }
                            else{
                                if($dat==2){
                                    $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$tpares,$preciov,"0");
                                }
                                else{
                                    if($dat==3){
                                        $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$tpares,$preciov,"0");
                                    }
                                    else{
                                        if($dat==4){
                                            $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$dato23p,$tpares,$preciov,"0");
                                        }
                                        else{
                                            if($dat==5){
                                                $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$dato23p,$dato24p,$tpares,$preciov,"0");
                                            }
                                            else{
                                                if($dat==6){
                                                    $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$tpares,$preciov,"0");
                                                }
                                                else{
                                                    $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$tpares,$preciov,"0");
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            //echo"datos $linea";
                            fputcsv($file,$linea,";");
                            $cantcajas = $cantcajas + 1;
                            $totcajas = $totcajas + 1;
                            $totpares = $totpares + $tpares;
                            $totpreciov = $totpreciov + $preciov;
                        }
                    }
                    else{
                        echo"salio";
                        //verificar que el total este correcto
                        //fclose($archivo);
                    }
                }
                //}
            }
        }
        return $detalle;
    }
    else{
        echo "No existe el directorio";
    }
}
function CrearArchivosRAMARIM($marcaexcel, $return){
    $fecha = date("dmY");
    $mesanio = date("mY");
    if(file_exists("C:/proformas") == false){
        mkdir('C:/proformas', 0777, true);
    }
    $dirmesanio = "C:/proformas/".$mesanio;
    if(file_exists($dirmesanio) == false){
        mkdir($dirmesanio, 0777, true);
    }
    if(file_exists($dirmesanio)){
        //echo " entra $dirmesanio marca $marcaexcel ";
        $sql1 = "SELECT * FROM proforma_archivo where dato30 = '$marcaexcel' ORDER BY idproarchivo";
        //echo " sql $sql1";
        $sql2 = getTablaToArrayOfSQL($sql1);
        $sql3 = $sql2['resultado'];
        $row1 = NumeroTuplas($sql1);
        $row11 = $row1['resultado'];
        for($i=0; $i<=$row11; $i++){
            $proforma = $sql3[$i];
            $marcap = $proforma['marca'];
            $facturap = $proforma['factura'];
            $dato0p = $proforma['dato0'];
            $dato1p = $proforma['dato1'];
            $dato2p = $proforma['dato2'];
            $dato3p = $proforma['dato3'];
            $dato4p = $proforma['dato4'];
            $dato5p = $proforma['dato5'];
            $dato6p = $proforma['dato6'];
            $dato7p = $proforma['dato7'];
            $dato8p = $proforma['dato8'];
            $dato9p = $proforma['dato9'];
            $dato10p = $proforma['dato10'];
            $dato11p = $proforma['dato11'];
            $dato12p = $proforma['dato12'];
            $dato13p = $proforma['dato13'];
            $dato14p = $proforma['dato14'];
            $dato15p = $proforma['dato15'];
            $dato16p = $proforma['dato16'];
            $dato17p = $proforma['dato17'];
            $dato18p = $proforma['dato18'];
            $dato19p = $proforma['dato19'];
            $dato20p = $proforma['dato20'];
            $dato21p = $proforma['dato21'];
            $dato22p = $proforma['dato22'];
            $dato23p = $proforma['dato23'];
            $dato24p = $proforma['dato24'];
            $dato25p = $proforma['dato25'];
            $dato26p = $proforma['dato26'];
            $dato27p = $proforma['dato27'];
            $dato28p = $proforma['dato28'];
            $dato29p = $proforma['dato29'];
            $dato30p = $proforma['dato30'];

            if(($dato0p=="CODIGO")||($dato0p=="ARTICULO")||($dato0p=="STYLE")){
                $dat = 0;
                //echo " dato5 $dato5p dato14 $dato14p ";
                if(($dato5p=="USD")&&(($dato14p=="PRS")||($dato14p=="PARES")||($dato14p=="TOTAL PRS")||($dato14p=="TOTAL PARES"))){
                    $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,"PARES","TOTAL","ESTADO");
                }else{
                    //echo " dato15 $dato15p ";
                    if(($dato5p=="USD")&&(($dato15p=="PRS")||($dato15p=="PARES")||($dato15p=="TOTAL PRS")||($dato15p=="TOTAL PARES"))){
                        $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,"PARES","TOTAL","ESTADO");
                        $dat = 1;
                    }else{
                        //echo " dato16 $dato16p ";
                        if(($dato5p=="USD")&&(($dato16p=="PRS")||($dato16p=="PARES")||($dato16p=="TOTAL PRS")||($dato16p=="TOTAL PARES"))){
                            $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,"PARES","TOTAL","ESTADO");
                            $dat = 2;
                        }else{
                            //echo " dato25 $dato25p ";
                            if(($dato5p=="USD")&&(($dato17p=="PRS")||($dato17p=="PARES")||($dato17p=="TOTAL PRS")||($dato17p=="TOTAL PARES"))){
                                $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,"PARES","TOTAL","ESTADO");
                                $dat = 3;
                            }else{
                                echo "Existe un problema con la cabecera del archivo. Revise los nombres de la cabecera si estan correctos y vuelva a procesar";
                                break;
                            }
                        }
                    }
                }
                //echo"cabecera $datoscabecera";
                $j = $i;
                $proformaaux = $sql3[$j+1];
                $oficina = $proformaaux['dato3'];
                //echo"oficina $oficina";
                if($i<1){
                    $separafactura = explode( '/' , $facturap);
                    $nrofactura = $separafactura[0].$separafactura[1];
                    $nfactura = $separafactura[0];
                    $dirfactura = "C:/proformas/".$mesanio."/".$nfactura;
                    if(file_exists($dirfactura) == false){
                        mkdir($dirfactura, 0777, true);
                    }
                }
                $ofic = null;
                $separaofic = null;
                $separaofic = explode( '/' , $oficina);
                $ofic = $separaofic[1];
                //echo"ofic $ofic";
                if($ofic==null){
                    $nomarch = $marcap.$nrofactura.$oficina.$fecha;
                }
                else{
                    $ofic = substr($separaofic[0],0,2);
                    $nomarch = $marcap.$nrofactura.$ofic.$fecha;
                }
                //echo "nombre archivo $nomarch";
                $archivo = "C:\\proformas\\$mesanio\\$nfactura\\$nomarch.csv";
                $detalle = " Oficina: ".$ofic." Total Cajas: ";
                //echo "direccion archivo $archivo";
                $totcajas = 0;   $totpares = 0;   $totpreciov = 0;
                $file = fopen($archivo, "w");
                fputcsv($file,$datoscabecera,";");
            }
            else{
                //echo"oficina $oficina dato3p $dato3p ";
                if((substr($oficina,0,2)==substr($dato3p,0,2))&&($dato3p!=null)){   // revisar es innecesario la segunda condiciom
                    $cantcajas = 0;   $tpares = 0;   $preciov = 0;
                    // dividir el precio entre la cantidad de pares
                    switch ($dat){
                    case 1 :
                        $tpares = $dato15p/$dato4p;
                        break;
                    case 2 :
                        $tpares = $dato16p/$dato4p;
                        break;
                    case 3 :
                        $tpares = $dato17p/$dato4p;
                        break;
                    default:
                        $tpares = $dato14p/$dato4p;
                        break;
                    }
                    $preciounitario = $dato5p/12;
                    $preciounitario = number_format($preciounitario,4,'.',',');
                    $preciov = $preciounitario*$tpares;
                    $preciov = number_format($preciov,2,'.',',');
                    //echo"dato4p $dato4p cantcajas $cantcajas ";
                    while($dato4p>$cantcajas){
                        if($dat==1){
                            $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$tpares,$preciov,"0");
                        }
                        else{
                            if($dat==2){
                                $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$tpares,$preciov,"0");
                            }
                            else{
                                if($dat==3){
                                    $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$tpares,$preciov,"0");
                                }
                                else{
                                    $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$tpares,$preciov,"0");
                                }
                            }
                        }
                        //echo"datos1 $linea[1]";
                        fputcsv($file,$linea,";");
                        $cantcajas = $cantcajas + 1;
                        $totcajas = $totcajas + 1;
                        $totpares = $totpares + $tpares;
                        $totpreciov = $totpreciov + $preciov;

                    }
                }
                else{
                    //echo "file $file ";
                    $detalle = $detalle.$totcajas." Total Pares: ".$totpares." Total Precio: ".$totpreciov;
                    $totcajas = 0;  $totpares = 0;  $totpreciov = 0;
                    if($file!=null){
                        fclose($file);
                    }
                    $file = null;
                    $oficina = $dato3p;
                    if($dato3p!=null){
                        $ofic = null;
                        $separaofic = null;
                        $separaofic = explode( '/' , $dato3p);
                        //$ofic = $separaofic[0].$separaofic[1];
                        $ofic = $separaofic[1];
                        //echo"ofic $ofic";
                        if($ofic==null){
                            //$ofic = substr($dato3p,0,2);
                            $ofic = substr($separaofic[0],0,2);
                            if($ofic=="JL"){
                                $ofic = substr($separaofic[0],0,3);
                                $nomarch = $marcap.$nrofactura.$ofic.$fecha;
                            }
                            else{
                               $nomarch = $marcap.$nrofactura.$dato3p.$fecha;
                            }
                        }
                        else{
                            $ofic = substr($separaofic[0],0,2);
                            if($ofic=="JL"){
                                $ofic = substr($separaofic[0],0,3);
                            }
                            $nomarch = $marcap.$nrofactura.$ofic.$fecha;
                        }
                        //echo "nombre archivo $nomarch";
                        $archivo = "C:\\proformas\\$mesanio\\$nfactura\\$nomarch.csv";
                        $detalle = $detalle." Oficina: ".$ofic." Total Cajas: ";
                        //echo "direccion archivo $archivo ";
                        $file = fopen($archivo, "w");
                        fputcsv($file,$datoscabecera,";");
                        $cantcajas = 0;
                        $tpares = 0;
                        $preciov = 0;
                        // dividir el precio entre la cantidad de pares
                        switch ($dat){
                        case 1 :
                            $tpares = $dato15p/$dato4p;
                            break;
                        case 2 :
                            $tpares = $dato16p/$dato4p;
                            break;
                        case 3 :
                            $tpares = $dato17p/$dato4p;
                            break;
                        default:
                            $tpares = $dato14p/$dato4p;
                            break;
                        }
                        $preciounitario = $dato5p/12;
                        $preciounitario = number_format($preciounitario,4,'.',',');
                        $preciov = $preciounitario*$tpares;
                        $preciov = number_format($preciov,2,'.',',');
                        //echo"dato4p $dato4p cantcajas $cantcajas ";
                        while($dato4p>$cantcajas){
                            if($dat==1){
                                $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$tpares,$preciov,"0");
                            }
                            else{
                                if($dat==2){
                                    $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$tpares,$preciov,"0");
                                }
                                else{
                                    if($dat==3){
                                        $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$tpares,$preciov,"0");
                                    }
                                    else{
                                        $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$tpares,$preciov,"0");
                                    }
                                }
                            }
                            //echo"datos $linea";
                            fputcsv($file,$linea,";");
                            $cantcajas = $cantcajas + 1;
                            $totcajas = $totcajas + 1;
                            $totpares = $totpares + $tpares;
                            $totpreciov = $totpreciov + $preciov;
                        }
                    }
                    else{
                        echo"salio";
                        //verificar que el total este correcto
                        //fclose($archivo);
                    }
                }
            }
        }
        return $detalle;
    }
    else{
        echo "No existe el directorio. Llame a sistemas!!!!!";
    }
}
function CrearArchivosVIABEACH($marcaexcel, $return){
    $fecha = date("dmY");
    $mesanio = date("mY");
    if(file_exists("C:/proformas") == false){
        mkdir('C:/proformas', 0777, true);
    }
    $dirmesanio = "C:/proformas/".$mesanio;
    if(file_exists($dirmesanio) == false){
        mkdir($dirmesanio, 0777, true);
    }
    if(file_exists($dirmesanio)){
        //echo " entra $dirmesanio marca $marcaexcel ";
        $sql1 = "SELECT * FROM proforma_archivo where dato30 = '$marcaexcel' ORDER BY idproarchivo";
        $sql2 = getTablaToArrayOfSQL($sql1);
        $sql3 = $sql2['resultado'];
        $row1 = NumeroTuplas($sql1);
        $row11 = $row1['resultado'];
        for($i=0; $i<=$row11; $i++){
            $proforma = $sql3[$i];
            $marcap = $proforma['marca'];
            $facturap = $proforma['factura'];
            $dato0p = str_replace(' ', '', $proforma['dato0']);  ///Reemplazar espacios en blanco
            $dato1p = $proforma['dato1'];
            $dato2p = $proforma['dato2'];
            $dato3p = $proforma['dato3'];
            $dato4p = $proforma['dato4'];
            $dato5p = $proforma['dato5'];
            $dato6p = $proforma['dato6'];
            $dato7p = $proforma['dato7'];
            $dato8p = $proforma['dato8'];
            $dato9p = $proforma['dato9'];
            $dato10p = $proforma['dato10'];
            $dato11p = $proforma['dato11'];
            $dato12p = $proforma['dato12'];
            $dato13p = $proforma['dato13'];
            $dato14p = $proforma['dato14'];
            $dato15p = $proforma['dato15'];
            $dato16p = $proforma['dato16'];
            $dato17p = $proforma['dato17'];
            $dato18p = $proforma['dato18'];
            $dato19p = $proforma['dato19'];
            $dato20p = $proforma['dato20'];
            $dato21p = $proforma['dato21'];
            $dato22p = $proforma['dato22'];
            $dato23p = $proforma['dato23'];
            $dato24p = $proforma['dato24'];
            $dato25p = $proforma['dato25'];
            $dato26p = $proforma['dato26'];
            $dato27p = $proforma['dato27'];
            $dato28p = $proforma['dato28'];
            $dato29p = $proforma['dato29'];
            $dato30p = $proforma['dato30'];

            if(($dato0p=="STYLE")||($dato0p=="REF.")){
                $dat = 0;
                if((($dato4p=="CAJAS")||($dato4p=="CJS"))&&(($dato20p=="PRS")||($dato20p=="PARES")||($dato20p=="TOTAL PARES"))){
                    $separatalla = explode( '/' , $dato6p);   
                    if($separatalla[0]>0){
                        $talla17 = $separatalla[0];    $talla18 = $separatalla[1];
                        $separatalla = explode( '/' , $dato7p);   $talla19 = $separatalla[0];   $talla20 = $separatalla[1];
                        $separatalla = explode( '/' , $dato8p);   $talla21 = $separatalla[0];   $talla22 = $separatalla[1];
                        $separatalla = explode( '/' , $dato9p);   $talla23 = $separatalla[0];   $talla24 = $separatalla[1];
                        $separatalla = explode( '/' , $dato10p);   $talla25 = $separatalla[0];   $talla26 = $separatalla[1];
                        $separatalla = explode( '/' , $dato11p);   $talla27 = $separatalla[0];   $talla28 = $separatalla[1];
                        $separatalla = explode( '/' , $dato12p);   $talla29 = $separatalla[0];   $talla30 = $separatalla[1];
                        $separatalla = explode( '/' , $dato13p);   $talla31 = $separatalla[0];   $talla32 = $separatalla[1];
                        $separatalla = explode( '/' , $dato14p);   $talla33 = $separatalla[0];   $talla34 = $separatalla[1];
                        $talla35 = "35";  $talla36 = "36";  $talla37 = "37";  $talla38 = "38";  $talla39 = "39";  $talla40 = "40";
                        $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$talla17,$talla18,$talla19,$talla20,$talla21,$talla22,$talla23,$talla24,$talla25,$talla26,$talla27,$talla28,$talla29,$talla30,$talla31,$talla32,$talla33,$talla34,$talla35,$talla36,$talla37,$talla38,$talla39,$talla40,"PARES","TOTAL","ESTADO");
                    }
                    else{
                        $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","PARES","TOTAL","ESTADO");
                    }
                }
                else{
                    if((($dato3p=="CAJAS")||($dato3p=="CJS"))&&(($dato19p=="PRS")||($dato19p=="PARES")||($dato19p=="TOTAL PARES"))){
                        $separatalla = explode( '/' , $dato5p);
                        if($separatalla[0]>0){
                            $talla17 = $separatalla[0];    $talla18 = $separatalla[1];
                            $separatalla = explode( '/' , $dato6p);   $talla19 = $separatalla[0];   $talla20 = $separatalla[1];
                            $separatalla = explode( '/' , $dato7p);   $talla21 = $separatalla[0];   $talla22 = $separatalla[1];
                            $separatalla = explode( '/' , $dato8p);   $talla23 = $separatalla[0];   $talla24 = $separatalla[1];
                            $separatalla = explode( '/' , $dato9p);   $talla25 = $separatalla[0];   $talla26 = $separatalla[1];
                            $separatalla = explode( '/' , $dato10p);   $talla27 = $separatalla[0];   $talla28 = $separatalla[1];
                            $separatalla = explode( '/' , $dato11p);   $talla29 = $separatalla[0];   $talla30 = $separatalla[1];
                            $separatalla = explode( '/' , $dato12p);   $talla31 = $separatalla[0];   $talla32 = $separatalla[1];
                            $separatalla = explode( '/' , $dato13p);   $talla33 = $separatalla[0];   $talla34 = $separatalla[1];
                            $talla35 = "35";  $talla36 = "36";  $talla37 = "37";  $talla38 = "38";  $talla39 = "39";  $talla40 = "40";
                            $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$talla17,$talla18,$talla19,$talla20,$talla21,$talla22,$talla23,$talla24,$talla25,$talla26,$talla27,$talla28,$talla29,$talla30,$talla31,$talla32,$talla33,$talla34,$talla35,$talla36,$talla37,$talla38,$talla39,$talla40,"PARES","TOTAL","ESTADO");
                        }
                        else{
                            $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","PARES","TOTAL","ESTADO");
                        }
                        $dat = 1;
                    }
                    else{
                        if((($dato4p=="CAJAS")||($dato4p=="CJS"))&&(($dato29p=="PRS")||($dato29p=="PARES")||($dato29p=="TOTAL PARES"))){
                            $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","PARES","TOTAL","ESTADO");
                            $dat = 2;
                        }
                            else{
                            if((($dato4p=="CAJAS")||($dato4p=="CJS"))&&(($dato28p=="PRS")||($dato28p=="PARES")||($dato28p=="TOTAL PARES"))){
                                $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","PARES","TOTAL","ESTADO");
                                $dat = 3;
                            }
                            else{
                                echo "Existe un problema con la cabecera del archivo. Revise el archivo que subio y vuelva a procesar";
                                break;
                            }
                        }
                    }
                }
                //echo"cabecera $datoscabecera";
                $j = $i;
                $proformaaux = $sql3[$j+1];
                if($dat==1){
                    $oficina = $proformaaux['dato2'];
                }
                else{
                    $oficina = $proformaaux['dato3'];
                }
                //echo"oficina $oficina";
                if($i<1){
                    $separafactura = explode( '/' , $facturap);
                    $nrofactura = $separafactura[0].$separafactura[1];
                    $nfactura = $separafactura[0];
                    $dirfactura = "C:/proformas/".$mesanio."/".$nfactura;
                    if(file_exists($dirfactura) == false){
                        mkdir($dirfactura, 0777, true);
                    }
                }
                $ofic = null;
                $separaofic = null;
                $separaofic = explode( '/' , $oficina);
                $ofic = $separaofic[1];
                //echo"ofic $ofic";
                if($ofic==null){
                    $nomarch = $marcap.$nrofactura.$oficina.$fecha;
                }
                else{
                    $ofic = substr($separaofic[0],0,2);
                    $nomarch = $marcap.$nrofactura.$ofic.$fecha;
                }
                //echo "nombre archivo $nomarch";
                $archivo = "C:\\proformas\\$mesanio\\$nrofactura\\$nomarch.csv";
                $detalle = " Oficina: ".$ofic." Total Cajas: ";
                //echo "direccion archivo $archivo";
                $totcajas = 0;   $totpares = 0;   $totpreciov = 0;
                $file = fopen($archivo, "w");
                fputcsv($file,$datoscabecera,";");
            }
            else{
                //echo"oficina $oficina dato3p $dato3p ";
                $oficp = null;
                if($dat==1){
                    $oficp = $dato2p;
                }
                else{
                    $oficp = $dato3p;
                }
                if((substr($oficina,0,2)==substr($oficp,0,2))&&($oficp!=null)){   // revisar es innecesario la segunda condiciom
                    $cantcajas = 0;
                    if($dat==0){
                        $preciounitario = $dato3p/12;
                        $preciounitario = number_format($preciounitario,4,'.',',');
                        //echo"dato4p $dato4p cantcajas $cantcajas ";
                        while($dato4p>$cantcajas){
                            $linea = array($dato0p,"-",$dato1p,$dato2p,"","1",$dato3p,$preciounitario,$dato5p,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$dato23p,$dato24p,$dato25p,$dato26p,$dato27p,"12",$dato3p,"0");
                            //echo"datos1 $linea[1]";
                            fputcsv($file,$linea,";");
                            $cantcajas = $cantcajas + 1;
                            $totcajas = $totcajas + 1;
                            $totpares = $totpares + 12;
                            $totpreciov = $totpreciov + $dato3p;
                        }
                    }
                    else{
                        if($dat==1){
                            $preciounitario = $dato4p/12;
                            $preciounitario = number_format($preciounitario,4,'.',',');
                            //echo"dato4p $dato4p cantcajas $cantcajas ";
                            $material = null;
                            $color = null;
                            $separamc = explode( '-' , $dato1p);
                            //echo " dato1p $dato1p separamc $separamc 0 $separamc[0] 1 $separamc[1] ";
                            $material = $separamc[0];
                            $color = $separamc[1];
                            while($dato4p>$cantcajas){
                                $linea = array($dato0p,$material,$color,$dato2p,"","1",$dato3p,$preciounitario,$dato5p,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$dato23p,$dato24p,$dato25p,$dato26p,$dato27p,$dato28p,"12",$dato3p,"0");
                                //echo"datos1 $linea[1]";
                                fputcsv($file,$linea,";");
                                $cantcajas = $cantcajas + 1;
                                $totcajas = $totcajas + 1;
                                $totpares = $totpares + 12;
                                $totpreciov = $totpreciov + $dato3p;
                            }
                        }
                        else{
                            if($dat==2){
                                $preciounitario = $dato3p/12;
                                $preciounitario = number_format($preciounitario,4,'.',',');
                                //echo"dato4p $dato4p cantcajas $cantcajas ";
                                while($dato4p>$cantcajas){
                                    $linea = array($dato0p,"-",$dato1p,$dato2p,"","1",$dato3p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$dato23p,$dato24p,$dato25p,$dato26p,$dato27p,"12",$dato5p,"0");
                                    //echo"datos1 $linea[1]";
                                    fputcsv($file,$linea,";");
                                    $cantcajas = $cantcajas + 1;
                                    $totcajas = $totcajas + 1;
                                    $totpares = $totpares + 12;
                                    $totpreciov = $totpreciov + $dato3p;
                                }
                            }
                            else{
                                if($dat==3){
                                    $preciounitario = $dato3p/12;
                                    $preciounitario = number_format($preciounitario,4,'.',',');
                                    //echo"dato4p $dato4p cantcajas $cantcajas ";
                                    while($dato4p>$cantcajas){
                                        $linea = array($dato0p,"-",$dato1p,$dato2p,"","1",$dato3p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$dato23p,$dato24p,$dato25p,$dato26p,$dato27p,$dato28p,"12",$dato5p,"0");
                                        //echo"datos1 $linea[1]";
                                        fputcsv($file,$linea,";");
                                        $cantcajas = $cantcajas + 1;
                                        $totcajas = $totcajas + 1;
                                        $totpares = $totpares + 12;
                                        $totpreciov = $totpreciov + $dato3p;
                                    }
                                }
                            }
                        }
                    }
                }
                else{
                    //echo "file $file ";
                    $detalle = $detalle.$totcajas." Total Pares: ".$totpares." Total Precio: ".$totpreciov;
                    $totcajas = 0;  $totpares = 0;  $totpreciov = 0;
                    if($file!=null){
                        fclose($file);
                    }
                    $file = null;
                    if($dat==1){
                        $oficina = $dato2p;
                    }
                    else{
                        $oficina = $dato3p;
                    }
                    if($oficina!=null){
                        $ofic = null;
                        $separaofic = null;
                        $separaofic = explode( '/' , $oficina);
                        $ofic = $separaofic[1];
                        //echo"ofic $ofic";
                        if($ofic==null){
                            //$ofic = substr($dato3p,0,2);
                            $ofic = substr($separaofic[0],0,2);
                            if($ofic=="JL"){
                                $ofic = substr($separaofic[0],0,3);
                                $nomarch = $marcap.$nrofactura.$ofic.$fecha;
                            }
                            else{
                               $nomarch = $marcap.$nrofactura.$oficina.$fecha;
                            }
                        }
                        else{
                            $ofic = substr($separaofic[0],0,2);
                            if($ofic=="JL"){
                                $ofic = substr($separaofic[0],0,3);
                            }
                            $nomarch = $marcap.$nrofactura.$ofic.$fecha;
                        }
                        //echo "nombre archivo $nomarch";
                        $archivo = "C:\\proformas\\$mesanio\\$nfactura\\$nomarch.csv";
                        $detalle = $detalle." Oficina: ".$ofic." Total Cajas: ";
                        //echo "direccion archivo $archivo ";
                        $file = fopen($archivo, "w");
                        fputcsv($file,$datoscabecera,";");
                        $cantcajas = 0;
                        if($dat==0){
                            $preciounitario = $dato3p/12;
                            $preciounitario = number_format($preciounitario,4,'.',',');
                            //echo"dato4p $dato4p cantcajas $cantcajas ";
                            while($dato4p>$cantcajas){
                                $linea = array($dato0p,"-",$dato1p,$dato2p,"","1",$dato3p,$preciounitario,$dato5p,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$dato23p,$dato24p,$dato25p,$dato26p,$dato27p,"12",$dato3p,"0");
                                //echo"datos1 $linea[1]";
                                fputcsv($file,$linea,";");
                                $cantcajas = $cantcajas + 1;
                                $totcajas = $totcajas + 1;
                                $totpares = $totpares + 12;
                                $totpreciov = $totpreciov + $dato3p;
                            }
                        }
                        else{
                            if($dat==1){
                                $preciounitario = $dato4p/12;
                                $preciounitario = number_format($preciounitario,4,'.',',');
                                //echo"dato4p $dato4p cantcajas $cantcajas ";
                                $material = null;
                                $color = null;
                                $separamc = explode( '-' , $dato1p);
                                //echo " dato1p $dato1p separamc $separamc 0 $separamc[0] 1 $separamc[1] ";
                                $material = $separamc[0];
                                $color = $separamc[1];
                                while($dato4p>$cantcajas){
                                    $linea = array($dato0p,$material,$color,$dato2p,"","1",$dato3p,$preciounitario,$dato5p,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$dato23p,$dato24p,$dato25p,$dato26p,$dato27p,$dato28p,"12",$dato3p,"0");
                                    //echo"datos1 $linea[1]";
                                    fputcsv($file,$linea,";");
                                    $cantcajas = $cantcajas + 1;
                                    $totcajas = $totcajas + 1;
                                    $totpares = $totpares + 12;
                                    $totpreciov = $totpreciov + $dato3p;
                                }
                            }
                            else{
                                if($dat==2){
                                    $preciounitario = $dato3p/12;
                                    $preciounitario = number_format($preciounitario,4,'.',',');
                                    //echo"dato4p $dato4p cantcajas $cantcajas ";
                                    while($dato4p>$cantcajas){
                                        $linea = array($dato0p,"-",$dato1p,$dato2p,"","1",$dato3p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$dato23p,$dato24p,$dato25p,$dato26p,$dato27p,"12",$dato5p,"0");
                                        //echo"datos1 $linea[1]";
                                        fputcsv($file,$linea,";");
                                        $cantcajas = $cantcajas + 1;
                                        $totcajas = $totcajas + 1;
                                        $totpares = $totpares + 12;
                                        $totpreciov = $totpreciov + $dato3p;
                                    }
                                }
                                else{
                                    if($dat==3){
                                        $preciounitario = $dato3p/12;
                                        $preciounitario = number_format($preciounitario,4,'.',',');
                                        //echo"dato4p $dato4p cantcajas $cantcajas ";
                                        while($dato4p>$cantcajas){
                                            $linea = array($dato0p,"-",$dato1p,$dato2p,"","1",$dato3p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$dato23p,$dato24p,$dato25p,$dato26p,$dato27p,$dato28p,"12",$dato5p,"0");
                                            //echo"datos1 $linea[1]";
                                            fputcsv($file,$linea,";");
                                            $cantcajas = $cantcajas + 1;
                                            $totcajas = $totcajas + 1;
                                            $totpares = $totpares + 12;
                                            $totpreciov = $totpreciov + $dato3p;
                                        }
                                    }
                                }
                            }
                        }
                    }
                    else{
                        echo"salio";
                        //verificar que el total este correcto
                        //fclose($archivo);
                    }
                }
                //}
            }
        }
    }
}

function CrearArchivosWESTCOAST($marcaexcel, $return){
    $fecha = date("dmY");
    $mesanio = date("mY");
    if(file_exists("C:/proformas") == false){
        mkdir('C:/proformas', 0777, true);
    }
    $dirmesanio = "C:/proformas/".$mesanio;
    if(file_exists($dirmesanio) == false){
        mkdir($dirmesanio, 0777, true);
    }
    if(file_exists($dirmesanio)){
        //echo " entra $dirmesanio marca $marcaexcel ";
        $sql1 = "SELECT * FROM proforma_archivo where dato30 = '$marcaexcel' ORDER BY idproarchivo";
        $sql2 = getTablaToArrayOfSQL($sql1);
        $sql3 = $sql2['resultado'];
        $row1 = NumeroTuplas($sql1);
        $row11 = $row1['resultado'];
        for($i=0; $i<=$row11; $i++){
            $proforma = $sql3[$i];
            $marcap = $proforma['marca'];
            $facturap = $proforma['factura'];
            $dato0p = $proforma['dato0'];
            $dato1p = $proforma['dato1'];
            $dato2p = $proforma['dato2'];
            $dato3p = $proforma['dato3'];
            $dato4p = $proforma['dato4'];
            $dato5p = $proforma['dato5'];
            $dato6p = $proforma['dato6'];
            $dato7p = $proforma['dato7'];
            $dato8p = $proforma['dato8'];
            $dato9p = $proforma['dato9'];
            $dato10p = $proforma['dato10'];
            $dato11p = $proforma['dato11'];
            $dato12p = $proforma['dato12'];
            $dato13p = $proforma['dato13'];
            $dato14p = $proforma['dato14'];
            $dato15p = $proforma['dato15'];
            $dato16p = $proforma['dato16'];
            $dato17p = $proforma['dato17'];
            $dato18p = $proforma['dato18'];
            $dato19p = $proforma['dato19'];
            $dato20p = $proforma['dato20'];
            $dato21p = $proforma['dato21'];
            $dato22p = $proforma['dato22'];
            $dato23p = $proforma['dato23'];
            $dato24p = $proforma['dato24'];

            if(($dato0p=="STYLE")||($dato0p=="MODELO")){
                $dat = 0;
                if((($dato5p=="CAJAS")||($dato5p=="CJS"))&&(($dato14p=="PRS")||($dato14p=="PARES")||($dato14p=="TOTAL PARES"))){
                    $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,"PARES","TOTAL","ESTADO");
                }
                else{
                    echo "Existe un problema con la cabecera del archivo. Revise el archivo que subio y vuelva a procesar";
                    break;
                }
                //echo"cabecera $datoscabecera";
                $j = $i;
                $proformaaux = $sql3[$j+1];
                $oficina = $proformaaux['dato3'];
                //echo"oficina $oficina";
                if($i<1){
                    $separafactura = explode( '/' , $facturap);
                    $nrofactura = $separafactura[0].$separafactura[1];
                    $nfactura = $separafactura[0];
                    $dirfactura = "C:/proformas/".$mesanio."/".$nfactura;
                    if(file_exists($dirfactura) == false){
                        mkdir($dirfactura, 0777, true);
                    }
                }
                $ofic = null;
                $separaofic = null;
                $separaofic = explode( '/' , $oficina);
                //$ofic = $separaofic[0].$separaofic[1];
                $ofic = $separaofic[1];
                $mar = "WestCoast";
                //echo"ofic $ofic";
                if($ofic==null){
                    //$ofic = substr($oficina,0,2);
                    $nomarch = $mar.$nrofactura.$oficina.$fecha;
                }
                else{
                    $ofic = substr($separaofic[0],0,2);
                    $nomarch = $mar.$nrofactura.$ofic.$fecha;
                }
                //echo "nombre archivo $nomarch";
                $archivo = "C:\\proformas\\$mesanio\\$nfactura\\$nomarch.csv";
                $detalle = " Oficina: ".$ofic." Total Cajas: ";
                //echo "direccion archivo $archivo";
                $totcajas = 0;   $totpares = 0;   $totpreciov = 0;
                $file = fopen($archivo, "w");
                fputcsv($file,$datoscabecera,";");
            }
            else{
                //echo"oficina $oficina dato3p $dato3p ";
                if((substr($oficina,0,2)==substr($dato3p,0,2))&&($dato3p!=null)){   // revisar es innecesario la segunda condiciom
                    $cantcajas = 0;
                    $preciounitario = $dato4p/12;
                    //$preciounitario = $dato5p;
                    $preciounitario = number_format($preciounitario,2,'.',',');
//echo"dato4p $dato4p cantcajas $cantcajas ";
                    while($dato5p>$cantcajas){
                        $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato4p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,"12",$dato4p,"0");
                        //$linea = array($dato0p,"-","-",$dato2p,"","1",$dato4p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,"0");
                        //echo"datos1 $linea[1]";
                        fputcsv($file,$linea,";");
                        $cantcajas = $cantcajas + 1;
                        $totcajas = $totcajas + 1;
                        $totpares = $totpares + 12;
                        $totpreciov = $totpreciov + $dato4p;
                    }
                }
                else{
                    //echo "file $file ";
                    $detalle = $detalle.$totcajas." Total Pares: ".$totpares." Total Precio: ".$totpreciov;
                    $totcajas = 0;  $totpares = 0;  $totpreciov = 0;
                    if($file!=null){
                        fclose($file);
                    }
                    $file = null;
                    $oficina = $dato3p;
                    if($dato3p!=null){
                        $ofic = null;
                        $separaofic = null;
                        $separaofic = explode( '/' , $dato3p);
                        $ofic = $separaofic[1];
                        //echo"ofic $ofic";
                        if($ofic==null){
                            $nomarch = $mar.$nrofactura.$dato3p.$fecha;
                        }
                        else{
                            $ofic = substr($separaofic[0],0,2);
                            $nomarch = $mar.$nrofactura.$ofic.$fecha;
                        }
                        //echo "nombre archivo $nomarch";
                        $archivo = "C:\\proformas\\$mesanio\\$nfactura\\$nomarch.csv";
                        $detalle = $detalle." Oficina: ".$ofic." Total Cajas: ";
                        //echo "direccion archivo $archivo ";
                        $file = fopen($archivo, "w");
                        fputcsv($file,$datoscabecera,";");
                        $cantcajas = 0;
                        $preciounitario = $dato4p;
                        $preciounitario = number_format($preciounitario,2,'.',',');
                        while($dato5p>$cantcajas){
                            $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato4p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,"12",$dato4p,"0");
                            //$linea = array($dato0p,"-","-",$dato2p,"","1",$dato4p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,"0");
                            //echo"datos $linea";
                            fputcsv($file,$linea,";");
                            $cantcajas = $cantcajas + 1;
                            $totcajas = $totcajas + 1;
                            $totpares = $totpares + 12;
                            $totpreciov = $totpreciov + $dato4p;
                        }
                    }
                    else{
                        echo"salio";
                        //verificar que el total este correcto
                        //fclose($archivo);
                    }
                }
                //}
            }
        }
        return $detalle;
    }
    else{
        echo "No existe el directorio";
    }
}

function CrearArchivosCOCACOLA($marcaexcel, $return){
    $fecha = date("dmY");
    $mesanio = date("mY");
    if(file_exists("C:/proformas") == false){
        mkdir('C:/proformas', 0777, true);
    }
    $dirmesanio = "C:/proformas/".$mesanio;
    if(file_exists($dirmesanio) == false){
        mkdir($dirmesanio, 0777, true);
    }
    if(file_exists($dirmesanio)){
        //echo " entra $dirmesanio marca $marcaexcel ";
        $sql1 = "SELECT * FROM proforma_archivo where dato30 = '$marcaexcel' ORDER BY idproarchivo";
        $sql2 = getTablaToArrayOfSQL($sql1);
        $sql3 = $sql2['resultado'];
        $row1 = NumeroTuplas($sql1);
        $row11 = $row1['resultado'];
        for($i=0; $i<=$row11; $i++){
            $proforma = $sql3[$i];
            $marcap = $proforma['marca'];
            $facturap = $proforma['factura'];
            $dato0p = $proforma['dato0'];
            $dato1p = $proforma['dato1'];
            $dato2p = $proforma['dato2'];
            $dato3p = $proforma['dato3'];
            $dato4p = $proforma['dato4'];
            $dato5p = $proforma['dato5'];
            $dato6p = $proforma['dato6'];
            $dato7p = $proforma['dato7'];
            $dato8p = $proforma['dato8'];
            $dato9p = $proforma['dato9'];
            $dato10p = $proforma['dato10'];
            $dato11p = $proforma['dato11'];
            $dato12p = $proforma['dato12'];
            $dato13p = $proforma['dato13'];
            $dato14p = $proforma['dato14'];
            $dato15p = $proforma['dato15'];
            $dato16p = $proforma['dato16'];
            $dato17p = $proforma['dato17'];
            $dato18p = $proforma['dato18'];
            $dato19p = $proforma['dato19'];
            $dato20p = $proforma['dato20'];
            $dato21p = $proforma['dato21'];
            $dato22p = $proforma['dato22'];
            $dato23p = $proforma['dato23'];
            $dato24p = $proforma['dato24'];

            if(($dato0p=="CODIGO")||($dato0p=="REF")){
                $dat = 0;
                if(($dato4p=="USD")&&($dato17p=="TOTAL PRS")||($dato4p=="USD")&&($dato17p=="TOTAL PRS.")){
                    $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato5p,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,"PARES","TOTAL","ESTADO");
                }
                else{
                    echo "Existe un problema con la cabecera del archivo. Revise el archivo que subio y vuelva a procesar";
                    break;
                }
                //echo"cabecera $datoscabecera";
                $j = $i;
                $proformaaux = $sql3[$j+1];
                $oficina = $proformaaux['dato2'];
                //echo"oficina $oficina";
                if($i<1){
                    $separafactura = explode( '/' , $facturap);
                    $nrofactura = $separafactura[0].$separafactura[1];
                    $nfactura = $separafactura[0];
                    $dirfactura = "C:/proformas/".$mesanio."/".$nfactura;
                    if(file_exists($dirfactura) == false){
                        mkdir($dirfactura, 0777, true);
                    }
                }
                $ofic = null;
                $separaofic = null;
                $separaofic = explode( '/' , $oficina);
                $ofic = $separaofic[1];
                $mar = "CocaCola";
                //echo" oficprimero  $ofic";
                if($ofic==null){
                    //$ofic = substr($oficina,0,2);
                    $nomarch = $mar.$nrofactura.$oficina.$fecha;
                }
                else{
                    $ofic = substr($separaofic[0],0,2);
                    if($ofic=="OF"){
                        $ofic = $separaofic[0].$separaofic[1];
                    }
                    $nomarch = $mar.$nrofactura.$ofic.$fecha;
                }
                //echo "nombre archivo $nomarch";
                $archivo = "C:\\proformas\\$mesanio\\$nfactura\\$nomarch.csv";
                $detalle = " Oficina: ".$ofic." Total Cajas: ";
                //echo "direccion archivo $archivo";
                $totcajas = 0;   $totpares = 0;   $totpreciov = 0;
                $file = fopen($archivo, "w");
                fputcsv($file,$datoscabecera,";");
            }
            else{
                //echo"oficina $oficina dato3p $dato3p ";
                if((substr($oficina,0,2)==substr($dato2p,0,2))&&($dato2p!=null)){   // revisar es innecesario la segunda condiciom
                    $cantcajas = 0;
                    $preciounitario = $dato4p/12;
                    $preciounitario = number_format($preciounitario,4,'.',',');
                    //echo"dato4p $dato4p cantcajas $cantcajas ";
                    while($dato3p>$cantcajas){
                        $linea = array($dato0p,"-",$dato1p,$dato2p,"","1",$dato4p,$preciounitario,$dato5p,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,"12",$dato4p,"0");
                        //echo"datos1 $linea[1]";
                        fputcsv($file,$linea,";");
                        $cantcajas = $cantcajas + 1;
                        $totcajas = $totcajas + 1;
                        $totpares = $totpares + 12;
                        $totpreciov = $totpreciov + $dato4p;
                    }
                }
                else{
                    //echo "file $file ";
                    $detalle = $detalle.$totcajas." Total Pares: ".$totpares." Total Precio: ".$totpreciov;
                    $totcajas = 0;  $totpares = 0;  $totpreciov = 0;
                    if($file!=null){
                        fclose($file);
                    }
                    $file = null;
                    $oficina = $dato2p;
                    if($dato2p!=null){
                        $ofic = null;
                        $separaofic = null;
                        $separaofic = explode( '/' , $dato2p);
                        $ofic = $separaofic[1];
                        $mar = "CocaCola";
                        //echo" ofic $ofic";
                        if($ofic==null){
                            //$ofic = substr($dato3p,0,2);
                            $nomarch = $mar.$nrofactura.$dato2p.$fecha;
                        }
                        else{
                            $ofic = substr($separaofic[0],0,2);
                            if($ofic=="OF"){
                                $ofic = $separaofic[0].$separaofic[1];
                            }
                            $nomarch = $mar.$nrofactura.$ofic.$fecha;
                        }
                        //echo "nombre archivo $nomarch";
                        $archivo = "C:\\proformas\\$mesanio\\$nfactura\\$nomarch.csv";
                        $detalle = $detalle." Oficina: ".$ofic." Total Cajas: ";
                        //echo "direccion archivo $archivo ";
                        $file = fopen($archivo, "w");
                        fputcsv($file,$datoscabecera,";");
                        $cantcajas = 0;
                        $preciounitario = $dato4p/12;
                        $preciounitario = number_format($preciounitario,4,'.',',');
                        while($dato3p>$cantcajas){
                            $linea = array($dato0p,"-",$dato1p,$dato2p,"","1",$dato4p,$preciounitario,$dato5p,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,"12",$dato4p,"0");
                            //echo"datos $linea";
                            fputcsv($file,$linea,";");
                            $cantcajas = $cantcajas + 1;
                            $totcajas = $totcajas + 1;
                            $totpares = $totpares + 12;
                            $totpreciov = $totpreciov + $dato4p;
                        }
                    }
                    else{
                        echo"salio";
                        //verificar que el total este correcto
                        //fclose($archivo);
                    }
                }
                //}
            }
        }
        return $detalle;
    }
    else{
        echo "No existe el directorio";
    }
}

function CrearArchivosKIDY($marcaexcel, $return){
    $fecha = date("dmY");
    $mesanio = date("mY");
    if(file_exists("C:/proformas") == false){
        mkdir('C:/proformas', 0777, true);
    }
    $dirmesanio = "C:/proformas/".$mesanio;
    if(file_exists($dirmesanio) == false){
        mkdir($dirmesanio, 0777, true);
    }
    if(file_exists($dirmesanio)){
        //echo " entra $dirmesanio marca $marcaexcel ";
        $sql1 = "SELECT * FROM proforma_archivo where dato30 = '$marcaexcel' ORDER BY idproarchivo";
        $sql2 = getTablaToArrayOfSQL($sql1);
        $sql3 = $sql2['resultado'];
        $row1 = NumeroTuplas($sql1);
        $row11 = $row1['resultado'];
        for($i=0; $i<=$row11; $i++){
            $proforma = $sql3[$i];
            $marcap = $proforma['marca'];
            $facturap = $proforma['factura'];
            //$dato0p = str_replace(' ', '', $proforma['dato0']);  ///Reemplazar espacios en blanco
            $dato0p = $proforma['dato0'];
            $dato1p = $proforma['dato1'];
            $dato2p = $proforma['dato2'];
            $dato3p = $proforma['dato3'];
            $dato4p = $proforma['dato4'];
            $dato5p = $proforma['dato5'];
            $dato6p = $proforma['dato6'];
            $dato7p = $proforma['dato7'];
            $dato8p = $proforma['dato8'];
            $dato9p = $proforma['dato9'];
            $dato10p = $proforma['dato10'];
            $dato11p = $proforma['dato11'];
            $dato12p = $proforma['dato12'];
            $dato13p = $proforma['dato13'];
            $dato14p = $proforma['dato14'];
            $dato15p = $proforma['dato15'];
            $dato16p = $proforma['dato16'];
            $dato17p = $proforma['dato17'];
            $dato18p = $proforma['dato18'];
            $dato19p = $proforma['dato19'];
            $dato20p = $proforma['dato20'];
            $dato21p = $proforma['dato21'];
            $dato22p = $proforma['dato22'];
            $dato23p = $proforma['dato23'];
            $dato24p = $proforma['dato24'];
            $dato25p = $proforma['dato25'];
            $dato26p = $proforma['dato26'];

            if(($dato0p=="CODIGO")||($dato0p=="MODELO")){
                $dat = 0;
                if((($dato3p=="PRECIO DOCENA")||($dato3p=="PRECIO"))&&(($dato25p=="PARES")||($dato25p=="TOTAL PARES"))){

                    $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato4p,$dato5p,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$dato23p,$dato24p,"PARES","TOTAL","ESTADO");
                }
                else{
                    echo "Existe un problema con la cabecera del archivo. Revise el archivo que subio y vuelva a procesar";
                    break;
                }
                //echo"cabecera $datoscabecera";
                $j = $i;
                $proformaaux = $sql3[$j+1];
                $oficina = $proformaaux['dato1'];
                //echo"oficina $oficina";
                if($i<1){
                    $separafactura = explode( '/' , $facturap);
                    $nrofactura = $separafactura[0].$separafactura[1];
                    $nfactura = $separafactura[0];
                    $dirfactura = "C:/proformas/".$mesanio."/".$nfactura;
                    if(file_exists($dirfactura) == false){
                        mkdir($dirfactura, 0777, true);
                    }
                }
                $ofic = null;
                $separaofic = null;
                $separaofic = explode( '/' , $oficina);
                $ofic = $separaofic[1];
                //echo"ofic $ofic";
                if($ofic==null){
                    $nomarch = $marcap.$nrofactura.$oficina.$fecha;
                    $detalle = " Oficina: ".$oficina." Total Cajas: ";
                }
                else{
                    $ofic = substr($separaofic[0],0,2);
                    $nomarch = $marcap.$nrofactura.$ofic.$fecha;
                    $detalle = " Oficina: ".$ofic." Total Cajas: ";
                }
                //echo "nombre archivo $nomarch";
                $archivo = "C:\\proformas\\$mesanio\\$nfactura\\$nomarch.csv";
                //echo "direccion archivo $archivo";
                $totcajas = 0;   $totpares = 0;   $totpreciov = 0;
                $file = fopen($archivo, "w");
                fputcsv($file,$datoscabecera,";");
            }
            else{
                //echo"oficina $oficina dato3p $dato3p ";
                if((substr($oficina,0,2)==substr($dato1p,0,2))&&($dato1p!=null)){   // revisar es innecesario la segunda condiciom
                    $cantcajas = 0;
                    $preciounitario = $dato3p/12;
                    $preciounitario = number_format($preciounitario,4,'.',',');
                    //echo"dato4p $dato4p cantcajas $cantcajas ";
                    while($dato2p>$cantcajas){
                        $linea = array($dato0p,"-","-",$dato1p,"","1",$dato3p,$preciounitario,$dato4p,$dato5p,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$dato23p,$dato24p,"12",$dato3p,"0");
                        //echo"datos1 $linea[1]";
                        fputcsv($file,$linea,";");
                        $cantcajas = $cantcajas + 1;
                        $totcajas = $totcajas + 1;
                        $totpares = $totpares + 12;
                        $totpreciov = $totpreciov + $dato3p;
                    }
                }
                else{
                    //echo "file $file ";
                    $detalle = $detalle.$totcajas." Total Pares: ".$totpares." Total Precio: ".$totpreciov;
                    $totcajas = 0;  $totpares = 0;  $totpreciov = 0;
                    if($file!=null){
                        fclose($file);
                    }
                    $file = null;
                    $oficina = $dato1p;
                    if($dato1p!=null){
                        $ofic = null;
                        $separaofic = null;
                        $separaofic = explode( '/' , $dato1p);
                        //$ofic = $separaofic[0].$separaofic[1];
                        $ofic = $separaofic[1];
                        //echo"ofic $ofic";
                        if($ofic==null){
                            //$ofic = substr($dato3p,0,2);
                            $nomarch = $marcap.$nrofactura.$dato1p.$fecha;
                        }
                        else{
                            $ofic = substr($separaofic[0],0,2);
                            if($ofic=="JL"){
                                $ofic = substr($separaofic[0],0,3);
                            }
                            $nomarch = $marcap.$nrofactura.$ofic.$fecha;
                        }
                        //echo "nombre archivo $nomarch";
                        $archivo = "C:\\proformas\\$mesanio\\$nfactura\\$nomarch.csv";
                        $detalle = $detalle." Oficina: ".$ofic." Total Cajas: ";
                        //echo "direccion archivo $archivo ";
                        $file = fopen($archivo, "w");
                        fputcsv($file,$datoscabecera,";");
                        $cantcajas = 0;
                        $preciounitario = $dato3p/12;
                        $preciounitario = number_format($preciounitario,4,'.',',');
                        while($dato2p>$cantcajas){
                            $linea = array($dato0p,"-","-",$dato1p,"","1",$dato3p,$preciounitario,$dato4p,$dato5p,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$dato22p,$dato23p,$dato24p,"12",$dato3p,"0");
                            //echo"datos $linea";
                            fputcsv($file,$linea,";");
                            $cantcajas = $cantcajas + 1;
                            $totcajas = $totcajas + 1;
                            $totpares = $totpares + 12;
                            $totpreciov = $totpreciov + $dato3p;
                        }
                    }
                    else{
                        echo"salio";
                        //verificar que el total este correcto
                        //fclose($archivo);
                    }
                }
                //}
            }
        }
        return $detalle;
    }
    else{
        echo "No existe el directorio";
    }
}

function CrearArchivosCRAVOCANELA($marcaexcel, $return){
    $fecha = date("dmY");
    $mesanio = date("mY");
    if(file_exists("C:/proformas") == false){
        mkdir('C:/proformas', 0777, true);
    }
    $dirmesanio = "C:/proformas/".$mesanio;
    if(file_exists($dirmesanio) == false){
        mkdir($dirmesanio, 0777, true);
    }
    if(file_exists($dirmesanio)){
        //echo " entra $dirmesanio marca $marcaexcel ";
        $sql1 = "SELECT * FROM proforma_archivo where dato30 = '$marcaexcel' ORDER BY idproarchivo";
        $sql2 = getTablaToArrayOfSQL($sql1);
        $sql3 = $sql2['resultado'];
        $row1 = NumeroTuplas($sql1);
        $row11 = $row1['resultado'];
        for($i=0; $i<=$row11; $i++){
            $proforma = $sql3[$i];
            $marcap = $proforma['marca'];
            $facturap = $proforma['factura'];
            $dato0p = $proforma['dato0'];
            $dato1p = $proforma['dato1'];
            $dato2p = $proforma['dato2'];
            $dato3p = $proforma['dato3'];
            $dato4p = $proforma['dato4'];
            $dato5p = $proforma['dato5'];
            $dato6p = $proforma['dato6'];
            $dato7p = $proforma['dato7'];
            $dato8p = $proforma['dato8'];
            $dato9p = $proforma['dato9'];
            $dato10p = $proforma['dato10'];
            $dato11p = $proforma['dato11'];
            $dato12p = $proforma['dato12'];
            $dato13p = $proforma['dato13'];
            $dato14p = $proforma['dato14'];
            $dato15p = $proforma['dato15'];
            $dato16p = $proforma['dato16'];
            $dato17p = $proforma['dato17'];
            $dato18p = $proforma['dato18'];
            $dato19p = $proforma['dato19'];
            $dato20p = $proforma['dato20'];
            $dato21p = $proforma['dato21'];
            $dato22p = $proforma['dato22'];
            $dato23p = $proforma['dato23'];
            $dato24p = $proforma['dato24'];
            $dato25p = $proforma['dato25'];
            $dato26p = $proforma['dato26'];
            $dato27p = $proforma['dato27'];
            $dato28p = $proforma['dato28'];
            $dato29p = $proforma['dato29'];
            $dato30p = $proforma['dato30'];

            if(($dato0p=="STYLE")||($dato0p=="CODIGO")||($dato0p=="MODELO")){
                $dat = 0;
                //echo " dato5 $dato5p dato14 $dato14p ";
                if(($dato4p=="USD")&&(($dato14p=="PRS")||($dato14p=="PARES")||($dato14p=="TOTAL PRS")||($dato14p=="TOTAL PARES"))){
                    $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,"PARES","TOTAL","ESTADO");
                }
                else{
                    //echo " dato15 $dato15p ";
                    if(($dato4p=="USD")&&(($dato15p=="PRS")||($dato15p=="PARES")||($dato15p=="TOTAL PRS")||($dato15p=="TOTAL PARES"))){
                        $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,"PARES","TOTAL","ESTADO");
                        $dat = 1;
                    }
                    else{
                        //echo " dato16 $dato16p ";
                        if(($dato4p=="USD")&&(($dato16p=="PRS")||($dato16p=="PARES")||($dato16p=="TOTAL PRS")||($dato16p=="TOTAL PARES"))){
                            $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,"PARES","TOTAL","ESTADO");
                            $dat = 2;
                        }
                        else{
                            echo "Existe un problema con la cabecera del archivo. Revise el archivo que subio y vuelva a procesar";
                            break;
                        }
                    }
                }
                //echo"cabecera $datoscabecera";
                $j = $i;
                $proformaaux = $sql3[$j+1];
                $oficina = $proformaaux['dato3'];
                //echo"oficina $oficina";
                if($i<1){
                    $separafactura = explode( '/' , $facturap);
                    $nrofactura = $separafactura[0].$separafactura[1];
                    $separamarca = explode( '/' , $marcap);
                    $marca = $separamarca[0];
                    $nfactura = $separafactura[0];
                    $dirfactura = "C:/proformas/".$mesanio."/".$nfactura;
                    if(file_exists($dirfactura) == false){
                        mkdir($dirfactura, 0777, true);
                    }
                }
                $ofic = null;
                $separaofic = null;
                $separaofic = explode( '/' , $oficina);
                $ofic = $separaofic[1];
                //echo"ofic $ofic";
                if($ofic==null){
                    $nomarch = $marca.$nrofactura.$oficina.$fecha;
                }
                else{
                    $ofic = substr($separaofic[0],0,2);
                    $nomarch = $marca.$nrofactura.$ofic.$fecha;
                }
                //echo "nombre archivo $nomarch";
                $archivo = "C:\\proformas\\$mesanio\\$nfactura\\$nomarch.csv";
                $detalle = " Oficina: ".$ofic." Total Cajas: ";
                //echo "direccion archivo $archivo";
                $totcajas = 0;   $totpares = 0;   $totpreciov = 0;
                $file = fopen($archivo, "w");
                fputcsv($file,$datoscabecera,";");
            }
            else{
                //echo"oficina $oficina dato3p $dato3p ";
                if((substr($oficina,0,2)==substr($dato3p,0,2))&&($dato3p!=null)){   // revisar es innecesario la segunda condiciom
                    $cantcajas = 0;   $tpares = 0;   $preciov = 0;
                    // dividir el precio entre la cantidad de pares
                    $tpares = $dato14p;
                    $preciounitario = $dato4p/12;
                    $preciounitario = number_format($preciounitario,4,'.',',');
                    if($tpares<12){
                        $preciov = $preciounitario*$tpares;
                        $preciov = number_format($preciov,2,'.',',');
                    }
                    else{
                        if($tpares==18){  /// ojo si cantidad cajas son 2 es 2 cajas de 9 si es 1 es una caja de 18
                            $tpares = 9;
                            $preciov = $preciounitario*$tpares;
                            $preciov = number_format($preciov,2,'.',',');
                        }
                        else{
                            $preciov = $dato4p;
                            $tpares = 12;
                        }
                    }
                    //echo"dato4p $dato4p cantcajas $cantcajas ";
                    while($dato5p>$cantcajas){
                        if($dat==1){
                            $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato4p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$tpares,$preciov,"0");
                        }
                        else{
                            if($dat==2){
                                $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato4p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$tpares,$preciov,"0");
                            }
                            else{
                                $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato4p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$tpares,$preciov,"0");
                            }
                        }
                        //echo"datos1 $linea[1]";
                        fputcsv($file,$linea,";");
                        $cantcajas = $cantcajas + 1;
                        $totcajas = $totcajas + 1;
                        $totpares = $totpares + $tpares;
                        $totpreciov = $totpreciov + $preciov;
                    }
                }
                else{
                    //echo "file $file ";
                    $detalle = $detalle.$totcajas." Total Pares: ".$totpares." Total Precio: ".$totpreciov;
                    $totcajas = 0;  $totpares = 0;  $totpreciov = 0;
                    if($file!=null){
                        fclose($file);
                    }
                    $file = null;
                    $oficina = $dato3p;
                    if($dato3p!=null){
                        $ofic = null;
                        $separaofic = null;
                        $separaofic = explode( '/' , $dato3p);
                        //$ofic = $separaofic[0].$separaofic[1];
                        $ofic = $separaofic[1];
                        //echo"ofic $ofic";
                        if($ofic==null){
                            //$ofic = substr($dato3p,0,2);
                            $ofic = substr($separaofic[0],0,2);
                            if($ofic=="JL"){
                                $ofic = substr($separaofic[0],0,3);
                                $nomarch = $marca.$nrofactura.$ofic.$fecha;
                            }
                            else{
                               $nomarch = $marca.$nrofactura.$dato3p.$fecha;
                            }
                        }
                        else{
                            $ofic = substr($separaofic[0],0,2);
                            if($ofic=="JL"){
                                $ofic = substr($separaofic[0],0,3);
                            }
                            $nomarch = $marca.$nrofactura.$ofic.$fecha;
                        }
                        //echo "nombre archivo $nomarch";
                        $archivo = "C:\\proformas\\$mesanio\\$nfactura\\$nomarch.csv";
                        $detalle = $detalle." Oficina: ".$ofic." Total Cajas: ";
                        //echo "direccion archivo $archivo ";
                        $file = fopen($archivo, "w");
                        fputcsv($file,$datoscabecera,";");
                        $cantcajas = 0;   $tpares = 0;   $preciov = 0;
                        // dividir el precio entre la cantidad de pares
                        $tpares = $dato14p;
                        $preciounitario = $dato4p/12;
                        $preciounitario = number_format($preciounitario,4,'.',',');
                        if($tpares<12){
                            $preciov = $preciounitario*$tpares;
                            $preciov = number_format($preciov,2,'.',',');
                        }
                        else{
                            if($tpares==18){  /// ojo si cantidad cajas son 2 es 2 cajas de 9 si es 1 es una caja de 18
                                $tpares = 9;
                                $preciov = $preciounitario*$tpares;
                                $preciov = number_format($preciov,2,'.',',');
                            }
                            else{
                                $preciov = $dato4p;
                                $tpares = 12;
                            }
                        }
                        while($dato5p>$cantcajas){
                            if($dat==1){
                                $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato4p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$tpares,$preciov,"0");
                            }
                            else{
                                if($dat==2){
                                    $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato4p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$tpares,$preciov,"0");
                                }
                                else{
                                    $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato4p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$tpares,$preciov,"0");
                                }
                            }
                            //echo"datos $linea";
                            fputcsv($file,$linea,";");
                            $cantcajas = $cantcajas + 1;
                            $totcajas = $totcajas + 1;
                            $totpares = $totpares + $tpares;
                            $totpreciov = $totpreciov + $preciov;
                        }
                    }
                    else{
                        echo"salio";
                        //verificar que el total este correcto
                        //fclose($archivo);
                    }
                }
                //}
            }
        }
        return $detalle;
    }
    else{
        echo "No existe el directorio";
    }
}

function CrearArchivos361(){
    $fecha = date("dmY");
    $mesanio = date("mY");
    if(file_exists("C:/proformas") == false){
        mkdir('C:/proformas', 0777, true);
    }
    $dirmesanio = "C:/proformas/".$mesanio;
    if(file_exists($dirmesanio) == false){
        mkdir($dirmesanio, 0777, true);
    }
    if(file_exists($dirmesanio)){
        //echo " entra $dirmesanio marca $marcaexcel ";
        $sql1 = "SELECT * FROM proforma_archivo where dato30 = '$marcaexcel' ORDER BY idproarchivo";
        $sql2 = getTablaToArrayOfSQL($sql1);
        $sql3 = $sql2['resultado'];
        $row1 = NumeroTuplas($sql1);
        $row11 = $row1['resultado'];
        for($i=0; $i<=$row11; $i++){
            $proforma = $sql3[$i];
            $marcap = $proforma['marca'];
            $facturap = $proforma['factura'];
            $dato0p = $proforma['dato0'];
            $dato1p = $proforma['dato1'];
            $dato2p = $proforma['dato2'];
            $dato3p = $proforma['dato3'];
            $dato4p = $proforma['dato4'];
            $dato5p = $proforma['dato5'];
            $dato6p = $proforma['dato6'];
            $dato7p = $proforma['dato7'];
            $dato8p = $proforma['dato8'];
            $dato9p = $proforma['dato9'];
            $dato10p = $proforma['dato10'];
            $dato11p = $proforma['dato11'];
            $dato12p = $proforma['dato12'];
            $dato13p = $proforma['dato13'];
            $dato14p = $proforma['dato14'];
            $dato15p = $proforma['dato15'];
            $dato16p = $proforma['dato16'];
            $dato17p = $proforma['dato17'];
            $dato18p = $proforma['dato18'];
            $dato19p = $proforma['dato19'];
            $dato20p = $proforma['dato20'];
            $dato21p = $proforma['dato21'];
            $dato22p = $proforma['dato22'];
            $dato23p = $proforma['dato23'];
            $dato24p = $proforma['dato24'];
            $dato25p = $proforma['dato25'];
            $dato26p = $proforma['dato26'];
            $dato27p = $proforma['dato27'];
            $dato28p = $proforma['dato28'];
            $dato29p = $proforma['dato29'];
            $dato30p = $proforma['dato30'];

            if(($dato0p=="STYLE")||($dato0p=="CODIGO")||($dato0p=="SKU")){
                $dat = 0;
                //echo " dato5 $dato5p dato14 $dato14p ";
                if(($dato5p=="CJS")&&(($dato22p=="PRS")||($dato22p=="PARES")||($dato22p=="TOTAL PRS")||($dato22p=="TOTAL PARES"))){
                    $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,"PARES","TOTAL","ESTADO");
                }
                else{
                    //echo " dato15 $dato15p ";
                    if(($dato5p=="CJS")&&(($dato15p=="PRS")||($dato15p=="PARES")||($dato15p=="TOTAL PRS")||($dato15p=="TOTAL PARES"))){
                        $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,"PARES","TOTAL","ESTADO");
                        $dat = 1;
                    }
                    else{
                        //echo " dato16 $dato16p ";
                        if(($dato5p=="CJS")&&(($dato16p=="PRS")||($dato16p=="PARES")||($dato16p=="TOTAL PRS")||($dato16p=="TOTAL PARES"))){
                            $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,"PARES","TOTAL","ESTADO");
                            $dat = 2;
                        }
                        else{
                            echo "Existe un problema con la cabecera del archivo. Revise el archivo que subio y vuelva a procesar";
                            break;
                        }
                    }
                }
                //echo"cabecera $datoscabecera";
                $j = $i;
                $proformaaux = $sql3[$j+1];
                $oficina = $proformaaux['dato3'];
                //echo"oficina $oficina";
                if($i<1){
                    $separafactura = explode( '/' , $facturap);
                    $nrofactura = $separafactura[0].$separafactura[1];
                    $separamarca = explode( '/' , $marcap);
                    $marca = $separamarca[0];
                    $nfactura = $separafactura[0];
                    $dirfactura = "C:/proformas/".$mesanio."/".$nfactura;
                    if(file_exists($dirfactura) == false){
                        mkdir($dirfactura, 0777, true);
                    }
                }
                $ofic = null;
                $separaofic = null;
                $separaofic = explode( '/' , $oficina);
                $ofic = $separaofic[1];
                //echo"ofic $ofic";
                if($ofic==null){
                    $nomarch = $marca.$nrofactura.$oficina.$fecha;
                }
                else{
                    $ofic = substr($separaofic[0],0,2);
                    $nomarch = $marca.$nrofactura.$ofic.$fecha;
                }
                //echo "nombre archivo $nomarch";
                $archivo = "C:\\proformas\\$mesanio\\$nfactura\\$nomarch.csv";
                $detalle = " Oficina: ".$ofic." Total Cajas: ";
                //echo "direccion archivo $archivo";
                $totcajas = 0;   $totpares = 0;   $totpreciov = 0;
                $file = fopen($archivo, "w");
                fputcsv($file,$datoscabecera,";");
            }
            else{
                //echo"oficina $oficina dato3p $dato3p ";
                if((substr($oficina,0,2)==substr($dato3p,0,2))&&($dato3p!=null)){   // revisar es innecesario la segunda condiciom
                    $cantcajas = 0;   $tpares = 0;   $preciov = 0;
                    // dividir el precio entre la cantidad de pares
                    $tpares = $dato22p;
                    $preciounitario = $dato6p;
                        if($dat==1){
                            $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"",$dato4p,$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$tpares,$dato15p,"0");
                        }
                        else{
                            if($dat==2){
                                $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"",$dato4p,$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$tpares,$dato15p,"0");
                            }
                            else{
                                $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"",$dato5p,$dato4p,$preciounitario,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$tpares,$dato23p,"0");
                            }
                        }
                        //echo"datos1 $linea[1]";
                        fputcsv($file,$linea,";");
                        $cantcajas = $cantcajas + 1;
                        $totcajas = $totcajas + 1;
                        $totpares = $totpares + $tpares;
                        $totpreciov = $totpreciov + $preciov;
                    //}
                }
                else{
                    //echo "file $file ";
                    $detalle = $detalle.$totcajas." Total Pares: ".$totpares." Total Precio: ".$totpreciov;
                    $totcajas = 0;  $totpares = 0;  $totpreciov = 0;
                    if($file!=null){
                        fclose($file);
                    }
                    $file = null;
                    $oficina = $dato3p;
                    if($dato3p!=null){
                        $ofic = null;
                        $separaofic = null;
                        $separaofic = explode( '/' , $dato3p);
                        //$ofic = $separaofic[0].$separaofic[1];
                        $ofic = $separaofic[1];
                        //echo"ofic $ofic";
                        if($ofic==null){
                            //$ofic = substr($dato3p,0,2);
                            $ofic = substr($separaofic[0],0,2);
                            if($ofic=="JL"){
                                $ofic = substr($separaofic[0],0,3);
                                $nomarch = $marca.$nrofactura.$ofic.$fecha;
                            }
                            else{
                               $nomarch = $marca.$nrofactura.$dato3p.$fecha;
                            }
                        }
                        else{
                            $ofic = substr($separaofic[0],0,2);
                            if($ofic=="JL"){
                                $ofic = substr($separaofic[0],0,3);
                            }
                            $nomarch = $marca.$nrofactura.$ofic.$fecha;
                        }
                        //echo "nombre archivo $nomarch";
                        $archivo = "C:\\proformas\\$mesanio\\$nfactura\\$nomarch.csv";
                        $detalle = $detalle." Oficina: ".$ofic." Total Cajas: ";
                        //echo "direccion archivo $archivo ";
                        $file = fopen($archivo, "w");
                        fputcsv($file,$datoscabecera,";");
                        $cantcajas = 0;   $tpares = 0;   $preciov = 0;
                        // dividir el precio entre la cantidad de pares
                        $tpares = $dato22p;
                        $preciounitario = $dato6p;
                            if($dat==1){
                                $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$tpares,$dat15p,"0");
                            }
                            else{
                                if($dat==2){
                                    $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"","1",$dato5p,$preciounitario,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$tpares,$dat15p,"0");
                                }
                                else{
                                    $linea = array($dato0p,$dato1p,$dato2p,$dato3p,"",$dato5p,$dato4p,$preciounitario,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$dato18p,$dato19p,$dato20p,$dato21p,$tpares,$dato23p,"0");
                                }
                            }
                            //echo"datos $linea";
                            fputcsv($file,$linea,";");
                            $cantcajas = $cantcajas + 1;
                            $totcajas = $totcajas + 1;
                            $totpares = $totpares + $tpares;
                            $totpreciov = $totpreciov + $preciov;
                       // }
                    }
                    else{
                        echo"salio";
                        //verificar que el total este correcto
                        //fclose($archivo);
                    }
                }
                //}
            }
        }
        return $detalle;
    }
    else{
        echo "No existe el directorio";
    }
}

function CrearArchivosADRUM($marcaexcel, $return){
    $fecha = date("dmY");
    $mesanio = date("mY");
    if(file_exists("C:/proformas") == false){
        mkdir('C:/proformas', 0777, true);
    }
    $dirmesanio = "C:/proformas/".$mesanio;
    if(file_exists($dirmesanio) == false){
        mkdir($dirmesanio, 0777, true);
    }
    if(file_exists($dirmesanio)){
        //echo " entra $dirmesanio marca $marcaexcel ";
        $detalle = "";
        $sql1 = "SELECT * FROM proforma_archivo where dato30 = '$marcaexcel' ORDER BY idproarchivo";
        $sql2 = getTablaToArrayOfSQL($sql1);
        $sql3 = $sql2['resultado'];
        $row1 = NumeroTuplas($sql1);
        $row11 = $row1['resultado'];
        for($i=0; $i<=$row11; $i++){
            $proforma = $sql3[$i];
            $marcap = $proforma['marca'];
            $facturap = $proforma['factura'];
            $dato0p = $proforma['dato0'];
            $dato1p = $proforma['dato1'];
            $dato2p = $proforma['dato2'];
            $dato3p = $proforma['dato3'];
            $dato4p = $proforma['dato4'];
            $dato5p = $proforma['dato5'];
            $dato6p = $proforma['dato6'];
            $dato7p = $proforma['dato7'];
            $dato8p = $proforma['dato8'];
            $dato9p = $proforma['dato9'];
            $dato10p = $proforma['dato10'];
            $dato11p = $proforma['dato11'];
            $dato12p = $proforma['dato12'];
            $dato13p = $proforma['dato13'];
            $dato14p = $proforma['dato14'];
            $dato15p = $proforma['dato15'];
            $dato16p = $proforma['dato16'];
            $dato17p = $proforma['dato17'];
            $dato18p = $proforma['dato18'];
            $dato19p = $proforma['dato19'];
            $dato20p = $proforma['dato20'];
            $dato21p = $proforma['dato21'];
            $dato22p = $proforma['dato22'];
            $dato23p = $proforma['dato23'];
            $dato24p = $proforma['dato24'];
            $dato25p = $proforma['dato25'];
            $dato26p = $proforma['dato26'];
            $dato27p = $proforma['dato27'];
            $dato28p = $proforma['dato28'];
            $dato29p = $proforma['dato29'];
            $dato30p = $proforma['dato30'];

            if(($dato0p=="LINE")||($dato0p=="ARTICULO")||($dato0p=="CODIGO")){
                $dat = 0;
                //echo " dato5 $dato5p dato14 $dato14p ";
                if(($dato4p=="USD")&&(($dato17p=="PRS")||($dato17p=="PARES")||($dato17p=="TOTAL PRS")||($dato17p=="TOTAL PARES"))){
                    $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato5p,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato15p,$dato16p,"PARES","TOTAL","ESTADO");
                }
                else{
                    //echo " dato4p $dato4p dato18 $dato18p ";
                    //if(($dato4p=="USD")&&($dato18p=="PARES")){
                      //  echo "entro";
                    if(($dato4p=="USD")&&(($dato18p=="PRS")||($dato18p=="PARES")||($dato18p=="TOTAL PRS")||($dato18p=="TOTAL PARES"))){
                        $datoscabecera = array("MODELO","MATERIAL","COLOR","ITEM","VENDEDOR","CJS","PRECIO VENTA","UNITARIO",$dato5p,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,"PARES","TOTAL","ESTADO");
                        $dat = 1;
                    }
                }
//                echo" cabecera $datoscabecera dat $dat";
                $j = $i;
                $proformaaux = $sql3[$j+1];
                $oficina = $proformaaux['dato2'];
                //echo"oficina $oficina";
                if($i<1){
                    $separafactura = explode( '/' , $facturap);
                    $nrofactura = $separafactura[0].$separafactura[1];
                    $nfactura = $separafactura[0];
                    $dirfactura = "C:/proformas/".$mesanio."/".$nfactura;
                    if(file_exists($dirfactura) == false){
                        mkdir($dirfactura, 0777, true);
                    }
                }
                $ofic = null;
                $separaofic = null;
                $separaofic = explode( '/' , $oficina);
                $ofic = $separaofic[1];
                //echo"ofic $ofic";
                if($ofic==null){
                    $nomarch = $marcap.$nrofactura.$oficina.$fecha;
                }
                else{
                    $ofic = substr($separaofic[0],0,2);
                    $nomarch = $marcap.$nrofactura.$ofic.$fecha;
                }
                //echo "nombre archivo $nomarch";
                $archivo = "C:\\proformas\\$mesanio\\$nfactura\\$nomarch.csv";
                $detalle = " Oficina: ".$ofic." Total Cajas: ";
                //echo "direccion archivo $archivo";
                $totcajas = 0;   $totpares = 0;   $totpreciov = 0;
                $file = fopen($archivo, "w");
                fputcsv($file,$datoscabecera,";");
            }
            else{
                //echo"oficina $oficina dato3p $dato3p ";
                if((substr($oficina,0,2)==substr($dato2p,0,2))&&($dato2p!=null)){   // revisar es innecesario la segunda condiciom
                    $cantcajas = 0;   $tpares = 0;   $preciov = 0;
                    $preciounitario = $dato4p/12;
                    $preciounitario = number_format($preciounitario,4,'.',',');
                    $preciov = $dato4p;
                    $tpares = 12;
                    //echo"dato4p $dato4p cantcajas $cantcajas ";
                    while($dato3p>$cantcajas){
                        if($dat==1){
                            $linea = array($dato0p,"-",$dato1p,$dato2p,"","1",$dato4p,$preciounitario,$dato5p,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$tpares,$preciov,"0");
                        }
                        else{
                            $linea = array($dato0p,"-",$dato1p,$dato2p,"","1",$dato4p,$preciounitario,$dato5p,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$tpares,$preciov,"0");
                        }
                        //echo"datos1 $linea[1]";
                        fputcsv($file,$linea,";");
                        $cantcajas = $cantcajas + 1;
                        $totcajas = $totcajas + 1;
                        $totpares = $totpares + $tpares;
                        $totpreciov = $totpreciov + $preciov;
                    }
                }
                else{
                    //echo "file $file ";
                    $detalle = $detalle.$totcajas." Total Pares: ".$totpares." Total Precio: ".$totpreciov;
                    $totcajas = 0;  $totpares = 0;  $totpreciov = 0;
                    if($file!=null){
                        fclose($file);
                    }
                    $file = null;
                    $oficina = $dato2p;
                    if($dato2p!=null){
                        $ofic = null;
                        $separaofic = null;
                        $separaofic = explode( '/' , $dato2p);
                        //$ofic = $separaofic[0].$separaofic[1];
                        $ofic = $separaofic[1];
                        //echo"ofic $ofic";
                        if($ofic==null){
                            //$ofic = substr($dato3p,0,2);
                            $ofic = substr($separaofic[0],0,2);
                            if($ofic=="JL"){
                                $ofic = substr($separaofic[0],0,3);
                                $nomarch = $marcap.$nrofactura.$ofic.$fecha;
                            }
                            else{
                               $nomarch = $marcap.$nrofactura.$dato3p.$fecha;
                            }
                        }
                        else{
                            $ofic = substr($separaofic[0],0,2);
                            if($ofic=="JL"){
                                $ofic = substr($separaofic[0],0,3);
                            }
                            $nomarch = $marcap.$nrofactura.$ofic.$fecha;
                        }
                        //echo "nombre archivo $nomarch";
                        $archivo = "C:\\proformas\\$mesanio\\$nfactura\\$nomarch.csv";
                        $detalle = $detalle." Oficina: ".$ofic." Total Cajas: ";
                        //echo "direccion archivo $archivo ";
                        $file = fopen($archivo, "w");
                        fputcsv($file,$datoscabecera,";");
                        $cantcajas = 0;   $tpares = 0;   $preciov = 0;
                        // dividir el precio entre la cantidad de pares
                        $preciounitario = $dato4p/12;
                        $preciounitario = number_format($preciounitario,4,'.',',');
                        $preciov = $dato4p;
                        $tpares = 12;
                        while($dato3p>$cantcajas){
                            if($dat==1){
                                $linea = array($dato0p,"-",$dato1p,$dato2p,"","1",$dato4p,$preciounitario,$dato5p,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$dato17p,$tpares,$preciov,"0");
                            }
                            else{
                                $linea = array($dato0p,"-",$dato1p,$dato2p,"","1",$dato4p,$preciounitario,$dato5p,$dato6p,$dato7p,$dato8p,$dato9p,$dato10p,$dato11p,$dato12p,$dato13p,$dato14p,$dato15p,$dato16p,$tpares,$preciov,"0");
                            }
                            //echo"datos $linea";
                            fputcsv($file,$linea,";");
                            $cantcajas = $cantcajas + 1;
                            $totcajas = $totcajas + 1;
                            $totpares = $totpares + $tpares;
                            $totpreciov = $totpreciov + $preciov;
                        }
                    }
                    else{
                        echo" salio ";
                        //verificar que el total este correcto
                        //fclose($archivo);
                    }
                }
                //}
            }
        }
        return $detalle;
    }
    else{
        echo "No existe el directorio";
    }
}

?>