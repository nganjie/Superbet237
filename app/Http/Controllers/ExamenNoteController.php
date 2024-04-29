<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Collection;

class ExamenNoteController extends Controller
{


    public function getevanoteexaa(Request $request)
    {
        $selecteregId = intval($request->input('evaId'));

        // Appeler la procédure stockée pour récupérer les auditeurs
        $auditeurs = DB::select('CALL psVoirNoteEvaExaa(?)', [$selecteregId]);

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
                'idexaa' => $auditeur->idexaa,
                'note' => $auditeur->note,
                'nom' => $auditeur->nom,
                'prenom' => $auditeur->prenom,

            ];

            $options[] = $option;
        }

        // Renvoyer les options des auditeurs en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
    }

     //insert une nouvelle période
     public function storenoter(Request $request)
     {
       $idev = intval($request->input('idev'));
       $idaudi = intval($request->input('idaudi'));
       $note = floatval($request->input('note'));

         //dd($idev,$idaudi,$note);

          // Appelez la procédure stockée avec les valeurs du formulaire
          DB::insert('CALL psNoteAnonyme_Insert(?,?,?)', [$idev,$idaudi,$note]);
 
       // Redirigez vers une autre page ou affichez un message de confirmation
       return redirect()->route('examennote');
     }

    public function storenoterAPI(Request $request)
    {
        $message = 'Insertion de la Note réussie';

        $idev = intval($request->input('idev'));
        $idaudi = intval($request->input('idaudi'));
        $note = floatval($request->input('note'));
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::insert('CALL psNoteAnonyme_Insert(?,?,?)', [$idev, $idaudi, $note]);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return response()->json(['success' => $message]);
    }

    public function storenote(Request $request)
    {
        $anonymat = $request->input('anonymat');
        $idev = intval($request->input('idev'));
        $idaudi = intval($request->input('idaudi'));

        $paramValue = Session::get('paramValue');
        $organisations = Organisation::all();
        $evaluations = DB::select('CALL psEvaluation_List()');
        try {
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psEvaluation_Anonymat_Insert(?,?,?)', [$idev, $idaudi, $anonymat]);

            $succesMessage = "AUDITEUR ANONYME AVEC SUCCES";
            // Redirigez vers une autre page ou affichez un message de confirmation
            return redirect()->route('examennote')->with(['paramValue', $paramValue, 'succesMessage' => $succesMessage]);

        } catch (\PDOException $e) {
            // Récupérez le message d'erreur de l'exception
            $errorMessage = "CET AUDITEUR A DEJA ETE ANONYME POUR CET EXAMEN";

            // Retournez la vue avec le message d'erreur et le paramètre
            return view('examennote')->with(['errorMessage' => $errorMessage, 'paramValue' => $paramValue, 'organisations' => $organisations, 'evaluations' => $evaluations]);
        }
    }

    public function storenoteAPI(Request $request)
    {
        $anonymat = $request->input('anonymat');
        $idev = intval($request->input('idev'));
        $idaudi = intval($request->input('idaudi'));

        $paramValue = Session::get('paramValue');
        $organisations = Organisation::all();
        $evaluations = DB::select('CALL psEvaluation_List()');
        try {
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psEvaluation_Anonymat_Insert(?,?,?)', [$idev, $idaudi, $anonymat]);

            $succesMessage = "AUDITEUR ANONYME AVEC SUCCES";
            // Redirigez vers une autre page ou affichez un message de confirmation
            return redirect()->route('examennote')->with(['paramValue', $paramValue, 'succesMessage' => $succesMessage]);

        } catch (\PDOException $e) {
            // Récupérez le message d'erreur de l'exception
            $errorMessage = "CET AUDITEUR A DEJA ETE ANONYME POUR CET EXAMEN";
            // Retournez la vue avec le message d'erreur et le paramètre
            return response()->json(['errorMessage' => $errorMessage, 'paramValue' => $paramValue, 'organisations' => $organisations, 'evaluations' => $evaluations]); 
        }
    }

    public function getParamexanote()
     {
         $paramValue = Session::get('paramValue');
         $organisations = Organisation::all();
         $evaluations = DB::select('CALL psEvaluationAnonyme_List()');
         $typessessions = DB::select('CALL psTypeSession1_List()');
         $salles= DB::select('CALL psSalle_List()');

         return view('examennote',['paramValue' => $paramValue,'organisations' => $organisations, 'evaluations' => $evaluations, 'typessessions' => $typessessions, 'salles' => $salles]);
     }

    public function getParamexanoteAPI()
     {
         $paramValue = Session::get('paramValue');
         $organisations = Organisation::all();
         $evaluations = DB::select('CALL psEvaluationAnonyme_List()');
         $typessessions = DB::select('CALL psTypeSession1_List()');
         $salles= DB::select('CALL psSalle_List()');

         return response()->json(['paramValue' => $paramValue,'organisations' => $organisations, 'evaluations' => $evaluations, 'typessessions' => $typessessions, 'salles' => $salles]); 
    }
}
