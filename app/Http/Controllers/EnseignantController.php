<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Organisation;
use App\Models\PeriodeAca;
use App\Models\Promotions;
use App\Models\Parcours;
use App\Models\Enseignant;
use App\Models\Ue;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use GuzzleHttp\Client;

class EnseignantController extends Controller
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

    public function getParcoursAca(Request $request){
        dd("ok");
    }

      //récupère les période grace a l'id de lorganisation
    public function enseignant(Request $request)
    {
        $paramValue = Session::get('paramValue');

        // Faites quelque chose avec la valeur récupérée

        $ues = Ue::all();

        $idue = $request->input('idue');
        $idue = intval($idue);
        // Affiche le code de l'organisation dans la console



        // Appelez votre procédure stockée avec le paramètre $codeorg
        $enseignants = DB::select('CALL psEnseignantByIdUe(?)', [$idue]);

        // Retournez la vue avec les résultats des périodes
        return view('enseignant', ['paramValue' => $paramValue, 'enseignants' => $enseignants, 'ues' => $ues]);

    }

    public function enseignantAPI(Request $request)
    {
        $paramValue = Session::get('paramValue');
        // Faites quelque chose avec la valeur récupérée
        $ues = Ue::all();

        $idue = $request->input('idue');
        $idue = intval($idue);
        // Appelez votre procédure stockée avec le paramètre $codeorg
        $enseignants = DB::select('CALL psEnseignantByIdUe(?)', [$idue]);
        // Retournez les résultats des périodes
        return response()->json(['paramValue' => $paramValue, 'enseignants' => $enseignants, 'ues' => $ues]); 
    }

    public function getuebyens(Request $request)
    {
        $selectedens = Intval($request->input('ensId'));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $ues = DB::select('CALL psUeByIdEns(?)', [$selectedens]);
        // Construire les options HTML des ues
        $options = array();
        foreach ($ues as $ue) {
            $option = array(
                'id' => $ue->id,
                'nomue' => $ue->nomue,
                'coefficient' => $ue->coefficient,
            );
            $options[] = $option;
        }
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
    }

    public function getuebyensAPI(Request $request)
    {
        $selectedens = Intval($request->input('ensId'));
        // Appeler la procédure stockée pour récupérer les périodes académiques
        $ues = DB::select('CALL psUeByIdEns(?)', [$selectedens]);
        // Construire les options HTML des ues
        $options = array();
        foreach ($ues as $ue) {
            $option = array(
                'id' => $ue->id,
                'nomue' => $ue->nomue,
                'coefficient' => $ue->coefficient,
            );
            $options[] = $option;
        }
        // Renvoyer les options des périodes académiques en tant que réponse JSON avec l'encodage UTF-8
        return response()->json($options)->header('Content-Type', 'application/json; charset=utf-8');
    }

   //insert une nouvelle période
    public function store(Request $request)
    {
        $idens = $request->input('idens');
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $grade = $request->input('grade');
        $email = $request->input('email');
        $tel = $request->input('tel');
        $numero = $request->input('numero');
        $iduser = $request->input('iduser');
        $tel ="+237".$tel;
       /*  $password = Hash::make($nom . $email . $tel); */
      // $password = $nom .'123';
        $userID = 'USER' . now()->format('YmdHis') . '.' . rand(0, 999) . '.' . rand(0, 999);
        //  dd($idens,$numero ,$nom,$prenom ,$grade,$email,$tel);
if ($idens == null) {
  //  $emailExists = DB::table('users')->where('email', $email)->exists();

  
       // dd('niveau2');
        $message = "Enseignant modifié avec succès.";
        $idens = intval($idens);
        
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::insert('CALL psEnseignant_Insert(?,?,?,?,?,?,?,?)', [null, $numero, $nom, $grade, $prenom, $email, $tel, $userID]);
       // DB::insert('CALL psUserCompte_Insert(?,?,?,?,?,?,?,?,?,?,?)', [0, $nom, $email, $password, 2, $userID, 0, 1, 0, 0, 0]);
        session()->flash('messagesuc', $message);

} else {

    $message = "Enseignant modifié avec succès.";
    // Appelez la procédure stockée avec les valeurs du formulaire
    DB::insert('CALL psEnseignant_Insert(?, ?, ?, ?, ?, ?, ?, ?)', [$idens, $numero, $nom, $grade, $prenom, $email, $tel, $iduser]);
   // DB::insert('CALL psUserCompte_Insert(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [0, $nom, $email, $password, 2, $iduser, 0, 1, 0, 0, 0]);
    session()->flash('messagesuc', $message);


}
// Redirigez vers une autre page ou affichez un message de confirmation
return redirect()->route('enseignant');

    }

    public function storeAPI(Request $request)
    {
        $idens = $request->input('idens');
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $grade = $request->input('grade');
        $email = $request->input('email');
        $tel = $request->input('tel');
        $numero = $request->input('numero');
 
        if ($idens == null) {
            $message = "Enseignant insérer avec succès.";
            $idens = intval($idens);
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psEnseignant_Insert(?,?, ?,?,?,?,?)', [null, $numero, $nom, $grade, $prenom, $email, $tel]);
            session()->flash('messagesuc', $message);
        } else {
            $message = "Enseignant modifié avec succès.";
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psEnseignant_Insert(?,?, ?,?,?,?,?)', [$idens, $numero, $nom, $grade, $prenom, $email, $tel]);
            session()->flash('messagesuc', $message);
        }
        // Redirigez vers une autre page ou affichez un message de confirmation
        return response()->json(['success' => $message]); 

    }

        //insert une nouvelle période
    public function storeensue(Request $request)
    {
        $message = "Enseignant affecté avec succès.";
        $idens = intval($request->input('idens'));
        $idue = intval($request->input('idue'));
        //dd($idens,$idue);
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::insert('CALL psEnseignantUe_Insert(?,?)', [$idens, $idue]);
        session()->flash('messagesuc', $message);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('enseignant');
    }

    public function storeensueAPI(Request $request)
    {
        $message = "Enseignant affecté avec succès.";
        $idens = intval($request->input('idens'));
        $idue = intval($request->input('idue'));
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::insert('CALL psEnseignantUe_Insert(?,?)', [$idens, $idue]);
        session()->flash('messagesuc', $message);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return response()->json(['success' => $message]); 
    }

    //Supprimer une nouvelle période
    public function destroy(Request $request)
    {
        $message = "Enseignant supprimer avec succès.";
        $iddens = $request->input('iddens');
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::delete('CALL psEnseignant_Delete(?)', [$iddens]);

        session()->flash('message', $message);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('enseignant');
    }

    public function destroyAPI(Request $request)
    {
        $message = "Enseignant supprimer avec succès.";
        $iddens = $request->input('iddens');
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::delete('CALL psEnseignant_Delete(?)', [$iddens]);

        session()->flash('message', $message);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return response()->json(['success' => $message]); 
    }

//Supprimer une nouvelle période
    public function destroyue(Request $request)
    {
        $message = "Unité d'enseignement supprimer avec succès.";
        $iddegue = intval($request->input('iddegue'));
        $idue = intval($request->input('idue'));
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::delete('CALL psUeEns_Delete(?,?)', [$iddegue, $idue]);
        session()->flash('message', $message);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('enseignant');
    }

    public function destroyueAPI(Request $request)
    {
        $message = "Unité d'enseignement supprimer avec succès.";
        $iddegue = intval($request->input('iddegue'));
        $idue = intval($request->input('idue'));
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::delete('CALL psUeEns_Delete(?,?)', [$iddegue, $idue]);
        session()->flash('message', $message);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return response()->json(['success' => $message]);
    }

    public function getParamens()
    {
        $paramValue = Session::get('paramValue');
        // Faites quelque chose avec la valeur récupérée
        $organisations = Organisation::all();
        $periodes = PeriodeAca::all();
        $parcours = Parcours::all();
        $enseignants = Enseignant::all();
        $ues = Ue::all();
        return view('enseignant', ['paramValue' => $paramValue, 'organisations' => $organisations, 'periodes' => $periodes, 'parcours' => $parcours, 'enseignants' => $enseignants, 'ues' => $ues]);
    }

    public function getParamensAPI()
    {
        $paramValue = Session::get('paramValue');
        // Faites quelque chose avec la valeur récupérée
        $organisations = Organisation::all();
        $periodes = PeriodeAca::all();
        $parcours = Parcours::all();
        $enseignants = Enseignant::all();
        $ues = Ue::all();
        return response()->json(['paramValue' => $paramValue, 'organisations' => $organisations, 'periodes' => $periodes, 'parcours' => $parcours, 'enseignants' => $enseignants, 'ues' => $ues]); 
    }

   public function sendMail(Request $request){
         $client = new Client();
         $name = $request->input('nomens');
        $email = $request->input('email');
        $iduser = $request->input('iduser');
        $tel = $request->input('telens');
       //  dd($name ,$email, $tel,$iduser );

          // Valider la requête
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 400);
        }
    
        // Vérifier si l'utilisateur existe avec l'adresse e-mail donnée
        $user = User::where('email', $email)->first();
    
        if ($user) {
            // L'utilisateur existe déjà, rien n'est fait
            $message="Un utilisateur existe deja avec ce email!.";
            session()->flash('message', $message);
            return redirect()->route('enseignant');
        } else {
            // Générer un mot de passe de 8 caractères pour le nouvel utilisateur
            $password = Str::random(8);
    
            // Insérer le nouvel utilisateur dans la table "users"
            $newUser = new User();
            $newUser->name = $name;
            $newUser->email = $email;
            $newUser->password = md5($password.$email); // Assurez-vous d'utiliser une fonction de hachage sécurisée pour le mot de passe
            $newUser->telephone = $tel;
            $newUser->iduser = $iduser;
             $newUser->profilenseignant = 1;
            $newUser->save();
    
            $userName = $name;
            // Envoyer l'e-mail avec le mot de passe généré
            $data['userName'] = $userName;
            $data['email'] = $email;
            $data['password'] = $password;
            $data['title'] = "INFORMATIONS DE CONNEXION À L'ESPACE ENSEIGNANT DE L'ISMP";
            $data['body'] = "No Reply.Ceci est un mail de vérification, ne pas répondre.";
            $data['link'] = "https://ismpmaster.cm/Enseignant"; // Remplacez par votre lien réel
    
            Mail::send('sendmailaudi', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });

           // dd(intval($tel));
           $tellens = intval($tel);
          // dd($tellens);
       try {
            $response = $client->post('https://app.techsoft-sms.com/api/v3/sms/send', [
                'headers' => [
                    'Authorization' => 'Bearer 9|NTTkQIJROPURdSkXnEDSiviZjff8d0SQBFV3EK0w57228ea5',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'recipient' => $tellens,
                    'sender_id' => 'ISMP',
                    'type' => 'plain',
                  'message' => "Vos identifiants de connexion à l'espace enseignant de l'ismp vous ont été envoyés dans votre boite mail.Consultez votre messagerie",
                ],
            ]);

             } catch (\Exception $e) {
            // Gérez l'erreur ici
            $message = "Une erreur s'est produite lors de l'envoi du message!";
            session()->flash('message', $message);
            return redirect()->route('enseignant');
        }  
        
         
         

            $message="Compte créé et Mail envoyé a cet enseignant avec succès.";
            session()->flash('messagesuc', $message);
           
            return redirect()->route('enseignant');
        }

   }

   


}
