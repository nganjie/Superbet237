<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\AuthenticationCodeEmail;
use Validator;
use GuzzleHttp\Client;



class UserAPIController extends Controller
{
    public $successStatus = 200;
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */



    //  public function login(Request $request)
    //  {
    //      $email = $request->email;
    //      $password = $request->password;

    //      $authResult = DB::select('CALL user_login(?,?)', [$email, $password]);

    //      if ($authResult && isset($authResult[0]->telephone)) {
    //          $code = mt_rand(100000, 999999);
    //          $phoneNumber = $authResult[0]->telephone; 
    //          $client = new Client();
    //          try {
    //              $response = $client->post('https://app.techsoft-sms.com/api/v3/sms/send', [
    //                  'headers' => [
    //                      'Authorization' => 'Bearer 9|NTTkQIJROPURdSkXnEDSiviZjff8d0SQBFV3EK0w57228ea5',
    //                      'Content-Type' => 'application/json',
    //                      'Accept' => 'application/json',
    //                  ],
    //                  'json' => [
    //                      'recipient' => intval($phoneNumber),
    //                      'sender_id' => 'ISMP',
    //                      'type' => 'plain',
    //                      'message' => 'Votre code d\'authentification est : ' . $code,
    //                  ],
    //              ]);

    //              if ($response->getStatusCode() === 200) {
    //                  return response()->json(['success' => 'Code envoyé par SMS'], $this->successStatus);
    //              } else {
    //                  return response()->json(['error' => 'Erreur lors de l\'envoi du SMS'], 500);
    //              }
    //          } catch (\Exception $e) {
    //              return response()->json(['error' => 'Erreur lors de l\'envoi du SMS : ' . $e->getMessage()], 500);
    //          }
    //      } else {
    //          return response()->json(['resultat' => $authResult]);
    //      }
    //  }



    // public function login()
    // { 
    //     if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) { 
    //         $user = Auth::user(); 
    //         $success['token'] = $user->createToken($user->name)->accessToken; 
    //         $success['userId'] = $user->id;
    //         return response()->json(['success' => $success], $this->successStatus); 
    //     } else { 
    //         return response()->json(['error' => 'Echec !'], 401); 
    //     } 
    // }


    public function login(Request $request)
    {
        $profil = $request->input('profil');
        $email = $request->input('email');
        $password = $request->input('password');
         $password = md5($password.$email);

        $results = DB::select('CALL user_login(?,?,?)', [$email,$password, $profil]);
        return response()->json($results);
    }

   /*  public function kenologin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $results = DB::select('CALL psUsers_Login(?,?)', [$email,$password]);
        return response()->json($results);
    } */

    public function kenologin(Request $request, $email, $password)
    {
        $results = DB::select('CALL psUsers_Login(?,?)', [$email,$password]);
        return response()->json($results);
    }
    
    public function loginAndroid(Request $request)
    {
        $profil = $request->input('profil');
        $email = $request->input('email');
        $password = $request->input('password');
        $password = md5($password . $email);
    
        $results = DB::select('CALL user_login(?,?,?)', [$email, $password, $profil]);
    
        if (count($results) > 0) {
            $responseData = $results[0]; // Supposons que l'objet JSON soit le premier élément du tableau
            return response()->json($responseData);
        } else {
            $error = ['error' => 'Aucun résultat trouvé'];
            return response()->json($error, 404);
        }
    }

    public function changePassword(Request $request)
    {
        $id = $request->input('id');
        $email = $request->input('email');
        $oldpassword = $request->input('oldpassword');
        $password = $request->input('password');

        $oldpassword = md5($oldpassword.$email);
        $password = md5($password.$email);

        DB::statement('CALL user_update_password(?,?,?)', [
            $id,
            $oldpassword,
            $password,
        ]);
        return response()->json(['success' => true]);
    }

    public function loginByCode(Request $request)
    {
        $profil = $request->input('profil');
        $code = $request->input('code');

        $results = DB::select('CALL user_login_code(?,?)', [$code, $profil]);
        return response()->json($results);
    }

    //     public function login(Request $request)
// {
//     $email = $request->input('email');
//     $password = $request->input('password');

    //     $results = DB::select('CALL user_login(?,?)', [$email, $password]);

    //     if ($results) {
//         // L'utilisateur est authentifié avec succès

    //         // Générez un code d'authentification aléatoire
//         $code = rand(100000, 999999);

    //         // Enregistrez le code d'authentification en session pour le vérifier ultérieurement
//         Session::put('auth_code', $code);

    //         // Envoie du code d'authentification par email
//         Mail::to($email)->send(new AuthenticationCodeEmail($code));

    //         // Redirigez l'utilisateur vers la page de vérification du code d'authentification
//         return response()->json(['success' => true]);

    //     } else {
//         // L'authentification a échoué

    //         // Retournez une réponse d'erreur ou redirigez vers la page de connexion avec un message d'erreur
//         return response()->json(['error' => false]);
//     }
// }



    protected function authenticated(Request $request, $user)
    {
        //dd($user->id);
        // Appeler la procédure stockée pour récupérer les rôles de l'utilisateur
        $roles = DB::select('CALL psUserRoles_List(?)', [$user->id]);

        // Enregistrer les rôles dans la session de l'utilisateur
        $request->session()->put('user_roles', $roles);
    }

    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function userDetails()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }










}