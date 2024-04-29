<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;   
use App\Models\Organisation;
use App\Models\divisionca; 
use App\Models\Enseignant;
use App\Models\salle;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProgrammationController extends Controller
{
    //

    public function store(Request $request)
    {
      $idpro = $request->input('idpro');
        $organisation = $request->input('organisation');
        $perio = $request->input('perio');
        $parc = $request->input('parc');
        $re = $request->input('re');
        $div = $request->input('div');
        $ens = $request->input('ens');
        $ue = $request->input('ue');
        $salle = $request->input('salle');
        $datedebut = $request->input('datedebut');
        $datefin = $request->input('datefin');
        $heuredebut = $request->input('heuredebut');
        $heurefin = $request->input('heurefin');

        if($idpro ==null){

        
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::insert('CALL psCours_Insert(?,?, ?, ?, ?,?,?,?,?,?,?,?,?)', [0,
        $ue,
        $ens,
        $div,
        $perio,
        $parc,
        $re,
        $datedebut,
        $datefin,
        $heuredebut,
        $heurefin,
        $salle,
        $organisation]);
    }else{
           // Appelez la procédure stockée avec les valeurs du formulaire
           DB::insert('CALL psCours_Insert(?,?, ?, ?, ?,?,?,?,?,?,?,?,?)', [$idpro,
           $ue,
           $ens,
           $div,
           $perio,
           $parc,
           $re,
           $datedebut,
           $datefin,
           $heuredebut,
           $heurefin,
           $salle,
           $organisation]);
    }
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('programmation');
    }
    
    public function getParamPro()
    {
        $paramValue = Session::get('paramValue');
        // Faites quelque chose avec la valeur récupérée
        $cours = DB::select('CALL psCours_List()');
        $organisations = Organisation::all();
        $divisioncas = divisionca::all();
        $enseignants = Enseignant::all();
        $salles = salle::all();
    return view('programmation',['paramValue' => $paramValue, 'organisations' => $organisations, 'cours' => $cours, 'divisioncas' => $divisioncas, 'enseignants' => $enseignants, 'salles' => $salles]);
}
}