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

class GueController extends Controller
{
    
    public function getPeriodesAca(Request $request)
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


    public function getuebygue(Request $request){
        $selectedgue= Intval($request->input('gueId'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $ues = DB::select('CALL psUeByIdGue(?)', [$selectedgue]);
    
             // Construire les options HTML des ues
    $options = array();
    foreach ($ues as $ue) {
    $option = array(
        'id' => $ue->id,
        'nomue' => $ue->nomue,
        'coefficient' => $ue->coefficient,
       
     
    );

    $options[] = $option;
}
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
    }

    //récupère les période grace a l'id de lorganisation
    public function gue(Request $request)
    {
        $paramValue = Session::get('paramValue');
    
        // Faites quelque chose avec la valeur récupérée
    
        $organisations = Organisation::all();

    
        $idparc = $request->input('parc');
$idparc = intval($idparc);
          // Affiche le code de l'organisation dans la console

        // Appelez votre procédure stockée avec le paramètre $codeorg
        $gues = DB::select('CALL psGueByIdParc(?)', [$idparc]);
    
        // Retournez la vue avec les résultats des périodes
        return view('gue', ['paramValue' => $paramValue, 'organisations' => $organisations,'gues' => $gues]);

    }

    //insert une nouvelle période
    public function store(Request $request)
    {
        $idgue = $request->input('idgue');
        $codegue = $request->input('codegue');
        $nomgue = $request->input('nomgue');
        
     

        if($idgue ==null){
            $message="Groupe d'unité insérer avec succès.";
        
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::insert('CALL psGue_Insert(?,?, ?)', [null,$codegue,$nomgue]);
        session()->flash('messagesuc', $message);
    }else{
        $message="Groupe d'unité modifié avec succès.";
           // Appelez la procédure stockée avec les valeurs du formulaire
           DB::insert('CALL psGue_Insert(?,?, ?)', [$idgue,$codegue,$nomgue]);
           session()->flash('messagesuc', $message);
        }
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('gue');
    }

    //insert une nouvelle période
    public function storepg(Request $request)
    {
        $idgue = $request->input('idguee');
        $idparc = $request->input('parc');
        $message="Parcours affecté avec succès.";
    
           // Appelez la procédure stockée avec les valeurs du formulaire
           DB::insert('CALL psParcoursGue_Insert(?,?)', [$idgue,$idparc]);
           session()->flash('messagesuc', $message);
        return redirect()->route('gue');
    }

     //Supprimer une nouvelle période
     public function destroy(Request $request)
     {
        $message = "Groupe d'nité d'enseignement supprimer avec succès.";
         $iddreg= $request->input('iddgue');
      //dd($iddpro);
         // Appelez la procédure stockée avec les valeurs du formulaire
         DB::delete('CALL psGue_Delete(?)', [ $iddreg]);
         session()->flash('message', $message);
         // Redirigez vers une autre page ou affichez un message de confirmation
         return redirect()->route('gue');
     }

     //Supprimer une nouvelle période
     public function destroyue(Request $request)
     {
        $message = "Unité d'enseignement supprimer avec succès."; 
         $iddegue= intval($request->input('iddegue'));
         $idue= intval($request->input('idue'));
        //dd($iddegue,$idue);
         // Appelez la procédure stockée avec les valeurs du formulaire
         DB::delete('CALL psUeGue_Delete(?,?)', [ $iddegue,$idue]);
         session()->flash('message', $message);
         // Redirigez vers une autre page ou affichez un message de confirmation
         return redirect()->route('gue');
     }
     



     public function getParamgue()
     {
         $paramValue = Session::get('paramValue');
         // Faites quelque chose avec la valeur récupérée
         $gues = Gue::all();
         $organisations = Organisation::all();
   
         return view('gue', ['paramValue' => $paramValue, 'gues' => $gues, 'organisations' => $organisations]);
     }
}
