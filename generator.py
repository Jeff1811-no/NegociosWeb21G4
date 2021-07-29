from numpy import *


############### SECCIÓN DE PARÁMETROS EDITABLES ####################
nombre_carpeta = "NegociosWeb21G4" #Nombre de la carpeta donde estás trabajando
dao_name = "FuncionesPanel" #Nombre del Dao
plural_name = "Funciones" #Identificador en plural
table_name = "funciones" #Nombre de la tabla como está en la base de datos
singular_name = "Funcion" #Identificador en singular
####################################################################

lowerSingular = singular_name.lower()
lowerPlural = plural_name.lower()
campus = 0
comillas = chr(34)
slash = chr(92)
abrellave = chr(123)
cierrallave = chr(125)
table_data = []
contador = 0

print("/src/Dao/"+dao_name+".class.php")

print("---Generador de archivos PHP---")
print("Reglas de uso: ")
print("El primer campo ingresado debe ser SIEMPRE la llave primaria")
print("El último campo ingresado debe ser SIEMPRE el estado")
campos = int(input("¿Cuántos campos tiene la tabla? "))

for i in range(0, campos):
    aux = input("Ingrese campo ")
    table_data.append(aux)

################ CREACIÓN DEL DAO #####################

f = open("K:/Programs/xampp/htdocs/NegociosWeb21G4/src/Dao/"+dao_name+".class.php",'w')

longitud = len(table_data)
parameters = ""
parameters_insert = ""
parameters_values = ""
array_parameters = ""
array_idparam = "'"+table_data[0]+"'"+" => $"+table_data[0]
update_params = ""
update_paramsid = "`"+table_data[0]+"`=:"+table_data[0]
viewDataArray1 = ""
viewDataArray2 = ""
viewDataArrayId = "$viewData["+comillas+table_data[0]+comillas+"] = 0;"+"\n"
viewDataArrayId2 = "$viewData["+comillas+table_data[0]+comillas+"]"+"\n"
viewDataDelete = ""
htmlTable1 = ""
htmlHeaderTable = "<th>#</th>"
htmlTable2 = ""
i = 0

for i in range(1, longitud):
    if i == longitud - 1:
        parameters += "$"+table_data[i]
        parameters_insert += "`"+table_data[i]+"`"
        parameters_values += ":"+table_data[i]
        array_parameters += "'"+table_data[i]+"'"+" => $"+table_data[i]
        update_params += "`"+table_data[i]+"`=:"+table_data[i]
        viewDataArray1 += "$viewData["+comillas+table_data[i]+comillas+"]"+"\n"
        viewDataArray2 += "$viewData["+comillas+table_data[i]+comillas+"] = 'ACT';"+"\n"
        viewDataDelete += "$viewData["+comillas+table_data[i]+comillas+"] = $_POST["+comillas+table_data[i]+comillas+"];"+"\n"
        htmlTable1 += "<td>"+abrellave+abrellave+table_data[i]+cierrallave+cierrallave+"</td>"
        htmlHeaderTable += "<th>"+table_data[i]+"</th>"

    else:
        parameters += "$"+table_data[i]+", "
        parameters_insert += "`"+table_data[i]+"`, "
        parameters_values += ":"+table_data[i]+", "
        array_parameters += "'"+table_data[i]+"'"+" => $"+table_data[i]+","+"\n"
        update_params += "`"+table_data[i]+"`=:"+table_data[i]+", "
        viewDataArray1 += "$viewData["+comillas+table_data[i]+comillas+"],"+"\n"
        viewDataArray2 += "$viewData["+comillas+table_data[i]+comillas+"] = "+comillas+comillas+";"+"\n"
        viewDataDelete += "$viewData["+comillas+table_data[i]+comillas+"] = $_POST["+comillas+table_data[i]+comillas+"];"+"\n"
        htmlHeaderTable += "<th class="+comillas+"hidden-s"+comillas+">"+table_data[i]+"</th>"
        htmlTable2 += "<div class="+comillas+"row my-2 align-center"+comillas+">"+"\n"+"<label class="+comillas+"col-12 col-m-3"+comillas+" for="+comillas+table_data[i]+comillas+">"+table_data[i]+"</label>"+"\n"+"<input class="+comillas+"col-12 col-m-9"+comillas+"{{readonly}} type="+comillas+"text"+comillas+" name="+comillas+table_data[i]+comillas+" id="+comillas+table_data[i]+comillas+" placehoder="+comillas+table_data[i]+comillas+" value="+comillas+abrellave+abrellave+table_data[i]+cierrallave+cierrallave+comillas+" />"+"\n"+"</div>"
        if i == 1:
          htmlTable1 += "<td><a href="+comillas+"index.php?page=mnt_"+lowerSingular+"&mode=DSP&id="+abrellave+abrellave+table_data[0]+cierrallave+cierrallave+comillas+">"+abrellave+abrellave+table_data[1]+cierrallave+cierrallave+"</a></td>"
        else:
          htmlTable1 += "<td class="+comillas+"hidden-s"+comillas+">"+abrellave+abrellave+table_data[i]+cierrallave+cierrallave+"</td>"


contenido = """<?php 
namespace Dao;

class """+plural_name+"""Panel extends Table{

    public static function getActive"""+plural_name+"""()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from """+table_name+""" where """+table_data[longitud-1]+"""='ACT';",
            array()
        );
        return $registros;
    }

    public static function getAll"""+plural_name+"""()
    {
        $registros = array();
        $registros = self::obtenerRegistros(
            "SELECT * from """+table_name+""";",
            array()
        );
        return $registros;
    }

    public static function get"""+singular_name+"""ById($id)
    {
        $sqlstr = "SELECT * from """+table_name+""" where """+table_data[0]+"""=:id;";
        $parameters = array("id" => $id);
        $registro = self::obtenerUnRegistro($sqlstr, $parameters);
        return $registro;

    }

    public static function add"""+singular_name+"""("""+parameters+""")
    {
        $insSQL = "INSERT INTO `"""+table_name+"""` ("""+parameters_insert+""") VALUES ("""+parameters_values+""");";
        $parameters = array(
            """+array_parameters+"""
        );

        return self::executeNonQuery($insSQL, $parameters);
    }

    public static function update"""+singular_name+"""("""+parameters+""", $"""+table_data[0]+""")
    {
        $updSQL = "UPDATE `"""+table_name+"""` set """+update_params+""" where """+update_paramsid+""";";
        $parameters = array(
           """+array_parameters+""",
           """+array_idparam+"""
        );

        return self::executeNonQuery($updSQL, $parameters);
    }

    public static function delete"""+singular_name+"""($"""+table_data[0]+""")
    {
        $delSQL = "DELETE FROM `"""+table_name+"""`  where `"""+table_data[0]+"""`=:"""+table_data[0]+""";";
        $parameters = array(
            '"""+table_data[0]+"""' => $"""+table_data[0]+"""
        );

        return self::executeNonQuery($delSQL, $parameters);
    }

}



?>"""

f.write(contenido)
f.close()
########################## FIN CREACIÓN DEL DAO ##########################################



########################## INICIO CREACIÓN DE CONTROLADORES ##########################################

f2 = open("K:/Programs/xampp/htdocs/NegociosWeb21G4/src/Controllers/Mnt/"+singular_name+".control.php","w")

contenido = """<?php

namespace Controllers\Mnt;

use Utilities\ArrUtils;

class """+singular_name+""" extends \Controllers\PublicController
{
    public function run():void
    {
        $viewData = array();
        $ModalTitles = array(
            'INS' => 'Nuevo """+dao_name+"""',
            'UPD' => 'Actualizando %s - %s',
            'DSP' => 'Detalle de %s - %s',
            'DEL' => 'Eliminado %s - %s'
        );

        $viewData['ModalTitle'] = '';
        """+viewDataArrayId+viewDataArray2+"""
        $viewData['readonly'] = '';
        $viewData['showCommitBtn'] = true;
        $viewData['"""+table_data[longitud-1]+"""_act'] = true;
        $viewData['"""+table_data[longitud-1]+"""_ina'] = false;

        if ($this->isPostBack()) {
            $viewData['mode'] = $_POST['mode'];
            $viewData['"""+table_data[0]+"""'] = $_POST['"""+table_data[0]+"""'];
            $viewData['token'] = $_POST['token'];

            $this->verificarToken();
            if ($viewData['token'] != $_SESSION['"""+lowerPlural+"""_xss_token']) {
                $time = time();
                $token = md5("""+comillas+lowerPlural+comillas+""" . $time);
                $_SESSION['"""+lowerPlural+"""_xss_token'] = $token;
                $_SESSION['"""+lowerPlural+"""_xss_token_tts'] = $time;
                """+slash+"""Utilities\Site::redirectToWithMsg(
                    'index.php?page=mnt_"""+lowerPlural+"""',
                    'Algo sucedio mal intente de nuevo'
                );
            }

            if ($viewData['mode'] != 'DEL') {
               """+viewDataDelete+"""
            }
            switch($viewData['mode']) {
            case 'INS':
                $ok = \Dao"""+slash+dao_name+"""::add"""+singular_name+"""(
                    """+viewDataArray1+"""
                );
                if ($ok) {
                    """+slash+"""Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt_"""+lowerPlural+"""',
                        '"""+dao_name+""" agregado Exitosamente'
                    );
                }
                break;
            case 'UPD':
                $ok = \Dao"""+slash+dao_name+"""::update"""+singular_name+"""(
                    """+viewDataArray1+",""""
                    """+viewDataArrayId2+"""
                );
                if ($ok) {
                    """+slash+"""Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt_"""+lowerPlural+"""',
                        '"""+dao_name+""" actualizado Exitosamente'
                    );
                }
                break;
            case 'DEL':
                $ok = \Dao"""+slash+dao_name+"""::delete"""+singular_name+"""(
                    $viewData['"""+table_data[0]+"""']
                );
                if ($ok) {
                    """+slash+"""Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt_"""+lowerPlural+"""',
                        '"""+dao_name+""" eliminado Exitosamente'
                    );
                }
                break;
            }


        } else {
            $viewData['mode'] = $_GET['mode'];
            $viewData['"""+table_data[0]+"""'] = isset($_GET['id'])? $_GET['id'] : 0;
            $this->verificarToken();
        }
        if ($viewData['mode'] == 'INS') {
            $viewData['ModalTitle'] = 'Agregando nuevo """+dao_name+"""';
        } else {

            $"""+table_data[0]+""" = \Dao"""+slash+dao_name+"""::get"""+singular_name+"""ById($viewData['"""+table_data[0]+"""']);

            error_log(json_encode($"""+table_data[0]+"""));
            if (!$"""+table_data[0]+""") {
                """+slash+"""Utilities\Site::redirectToWithMsg(
                    'index.php?page=mnt_"""+lowerPlural+"""',
                    'No existe el registro'
                );
            }
            """+slash+"""Utilities\ArrUtils::mergeFullArrayTo($"""+table_data[0]+""", $viewData);
                $viewData['ModalTitle'] = sprintf(
                $ModalTitles[$viewData['mode']],
                $viewData['"""+table_data[0]+"""'],
                $viewData['"""+table_data[1]+"""']
            );
            $viewData['"""+table_data[longitud-1]+"""_act'] = $viewData['"""+table_data[longitud-1]+"""'] == 'ACT';
            $viewData['"""+table_data[longitud-1]+"""_ina'] = $viewData['"""+table_data[longitud-1]+"""'] == 'INA';

            if ($viewData['mode'] == 'DEL' || $viewData['mode'] == 'DSP') {
                $viewData['readonly'] = 'readonly';
                $viewData['showCommitBtn']  = $viewData['mode'] == 'DEL';
            }

        }

        \Views\Renderer::render('mnt/"""+lowerSingular+"""', $viewData);
    }

    private function verificarToken(){
        if (!isset($_SESSION['"""+lowerPlural+"""_xss_token'])) {
            """+slash+"""Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt_"""+lowerPlural+"""',
                'Algo sucedio mal intente de nuevo'
            );
        } else {
            $time = time();
            if ($time - $_SESSION['"""+lowerPlural+"""_xss_token_tts'] > 86400) {
                """+slash+"""Utilities\Site::redirectToWithMsg(
                    'index.php?page=mnt_"""+lowerPlural+"""',
                    'Algo sucedio mal intente de nuevo'
                );
            }
        }
    }

}
?>
"""

f2.write(contenido)

f2.close()
#################### FIN DE CONTROLADOR #1 ###########################


##################### INICIO CONTROLADOR #2 ########################

f3 = open("K:/Programs/xampp/htdocs/NegociosWeb21G4/src/Controllers/Mnt/"+plural_name+".control.php","w")

contenido = """<?php

namespace Controllers\Mnt;

class """+plural_name+""" extends \Controllers\PublicController {

    public function run():void
    {
        $viewData = array();
        $tmp"""+plural_name+""" = \Dao"""+slash+dao_name+"""::getAll"""+plural_name+"""();
        $viewData["""+comillas+lowerPlural+comillas+"""] = array();
        $counter = 0;
        foreach ($tmp"""+plural_name+""" as $"""+lowerPlural+""") {
            $counter ++;
            $"""+lowerPlural+"""["rownum"] = $counter;
            $viewData["""+comillas+lowerPlural+comillas+"""][] = $"""+lowerPlural+""";
        }
        $time = time();
        $token = md5("""+comillas+lowerPlural+comillas+""". $time);
        $_SESSION["""+comillas+lowerPlural+"""_xss_token"] = $token;
        $_SESSION["""+comillas+lowerPlural+"""_xss_token_tts"] = $time;
        \Views\Renderer::render("mnt/"""+lowerPlural+comillas+""", $viewData);
    }
}

?>"""

f3.write(contenido)

f3.close()

#################### FIN DE CONTROLADOR #2 ###########################


#################### INICIO VIEW TEMPLATE 1 ###########################
f4 = open("K:/Programs/xampp/htdocs/NegociosWeb21G4/src/Views/templates/mnt/"+lowerPlural+".view.tpl","w")

contenido = """<h1>Listado de """+dao_name+"""</h1>
<section class="WWList container-m">
<table>
  <thead>
    <tr>
          """+htmlHeaderTable+"""
          <th><a href="index.php?page=mnt_"""+lowerSingular+"""&mode=INS" class="button">+</a></th>
    </tr>
  </thead>
  <tbody>
    {{foreach """+lowerPlural+"""}}
    <tr>
      <td>{{rownum}}</td>
      """+htmlTable1+"""
      <td class="center">
        <a href="index.php?page=mnt_"""+lowerSingular+"""&mode=UPD&id="""+abrellave+abrellave+table_data[0]+cierrallave+cierrallave+comillas+""">Editar</a>
        &nbsp;
        <a href="index.php?page=mnt_"""+lowerSingular+"""&mode=DEL&id="""+abrellave+abrellave+table_data[0]+cierrallave+cierrallave+comillas+""">Eliminar</a>
      </td>
    </tr>
    {{endfor """+lowerPlural+"""}}

  </tbody>
</table>
</section>"""

f4.write(contenido)

f4.close()
#################### FIN VIEW TEMPLATE 1 ###########################

#################### INICIO VIEW TEMPLATE 2 ###########################
f5 = open("K:/Programs/xampp/htdocs/NegociosWeb21G4/src/Views/templates/mnt/"+lowerSingular+".view.tpl","w")

contenido = """
<section class="container-m row depth-1 px-4 py-4">
  <h1>{{ModalTitle}}</h1>
</section>
<section class="container-m row depth-1 px-4 py-4">
  <form action="index.php?page=mnt_"""+lowerSingular+"""" method="POST" class="col-12 col-m-8 offset-m-2">
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="""+comillas+table_data[0]+"d"+comillas+""">Código</label>
      <input class="col-12 col-m-9" readonly disabled type="text" name="""+comillas+table_data[0]+"d"+comillas+""" id="""+comillas+table_data[0]+"d"+comillas+""" placehoder="Código" value="""+comillas+abrellave+abrellave+table_data[0]+cierrallave+cierrallave+comillas+"""/>
      <input type="hidden" name="mode" value="{{mode}}" />
      <input type="hidden" name="""+comillas+table_data[0]+comillas+""" value="""+comillas+abrellave+abrellave+table_data[0]+cierrallave+cierrallave+comillas+""" />
      <input type="hidden" name="token" value="{{"""+lowerPlural+"""_xss_token}}" />
    </div>
    """+htmlTable2+"""
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="""+comillas+table_data[longitud-1]+comillas+""">Estado</label>
      <select name="""+comillas+table_data[longitud-1]+comillas+""" id="""+comillas+table_data[longitud-1]+comillas+""" class="col-12 col-m-9" {{if readonly}} readonly disabled {{endif readonly}}>
        <option value="ACT" {{if """+table_data[longitud-1]+"""_act}}selected{{endif """+table_data[longitud-1]+"""_act}}>Mostrar</option>
        <option value="INA" {{if """+table_data[longitud-1]+"""_ina}}selected{{endif """+table_data[longitud-1]+"""_ina}}>Ocultar</option>
      </select>
    </div>
    <div class="row my-4 align-center flex-end">
      {{if showCommitBtn}}
      <button class="primary col-12 col-m-2" type="submit" name="btnConfirmar">Confirmar</button>
      &nbsp;
      {{endif showCommitBtn}}
      <button class="col-12 col-m-2"type="button" id="btnCancelar">
        {{if showCommitBtn}}
        Cancelar
        {{endif showCommitBtn}}
        {{ifnot showCommitBtn}}
        Regresar
        {{endifnot showCommitBtn}}
      </button>
    </div>
    </div>
  </form>
</section>


<script>
  document.addEventListener("DOMContentLoaded", ()=>{
    const btnCancelar = document.getElementById("btnCancelar");
    btnCancelar.addEventListener("click", (e)=>{
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=mnt_"""+lowerPlural+comillas+""");
    });
  });
</script>
"""

f5.write(contenido)

f5.close()

print("Archivos generados correctamente")
print("--- Negocios Web ---")
print("--- GRUPO 4 ---")