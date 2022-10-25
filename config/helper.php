<?php
class General {


    public function getMenu(){
        $arrMenu = array();
        $sting = "SELECT 
                menu.*, 
                menu_items.id AS id_sub_menu,
                menu_items.sub_menu,
                menu_items.title AS sub_menu_title,
                menu_items.icon AS sub_icon
            FROM
                menu
            LEFT JOIN menu_items ON(menu_items.`status`=1 AND menu_items.id_menu=menu.id)
            WHERE menu.`status` = 1";
        $stmt = $this->sql->execute("query",$sting);
        if (is_array($stmt) && count($stmt)>0){
            foreach ($stmt as $key => $menu) {
                $temp[$menu["id"]][] = $menu;
            }

            foreach ($temp as $id=> $ival){
                foreach ($ival as $k){
                    $arrMenu[$id]["title"]=$k["title"];
                    $arrMenu[$id]["icon"]=$k["icon"];
                    $arrMenu[$id]["sub_menu"][]=$k;
                }
            }

        }

        return $arrMenu;
    }

    // Devuelve datos con Sql
    public function getLanguajes(){
        $query = "SELECT
                languajes.id,
                c_atributos.id AS id_languajes_att_codes,
                c_atributos.id_attributes_languajes,
                c_atributos.id_codes_languajes,
                c_atributos.`title`,
                codes_languajes.`code`,
                attributes_languajes.field,
                attributes_languajes_codes.title AS `name`,
                languajes.img_flag
            FROM
                (
                    (
                        (
                            (
                                SELECT
                                    *
                                FROM
                                    languajes_attributes_codes
                                WHERE
                                    languajes_attributes_codes.`status` = '1'
                            ) c_atributos
                            INNER JOIN languajes ON (
                                c_atributos.id_languajes = languajes.id
                                AND languajes.`status` = 1
                            )
                        )
                        INNER JOIN attributes_languajes ON (
                            attributes_languajes.id = c_atributos.id_attributes_languajes
                            AND attributes_languajes.`status` = 1
                        )
                    )
                    INNER JOIN attributes_languajes_codes ON (
                        attributes_languajes_codes.id_attributes_languajes = attributes_languajes.id
                        AND attributes_languajes_codes.id_codes_languajes = c_atributos.id_languajes
                        AND attributes_languajes_codes.`status` = 1
                    )
                )
            INNER JOIN codes_languajes ON (
                c_atributos.id_languajes = codes_languajes.id
                AND codes_languajes.`status` = 1
            )
            ORDER BY
                c_atributos.id,
                id_codes_languajes ASC";

        $arrLangs = $this->sql->execute('query',$query);
        $arrCodes = $this->sql->execute('query',"SELECT * FROM `codes_languajes` WHERE `status`=1");

        $codes=array();
        if (count($arrCodes)){
            foreach ($arrCodes as $values){
                $codes[$values['id']] = $values['code'];
            }
        }
        $langsT = array();
        $_tem=array();
        $langs = array();
        if (count($arrLangs)>0) {
            foreach ($arrLangs as $key => $attr) {
                $temp[$attr['code']][$attr['code']][$attr["field"]]["value"][$attr['code']] = $attr["title"];
                $langsT[$attr['code']]['code'][$attr['id_codes_languajes']] = $temp[$attr['code']][$attr['code']];
            }

            if (count($langsT)>0){
                foreach ($langsT as $code => $values){

                    foreach ($langsT as $code2 => $values2) {   //code: en, es
                        foreach ($values2 as $key=> $values3) { //key: rimer code index
                            foreach ($values3 as  $key2=> $values4) { //key2: 1,2 id idiomas
                                if (key_exists($key2,$codes)){
                                    $_tem[$codes[$key2]] = $values4['code']['value'][$code2];
                                }
                            }
                        }
                    }
                    $langs[$code]['code'] = $_tem;
                }
            }
        }

        return $langs;
    }

    public function getCurrencies()
    {
        $currencies = $this->sql->execute('query', "SELECT * FROM `catalog_currencies` WHERE `status`=1");

        $arrOut = array();
        if (count($currencies)>0) {
            $arrOut=$currencies;
        }
        return $arrOut;
    }

    public function listStudiesLevels($id=""){
        $porId=($id!='')? 'id='.$id. ' AND ' : '';
        $stmt = $this->sql->execute("query","SELECT * FROM studies_levels WHERE ".$porId." status=1");
        return (count($stmt)>0)? $stmt : array();
    }

    public function getDocuments($id=""){
        $porId=($id!='')? 'id='.$id. ' AND ' : '';
        $stmt = $this->sql->execute("query","SELECT * FROM documents WHERE ".$porId." status=1");
        return (count($stmt)>0)? $stmt : array();
    }

    public function getAllergies(){
        $stmt = $this->sql->execute("query","SELECT * FROM allergies WHERE status=1");
        return (is_array($stmt) && count($stmt)>0)? $stmt : array();
    }

    public function getDestinos($id=""){
        $strQuery = self::crearCadenaSql(__FUNCTION__,array("id_destino"=>$id));
        $stmt = $this->sql->execute("query",$strQuery);
        return (count($stmt)>0)? $stmt : array();
    }

    public function getAreas($id=""){
        $strQuery = self::crearCadenaSql(__FUNCTION__,array("id_area"=>$id));
        $stmt = $this->sql->execute("query",$strQuery);
        return (count($stmt)>0)? $stmt : array();
    }

    public function getCategories($id=""){
        $strQuery = self::crearCadenaSql(__FUNCTION__,array("id_categoria"=>$id));
        $stmt = $this->sql->execute("query",$strQuery);
        return (is_array($stmt) && count($stmt)>0)? $stmt : array();
    }

    public function getTypesBlood($id=""){
        $strQuery = self::crearCadenaSql(__FUNCTION__,array("id"=>$id));
        $stmt = $this->sql->execute("query",$strQuery);
        return (is_array($stmt) && count($stmt)>0)? $stmt : array();
    }

    public function getContratsTypes($id=""){
        $strQuery = self::crearCadenaSql(__FUNCTION__,array("id"=>$id));
        $stmt = $this->sql->execute("query",$strQuery);
        return (is_array($stmt) && count($stmt)>0)? $stmt : array();
    }

    private function crearCadenaSql($nombre,$filtros=array()){
        $arrQuery["getDestinos"] = "SELECT * FROM destinations WHERE status!=0
          *_* AND id = __id_destino__ *.* ";

        $arrQuery["getAreas"] = "SELECT * FROM areas WHERE status=1 *_* AND id = __id_area__ *.*";

        $arrQuery["getCategories"] = "SELECT * FROM categories WHERE status=1 *_* AND id = __id_categoria__ *.*";

        $arrQuery["getTypesBlood"] = "SELECT * FROM types_blood WHERE status=1 *_* AND id = __id__ *.*";

        $arrQuery["getContratsTypes"] = "SELECT * FROM contracts_types WHERE status=1 *_* AND id = __id__ *.*";

        $arrQuery["login"] = "SELECT
            users.id,
            users.last_name,
            users.email,
            users.avatar,
            users.`name`,
            users.`password`
        FROM
            users
        WHERE
            `status` = 1
        *_* AND users.email = '__email__' *.*
        *_* AND users.`password` = '__password__' *.*
        LIMIT 1";

        $cadena ="";
        if (isset($arrQuery[$nombre])){
            $query = $arrQuery[$nombre];
            $filtros = (is_array($filtros) && count($filtros)>0)? self::cleanArray($filtros): array();
            $cadena = self::get_real_query($query,$filtros);
        }

        return $cadena;
    }

    /*-------------------------------------------------\
    |               SOLO FUNCIONES                     |
    \-------------------------------------------------*/
    public function getDays(){
        return array(
            'en' => array(
                "monday"    => "Monday",
                "tuesday"   => "Tuesday",
                "wednesday" => "Wednesday",
                "thursday"  => "Thursday",
                "friday"    => "Friday",
                "saturday"  => "Saturday",
                "sunday"    => "Sunday",
            ),
            'es' => array(
                "monday"    => "Lunes",
                "tuesday"   => "Martes",
                "wednesday" => "Miercoles",
                "thursday"  => "Jueves",
                "friday"    => "Viernes",
                "saturday"  => "Sabado",
                "sunday"    => "Domingo"
            )
        );
    }

    public function clean_and_validate($arrValidation, $_post){

        $errors = array();
        $dataOk = array();
        if (count($arrValidation)>0) {
            foreach ($arrValidation as $input => $value) {

               $postString = (isset($_post[$input]))? $_post[$input] : "";

               if ($value["obligatorio"] == "1") {
                  if ($postString == ""){
                     $errors[$input] = "El campo " . $value["etiqueta"] . ", es obligatorio.";
                  }
               }

               if (!isset($errors[$input])){
                  switch ($value["validacion"]) {
                        case 'email':
                            if ($postString!="") {
                                if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $postString)) {
                                    $string = self::cleanString($postString);
                                    $dataOk[$input] = $string;
                                } else {
                                    $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                }
                            }
                            break;

                        case 'fecha_db':
                            if ($postString!="") {
                                if (preg_match("/^[0-9]{2}(\/|-)[0-9]{2}(\/|-)[0-9]{4}$/",$postString)) {
                                    $postString = self::cambiarFormatFecha($postString,"en","db","","-");
                                    $dataOk[$input] = $postString;
                                } else {
                                    $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                }
                            }else{
                                $dataOk[$input] = "";
                            }

                            $dataOk[$input] = $postString;
                            break;
                        case 'fecha_es':
                            if ($postString!="") {
                                if (preg_match("/^[0-9]{2}(\/|-)[0-9]{2}(\/|-)[0-9]{4}$/", $postString)) {
                                    $postString = self::cambiarFormatFecha($postString,"es","db","","-");
                                    $dataOk[$input] = $postString;
                                } else {
                                    $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                }
                            }else{
                                $dataOk[$input] = "";
                            }
                            break;

                        case 'numeros':
                            if (is_array($postString) && count($postString)>0){
                                foreach ($postString as $k=>$item){
                                    if (preg_match("/^([0-9])+$/", $item)) {
                                        $dataOk[$input][$k] = $item;
                                    } else {
                                        $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                    }
                                }
                            }else{
                                if ($postString!=""){
                                    if (preg_match("/^([0-9])+$/", $postString)) {
                                        $string = self::cleanString($postString);
                                        $dataOk[$input] = $string;
                                    } else {
                                        $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                    }
                                }else{
                                    $dataOk[$input] = "";
                                }
                            }

                            break;
                        case 'decimales':
                            if ($postString!="") {
                                if (preg_match("/^([0-9])*(\.)?([0-9]){1,2}$/", $postString)) {
                                    $dataOk[$input] = $postString;
                                } else {
                                    $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                }
                            }else{
                                $dataOk[$input] = "";
                            }

                            break;

                        case 'letras_numeros':
                            if ($postString!="") {
                                if (preg_match("/^[a-zA-Z0-9]+$/", $postString)) {
                                    $string = self::cleanString($postString);
                                    $dataOk[$input] = $string;
                                } else {
                                    $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                }
                            }else{
                                $dataOk[$input] = "";
                            }
                            break;

                        case 'letras':
                            if ($postString!="") {
                                if (preg_match("/^[A-Za-z]+$/", $postString)) {
                                    $string = self::cleanString($postString);
                                    $dataOk[$input] = $string;
                                } else {
                                    $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                }
                            }else{
                                $dataOk[$input] = "";
                            }
                            break;

                        case 'letras_espacios':
                            if ($postString!="") {
                                if (preg_match("/^[A-Za-z\s]+$/", $postString)) {
                                    $string = self::cleanString($postString);
                                    $dataOk[$input] = $string;
                                } else {
                                    $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                }
                            }else{
                                $dataOk[$input] = "";
                            }
                            break;

                        case 'letras_numeros_espacios':
                            if ($postString!="") {
                                if (preg_match("/^[A-Za-z0-9\s]+$/", $postString)) {
                                    $string = self::cleanString($postString);
                                    $dataOk[$input] = $string;
                                } else {
                                    $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                }
                            }else{
                                $dataOk[$input] = "";
                            }

                            break;

                        //Si no cumple ninguna de los casos ejecuta la default y termina.
                        default:
                            $string = self::cleanString($postString);
                            $dataOk[$input] = $string;
                            break;
                  }
               }
            }
         }else{
            $errors[] = "No se recibieron datos.";
         }

        $arrOut = array('data_ok'=>$dataOk,'errors'=>$errors);
        return $arrOut;
    }

    public function ordenar_por_id($valores=array(),$opciones=array(),$completo=""){
        $resultado=array();
        if (count($valores)>0){
            foreach ($valores as $key => $valor){
                if (count($opciones)>0){
                    $resultado[$valor[$opciones["indice"]]] = ($completo=="")? $valor[$opciones["valor"]] : $valor;
                }else{
                    $resultado[$key]=$valor;
                }
            }
        }else{$resultado=$valores;}

        return $resultado;
    }

    public function cleanString($string){
        $string = trim($string); // Elimina espacios antes y después de los string
        $string = addslashes($string);
        #$string = stripslashes($string); // Elimina backslashes \
        #$string = htmlspecialchars($string); // Traduce caracteres especiales en entidades HTML
        #$string = htmlentities($string);
        return $string;
    }

    public function cleanArray( $array = array() ){
        $arrOut=array();
        if (count($array)>0){
            foreach ($array as $key => $value){
                $value=trim($value);
                if ($value !="" && $value!=null){
                    $arrOut[$key] = $value;
                }
            }
        }
        return $arrOut;
    }

    public function end($success, $message, $data=array()){
        header('Content-Type: application/json');
        $info = array("success" => $success, "message"=> $message);
        #if (count($data)>0)
        $info['data'] = $data;
        $out = json_encode($info);
        die($out);
    }

    public function makeStringInsert($table,$array=array()){
        $sqlInsert = "";
        if ($table!=""){
            if (count($array)>0){
                $sqlInsert="INSERT INTO `". $table ."` (`". implode('`, `',array_keys($array)) ."`) VALUES ('" . implode("', '", $array) . "')";
            }
        }

        return $sqlInsert;
    }

    public function makeStringUpdate($table, $params,$arrWhere){
        $sqlUpdate ="";
        $cont = 0;
        $temp = "";
        if (count($params)>0) {
            $cont2 = count($params)-1;
            foreach ($params as $key => $value) {
                $coma = ($cont<$cont2)?",":"";
                $temp .= "`".$key."`='".$value."'".$coma." ";
                $cont++;
            }

            $sqlUpdate = "UPDATE ".$table." SET ".$temp;
            $where="";
            if (count($arrWhere)>0){
                foreach ($arrWhere as $key2 => $item) {
                    if ($where != "") {
                        $where .= " AND `" . $key2 . "`='" . $item . "'";
                    }else{
                        $where .= " WHERE `" . $key2 . "`='" . $item . "'";
                    }
                }
            }
            $sqlUpdate .= $where;
        }
        return $sqlUpdate;
    }

    public function cambiarFormatFecha($date, $lang, $formatOut, $langMonth="", $separator=""){
        $fecha 		= explode('/', $date);

        $dateOutPut = "";
        switch ($lang) {
            case 'en': // month-day-year
                //$dateOutPut = $fecha[0].$separator. $fecha[1] .$separator.$fecha[2];
                $dateOutPut = $fecha[2]."-".$fecha[0]."-".$fecha[1];
                $dateOutPut = self::devolverFecha($dateOutPut,$formatOut,$langMonth,$separator);
                break;

            case 'es': // day-month-year
                //$dateOutPut = $fecha[1].$separator. $fecha[0] .$separator.$fecha[2];
                $dateOutPut = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                $dateOutPut = self::devolverFecha($dateOutPut,$formatOut,$langMonth,$separator);
                break;
            case 'db':
            default:
                if ($formatOut != "db"){
                    $dateOutPut = self::devolverFecha($date,$formatOut,$langMonth,$separator);
                }else{
                    $dateOutPut = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                    $dateOutPut = self::devolverFecha($date,$formatOut,$langMonth,$separator);
                }

                break;
        }
        return $dateOutPut;
    }

    private function devolverFecha($dateOutPut,$formatOut,$langMonth,$separator=''){

        $fecha 		= explode('-', $dateOutPut); // Fecha formato DB
        $arrMonths_es = array( '01' => "Ene", '02' => "Feb", '03' => "Mar", '04' => "Abr", '05' => "May", '06' => "Jun", '07' => "Jul", '08' => "Ago", '09' => "Sep", '10' => "Oct",  '11' => "Nov", '12' => "Dic" );
        $arrMonths_en = array( '01' => "Jan", '02' => "Feb", '03' => "Mar", '04' => "Apr", '05' => "May", '06' => "Jun", '07' => "Jul", '08' => "Aug", '09' => "Sep", '10' => "Oct",  '11' => "Nov", '12' => "Dec" );

        switch ($formatOut) {
            case 'en': // month-day-year
                $nameMonth=($langMonth!="")? $arrMonths_en[ $fecha[1] ]: $fecha[1];
                $dateOut = $nameMonth.$separator.$fecha[2].$separator.$fecha[0];
                break;

            case 'es': // day-month-year;
                $nameMonth=($langMonth!="")? $arrMonths_es[ $fecha[1] ]: $fecha[1];
                $dateOut = $fecha[2].$separator.$nameMonth.$separator.$fecha[0];
                break;
            default:
                $dateOut = $dateOutPut;
                break;
        }
        return $dateOut;
    }

    public function generateReferenceCode($ref, $id){
        return $ref.str_pad($id, 6,"0", STR_PAD_LEFT);
    }

    public function registerBinnacle($who, $what, $info, $module ){
        $month 	= date("m");
        $date 	= date('Y-m-d');
        $hour 	= date("h:i:s A");
        $year 	= date("Y");

        $strBinnacle = $who."|".$what."|".$date."|".$hour."|".$info."\r\n";

        if(($file = fopen(_BINNACLE_.'/'.$module."/".$month.$year.".csv", "ab")) !==FALSE ){
            fwrite($file, $strBinnacle);
            fclose($file);
        }
    }

    public function get_real_query($string,$arrayReplace=array() ){
        if ($string!=""){
            $arrString = explode('*_*',$string);

            $expr = "/^((.|\n)*)((\*\.\*)){1}/";
            if (count($arrString)>0){
                foreach ($arrString as $key => $_string){
                    $flag =0;
                    if(preg_match($expr,$_string)){
                        $arrString2 = explode('*.*',$_string);
                        $_string2 = $arrString2[0];

                        if (count($arrayReplace)>0 && $_string2 !=""){
                            foreach ($arrayReplace as $index_to_replace => $value){
                                $patt = "/((_{2}".$index_to_replace."_{2}))/";
                                if (preg_match($patt, $_string2) && $value!=""){
                                    $new = preg_replace($patt,$value,$_string2);
                                    $flag = 1;
                                }
                            }
                        }
                        if ($flag==0){
                            $expr2 = "/((_{2}.*._{2}))/";
                            if (preg_match($expr2, $_string2)){
                                $new = preg_replace(array($expr2,'*.*'),array('',''),$_string2);
                            }
                        }
                        $arrString[$key] = (isset($new))? $new.$arrString2[1] : $arrString2[1];
                    }
                }
            }
        }
        $strOut = (isset($arrString))? implode(" ",$arrString): $string;

        return $strOut;
    }

    public function upload_file($file,$path,$fileType,$arrOthers=array())
    {
        $preName=(isset($arrOthers["pre_name"]))? $arrOthers["pre_name"] : "";
        $minSize=(isset($arrOthers["min_size"]))? $arrOthers["min_size"] : 0;
        $maxSize=(isset($arrOthers["max_size"]))? $arrOthers["max_size"] : 0;

        // 2097152 = 2MB

        $errors = array();
        if (count($file) > 0) {
            $file_name = $file['name'];
            $file_size = $file['size'];
            $file_tmp = $file['tmp_name'];
            $file_type = $file['type'];
            $file_error = $file['error'];
            $temp = explode('.', $file_name);
            $file_ext = $temp[1];

            $checType = $this->checkFileType($fileType,$file_ext);
            if ($checType["success"] == 1) {

                $checSize= $this->checkFileSize($file_size,$minSize,$maxSize);
                if ($checSize["success"]==1){

                    $file_name_db = $preName."-" . time() . "." . $file_ext;
                    $path .=$file_name_db;
                    if (move_uploaded_file($file_tmp, $path)) {
                        $response['success'] = true;
                        $response['name']    = $file_name;
                        $response['name_db'] = $file_name_db;
                    } else {
                        $response['success'] = false;
                        $response['errors']  = "no se movio la imagen ";
                    }

                }else{
                    $response['success']= false;
                    $response['errors'] = $checSize["message"];
                }

            }else{
                $response['success']= false;
                $response['errors'] = $checType["message"];
            }

        } else {
            $response['success']= false;
            $response['errors'] = "No hay archivo";
        }
        return $response;
    }

    private function checkFileSize($size,$minSize=0, $maxSize=0){
        $success=0;
        $message="";
        if ($size!=""){
            if ($maxSize > 0 && $size < $minSize && $size > $maxSize) {
                $message = 'Tamaño no coincide con lo requerido';
            }elseif ($size < $minSize){
                $message = 'Demaciado pequeño.';
            }elseif($size > $maxSize){
                $message = 'Demaciado grande.';
            }else{
                $success=1;
                $message = 'Bien!';
            }
        }
        return array("success"=>$success,"message"=>$message);
    }

    private function checkFileType($type,$fileTye){

        $arrTypes["image"] = array("jpeg", "jpg", "png", "gif");
        $arrTypes["document"]= array("pdf","doc","docs","xln","csv");
        $arrTypes["audio"]= array("mp3","mp4");

        if (isset($arrTypes[$type])){
            if (in_array($fileTye, $arrTypes[$type]) === false) {
                $success= 0;
                $message= "Tipo de archivo no permitido";
            }else{
                $success=1;
                $message = "Bien";
            }
        }else{
            $success= 0;
            $message = "Tipo de archivo no permitido";
        }

        return array("success"=>$success,"message"=>$message);
    }

    public function logIn($user,$pass){
        $filtros = array('email'=>$user,'password'=>md5($pass));

        $strQuery = self::crearCadenaSql('login',$filtros);

        $query=$this->sql->execute('query',$strQuery);
        if (is_array($query) && count($query)>0){
            $response['success'] =true;
            $response['message'] = "Acceso autorizado";
            $_SESSION['user'] = $query[0];
        }else{
            $response['success']=false;
            $response['errors'] = "Usuario Y/O Contraseña incorrecta. ";
        }
        return $response;
    }

    public function hace_cuanto($fecha1, $fecha2 = NULL) {
        $fecha1 = new Datetime($fecha1);
        if ( ! $fecha2) {
            $fecha2 = new Datetime('now');
        } else {
            $fecha2 = new Datetime($fecha2);
        }
        if ($fecha1 > $fecha2) return;
        $r_str = array();
        $intervalo = $fecha1->diff($fecha2);
        $diff = $intervalo->format('%ya-%mm-%dd-%hh-%ii-%ss');
        preg_match_all("/[1-9]+[a-z]+/", $diff, $match_diff);
        $time_str = array(  'a' => 'año',
            'm' => 'mes',
            'd' => 'día',
            'h' => 'hora',
            'i' => 'minuto',
            's' => 'segundo'
        );
        foreach ($match_diff[0] as $time) {
            $times = intval($time);
            $index_time = str_replace($times, '', $time);
            $string = $time_str[$index_time];
            $string .= $time > 1 ? ($string === 'mes' ? 'es' : 's' ) : '' ;
            $r_str[] =sprintf('%d %s', $time, $string);
        }
        $ult = end($r_str);
        $prev = prev($r_str);
        $r_str = array_reduce($r_str, function($r, $v) use($prev, $ult, $r_str) {
            if (count($r_str) > 1) {
                $v = $prev === $v ? sprintf('%s ', $v) : ($ult === $v ? sprintf('y %s', $v) :  sprintf('%s, ', $v));
            }
            $r .= $v;
            return $r;
        });
        return $r_str;
    }



}