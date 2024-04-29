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
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Hash;
use Validator;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use GuzzleHttp\Client;


class AuditeurController extends Controller
{
    
    public function getPeriodesAca(Request $request)
    {
        $selectedOrganisation = $request->input('organisation');
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
    public function auditeur(Request $request)
    {
        $paramValue = Session::get('paramValue');
    
        // Faites quelque chose avec la valeur récupérée
    
        $organisations = Organisation::all();

    
        $idre = trim(stripslashes($request->input('re')));
        $idre = str_replace('"', '', $idre);
$idre = intval($idre);
//dd($idre );
         
        // Appelez votre procédure stockée avec le paramètre $codeorg
        $auditeurs = DB::select('CALL psAuditeurByIdreg(?)', [$idre]);

        $auditeursCollection = new Collection($auditeurs);
        
        $decryptedAuditeurs = $auditeursCollection->map(function ($auditeur) {
            $auditeur->nom = Crypt::decrypt($auditeur->nom);
            $auditeur->prenom = Crypt::decrypt($auditeur->prenom);
            $auditeur->genre = Crypt::decrypt($auditeur->genre);
            $auditeur->date = Crypt::decrypt($auditeur->date);
            $auditeur->email = Crypt::decrypt($auditeur->email);
            $auditeur->tel = Crypt::decrypt($auditeur->tel);
            $auditeur->provenance;
            $auditeur->imageurl; 
            $auditeur->iduser; 
            // Répétez pour chaque attribut que vous avez chiffré
            return $auditeur;
        });
        
        // Retournez la vue avec les résultats des périodes
        return view('auditeur', ['paramValue' => $paramValue, 'organisations' => $organisations, 'auditeurslist' => $decryptedAuditeurs]);
    }


   

    
    function crypter($data) {
        /*  Définir la clé de cryptage */ $cle = 'votre_cle_secrete_et_longue';
             /* Hachage de la clé */ $cle_hachee = hash('sha256', $cle); 
              /* Génération d'un sel aléatoire */ $sel = bin2hex(random_bytes(16));
             /*  Concaténation du sel et des données */ $data_salee = $sel . $data;
              /*  Cryptage avec l'algorithme PBKDF2 */ $crypted_data = hash_pbkdf2('sha256', $data_salee, $cle_hachee, 10000, 64);
              /*   Retourner le sel et les données cryptées */ return $sel . $crypted_data; }
       
       
       
              function decrypter($data_cryptee) {
                 /* Définir la clé de cryptage */ $cle = 'votre_cle_secrete_et_longue';
                /* Hachage de la clé */ $cle_hachee = hash('sha256', $cle); // Extraction du sel $sel = substr($data_cryptee, 0, 32);
                  /* Extraction des données cryptées  */$crypted_data = substr($data_cryptee, 32);
                  /*  Décryptage avec l'algorithme PBKDF2 */ $data_dechiffree = hash_pbkdf2('sha256', $sel . $crypted_data, $cle_hachee, 10000, 64);
                /*  Retourner les données décryptées */ return $data_dechiffree; }




    //insert un nouvel auditeur
    public function store(Request $request)
    {
 
        $idaudi = intval($request->input('idau'));
        $nom = $request->input('nom');
        $nomu = $request->input('nom');
        $prenom = $request->input('prenom');
        $genre = $request->input('genre');
        $email = $request->input('email');
        $emailu = $request->input('email');
        $tel = $request->input('tel');
        $date = $request->input('date');
        $provenance = $request->input('provenance');
        $idreg = intval($request->input('re'));
        $iduser = $request->input('iduser');
        $tel = "+237".$tel;
        $image = $request->file('image');
      /*   $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $imageUrl = 'images/' . $imageName; */
       

        // Convert the input date to a Carbon instance
        $dateObj = Carbon::createFromFormat('d/m/Y', $date);
        // Extract the day, month, and year from the date
        $jour = $dateObj->format('d');
        $mois = $dateObj->format('m');
        $annee = $dateObj->format('Y');

        $premiereLettreNom = strtoupper(substr($nom, 0, 1));
        $premiereLettrePrenom = strtoupper(substr($prenom, 0, 1));
        $initiale = $premiereLettreNom . $premiereLettrePrenom;
       // dd($initiale);
        // Extraire les 2 premières lettres du nom en majuscules
        $deuxPremieresLettres = strtoupper(substr($nom, 0, 2));
        // Créer le matricule en concaténant les parties extraites
        $matricule = $jour . $deuxPremieresLettres . $mois . substr($annee, -2);
        // Afficher le matricule


        $nom = Crypt::encrypt($nom);
        $prenom = Crypt::encrypt($prenom);
        $genre = Crypt::encrypt($genre);
        $email = Crypt::encrypt($email);
        $tel = Crypt::encrypt($tel);
        $date = Crypt::encrypt($date);
        $provenance = Crypt::encrypt($provenance);
        // $password = Hash::make($nom . $email . $date);
       // dd($password =  $nomu.'123');
        //$password = $nomu.'123';
       
        $userID = 'USER' . now()->format('YmdHis') . '.' . rand(0, 999) . '.' . rand(0, 999);

       //dd($userID);
       if ($image) {
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $imageUrl = 'images/' . $imageName;

        if ($idaudi == null) {
           // dd('n1');
            $message = "Auditeur insérer avec succès.";
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psAuditeur_Insert(?,?,?,?,?,?,?,?,?,?,?,?)', [0, $matricule, $nom, $prenom, $genre, $date, $email, $tel,$provenance,$initiale,$imageUrl,$userID ]);
            //DB::insert('CALL psUserCompte_Insert(?,?,?,?,?,?,?,?,?,?,?)', [0,$nomu,$emailu,$password,1,$userID,1,0,0,0,0]);
            session()->flash('messagesuc', $message);
        } else {
         //   dd('n2');
            dd($emailu);
            $message = "Auditeur modifié avec succès.";
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psAuditeur_Insert(?,?,?,?,?,?,?,?,?,?,?,?)', [$idaudi, $matricule, $nom, $prenom, $genre, $date, $email, $tel,$provenance,$initiale,$imageUrl,$userID ]);
           // DB::insert('CALL psUserCompte_Insert(?,?,?,?,?,?,?,?,?,?,?)', [$idaudi,$nomu,$emailu,$password,1,$iduser,1,0,0,0,0]);
            session()->flash('messagesuc', $message);
        }
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('auditeur');
    } else {
        // Utiliser une image par défaut ou attribuer null
       // $imageUrl = 'chemin/vers/image-par-defaut.jpg'; // Remplacez par le chemin de votre image par défaut
        // Ou
        
        $imageUrl = null;
       if ($idaudi == null) {
           // dd('n11');
            $message = "Auditeur insérer avec succès.";
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psAuditeur_Insert(?,?,?,?,?,?,?,?,?,?,?,?)', [0, $matricule, $nom, $prenom, $genre, $date, $email, $tel,$provenance,$initiale,$imageUrl,$userID ]);
           // DB::insert('CALL psUserCompte_Insert(?,?,?,?,?,?,?,?,?,?,?)', [0,$nomu,$emailu,$password,1,$userID,1,0,0,0,0]);
            session()->flash('messagesuc', $message);
        } else {
            // dd($iduser);
           // dd($idaudi);
           // dd($emailu);
            $message = "Auditeur modifié avec succès.";
            // Appelez la procédure stockée avec les valeurs du formulaire
            DB::insert('CALL psAuditeur_Insert(?,?,?,?,?,?,?,?,?,?,?,?)', [$idaudi, $matricule, $nom, $prenom, $genre, $date, $email, $tel,$provenance,$initiale,$imageUrl,$userID ]);
           // DB::insert('CALL psUserCompte_Insert(?,?,?,?,?,?,?,?,?,?,?)', [$idaudi,$nomu,$emailu,$password,1,$iduser,1,0,0,0,0]);
            session()->flash('messagesuc', $message);
        }
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('auditeur');
    }

       
    }

   

    //insert une nouvelle période
    public function storeag(Request $request)
    {
        $message = " succès.";
        $idaudia = intval($request->input('idaudia'));
        $idreg = intval($request->input('re'));
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::insert('CALL psAuditeurRegrou_Insert(?,?)', [$idaudia, $idreg]);
        session()->flash('messagesuc', $message);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('auditeur');
    }


    public function storeagp(Request $request)
    {
       /*  $message = " succès.";
        $idaudia = intval($request->input('idaudia'));
        $idreg = intval($request->input('re'));
        // Appelez la procédure stockée avec les valeurs du formulaire
        DB::insert('CALL psAuditeurRegrou_Insert(?,?)', [$idaudia, $idreg]);
        session()->flash('messagesuc', $message);
        // Redirigez vers une autre page ou affichez un message de confirmation
        return redirect()->route('auditeur');


 */

        $message="Auditeurs ajoutés avec succès.";
        $idreg = intval($request->input('re'));
        $tableau = $request->input('selectedElementsaudi');
        $elements = explode(',', $tableau); // Divise la chaîne en un tableau en utilisant la virgule comme séparateur
     //   dd($idreg );
        foreach ($elements as $element) {
            $idaudi = intval($element);
           // dd($idaudi );
            DB::insert('CALL psAuditeurRegrou_Insert(?, ?)', [$idaudi, $idreg]);
            session()->flash('messagesuc', $message);
        }
        
        return redirect()->route('auditeur');
    }



     public function destroy(Request $request)
     {
         $message = "Auditeur supprimé avec succès.";
         $iddaudi = intval($request->input('iddaudi'));
      
         DB::delete('CALL psAuditeur_Delete(?)', [$iddaudi]);
     
         session()->flash('message', $message);
     
         return redirect()->route('auditeur');
     }

 



     public function getParamraudi()
     {
         $paramValue = Session::get('paramValue');
         // Faites quelque chose avec la valeur récupérée
         $organisations = Organisation::all();
         $periodes = PeriodeAca::all();
         $parcours = Parcours::all();
        // $auditeurs = Auditeur::all();

        $auditeurs = DB::select('CALL psAuditeur_List()');

        $decryptedAuditeurs = collect($auditeurs)->map(function ($auditeur) {
            $auditeur->nom = Crypt::decrypt($auditeur->nom);
            $auditeur->prenom = Crypt::decrypt($auditeur->prenom);
            $auditeur->genre = Crypt::decrypt($auditeur->genre);
            $auditeur->date = Crypt::decrypt($auditeur->date);
            $auditeur->email = Crypt::decrypt($auditeur->email);
            $auditeur->tel = Crypt::decrypt($auditeur->tel);
            // Répétez pour chaque attribut que vous avez chiffré
            return $auditeur;
        });
    
        return view('auditeur', [
            'paramValue' => $paramValue,
            'organisations' => $organisations,
            'periodes' => $periodes,
            'parcours' => $parcours,
            'auditeurs' => $decryptedAuditeurs,
        ]);
    }


    public function sendMail(Request $request)
    {
        $client = new Client();
        $name = $request->input('nom');
        $email = $request->input('email');
        $iduser = $request->input('iduser');
        $tel = $request->input('tel');
   // $tel = "+237".$tel;
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
            session()->flash('messagessuc', $message);
            return redirect()->route('auditeur');
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
             $newUser->profilauditeur = 1;
            $newUser->save();
            $userName=$name;
            // Envoyer l'e-mail avec le mot de passe généré
            $data['userName'] = $userName;
            $data['email'] = $email;
            $data['password'] = $password;
            $data['title'] = "INFORMATIONS DE CONNEXION À L'ESPACE AUDITEUR DE L'ISMP";
            $data['body'] = "No Reply.Ceci est un mail de notification, ne pas répondre.";
            $data['link'] = "https://ismpmaster.cm/Auditeur"; // Remplacez par votre lien réel
    
            Mail::send('sendmailaudi', ['data' => $data], function ($message) use ($data) {
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
                    'recipient' => $tell,
                    'sender_id' => 'ISMP',
                    'type' => 'plain',
                  'message' => "Vos identifiants de connexion à l'espace auditeur de l'ismp vous ont été envoyés dans votre boite mail.Consultez votre messagerie",
                ],
            ]);

             } catch (\Exception $e) {
            // Gérez l'erreur ici
            $message = "Une erreur s'est produite lors de l'envoi du message!";
            session()->flash('message', $message);
            return redirect()->route('auditeur');
        }  
        
         
         

            $message="Compte créé et Mail envoyé a cet auditeur avec succès.";
            session()->flash('messagesuc', $message);
           
            return redirect()->route('auditeur');
        }
    }
}
