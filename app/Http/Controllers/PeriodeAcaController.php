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

class PeriodeAcaController extends Controller
{
    //récupère les période grace a l'id de lorganisation
    public function periodes(Request $request)
    {
        $paramValue = Session::get('paramValue');
    
        // Faites quelque chose avec la valeur récupérée
    
        $organisations = Organisation::all();
    
        $codeorg = $request->input('state');
       /*  dd($codeorg); */ // Affiche le code de l'organisation dans la console
    
        // Appelez votre procédure stockée avec le paramètre $codeorg
        $periodes = DB::select('CALL psPeriodeListByOrg(?)', [$codeorg]);
    
        // Retournez la vue avec les résultats des périodes
        return view('periodeAca', ['paramValue' => $paramValue, 'organisations' => $organisations, 'periodes' => $periodes]);
    }

    //insert une nouvelle période
    public function store(Request $request)
    {
        $codeorg = $request->input('state');
        $idperio = $request->input('idperio');
        $libelleperio = $request->input('libelleperio');
        $start = $request->input('start');
        $end = $request->input('end');

        if($idperio ==null){
            $message="Période insérée avec succès.";
        
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::insert('CALL psPeriode_Insert(?,?, ?, ?, ?)', [0, $libelleperio, $start, $end,$codeorg]);
        session()->flash('messagesuc', $message);
    }else{
        $message="Période modifiée avec succès.";
           // Appelez la procédure stockée avec les valeurs du formulaire
           DB::insert('CALL psPeriode_Insert(?,?, ?, ?, ?)', [$idperio ,$libelleperio, $start, $end,$codeorg]);
           session()->flash('messagesuc', $message);
        }
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('periodeAca');
    }

     //Supprimer une nouvelle période
     public function destroy(Request $request)
     {
        $message = "Période supprimées avec succès.";
         $iddperio = $request->input('iddperio');
      
         // Appelez la procédure stockée avec les valeurs du formulaire
         DB::delete('CALL psPeriode_Delete(?)', [ $iddperio]);
    
         session()->flash('message', $message);
         // Redirigez vers une autre page ou affichez un message de confirmation
         return redirect()->route('periodeAca');
     }
 
      //Supprimer plusieurs période
      public function destroyp(Request $request)
      {
        $message = "Périodes supprimés avec succès.";
        $tableau = $request->input('tableau');
        $tableau = json_decode($tableau, true);
    
        // Utilisez le tableau comme vous le souhaitez
      //  dd(intval($tableau[0]));

        foreach ($tableau as $element) {
            $elementId = intval($element);
    //dd($elementId);
            // Appeler la procédure stockée pour supprimer l'élément
            DB::statement('CALL psPeriode_Delete(?)', [$elementId]);
            session()->flash('message', $message);
        }
          return redirect()->route('periodeAca');
      }


      public function getpromo(Request $request){
        $selectedPeriode = Intval($request->input('periode'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $promotionAca = DB::select('CALL psPromotionListByPerio(?)', [$selectedPeriode]);
    
      
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($promotionAca)->header('Content-Type', 'application/json; charset=utf-8');
    }

    public function getparcours(Request $request){
        $selectedPeriode = Intval($request->input('periode'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $parcoursAca = DB::select('CALL psParcoursListByPerio(?)', [$selectedPeriode]);
    
      
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($parcoursAca)->header('Content-Type', 'application/json; charset=utf-8');
    }

    public function getregroupements(Request $request){
        $selectedPeriode = Intval($request->input('periode'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $regroupements = DB::select('CALL psRegroupementListByPerio(?)', [$selectedPeriode]);
    
      
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($regroupements)->header('Content-Type', 'application/json; charset=utf-8');
    }


    public function getauditeurs(Request $request){
        $selectedPeriode = Intval($request->input('periode'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $auditeurs = DB::select('CALL psAuditeurListByPerio(?)', [$selectedPeriode]);
    
      

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

    public function getenseignants(Request $request){
        $selectedPeriode = Intval($request->input('periode'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $enseignants = DB::select('CALL psEnseignantListByPerio(?)', [$selectedPeriode]);
    
      
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($enseignants)->header('Content-Type', 'application/json; charset=utf-8');
    }

    public function getmatieres(Request $request){
        $selectedPeriode = Intval($request->input('periode'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $matieres = DB::select('CALL psMatierListByPerio(?)', [$selectedPeriode]);
    
      
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($matieres)->header('Content-Type', 'application/json; charset=utf-8');
    }

    public function getdivisions(Request $request){
        $selectedPeriode = Intval($request->input('periode'));

   // dd(Intval($selectedPeriode));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $divisions = DB::select('CALL psDivisionListByPerio(?)', [$selectedPeriode]);
    
      
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($divisions)->header('Content-Type', 'application/json; charset=utf-8');
    }
}
