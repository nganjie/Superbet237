<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\groupe;
use App\Models\role;
use Illuminate\Support\Facades\DB;

class GroupeController extends Controller
{

    public function getrolegroupe(Request $request)
    {
        $selectedGroupe = Intval($request->input('groupeId'));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $roles = DB::select('CALL psRoleByGroupe(?)', [$selectedGroupe]);
        // Construire les options HTML des ues
        $options = array();
        foreach ($roles as $role) {
            $option = array(
                'id' => $role->id,
                'code' => $role->code,
                'nom' => $role->nom,
            );
            $options[] = $option;
        }
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
    }

    public function getrolegroupeAPI(Request $request)
    {
        $selectedGroupe = Intval($request->input('groupeId'));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $roles = DB::select('CALL psRoleByGroupe(?)', [$selectedGroupe]);
        // Construire les options HTML des ues
        $options = array();
        foreach ($roles as $role) {
            $option = array(
                'id' => $role->id,
                'code' => $role->code,
                'nom' => $role->nom,
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
        DB::insert('CALL psRoleGroupe_Insert(?,?)', [$idgroupe, $idrole]);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('groupe');
    }

    //insert une nouvelle période
    public function storergAPI(Request $request)
    {
        $message = 'Isertion réussie';

        $idrole = intval($request->input('idrole'));
        $idgroupe = intval($request->input('idgroupe'));

        //dd($idgroupe);
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::insert('CALL psRoleGroupe_Insert(?,?)', [$idgroupe, $idrole]);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return response()->json(['success' => $message]); 
    }

    //insert une nouvelle période
    public function store(Request $request)
    {
        $message = 'Isertion réussie';

        $idgroupe = $request->input('idgroupe');
        $code = $request->input('code');
        $nom = $request->input('nom');
        $description = $request->input('description');
        $idgroupe = intval($idgroupe);
//dd(  $idgroupe,$code,$nom,$description );
        if ($idgroupe == 0) {
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psGroupe_Insert(?,?,?,?)', [0, $code, $nom, $description]);
        } else {
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psGroupe_Insert(?,?,?,?)', [$idgroupe, $code, $nom, $description]);
        }
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('groupe');
    }

    public function storeAPI(Request $request)
    {
        $message = 'Isertion réussie';

        $idgroupe = $request->input('idgroupe');
        $code = $request->input('code');
        $nom = $request->input('nom');
        $description = $request->input('description');
        $idgroupe = intval($idgroupe);

        if ($idgroupe == 0) {
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psGroupe_Insert(?,?,?,?)', [0, $code, $nom, $description]);
        } else {
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psGroupe_Insert(?,?,?,?)', [$idgroupe, $code, $nom, $description]);
        }
        // Redirigez vers une autre page ou affichez un message de confirmation
        return response()->json(['success' => $message]); 
    }

         //Supprimer une nouvelle période
    public function destroy(Request $request)
    {
        $idgroupe = $request->input('idgroupe');
        //dd($iddpro);
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::delete('CALL psGroupe_Delete(?)', [$idgroupe]);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('groupe');
    }

    public function destroyAPI(Request $request)
    {
        $message = 'Isertion réussie';

        $idgroupe = $request->input('idgroupe');
        //dd($iddpro);
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::delete('CALL psGroupe_Delete(?)', [$idgroupe]);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return response()->json(['success' => $message]); 
    }

           //Supprimer une nouvelle période
    public function destroygroupe(Request $request)
    {

        $idrrole = $request->input('idrrole');
        $idggroupe = $request->input('idggroupe');
        //dd($iddpro);
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::delete('CALL psRoleGroupe_Delete(?,?)', [$idggroupe, $idrrole]);

        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('groupe');
    }

    public function destroygroupeAPI(Request $request)
    {
        $message = 'Isertion réussie';

        $idrrole = $request->input('idrrole');
        $idggroupe = $request->input('idggroupe');
        //dd($iddpro);
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::delete('CALL psRoleGroupe_Delete(?,?)', [$idggroupe, $idrrole]);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return response()->json(['success' => $message]); 
    }


    public function getParamgroupe()
    {
        $paramValue = Session::get('paramValue');
        $groupes = groupe::all();
        $roles = role::all();
        return view('groupe', ['paramValue' => $paramValue, 'groupes' => $groupes, 'roles' => $roles]);
    }

    public function getParamgroupeAPI()
    {
        $paramValue = Session::get('paramValue');
        $groupes = groupe::all();
        $roles = role::all();
        return response()->json(['paramValue' => $paramValue, 'groupes' => $groupes, 'roles' => $roles]); 
    }

    /*    public function getParamgroupe()
    {
      $groupes = groupe::all();
      return response()->json($groupes);
    } */
} 

