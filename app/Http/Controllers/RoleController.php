<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\role;
use App\Models\groupe;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    
    public function getgrouperole(Request $request){
        $selectedRole = Intval($request->input('roleId'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $groupes = DB::select('CALL psGroupeByRole(?)', [$selectedRole]);
    
             // Construire les options HTML des ues
             $options = array();
        foreach ($groupes as $groupe) {
            $option = array(
                'id' => $groupe->id,
                'code' => $groupe->code,
                'nom' => $groupe->nom,
               
             
            );
        
            $options[] = $option;
        }
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
    }
     //insert une nouvelle période
     public function storerg(Request $request)
     {
         $idrole = intval($request->input('idrole'));
         $idgroupe = intval($request->input('idgroupe'));
   
 //dd($idgroupe);
  // Appelez la procédure stockée avec les valeurs du formulaire
  DB::insert('CALL psRoleGroupe_Insert(?,?)', [$idgroupe,$idrole]);
       // Redirigez vers une autre page ou affichez un message de confirmation
         return redirect()->route('role');
     }

    //insert une nouvelle période
    public function store(Request $request)
    {
        $idrole = $request->input('idrole');
        $code = $request->input('code');
        $nom = $request->input('nom');
        $description = $request->input('description');
        $idrole=intval($idrole);
       // DD( $idgroupe);
if($idrole==0){
 // Appelez la procédure stockée avec les valeurs du formulaire
 DB::insert('CALL psRole_Insert(?,?,?,?)', [0,$code,$nom,$description]);
}else{
 
     // Appelez la procédure stockée avec les valeurs du formulaire
 DB::insert('CALL psRole_Insert(?,?,?,?)', [$idrole,$code,$nom,$description]);
}
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('role');
    }

         //Supprimer une nouvelle période
         public function destroy(Request $request)
         {
            
             $idrole= $request->input('idrole');
          //dd($iddpro);
             // Appelez la procédure stockée avec les valeurs du formulaire
             DB::delete('CALL psRole_Delete(?)', [ $idrole]);
        
             // Redirigez vers une autre page ou affichez un message de confirmation
             return redirect()->route('role');
         }

          //Supprimer une nouvelle période
          public function destroygroupe(Request $request)
          {
             
              $idrrole= $request->input('idrrole');
              $idggroupe= $request->input('idggroupe');
           //dd($iddpro);
              // Appelez la procédure stockée avec les valeurs du formulaire
              DB::delete('CALL psRoleGroupe_Delete(?,?)', [ $idggroupe,$idrrole]);
         
              // Redirigez vers une autre page ou affichez un message de confirmation
              return redirect()->route('role');
          }

    public function getParamrole()
    {
        $paramValue = Session::get('paramValue');
        $groupes = groupe::all();
        $roles = role::all();
      
        return view('role', ['paramValue' => $paramValue, 'roles' => $roles, 'groupes' => $groupes]);
    }
}
