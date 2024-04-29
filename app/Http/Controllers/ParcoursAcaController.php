<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Organisation;
use App\Models\PeriodeAca;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Collection;

class ParcoursAcaController extends Controller
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

    public function getParcoursAcap(Request $request){
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


    public function getpromotionParcoursAcap(Request $request){
        $selectedPeriode = Intval($request->input('parcoursId'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $promos = DB::select('CALL psPromotionByParc(?)', [$selectedPeriode]);
    
             // Construire les options HTML des ues
             $options = array();
        foreach ($promos as $promo) {
            $option = array(
                'id' => $promo->id,
                'nompromo' => $promo->nompromo,
                'rentréeofficielle' => $promo->rentréeofficielle,
               
             
            );
        
            $options[] = $option;
        }
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
    }


    public function getgueParcoursAcap(Request $request){
        $selectedPeriode = Intval($request->input('parcoursId'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $gues = DB::select('CALL psGueByIdParc(?)', [$selectedPeriode]);
    
             // Construire les options HTML des ues
             $options = array();
        foreach ($gues as $gue) {
            $option = array(
                'id' => $gue->id,
                'codegue' => $gue->codegue,
                'nomgue' => $gue->nomgue,
               
             
            );
        
            $options[] = $option;
        }
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
    }


    public function getregroupe(Request $request){
        $selectedPeriode = Intval($request->input('parcour'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $regroupements = DB::select('CALL psRegroupeByParc(?)', [$selectedPeriode]);
    
        // Construire les options HTML des périodes académiques
      $options = '<option disabled selected value="">choisir un regroupement';
    
        foreach ($regroupements as $regroupement) {
           // $options .= '<option valeur="'. $regroupement->id .'">' . $regroupement->nomreg . '</option>';  
            $options .= '<option  value="' . $regroupement->id . '">' . $regroupement->nomreg . '';
        }
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
    }

    public function getEnsUe(Request $request){
        $selectedPeriode = Intval($request->input('parcour'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $ues = DB::select('CALL psUeByIdEns(?)', [$selectedPeriode]);
    
        // Construire les options HTML des périodes académiques
      $options = '<option disabled selected value="">choisir une unité';
    
        foreach ($ues as $ue) {
           // $options .= '<option valeur="'. $regroupement->id .'">' . $regroupement->nomreg . '</option>';  
            $options .= '<option  value="' . $ue->id . '">' . $ue->nomue . '';
        }
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
    }


    public function getgue(Request $request){
        $selectedparc = Intval($request->input('gue'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $gues = DB::select('CALL psGueByIdParc(?)', [$selectedparc]);
    
        // Construire les options HTML des périodes académiques
      $options = '<option disabled selected value="">choisir un groupe ue';
    
        foreach ($gues as $gue) {
           // $options .= '<option valeur="'. $regroupement->id .'">' . $regroupement->nomreg . '</option>';  
            $options .= '<option  value="' . $gue->id . '">' . $gue->nomgue . '';
        }
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
    }

    
    public function getue(Request $request){
        $selectedgue = Intval($request->input('ue'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $ues = DB::select('CALL psUeByIdGue(?)', [$selectedgue]);
    
        // Construire les options HTML des périodes académiques
      $options = '<option disabled selected value="">choisir une ue';
    
        foreach ($ues as $ue) {
           // $options .= '<option valeur="'. $regroupement->id .'">' . $regroupement->nomreg . '</option>';  
            $options .= '<option  value="' . $ue->id . '">' . $ue->nomue . '';
        }
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
    }

    //récupère les période grace a l'id de lorganisation
    public function parcours(Request $request)
    {
        $paramValue = Session::get('paramValue');
    
        // Faites quelque chose avec la valeur récupérée
    
        $organisations = Organisation::all();

    
        $idperio = trim(stripslashes($request->input('perio')));
        $idperio = str_replace('"', '', $idperio);
$idperio = intval($idperio);
          // Affiche le code de l'organisation dans la console

   

        // Appelez votre procédure stockée avec le paramètre $codeorg
        $parcours = DB::select('CALL psParcoursByPerio(?)', [$idperio]);
    
        // Retournez la vue avec les résultats des périodes
        return view('parcoursAca', ['paramValue' => $paramValue, 'organisations' => $organisations,'parcours' => $parcours]);

    }

    //insert une nouvelle période
    public function store(Request $request)
    {
        $idparc = $request->input('idparc');
        $code = $request->input('code');
        $nomparc = $request->input('nomparc');
        $idperio = trim(stripslashes($request->input('perio')));
        $idperio = str_replace('"', '', $idperio);
$idperio = intval($idperio);
     

        if($idparc ==null){

            $message="Parcours ajouté succès.";
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::insert('CALL psParcours_Insert(?,?, ?,?)', [null,$code,$nomparc,$idperio]);
        session()->flash('messagesuc', $message);
    }else{
        $message="Parcours modifié avec succès.";
           // Appelez la procédure stockée avec les valeurs du formulaire
           DB::insert('CALL psParcours_Insert(?,?, ?,?)', [$idparc ,$code,$nomparc,$idperio]);
           session()->flash('messagesuc', $message);
        }
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('parcoursAca');
    }

     //Supprimer une nouvelle période
     public function destroy(Request $request)
     {
        $message = "Parcours supprimé avec succès.";
         $iddperio = $request->input('iddparc');
      
         // Appelez la procédure stockée avec les valeurs du formulaire
         DB::delete('CALL psParcours_Delete(?)', [ $iddperio]);
         session()->flash('message', $message);
         // Redirigez vers une autre page ou affichez un message de confirmation
         return redirect()->route('parcoursAca');
     }

      //Supprimer plusieurs période
      public function destroyp(Request $request)
      {
        $message = "Parcours supprimés avec succès.";
        $tableau = $request->input('tableau');
        $tableau = json_decode($tableau, true);
    
        // Utilisez le tableau comme vous le souhaitez
      //  dd(intval($tableau[0]));

        foreach ($tableau as $element) {
            $elementId = intval($element);
    //dd($elementId);
            // Appeler la procédure stockée pour supprimer l'élément
            DB::statement('CALL psParcours_Delete(?)', [$elementId]);
            session()->flash('message', $message);
        }
          return redirect()->route('parcoursAca');
      }

      //Supprimer une nouvelle période
      public function destroypromoparc(Request $request)
      {
        $message = "Promotion supprimée avec succès.";
          $idparc= intval($request->input('idparc'));
          $idppro= intval($request->input('idppro'));
        // dd($idparc,$idppro);
          // Appelez la procédure stockée avec les valeurs du formulaire
          DB::delete('CALL psParcoursPromo_Delete(?,?)', [ $idparc,$idppro]);
          session()->flash('message', $message);
          // Redirigez vers une autre page ou affichez un message de confirmation
          return redirect()->route('parcoursAca');
      }

        //Supprimer une nouvelle période
        public function destroygue(Request $request)
        {
            $message = "groupe d'unité supprimé avec succès.";
            $iddparc= intval($request->input('iddparc'));
            $idgue= intval($request->input('idgue'));
          // dd($idparc,$idppro);
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::delete('CALL psParcoursGue_Delete(?,?)', [ $iddparc,$idgue]);
            session()->flash('message', $message);
            // Redirigez vers une autre page ou affichez un message de confirmation
            return redirect()->route('parcoursAca');
        }
      

     public function getParamparc()
     {
         $paramValue = Session::get('paramValue');
         // Faites quelque chose avec la valeur récupérée
         $organisations = Organisation::all();
         $periodes = PeriodeAca::all();
         return view('parcoursAca', ['paramValue' => $paramValue, 'organisations' => $organisations, 'periodes' => $periodes]);
     }

     public function getaudi(Request $request){
        $selectedPeriode = Intval($request->input('parcours'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $auditeurs = DB::select('CALL psAuditeurListByParc(?)', [$selectedPeriode]);
    
      
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
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($decryptedAuditeurs)->header('Content-Type', 'application/json; charset=utf-8');
    }

    public function getreg(Request $request){
        $selectedPeriode = Intval($request->input('periode'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $regroupements = DB::select('CALL psRegroupeByParc(?)', [$selectedPeriode]);
    
      
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($regroupements)->header('Content-Type', 'application/json; charset=utf-8');
    }
}
