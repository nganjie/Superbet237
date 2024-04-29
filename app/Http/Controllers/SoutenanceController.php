<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Organisation;
use App\Models\PeriodeAca;
use App\Models\Promotions;
use App\Models\Parcours;
use App\Models\Auditeur;
use App\Models\Enseignant;
use App\Models\soutenance;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use GuzzleHttp\Client;

class SoutenanceController extends Controller
{


  //récupère les période grace a l'id de lorganisation
    public function soutenance(Request $request)
    {
        $paramValue = Session::get('paramValue');

        // Faites quelque chose avec la valeur récupérée


        // Faites quelque chose avec la valeur récupérée

        $organisations = Organisation::all();
        $enseignants = Enseignant::all();

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
        return view('soutenance', ['paramValue' => $paramValue,
        'enseignants' => $enseignants, 'organisations' => $organisations, 'auditeurs' => $decryptedAuditeurs]);

    }

    public function soutenanceListAPI(Request $request)
    {
        $soutenancesList = soutenance::all();
        return response()->json(['soutenancesList' => $soutenancesList]); 
    }

/*  */


  

    //insert une nouvelle période
    public function store(Request $request)
    {
        $client = new Client();

        $idsou = intval($request->input('idsou'));
        $idaudi = intval($request->input('idaudi'));
        $idreg = intval($request->input('idreg'));
        $sujet = $request->input('sujet');
        $date = $request->input('date');
        $pr = $request->input('pr');
        $cp = $request->input('cp');
        $direct = $request->input('direct');
        $codirect = $request->input('codirect');

        $tel = intval($request->input('tel'));
        $email = $request->input('email');
        $userName = $request->input('nom');

 //dd($idsou,$idaudi,$sujet,$date,$pr,$direct,$codirect); 
     

        if($idsou==0){
        
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::insert('CALL psSoutenance_Insert(?,?, ?,?,?,?,?,?,?)', [0,$idaudi,$date,$sujet,$pr,$direct,$codirect,$cp,$idreg ]);
    // Envoyer l'e-mail avec le mot de passe généré
    $data['userName'] = $userName;
   /*  $date['sujet']=$sujet; */
    $data['email'] = $email;
    $data['title'] = "INFORMATIONS SUR LA SOUTENANCE";
    $data['body'] = "V";
    $data['link'] = "https://ismpmaster.cm/Auditeur"; // Remplacez par votre lien réel

    Mail::send('sendmailsout', ['data' => $data], function ($message) use ($data) {
        $message->to($data['email'])->subject($data['title']);
    });

   // dd(intval($tel));
   $tell = intval($tel);

   
try {
    $response = $client->post('https://app.techsoft-sms.com/api/v3/sms/send', [
        'headers' => [
            'Authorization' => 'Bearer 9|NTTkQIJROPURdSkXnEDSiviZjff8d0SQBFV3EK0w57228ea5',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'recipient' => $tel,
            'sender_id' => 'ISMP',
            'type' => 'plain',
           'message' => $userName . " Votre soutenance a été programmée pour le " . $date ."sous le thème:".$sujet. ". Pour plus d'informations, veuillez contacter l'ISMP.",        ],
    ]);

     } catch (\Exception $e) {
    // Gérez l'erreur ici
    $message = "Une erreur s'est produite lors de l'envoi du message!";
    session()->flash('message', $message);
    return redirect()->route('soutenance');
}  

    }else{
           // Appelez la procédure stockée avec les valeurs du formulaire
           DB::insert('CALL psSoutenance_Insert(?,?, ?,?,?,?,?,?,?)', [$idsou,$idaudi,$date,$sujet,$pr,$direct,$codirect,$cp,$idreg ]);
    }
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('soutenance');
    }


        //Supprimer une nouvelle période
        public function destroy(Request $request)
        {
           
            $idsou= Intval($request->input('idsou'));
        // dd($idsou);
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::delete('CALL psSoutenance_Delete(?)', [ $idsou]);
       
            // Redirigez vers une autre page ou affichez un message de confirmation
            return redirect()->route('soutenance');
        }

     public function getParamsou()
     {
         $paramValue = Session::get('paramValue');
         // Faites quelque chose avec la valeur récupérée
         $organisations = Organisation::all();
         $enseignants = Enseignant::all();
         $periodes = PeriodeAca::all();
         $parcours = Parcours::all();
         // Appeler la procédure stockée pour récupérer les soutenances
         $soutenances = DB::select('CALL psSoutenance_List');

         // Décryptez les attributs nécessaires des soutenances
         $decryptedSoutenances = collect($soutenances)->map(function ($soutenance) {
             $soutenance->nom = Crypt::decrypt($soutenance->nom);
             $soutenance->prenom = Crypt::decrypt($soutenance->prenom);
             // Répétez pour chaque attribut que vous avez chiffré
             return $soutenance;
         });

    return view('soutenance', [
        'paramValue' => $paramValue,
        'organisations' => $organisations,
        'enseignants' => $enseignants,
        'periodes' => $periodes,
        'parcours' => $parcours,
        'soutenances' => $decryptedSoutenances
    ]);
        } 


    
}
