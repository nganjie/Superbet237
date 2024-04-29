<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Organisation;
use App\Models\PeriodeAca;
use App\Models\Promotions;
use App\Models\Parcours;
use App\Models\regroupements;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RegroupementController extends Controller
{
    
    public function getPeriodesAcareg(Request $request)


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

    public function getParcoursAcareg(Request $request){
        $selectedPeriode = Intval($request->input('periode'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $parcoursAca = DB::select('CALL psParcoursListByPerio(?)', [$selectedPeriode]);
    
        // Construire les options HTML des périodes académiques
        $options = '<option disabled selected value="">choisir un parcours';
    
        foreach ($parcoursAca as $parcourAca) {
            $options .= '<option name="parc" value="' . $parcourAca->id . '">' . $parcourAca->nomparc . '';
        }
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
    }

    public function getauditeur(Request $request)
{
    $selecteregId = intval($request->input('regId'));

    // Appeler la procédure stockée pour récupérer les auditeurs
    $auditeurs = DB::select('CALL psAuditeurByIdreg(?)', [$selecteregId]);

    // Décrypter les attributs de chaque auditeur
    $decryptedAuditeurs = [];
    foreach ($auditeurs as $auditeur) {
        $auditeur->nom = Crypt::decrypt($auditeur->nom);
        $auditeur->prenom = Crypt::decrypt($auditeur->prenom);
        $auditeur->genre = Crypt::decrypt($auditeur->genre);
        $auditeur->date = Crypt::decrypt($auditeur->date);
        $auditeur->email = Crypt::decrypt($auditeur->email);
        $auditeur->tel = Crypt::decrypt($auditeur->tel);
        // Répétez pour chaque attribut que vous avez chiffré

        $decryptedAuditeurs[] = $auditeur;
    }

    // Construire les options HTML des auditeurs
    $options = [];
    foreach ($decryptedAuditeurs as $auditeur) {
        $option = [
            'id' => $auditeur->id,
            'matricule' => $auditeur->matricule,
            'nom' => $auditeur->nom,
            'prenom' => $auditeur->prenom,
            'genre' => $auditeur->genre,
            'date' => $auditeur->date,
            'email' => $auditeur->email,
            'tel' => $auditeur->tel,
        ];

        $options[] = $option;
    }

    // Renvoyer les options des auditeurs en tant que réponse JSON avec l'encodage UTF-8
    return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
}


public function getauditeuranonyme(Request $request)
{
    $selecteregId = intval($request->input('regId'));

    // Appeler la procédure stockée pour récupérer les auditeurs
    $auditeurs = DB::select('CALL psAuditeurAnonymeByIdReg(?)', [$selecteregId]);

    // Décrypter les attributs de chaque auditeur
    $decryptedAuditeurs = [];
    foreach ($auditeurs as $auditeur) {
        $auditeur->nom = Crypt::decrypt($auditeur->nom);
        $auditeur->prenom = Crypt::decrypt($auditeur->prenom);
    
        // Répétez pour chaque attribut que vous avez chiffré

        $decryptedAuditeurs[] = $auditeur;
    }

    // Construire les options HTML des auditeurs
    $options = [];
    foreach ($decryptedAuditeurs as $auditeur) {
        $option = [
            'id' => $auditeur->id,
            'idaudi' => $auditeur->idaudi,
            'idexaa' => $auditeur->idexaa,
            'code' => $auditeur->code,
            'nom' => $auditeur->nom,
            'prenom' => $auditeur->prenom
         
        ];

        $options[] = $option;
    }

    // Renvoyer les options des auditeurs en tant que réponse JSON avec l'encodage UTF-8
    return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
}

    public function getparcours(Request $request){
        $selecteregId = Intval($request->input('regId'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $parcours = DB::select('CALL psParcoursByIdreg(?)', [$selecteregId]);
    
        // Construire les options HTML des périodes académiques
      /*  $options = '<option disabled selected value="">'; */
   
        // Construire les options HTML des auditeurs
        $options = array();
        foreach ($parcours as $parcour) {
        $option = array(
            'nomparc' => $parcour->nomparc,
         
         
        );
    
        $options[] = $option;
    }
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
    }

    //récupère les période grace a l'id de lorganisation
    public function regroupements(Request $request)
    {
        $paramValue = Session::get('paramValue');
    
        // Faites quelque chose avec la valeur récupérée
    
        $organisations = Organisation::all();

    
        $parc = trim(stripslashes($request->input('parc')));
        $parc = str_replace('"', '', $parc);
$parc = intval($parc);
          // Affiche le code de l'organisation dans la console

   

        // Appelez votre procédure stockée avec le paramètre $codeorg
        $regroupements = DB::select('CALL psRegroupeByParc(?)', [$parc]);
    
        // Retournez la vue avec les résultats des périodes
        return view('regroupement', ['paramValue' => $paramValue, 'organisations' => $organisations,'regroupements' => $regroupements]);

    }

    //insert une nouvelle période
    public function store(Request $request)
    {
        $idparc = intval($request->input('parc'));
        $idreg = $request->input('idreg');
        $nom = $request->input('nom');
        $description = $request->input('description');
        $heuredebut = $request->input('heuredebut');
        $heurefin = $request->input('heurefin');
     //dd($idparc);

        if($idreg ==null){
            $message="Regroupement ajouté avec succès.";
        
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::insert('CALL psRegroupement_Insert(?,?, ?,?,?,?)', [null,$nom,$description,$heuredebut,$heurefin,$idparc]);
        session()->flash('messagesuc', $message);
    }else{
        $message="Regroupement modifié avec succès.";
           // Appelez la procédure stockée avec les valeurs du formulaire
           DB::insert('CALL psRegroupement_Insert(?,?, ?,?,?,?)', [$idreg,$nom,$description,$heuredebut,$heurefin,$idparc]);
           session()->flash('messagesuc', $message);
        }
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('regroupement');
    }

       //insert une nouvelle période
       public function storerp(Request $request)
       {
        $message="regoupement ajouté au parcours avec succès.";
           $idreg = $request->input('idreg');
           $idparc = $request->input('parc');
      
              // Appelez la procédure stockée avec les valeurs du formulaire
              DB::insert('CALL psRegroupementParcours_Insert(?,?)', [$idreg,$idparc]);
              session()->flash('messagesuc', $message);
           return redirect()->route('regroupement');
       }

     //Supprimer une nouvelle période
     public function destroy(Request $request)
     {
        $message = "Regroupement supprimé avec succès.";
         $iddreg= $request->input('iddreg');
      //dd($iddpro);
         // Appelez la procédure stockée avec les valeurs du formulaire
         DB::delete('CALL psRegroupement_Delete(?)', [ $iddreg]);
         session()->flash('message', $message);
         // Redirigez vers une autre page ou affichez un message de confirmation
         return redirect()->route('regroupement');
     }

      //Supprimer plusieurs période
      public function destroyp(Request $request)
      {
        $message = "Regroupements supprimés avec succès.";
        $tableau = $request->input('tableau');
        $tableau = json_decode($tableau, true);
    
        // Utilisez le tableau comme vous le souhaitez
      //  dd(intval($tableau[0]));

        foreach ($tableau as $element) {
            $elementId = intval($element);
    //dd($elementId);
            // Appeler la procédure stockée pour supprimer l'élément
            DB::statement('CALL psRegroupement_Delete(?)', [$elementId]);
            session()->flash('message', $message);
        }
          return redirect()->route('regroupement');
      }

     //Supprimer une nouvelle période
     public function destroy_audi(Request $request)
     {
        $message = "Auditeur supprimé avec succès.";
         $iddregg= intval($request->input('iddregg'));
         $idauditeur= intval($request->input('idauditeur'));
        //dd($iddregg,$idauditeur);
         // Appelez la procédure stockée avec les valeurs du formulaire
         DB::delete('CALL psAuditeurRegroupement_Delete(?,?)', [ $iddregg,$idauditeur]);
         session()->flash('message', $message);
         // Redirigez vers une autre page ou affichez un message de confirmation
         return redirect()->route('regroupement');
     }



     public function getParamregrou()
     {
         $paramValue = Session::get('paramValue');
         // Faites quelque chose avec la valeur récupérée
         $organisations = Organisation::all();
         $periodes = PeriodeAca::all();
         $parcours = Parcours::all();
         $regroupements = regroupements::all();
         return view('regroupement', ['paramValue' => $paramValue, 'organisations' => $organisations, 'periodes' => $periodes,'parcours' => $parcours,'regroupements' => $regroupements]);
     }



}
