<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\sessions;
use App\Models\typesession;
use Illuminate\Http\Response;
use Illuminate\Http\Request;


class UniteCaController extends Controller
{
    
//insert une nouvelle période
public function store(Request $request)
{
    $iduc = $request->input('iduc');
    $nom = $request->input('nom');
    $duree = $request->input('duree');
    $iduc=intval($iduc);
    //DD( $idsess);
if($iduc==0){
// Appelez la procédure stockée avec les valeurs du formulaire
DB::insert('CALL psUniteCa_Insert(?,?,?)', [0,$nom,$duree]);
}else{

 // Appelez la procédure stockée avec les valeurs du formulaire
DB::insert('CALL psUniteCa_Insert(?,?,?)', [$iduc,$nom,$duree]);
}
    // Redirigez vers une autre page ou affichez un message de confirmation
    return redirect()->route('uniteca');
}

   //Supprimer une nouvelle période
   public function destroy(Request $request)
   {
      
       $idduc= $request->input('idduc');
    //dd($iddpro);
       // Appelez la procédure stockée avec les valeurs du formulaire
       DB::delete('CALL psUniteCa_Delete(?)', [ $idduc]);
  
       // Redirigez vers une autre page ou affichez un message de confirmation
       return redirect()->route('uniteca');
   }

    public function getParamuc()
    {
        $paramValue = Session::get('paramValue');
        // Faites quelque chose avec la valeur récupérée
        $unitesca = DB::select('CALL psUniteCa_List()');      
 
   return view('uniteca', [
       'paramValue' => $paramValue,
       'unitesca' => $unitesca
    
   ]);
       } 
}
