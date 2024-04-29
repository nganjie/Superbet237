<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Organisation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class ResultatController extends Controller
{
    
    public function getresultat(Request $request){
        $paramValue = Session::get('paramValue');
         // Faites quelque chose avec la valeur récupérée
         $organisation = $request->input('organisation');
         $perio = $request->input('perio');
         $parc = $request->input('parc');
         $re = $request->input('re');
         $gue = $request->input('gue');
         $ue = $request->input('ue');

         $organisations = Organisation::all();
         $results = DB::select('CALL psResultatFinal(?,?,?,?,?,?)',[$organisation,$perio,$parc,$re,$gue,$ue]);
        
       
        // Tableau pour stocker les résultats par auditeur
     $groupedAuditeurs = [];
 
     foreach ($results as $row) {
         $auditeurId = $row->id_auditeur;
 
         if (!isset($groupedAuditeurs[$auditeurId])) {
             $groupedAuditeurs[$auditeurId] = [
                 'matricule' => $row->matricule_auditeur,
                 'nom' => Crypt::decrypt($row->nom_auditeur),
                 'prenom' => Crypt::decrypt($row->prenom_auditeur),
                 'noteIndividuel' => 0,
                 'noteGroupe' => 0,
                 'noteExam' => 0,
             ];
         }
 
         if ($row->anonymat == 0) {
             $groupedAuditeurs[$auditeurId]['noteGroupe'] = intval($row->note_auditeur);
         } elseif ($row->anonymat == 1) {
             $groupedAuditeurs[$auditeurId]['noteExam'] = intval($row->note_auditeur);
         } elseif ($row->anonymat == 2) {
             $groupedAuditeurs[$auditeurId]['noteIndividuel'] = intval($row->note_auditeur);
         }
     }
    //dd( $groupedAuditeurs[$auditeurId]['noteGroupe'],$groupedAuditeurs[$auditeurId]['noteExam'], $groupedAuditeurs[$auditeurId]['noteIndividuel']);
 //dd($groupedAuditeurs);
     // Retournez la vue avec les résultats groupés par auditeur
     return view('resultat', ['paramValue' => $paramValue, 'organisations' => $organisations,'results' => $results, 'groupedAuditeurs' => $groupedAuditeurs]);

    }

    public function getParamre(Request $request)
    {
        $paramValue = Session::get('paramValue');
    
        // Faites quelque chose avec la valeur récupérée
    
        $organisations = Organisation::all();
     
    return view('resultat', ['paramValue' => $paramValue, 'organisations' => $organisations]);
    }
}
