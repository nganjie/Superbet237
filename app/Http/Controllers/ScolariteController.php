<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Organisation;
use App\Models\PeriodeAca;
use App\Models\Promotions;
use App\Models\Parcours;
use App\Models\Scolarite;
use App\Models\Auditeur;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Collection;

class ScolariteController extends Controller
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

    public function sco(Request $request)
    {
        $paramValue = Session::get('paramValue');
    

       $idperio = trim(stripslashes($request->input('id')));
       $idperio = str_replace('"', '', $idperio);
       $idperio = intval($idperio);

       $idreg = trim(stripslashes($request->input('idreg')));
       $idreg = str_replace('"', '', $idreg);
       $idreg = intval($idreg);
      // dd($idreg,$idperio);
       // Appelez votre procédure stockée avec le paramètre $idperio
       $promos = DB::select('CALL psEtatScolarite(?,?)', [$idperio,$idreg]);

       // Récupérez la valeur du reste
       $reste = $promos[0]->reste; // Remplacez cette valeur par le calcul réel du reste
       $paye = $promos[0]->montant_payé;
       $montant = $promos[0]->montant_total;

           // Appelez votre deuxième procédure stockée avec les paramètres appropriés
    $result = DB::select('CALL psVersementDateScoByAudi(?)', [$idperio]);

    // Récupérez les valeurs de la deuxième procédure stockée
    $montants = [];
    $dateInscriptions = [];

    foreach ($result as $row) {
        $montants[] = $row->montant;
        $dateInscriptions[] = $row->dateinscrip;
    }

   
       // Retournez la valeur du reste sous forme de réponse JSON
      // return response()->json(['reste' => $reste,'paye' => $paye,'montant' => $montant]);
         // Retournez les valeurs des procédures stockées sous forme de réponse JSON
    return response()->json([
        'reste' => $reste,
        'paye' => $paye,
        'montant' => $montant,
        'montants' => $montants,
        'dateinscrip' => $dateInscriptions
    ]);

    }

    //récupère les période grace a l'id de lorganisation
    public function scolarite(Request $request)
    {
        $paramValue = Session::get('paramValue');
    
        // Faites quelque chose avec la valeur récupérée
    
        $organisations = Organisation::all();

    
        $idperio = trim(stripslashes($request->input('perio')));
        $idperio = str_replace('"', '', $idperio);
$idperio = intval($idperio);
          // Affiche le code de l'organisation dans la console

   

        // Appelez votre procédure stockée avec le paramètre $codeorg
        $promos = DB::select('CALL psParcoursByPerio(?)', [$idperio]);
    
        // Retournez la vue avec les résultats des périodes
        return view('promotionAca', ['paramValue' => $paramValue, 'organisations' => $organisations,'promos' => $promos]);

    }

    //insert une nouvelle période
    public function store(Request $request)
    {
        $idaudia = $request->input('idaudia');
        $montantinscrip = $request->input('montantinscrip');
     

       
           // Appelez la procédure stockée avec les valeurs du formulaire
           DB::insert('CALL psScolarite_Insert(?,?)', [$idaudia,$montantinscrip]);

        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('scolarite');
    }

     //Supprimer une nouvelle période
     public function destroy(Request $request)
     {
        
         $iddreg= $request->input('iddreg');
      //dd($iddpro);
         // Appelez la procédure stockée avec les valeurs du formulaire
         DB::delete('CALL psRegroupement_Delete(?)', [ $iddreg]);
    
         // Redirigez vers une autre page ou affichez un message de confirmation
         return redirect()->route('regroupement');
     }

//récupère les période grace a l'id de lorganisation
public function auditeur(Request $request)
{
    $paramValue = Session::get('paramValue');

    // Faites quelque chose avec la valeur récupérée

    $organisations = Organisation::all();


    $idre = trim(stripslashes($request->input('re')));
    $idre = str_replace('"', '', $idre);
$idre = intval($idre);
      // Affiche le code de l'organisation dans la console



    // Appelez votre procédure stockée avec le paramètre $codeorg
    $auditeurs = DB::select('CALL psAuditeurByReg(?)', [$idre]);

    $auditeursCollection = new Collection($auditeurs);
        
    $decryptedAuditeurs = $auditeursCollection->map(function ($auditeur) {
        $auditeur->nom = Crypt::decrypt($auditeur->nom);
        $auditeur->prenom = Crypt::decrypt($auditeur->prenom);
        $auditeur->genre = Crypt::decrypt($auditeur->genre);
        $auditeur->date = Crypt::decrypt($auditeur->date);
        $auditeur->email = Crypt::decrypt($auditeur->email);
        $auditeur->tel = Crypt::decrypt($auditeur->tel);
        // Répétez pour chaque attribut que vous avez chiffré
        return $auditeur;
    });

    // Retournez la vue avec les résultats des périodes
    return view('scolarite', ['paramValue' => $paramValue, 'organisations' => $organisations,'auditeurs' => $decryptedAuditeurs]);

}

     public function getParamsco()
     {
         $paramValue = Session::get('paramValue');
         // Faites quelque chose avec la valeur récupérée
         $organisations = Organisation::all();
         $periodes = PeriodeAca::all();
         $parcours = Parcours::all();
         $auditeurs = Auditeur::all();
       
         return view('scolarite', ['paramValue' => $paramValue, 'organisations' => $organisations, 'periodes' => $periodes,'parcours' => $parcours]);
     }
}
