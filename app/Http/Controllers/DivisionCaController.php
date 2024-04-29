<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\sessions;
use App\Models\typesession;
use App\Models\Organisation;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class DivisionCaController extends Controller
{
       
//insert une nouvelle période
    public function store(Request $request)
    {
        $iddc = $request->input('iddc');
        $perio = $request->input('perio');
        $uniteca = $request->input('uniteca');
        $nom = $request->input('nom');
        $debut = $request->input('debut');
        $fin = $request->input('fin');
        $iddc = intval($iddc);
        //DD( $idsess);
        if ($iddc == 0) {
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psDivisionCa_Insert(?,?,?,?,?,?)', [0, $perio, $uniteca, $nom, $debut, $fin]);
        } else {
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psDivisionCa_Insert(?,?,?,?,?,?)', [$iddc, $perio, $uniteca, $nom, $debut, $fin]);
        }
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('divisionca');
    }

    public function storeAPI(Request $request)
    {
        $message = "succès.";

        $iddc = $request->input('iddc');
        $perio = $request->input('perio');
        $uniteca = $request->input('uniteca');
        $nom = $request->input('nom');
        $debut = $request->input('debut');
        $fin = $request->input('fin');
        $iddc = intval($iddc);
        //DD( $idsess);
        if ($iddc == 0) {
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psDivisionCa_Insert(?,?,?,?,?,?)', [0, $perio, $uniteca, $nom, $debut, $fin]);
        } else {
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psDivisionCa_Insert(?,?,?,?,?,?)', [$iddc, $perio, $uniteca, $nom, $debut, $fin]);
        }
        // Redirigez vers une autre page ou affichez un message de confirmation
        return response()->json(['message' => $message]); 
    }

   //Supprimer une nouvelle période
    public function destroy(Request $request)
    {
        $idddc = $request->input('idddc');
        //dd($iddpro);
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::delete('CALL psDivisionCa_Delete(?)', [$idddc]);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('divisionca');
    }

    public function destroyAPI(Request $request)
    {
        $message = "succès.";

        $idddc = $request->input('idddc'); 
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::delete('CALL psDivisionCa_Delete(?)', [$idddc]);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return response()->json(['message' => $message]); 
    }

    public function getParamdc()
    {
        $paramValue = Session::get('paramValue');
        // Faites quelque chose avec la valeur récupérée
        $divisionsca = DB::select('CALL psDivisionCa_List()');
        $organisations = Organisation::all();
        $unitesca = DB::select('CALL psUniteCa_List()');

        return view('divisionca', [
            'paramValue' => $paramValue,
            'divisionsca' => $divisionsca,
            'organisations' => $organisations,
            'unitesca' => $unitesca,

        ]);
    } 
    public function getParamdcAPI()
    {
        $paramValue = Session::get('paramValue');
        // Faites quelque chose avec la valeur récupérée
        $divisionsca = DB::select('CALL psDivisionCa_List()');
        $organisations = Organisation::all();
        $unitesca = DB::select('CALL psUniteCa_List()');

        return response()->json([
            'paramValue' => $paramValue,
            'divisionsca' => $divisionsca,
            'organisations' => $organisations,
            'unitesca' => $unitesca,

        ]); 
    } 
}
