<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\typesession;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class TypeSessionController extends Controller
{

    //insert une nouvelle période
    public function store(Request $request)
    {
        $idtype = $request->input('idtype');
        $code = $request->input('code');
        $nom = $request->input('nom');
        $anonyme = $request->input('anonyme');
        $idtype=intval($idtype);
       // DD( $idgroupe);
if($idtype==0){
 // Appelez la procédure stockée avec les valeurs du formulaire
 DB::insert('CALL psTypeSession_Insert(?,?,?,?)', [0,$code,$nom,$anonyme]);
}else{
 
     // Appelez la procédure stockée avec les valeurs du formulaire
 DB::insert('CALL psTypeSession_Insert(?,?,?,?)', [$idtype,$code,$nom,$anonyme]);
}
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('typesession');
    }

    
         //Supprimer une nouvelle période
         public function destroy(Request $request)
         {
            
             $iddtype= $request->input('iddtype');
          //dd($iddpro);
             // Appelez la procédure stockée avec les valeurs du formulaire
             DB::delete('CALL psTypeSession_Delete(?)', [ $iddtype]);
        
             // Redirigez vers une autre page ou affichez un message de confirmation
             return redirect()->route('typesession');
         }

    public function getParamtypsess()
    {
        $paramValue = Session::get('paramValue');
        // Faites quelque chose avec la valeur récupérée
        $typesessions = typesession::all();
 
   return view('typesession', [
       'paramValue' => $paramValue,
       'typesessions' => $typesessions,
    
   ]);
       } 
}
