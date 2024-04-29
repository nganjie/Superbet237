<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Organisation;
use App\Models\PeriodeAca;
use App\Models\Promotions;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class PromotionAcaController extends Controller
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
        $selectedPeriode = $request->input('periode');

    dd($selectedPeriode);
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $parcoursAca = DB::select('CALL psParcoursListByPerio(?)', [$selectedPeriode]);
    
        // Construire les options HTML des périodes académiques
        $options = '<option disabled selected value="">choisir un parcours';
    
        foreach ($periodesAca as $periode) {
            $options .= '<option name="parc" value="' . $parcoursAca->id . '">' . $parcoursAca->nomparc . '';
        }
   
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
    }

    //récupère les période grace a l'id de lorganisation
    public function promotions(Request $request)
    {
        $paramValue = Session::get('paramValue');
    
        // Faites quelque chose avec la valeur récupérée
    
        $organisations = Organisation::all();

    
        $idparc= trim(stripslashes($request->input('parc')));
        $idparc = str_replace('"', '', $idparc);
$idparc = intval($idparc);
          // Affiche le code de l'organisation dans la console

   

        // Appelez votre procédure stockée avec le paramètre $codeorg
        $promos = DB::select('CALL psPromotionByParc(?)', [$idparc]);
    
        // Retournez la vue avec les résultats des périodes
        return view('promotionAca', ['paramValue' => $paramValue, 'organisations' => $organisations,'promos' => $promos]);

    }

    //insert une nouvelle période
    public function store(Request $request)
    {
        $idpro = $request->input('idpro');
        $nompromo = $request->input('nompromo');
        $nombapt = $request->input('nombapt');
        $ro = $request->input('ro');
        $so = $request->input('so');
     

        if($idpro ==null){
            $message="Promotion ajoutée avec succès.";
        
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::insert('CALL psPromotion_Insert(?,?, ?,?,?)', [null,$nompromo,$nombapt,$ro,$so]);
        session()->flash('messagesuc', $message);
    }else{
        $message="Promotion modifiée avec succès.";
           // Appelez la procédure stockée avec les valeurs du formulaire
           DB::insert('CALL psPromotion_Insert(?,?, ?,?,?)', [$idpro,$nompromo,$nombapt,$ro,$so]);
           session()->flash('messagesuc', $message);
        }
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('promotionAca');
    }



    //insert une nouvelle période
    public function storepp(Request $request)
    {
        $message="Promotion affectés au parcour succès.";
        $idpro = $request->input('idafpro');
        $idparc = $request->input('parc');

        $idparc = trim(stripslashes($request->input('parc')));
        $idparc = str_replace('"', '', $idparc);
$idparc = intval($idparc);
$idpro  = intval($idpro);
      
     //dd($idpro,$idparc);
           // Appelez la procédure stockée avec les valeurs du formulaire
           DB::insert('CALL psPromotionParcours_Insert(?,?)', [$idpro,$idparc]);
           session()->flash('messagesuc', $message);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('promotionAca');
    }
    

    public function storeppm(Request $request)
{
    $message="Promotions affectées avec succès.";
    $idparc = $request->input('parc');
    $tableau = $request->input('selectedElements');
    $elements = explode(',', $tableau); // Divise la chaîne en un tableau en utilisant la virgule comme séparateur
    
    foreach ($elements as $element) {
        $idpro = intval($element);
      //  dd($idpro);
        DB::insert('CALL psPromotionParcours_Insert(?, ?)', [$idpro, $idparc]);
        session()->flash('messagesuc', $message);
    }
    
    return redirect()->route('promotionAca');
}
    

     //Supprimer une nouvelle période
     public function destroypromo(Request $request)
     {
        $message = "Promotion supprimé avec succès.";
         $iddpro= $request->input('iddpro');
      //dd($iddpro);
         // Appelez la procédure stockée avec les valeurs du formulaire
         DB::delete('CALL psPromotion_Delete(?)', [ $iddpro]);
         session()->flash('message', $message);
         // Redirigez vers une autre page ou affichez un message de confirmation
         return redirect()->route('promotionAca');
     }

      //Supprimer plusieurs période
      public function destroyp(Request $request)
      {
        $message = "Promotions supprimées avec succès.";
        $tableau = $request->input('tableau');
        $tableau = json_decode($tableau, true);
    
        // Utilisez le tableau comme vous le souhaitez
      //  dd(intval($tableau[0]));

        foreach ($tableau as $element) {
            $elementId = intval($element);
    //dd($elementId);
            // Appeler la procédure stockée pour supprimer l'élément
            DB::statement('CALL psPromotion_Delete(?)', [$elementId]);
            session()->flash('message', $message);
        }
          return redirect()->route('promotionAca');
      }


     public function getParampromo(Request $request)
     {
         $paramValue = Session::get('paramValue');
         // Faites quelque chose avec la valeur récupérée
         $organisations = Organisation::all();
         $periodes = PeriodeAca::all();
       
         // Appelez votre procédure stockée avec le paramètre $codeorg
         $promos = DB::select('CALL psPromotions_List()');
       //  dd($promos);
         return view('promotionAca', ['paramValue' => $paramValue, 'organisations' => $organisations, 'periodes' => $periodes,'promos' => $promos]);
     }
}
