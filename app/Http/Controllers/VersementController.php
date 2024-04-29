<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Organisation;
use App\Models\PeriodeAca;
use App\Models\Promotions;
use App\Models\Parcours;
use App\Models\Versement;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class VersementController extends Controller
{
    
  /*   public function getPeriodesAca(Request $request)
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
 */
    //récupère les période grace a l'id de lorganisation
    public function versement(Request $request)
    {
        $paramValue = Session::get('paramValue');
    
        // Faites quelque chose avec la valeur récupérée
    
        $organisations = Organisation::all();

    
        $idparc = trim(stripslashes($request->input('parc')));
        $idparc = str_replace('"', '', $idparc);
$idparc = intval($idparc);
$idreg = trim(stripslashes($request->input('re')));
        $idreg = str_replace('"', '', $idreg);
$idreg = intval($idreg);
          // Affiche le code de l'organisation dans la console

   

        // Appelez votre procédure stockée avec le paramètre $codeorg
        $versements = DB::select('CALL psFraisScoByIdParcReg(?,?)', [$idparc,$idreg]);
    
        // Retournez la vue avec les résultats des périodes
        return view('versement', ['paramValue' => $paramValue, 'organisations' => $organisations,'versements' => $versements]);

    }

    //insert une nouvelle période
    public function store(Request $request)
    {
        $idfrais = $request->input('idfrais');
        $idreg = $request->input('re');
        $idparc = $request->input('parc');
        $nom = $request->input('nom');
        $montant = $request->input('montant');
        $delai = $request->input('delai');
     

        if($idfrais ==null){

        
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::insert('CALL psFraisScolarite_Insert(?,?, ?,?,?,?)', [null,$idparc,$idreg,$nom,$montant,$delai]);
    }else{
           // Appelez la procédure stockée avec les valeurs du formulaire
           DB::insert('CALL psFraisScolarite_Insert(?,?, ?,?,?,?)', [$idfrais,$idparc,$idreg,$nom,$montant,$delai]);
    }
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('versement');
    }

     //Supprimer une nouvelle période
     public function destroy(Request $request)
     {
        
         $iddfs= $request->input('iddfs');
      //dd($iddpro);
         // Appelez la procédure stockée avec les valeurs du formulaire
         DB::delete('CALL psFraisSco_Delete(?)', [ $iddfs]);
    
         // Redirigez vers une autre page ou affichez un message de confirmation
         return redirect()->route('versement');
     }



     public function getParamvers()
     {
         $paramValue = Session::get('paramValue');
         // Faites quelque chose avec la valeur récupérée
         $organisations = Organisation::all();
         $periodes = PeriodeAca::all();
         $parcours = Parcours::all();
         $versements = Versement::all();
         return view('versement', ['paramValue' => $paramValue, 'organisations' => $organisations, 'periodes' => $periodes,'parcours' => $parcours,'versements' => $versements]);
     }
}
