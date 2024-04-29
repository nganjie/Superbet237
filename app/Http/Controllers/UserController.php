<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\groupe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Validator;
use Mail;
use GuzzleHttp\Client;


class UserController extends Controller
{

public function login(Request $request)
{
    $profil = "admin";
    $email = $request->input('email');
    $password = $request->input('password');

    $password = md5($password . $email);
    $result = DB::select('CALL user_login(?, ?,?)', [$email, $password,$profil]);

    if (!empty($result)) {
        $user = $result[0]; // Supposons que la procédure stockée retourne un enregistrement utilisateur

        Auth::loginUsingId($user->id);
$ad = $user->profiladmin;
        if ($ad == 0) {
            return redirect()->route('login');
        } else {
                 // Appeler la procédure stockée pour récupérer les rôles de l'utilisateur
        $roles = DB::select('CALL psUserRoles_List(?)', [$user->id]);
        //dd($roles);
            // Enregistrer les rôles dans la session de l'utilisateur
            $request->session()->put('user_roles', $roles);
            return redirect()->route('home');
        }
    } else {
        $message = "Vos identifiants de connexion sont invalides!";
        session()->flash('message', $message);
        return redirect()->route('login')->with('message', 'Identifiants invalides');
    }
}

/* public function login(Request $request)
{
    $email = $request->input('email');
    $password = $request->input('password');

    $user = DB::table('users')->where('email', $email)->first();

    if ($user) {
        $hashedPassword = $user->password;

        if (Hash::check($password, $hashedPassword)) {
            dd('ok');
            // Le mot de passe est correct, procéder à l'authentification de l'utilisateur
            Auth::loginUsingId($user->id);

            if ($user->profiladmin == 1) {
                return redirect()->route('home');
            } elseif ($user->profilregister == 1) {
                return redirect()->route('home');
            } else {
                // Redirection par défaut si les conditions précédentes ne sont pas remplies
                return redirect()->route('default');
            }
        } else {
            return redirect()->route('login')->with('message', 'Identifiants invalides');
        }
    } else {
        return redirect()->route('login')->with('message', 'Identifiants invalides');
    }
} */

    public function users(Request $request)
    {
        $paramValue = Session::get('paramValue');

        $groupes = groupe::all();
        
        $idgroupe= $request->input('idgroupe');
$idgroupe = intval($idgroupe);
          // Affiche le code de l'organisation dans la console

   

        // Appelez votre procédure stockée avec le paramètre $codeorg
        $users = DB::select('CALL psUsersBygroupe(?)', [$idgroupe]);
    
        // Retournez la vue avec les résultats des périodes
        return view('user', ['paramValue' => $paramValue,'users' => $users,'groupes' => $groupes]);

    }

   //insert une nouvelle période
   public function storeug(Request $request)
   {
       $iduser = intval($request->input('iduser'));
       $idgroupe = intval($request->input('idgroupe'));
 
//dd($idgroupe);
// Appelez la procédure stockée avec les valeurs du formulaire
DB::insert('CALL psUserGroupe_Insert(?,?)', [$idgroupe,$iduser]);
     // Redirigez vers une autre page ou affichez un message de confirmation
       return redirect()->route('user');
   }

      //insert une nouvelle période
      public function storeup(Request $request)
      {
          $iduser = intval($request->input('iduser'));
          $profile = $request->input('profile');
    
       //  dd($profile);
   // Appelez la procédure stockée avec les valeurs du formulaire
   DB::insert('CALL psUserProfile_Update(?,?)', [$iduser,$profile]);
        // Redirigez vers une autre page ou affichez un message de confirmation
          return redirect()->route('user');
      }

public function store(Request $request)
{
    $client = new Client();
    $name = $request->input('name');
    $email = $request->input('email');
    $password = $request->input('password');
    $passmailsms = $password;
    $profile = $request->input('profile');
    $tel = $request->input('telephone');
    $tel="+237".$tel;
     
    
    //dd($tel);
      $existingUser = DB::select('SELECT * FROM users WHERE email = ?', [$email]);
    if (!empty($existingUser)) {
         $message = " Un utilisateur existe deja avec cette adresse mail.";
 session()->flash('message', $message);
        // L'e-mail existe déjà, vous pouvez choisir de gérer cette situation (par exemple, afficher un message d'erreur)
        return redirect()->back()->with('error', 'Cet e-mail existe déjà.');
    }
 $tell = intval($tel);
     //   $password = crypter($password);
    // $password =bcrypt($password);
    // dd(md5($password));
    $password=md5($password.$email);
        //$users = DB::select('CALL psUser_Insert(?,?,?,?,?)', [$name, $email, $password, $profile,$tel]);

if ($profile == "ADMINISTRATEUR") {
   
    // Envoyer l'e-mail avec le mot de passe généré
    $users = DB::select('CALL psUser_Insert(?,?,?,?,?)', [$name, $email, $password, $profile,$tel]);
            $userName = $name;
            $data['userName'] = $userName;
            $data['email'] = $email;
            $data['password'] = $passmailsms;
            $data['title'] = "INFORMATIONS DE CONNEXION À L'ESPACE ADMINISTRATEUR DE L'ISMP";
            $data['body'] = "No Reply.Ceci est un mail de vérification, ne pas répondre.";
            $data['link'] = "https://ismpmaster.cm/login"; // Remplacez par votre lien réel
    
            Mail::send('sendmailaudi', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });



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
                  'message' => "Vos identifiants de connexion a l’espace administrateur de l’ISMP vous ont été envoyés dans votre boite mail. Consulter votre messagerie.",
                ],
            ]);

             } catch (\Exception $e) {
            // Gérez l'erreur ici
            $message = "Une erreur s'est produite lors de l'envoi du message!";
            session()->flash('message', $message);
            return redirect()->route('user');
        }
        
} elseif ($profile == "DNEP") {
    $users = DB::select('CALL psUser_Insert(?,?,?,?,?)', [$name, $email, $password, $profile,$tel]);
  // Envoyer l'e-mail avec le mot de passe généré
            $userName = $name;
            $data['userName'] = $userName;
            $data['email'] = $email;
            $data['password'] = $passmailsms;
            $data['title'] = "INFORMATIONS DE CONNEXION À L'ESPACE DINEP DE L'ISMP";
            $data['body'] = "No Reply.Ceci est un mail de vérification, ne pas répondre.";
            $data['link'] = "https://ismpmaster.cm/Dinep"; // Remplacez par votre lien réel
    
            Mail::send('sendmailaudi', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });



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
                  'message' => "Votre compte viens d'etre créer sur la plate forme de l'ismp.Veuillez consulter votre boite électronique pour recevoir vos identifiants.",
                ],
            ]);

             } catch (\Exception $e) {
            // Gérez l'erreur ici
            $message = "Une erreur s'est produite lors de l'envoi du message!";
            session()->flash('message', $message);
            return redirect()->route('user');
        }
} elseif ($profile == "DSFR") {
   // dd($profile);
    $users = DB::select('CALL psUser_Insert(?,?,?,?,?)', [$name, $email, $password, $profile,$tel]);
    // Envoyer l'e-mail avec le mot de passe généré
            $userName = $name;
            $data['userName'] = $userName;
            $data['email'] = $email;
            $data['password'] = $passmailsms;
            $data['title'] = "INFORMATIONS DE CONNEXION À L'ESPACE DSFR DE L'ISMP";
            $data['body'] = "Ne pas répondre.Ceci est un mail de notification.";
            $data['link'] = "http://192.168.0.101:4200"; // Remplacez par votre lien réel
    
            Mail::send('sendmailaudi', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });



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
                  'message' => "Votre compte viens d'etre créer sur la plate forme de l'ismp.Veuillez consulter votre boite électronique pour recevoir vos identifiants.",
                ],
            ]);

             } catch (\Exception $e) {
            // Gérez l'erreur ici
            $message = "Une erreur s'est produite lors de l'envoi du message!";
            session()->flash('message', $message);
            return redirect()->route('user');
        }
}elseif ($profile == "DNEP") {
    $users = DB::select('CALL psUser_Insert(?,?,?,?,?)', [$name, $email, $password, $profile,$tel]);
  // Envoyer l'e-mail avec le mot de passe généré
            $userName = $name;
            $data['userName'] = $userName;
            $data['email'] = $email;
            $data['password'] = $passmailsms;
            $data['title'] = "INFORMATIONS DE CONNEXION À L'ESPACE DINEP DE L'ISMP";
            $data['body'] = "No Reply.Ceci est un mail de vérification, ne pas répondre.";
            $data['link'] = "https://ismpmaster.cm/Dinep"; // Remplacez par votre lien réel
    
            Mail::send('sendmailaudi', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });



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
                  'message' => "Votre compte viens d'etre créer sur la plate forme de l'ismp.Veuillez consulter votre boite électronique pour recevoir vos identifiants.",
                ],
            ]);

             } catch (\Exception $e) {
            // Gérez l'erreur ici
            $message = "Une erreur s'est produite lors de l'envoi du message!";
            session()->flash('message', $message);
            return redirect()->route('user');
        }
} elseif ($profile == "REGISTER") {
   // dd($profile);
    $users = DB::select('CALL psUser_Insert(?,?,?,?,?)', [$name, $email, $password, $profile,$tel]);
    // Envoyer l'e-mail avec le mot de passe généré
            $userName = $name;
            $data['userName'] = $userName;
            $data['email'] = $email;
            $data['password'] = $passmailsms;
            $data['title'] = "INFORMATIONS DE CONNEXION À L'ESPACE DSFR DE L'ISMP";
            $data['body'] = "Ne pas répondre.Ceci est un mail de notification.";
            $data['link'] = "http://192.168.0.101:4200"; // Remplacez par votre lien réel
    
            Mail::send('sendmailaudi', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });



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
                  'message' => "Votre compte viens d'etre créer sur la plate forme de l'ismp.Veuillez consulter votre boite électronique pour recevoir vos identifiants.",
                ],
            ]);

             } catch (\Exception $e) {
            // Gérez l'erreur ici
            $message = "Une erreur s'est produite lors de l'envoi du message!";
            session()->flash('message', $message);
            return redirect()->route('user');
        }
}else{
    $message = "impossible de créer cet utlisateur!";
    session()->flash('message', $message);
}
 

    return redirect()->route('user');
}


public function destroy(Request $request)
{
    $message = "Utilisateur supprimé avec succès.";
    $iduser = intval($request->input('iduser'));
    //dd($iduser);
 
    DB::delete('CALL psUser_Delete(?)', [$iduser]);

    session()->flash('message', $message);

    return redirect()->route('user');
}

/* public function store(Request $request)
{

    $name = $request->input('name');
    $email = $request->input('email');
    $password = $request->input('password');
    $profile = $request->input('profile');

      $existingUser = DB::select('SELECT * FROM users WHERE email = ?', [$email]);
    if (!empty($existingUser)) {
         $message = " Un utilisateur existe deja avec cette adresse mail.";
 session()->flash('message', $message);
        // L'e-mail existe déjà, vous pouvez choisir de gérer cette situation (par exemple, afficher un message d'erreur)
        return redirect()->back()->with('error', 'Cet e-mail existe déjà.');
    }

    if ($profile === 'ADMINISTRATEUR' || $profile === 'REGISTER') {
     //   $password = crypter($password);
   //  $password =bcrypt($password);
        $users = DB::select('CALL psUser_Insert(?,?,?,?)', [$name, $email, $password, $profile]);
    } else {
        $users = DB::select('CALL psUser_Insert(?,?,?,?)', [$name, $email, $password, $profile]);
    }

    return redirect()->route('user');
} */

    public function getParamuser()
    {
        $paramValue = Session::get('paramValue');
        $groupes = groupe::all();
        $users = User::all();
      
        return view('user', ['paramValue' => $paramValue,'users' => $users,'groupes' => $groupes]);
    }
}
