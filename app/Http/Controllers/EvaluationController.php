<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Organisation;
use App\Models\PeriodeAca;
use App\Models\Promotions;
use App\Models\Parcours;
use App\Models\Auditeur;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Collection;

class EvaluationController extends Controller
{

    public function getevanote(Request $request)
    {
        $selecteregId = intval($request->input('evaId'));
        // Appeler la procédure stockée pour récupérer les auditeurs
        $auditeurs = DB::select('CALL psVoirNoteEva(?)', [$selecteregId]);
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
                'ideva' => $auditeur->ideva,
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
    public function storenote(Request $request)
    {
        $idev = intval($request->input('idev'));
        $idaudi = intval($request->input('idaudi'));
        $note = floatval($request->input('note'));
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::insert('CALL psEvaluation_note_Insert(?,?,?)', [$idev, $idaudi, $note]);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('evaluation');
    }

    public function storenoteAPI(Request $request)
    {
        $message = "succès.";

        $idev = intval($request->input('idev'));
        $idaudi = intval($request->input('idaudi'));
        $note = floatval($request->input('note'));
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::insert('CALL psEvaluation_note_Insert(?,?,?)', [$idev, $idaudi, $note]);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return response()->json(['success' => $message]); 
    }

     //insert une nouvelle période
    public function store(Request $request)
    {
        $org = $request->input('organisation');
        $perio = intval($request->input('perio'));
        $parc = intval($request->input('parc'));
        $re = intval($request->input('re'));
        $gue = intval($request->input('gue'));
        $ue = intval($request->input('ue'));
        $description = $request->input('description');
        $session = intval($request->input('session'));
        $date = $request->input('date');
        $heured = $request->input('heured');
        $heuref = $request->input('heuref');
        $salle = intval($request->input('salle'));
        $ideva = intval($request->input('ideva'));
        //  dd($org,$perio,$parc,$re,$gue,$ue,$description,$session,$date,$heured,$heuref,$salle);

        if ($ideva == null) {

            $ideva = intval($ideva);
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psEvaluation_Insert(?,?,?, ?,?,?,?,?,?,?,?,?,?)', [null, $org, $perio, $parc, $re, $gue, $ue, $description, $session, $date, $heured, $heuref, $salle]);
        } else {
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psEvaluation_Insert(?,?,?, ?,?,?,?,?,?,?,?,?,?)', [$ideva, $org, $perio, $parc, $re, $gue, $ue, $description, $session, $date, $heured, $heuref, $salle]);
        }
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('evaluation');
    }

    public function storeAPI(Request $request)
    {
        $message = 'Insertion réussite';

        $org = $request->input('organisation');
        $perio = intval($request->input('perio'));
        $parc = intval($request->input('parc'));
        $re = intval($request->input('re'));
        $gue = intval($request->input('gue'));
        $ue = intval($request->input('ue'));
        $description = $request->input('description');
        $session = intval($request->input('session'));
        $date = $request->input('date');
        $heured = $request->input('heured');
        $heuref = $request->input('heuref');
        $salle = intval($request->input('salle'));
        $ideva = intval($request->input('ideva'));

        if ($ideva == null) {
            $ideva = intval($ideva);
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psEvaluation_Insert(?,?,?, ?,?,?,?,?,?,?,?,?,?)', [null, $org, $perio, $parc, $re, $gue, $ue, $description, $session, $date, $heured, $heuref, $salle]);
        } else {
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psEvaluation_Insert(?,?,?, ?,?,?,?,?,?,?,?,?,?)', [$ideva, $org, $perio, $parc, $re, $gue, $ue, $description, $session, $date, $heured, $heuref, $salle]);
        }
        // Redirigez vers une autre page ou affichez un message de confirmation
        return response()->json(['success' => $message]); 
    }

    public function getParamnote()
    {
        $paramValue = Session::get('paramValue');
        $organisations = Organisation::all();
        $periodes = PeriodeAca::all();
        $parcours = Parcours::all();
        $typessessions = DB::select('CALL psTypeSession0_List()');
        $salles = DB::select('CALL psSalle_List()');
        // Appel de la procédure stockée pour récupérer les évaluations
        $evaluations = DB::select('CALL psEvaluation_List()');

        return view('evaluation', [
            'paramValue' => $paramValue,
            'organisations' => $organisations,
            'periodes' => $periodes,
            'parcours' => $parcours,
            'typessessions' => $typessessions,
            'salles' => $salles,
            'evaluations' => $evaluations,
        ]);
    }


    public function getParamnoteAPI()
    {
        $paramValue = Session::get('paramValue');
        $organisations = Organisation::all();
        $periodes = PeriodeAca::all();
        $parcours = Parcours::all();
        $typessessions = DB::select('CALL psTypeSession0_List()');
        $salles = DB::select('CALL psSalle_List()');
        // Appel de la procédure stockée pour récupérer les évaluations
        $evaluations = DB::select('CALL psEvaluation_List()');
        return response()->json([
            'paramValue' => $paramValue,
            'organisations' => $organisations,
            'periodes' => $periodes,
            'parcours' => $parcours,
            'typessessions' => $typessessions,
            'salles' => $salles,
            'evaluations' => $evaluations,
        ]); 
    }
}
