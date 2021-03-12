<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Organizacao;
use Illuminate\Http\Request;

class EstatisticasController extends Controller
{
    public function index(){
        //"../../gabinete-multitenancy" patch do diretório completo
        //$domains = DB::table('organizacoes')->select('domain')->get();
        //dd($domains[0]->domain);


        // add folder name hear
        //$set_folder_path = "../../gabinete-multitenancy";
        //echo format_Size(folder_Size($set_folder_path));
        $Organizacoes = Organizacao::all();
        return view("Tenants/estatisticas",compact('Organizacoes'));
    }


    public function pesquisaEstatisticas(Request $request){
        $dataForm = $request->all();
        $domain = $dataForm['select-gab'];
        $mostraPesq = true;
        $Organizacoes = Organizacao::all();

        try{  //verifica se existe pasta com arquvio e consegue pegar pelo dominio
            $set_folder_path = "storage/".$domain."/pessoa";
            $tamanhoFoto = format_Size(folder_Size($set_folder_path));
        }catch(\Exception $e){
            $tamanhoFoto = 0;
        }

        try{  //verifica se existe pasta com arquvio e consegue pegar pelo dominio
            $set_folder_path = "storage/".$domain."/documentos";
            $tamanhoDocumento = format_Size(folder_Size($set_folder_path));
        }catch(\Exception $e){
            $tamanhoDocumento = 0;
        }

        try{  //verifica se existe pasta com arquvio e consegue pegar pelo dominio
            $set_folder_path = "storage/".$domain;
            $tamanhoTotal = format_Size(folder_Size($set_folder_path));
        }catch(\Exception $e){
            $tamanhoTotal = 0;
        }
        

        return view("Tenants/estatisticas",compact('tamanhoDocumento','tamanhoFoto','tamanhoTotal','mostraPesq','domain','Organizacoes'));
    }


}

function format_Size($set_bytes)
{
$set_kb = 1024;
$set_mb = $set_kb * 1024;
$set_gb = $set_mb * 1024;
$set_tb = $set_gb * 1024;
    if (($set_bytes >= 0) && ($set_bytes < $set_kb)){
        return $set_bytes . ' B';
    }
    elseif (($set_bytes >= $set_kb) && ($set_bytes < $set_mb)){
        return ceil($set_bytes / $set_kb) . ' KB';
    }
    elseif (($set_bytes >= $set_mb) && ($set_bytes < $set_gb)){
        return ceil($set_bytes / $set_mb) . ' MB';
    }
    elseif (($set_bytes >= $set_gb) && ($set_bytes < $set_tb)){
        return ceil($set_bytes / $set_gb) . ' GB';
    }
    elseif ($set_bytes >= $set_tb){
        return ceil($set_bytes / $set_tb) . ' TB';
    } else {
        return $set_bytes . ' Bytes';
    }
}
    
function folder_Size($set_dir)
{
    $set_total_size = 0;
    $set_count = 0;
    $set_dir_array = scandir($set_dir);
    foreach($set_dir_array as $key=>$set_filename)
    {
        if($set_filename!=".." && $set_filename!=".")
        {
            if(is_dir($set_dir."/".$set_filename)){
                $new_foldersize = folder_Size($set_dir."/".$set_filename);
                $set_total_size = $set_total_size+ $new_foldersize;
            }
            else if(is_file($set_dir."/".$set_filename)){
                $set_total_size = $set_total_size + filesize($set_dir."/".$set_filename);
                $set_count++;
            }
        }
    }
    return $set_total_size;
}