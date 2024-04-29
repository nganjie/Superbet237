<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Organisation;
use App\Models\PeriodeAca;
use App\Models\Promotions;
use App\Models\Parcours;
use App\Models\Regroupements;
use App\Models\Ue;
use App\Models\Gue;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UeController extends Controller
{
    
    public function getPeriodesAca(Request $request)
    {
        $selectedOrganisation = $request->input('organisation');
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $periodesAca = DB::select('CALL psPeriodeListByOrg(?)', [$selectedOrganisation]);
    
        // Construire les options HTML des périodes académiques
        $options = '<option disabled selected value="">choisir une periode';
    
        foreach ($periodesAca as $periode) {
            $options .= '<option name="perio" value="' . $periode->id . '">' . $periode->nomperio . '';
        }
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
    }

    public function getPeriodesAcaAPI(Request $request)
    {
        $selectedOrganisation = $request->input('organisation');

    dd($selectedOrganisation);
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $periodesAca = DB::select('CALL psPeriodeListByOrg(?)', [$selectedOrganisation]);
    
        // Construire les options HTML des périodes académiques
        $options = '<option disabled selected value="">choisir une periode';
    
        foreach ($periodesAca as $periode) {
            $options .= '<option name="perio" value="' . $periode->id . '">' . $periode->nomperio . '';
        }
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
    }

    public function getParcoursAca(Request $request){
        dd("ok");
    }

    //récupère les période grace a l'id de lorganisation
    public function ue(Request $request)
    {
        $paramValue = Session::get('paramValue');
        // Faites quelque chose avec la valeur récupérée
        $gues = Gue::all();
    $organisations = Organisation::all();
        $idgue = $request->input('idgue');
            
        $idgue = intval($idgue);
        //dd($idgue);
          // Affiche le code de l'organisation dans la console

   

        // Appelez votre procédure stockée avec le paramètre $codeorg
        $ues = DB::select('CALL psUeByIdGue(?)', [$idgue]);
    
        // Retournez la vue avec les résultats des périodes
        return view('ue', ['paramValue' => $paramValue,'organisations' => $organisations,'ues' => $ues,'gues' => $gues]);

    }



 

    //insert une nouvelle période
    public function store(Request $request)
    {
        $idue = $request->input('idue');
        $codeue = $request->input('codeue');
        $nomue = $request->input('nomue');
        $prerequis = $request->input('prerequis');
        $objectif = $request->input('objectif');
        $cout = $request->input('cout');
        $coefficient = $request->input('coefficient');


        if ($idue == null) {

            $message = "Unité insérer avec succès.";
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psUe_Insert(?,?,?, ?,?,?,?)', [null, $codeue, $nomue, $prerequis, $objectif, $cout, $coefficient]);
            session()->flash('messagesuc', $message);
        } else {
            $message = "Unité modifié avec succès.";
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psUe_Insert(?,?, ?,?,?,?,?)', [$idue, $codeue, $nomue, $prerequis, $objectif, $cout, $coefficient]);
            session()->flash('messagesuc', $message);
        }
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('ue');
    }



    //insert une nouvelle période
    public function storegu(Request $request)
    {
        $message = "Groupe affecté avec succès.";
        $idue = $request->input('idaue');
        $idgue = $request->input('gue');
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::insert('CALL psGueUe_Insert(?,?)', [$idgue, $idue]);
        session()->flash('messagesuc', $message);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('ue');
    }

     //insert une nouvelle période
       public function storepu(Request $request)
       {
           $message = "Parcours affecté avec succès.";
           $idue = $request->input('idaue');
           $parc = $request->input('parc');
           // Appelez la procédure stockée avec les valeurs du formulaire
           DB::insert('CALL psParcoursUe_Insert(?,?)', [$idue, $parc]);
           session()->flash('messagesuc', $message);
           // Redirigez vers une autre page ou affichez un message de confirmation
           return redirect()->route('ue');
       }



    //Supprimer une nouvelle période
     public function destroy(Request $request)
     {
        $message = "Unité d'enseignement supprimer avec succès.";
         $iddue= $request->input('iddue');
     // dd($iddue);
         // Appelez la procédure stockée avec les valeurs du formulaire
         DB::delete('CALL psUe_Delete(?)', [ $iddue]);
         session()->flash('message', $message);
         // Redirigez vers une autre page ou affichez un message de confirmation
         return redirect()->route('ue');
     }

  



     public function getParamue()
     {
         $paramValue = Session::get('paramValue');
         // Faites quelque chose avec la valeur récupérée
         $ues = Ue::all();
         $gues = Gue::all();
          $organisations = Organisation::all();
   
         return view('ue', ['paramValue' => $paramValue,'organisations' => $organisations, 'ues' => $ues, 'gues' => $gues]);
     }

     public function getens(Request $request){
        $selectedPeriode = Intval($request->input('ue'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $enseignants = DB::select('CALL psEnseignantByIdUe(?)', [$selectedPeriode]);
    
      
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($enseignants)->header('Content-Type', 'application/json; charset=utf-8');
    }

    public function getparc(Request $request){
        $selectedPeriode = Intval($request->input('ue'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $parcours = DB::select('CALL psParcoursByUe(?)', [$selectedPeriode]);
    
      
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($parcours)->header('Content-Type', 'application/json; charset=utf-8');
    }
}
