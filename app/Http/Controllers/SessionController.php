<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\sessions;
use App\Models\typesession;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class SessionController extends Controller
{

//insert une nouvelle période
public function store(Request $request)
{
    $idsess = $request->input('idsess');
    $idtype = $request->input('idtype');
    $nom = $request->input('nom');
    $description = $request->input('description');
    $idsess=intval($idsess);
    //DD( $idsess);
if($idsess==0){
// Appelez la procédure stockée avec les valeurs du formulaire
DB::insert('CALL psSession_Insert(?,?,?,?)', [0,$idtype,$nom,$description]);
}else{

 // Appelez la procédure stockée avec les valeurs du formulaire
DB::insert('CALL psSession_Insert(?,?,?,?)', [$idsess,$idtype,$nom,$description]);
}
    // Redirigez vers une autre page ou affichez un message de confirmation
    return redirect()->route('session');
}

   //Supprimer une nouvelle période
   public function destroy(Request $request)
   {
      
       $iddsess= $request->input('iddsess');
    //dd($iddpro);
       // Appelez la procédure stockée avec les valeurs du formulaire
       DB::delete('CALL psSession_Delete(?)', [ $iddsess]);
  
       // Redirigez vers une autre page ou affichez un message de confirmation
       return redirect()->route('session');
   }

    public function getParamsess()
    {
        $paramValue = Session::get('paramValue');
        // Faites quelque chose avec la valeur récupérée
        $sessions = DB::select('CALL psSession_List()');      
        $typesessions = typesession::all();
 
   return view('session', [
       'paramValue' => $paramValue,
       'sessions' => $sessions,
       'typesessions' => $typesessions,
    
   ]);
       } 
}
