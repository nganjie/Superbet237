<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Mail\AuthenticationCodeEmail;
use App\Mail\BulkMessageEmail;
use App\Mail\RessourcesBulkMessageEmail;
use App\Mail\AffectationEnseignantMail;
use App\Mail\ProgrammationCours;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;


use Illuminate\Support\Collection;

class APIController extends Controller
{

    /* Keno controllers */
    public function organisationList(Request $request, $organisationID)
    {
        $organisationList = DB::select('CALL psOrganisation_ListByParent(?)', [$organisationID]);
        return response()->json($organisationList);
    }
    public function salleList(Request $request, $organisationID)
    {
        $salleList = DB::select('CALL psSalle_List(?)', [$organisationID]);
        return response()->json($salleList);
    }
    public function organisationInsert(Request $request)
    {
        $data = $request->all();

        DB::statement('CALL psOrganisation_Insert(?,?,?,?,?,?)', [
            $data['user_update'],
            $data['libelle'],
            $data['parentID'],
            $data['login'],
            $data['password'],
            $data['responsable']
        ]);
        return response()->json(['success' => true]);
    }

    public function salleInsert(Request $request)
    {
        $data = $request->all();
        DB::statement('CALL psSalle_Insert(?,?,?,?)', [
            $data['userID'],
            $data['code_salle'],
            $data['libelle'],
            $data['description']
        ]);

        return response()->json(['success' => true]);
    }

    public function paramSalleInsert(Request $request)
    {
        $data = $request->all();

        /* Turn-Over */
        DB::statement('CALL psParametre_Update(?,?,?,?,?,?,?,?,?,?,?,?)', [
            $data['code_salle'],
            $data['date_cagnotte'],
            $data['lots'],
            $data['actif'],
            $data['organisationID'],
            $data['userID'],
            $data['jackpot_min'],
            $data['jackpot_max'],
            $data['jackpot_rate'],
            $data['montant_bonus'],
            $data['turn_over'],
            $data['cycle']
        ]);

        return response()->json(['success' => true]);
    }


    public function insertMise(Request $request)
    {
        $data = $request->all();

        $code = DB::statement('CALL psTicket_Insert(?,?,?,?,?,?,?)', [
            $data['code_salle'],
            $data['code_option'],
            $data['montant'],
            $data['nbtirage'],
            $data['userID'],
            $data['boules'],
            $data['avecmultiplicateur'],

        ]);

        return response()->json($code);
    }

        
/* ************************************* 31/05/2024 ********************************************* */

public function algorithmeDistribution(Request $request)
{
    $data = $request->all();

    $result = DB::select('CALL psAlgoDistribution(?,?)', [
        $data['code_salle'],
        $data['tirageID'],
        
    ]);

    return response()->json($result);
}

public function tirageInsert(Request $request)
{
    $data = $request->all();

    DB::statement('CALL psTirage_Insert(?,?,?)', [
        $data['tirageID'],
        $data['codeSalle'],
        $data['dateDebut'],

    ]);

    return response()->json(['success' => true]);
}

public function dernierstirages(Request $request, $code_salle)
{
    $result = DB::select('CALL psList_DerniersTirage(?)', [$code_salle]);
    return response()->json($result);
}

public function bouleslesplustirees(Request $request, $code_salle)
{
    $result = DB::select('CALL psList_BoulesLesPlusTirees(?)', [$code_salle]);
    return response()->json($result);
}

public function bouleslesmoinstirees(Request $request, $code_salle)
{
    $result = DB::select('CALL psList_BoulesLesMoinsTirees(?)', [$code_salle]);
    return response()->json($result);
}

public function derniersmultiplicateurs(Request $request, $code_salle)
{
    $result = DB::select('CALL psList_DerniersMultiplicateurs(?)', [$code_salle]);
    return response()->json($result);
}

public function entetecaisse(Request $request, $code_salle)
{
    $result = DB::select('CALL psList_EnteteCaisse(?)', [$code_salle]);
    return response()->json($result);
}


/* ************************************* 31/05/2024 ********************************************* */























    public function resetPassword(Request $request)
    {
        $email = $request->input('email');

        $user = DB::table('users')->where('email', $email)->first();

        if (!empty($user)) {
            $indicatif = "+237";
            $telephone = $indicatif . $user->telephone;

            $code = rand(100000, 999999);
            $expiration = Carbon::now()->addMinutes(10);

            DB::table('users')->where('email', $email)->update([
                'codegenere' => $code,
                'code_expiration' => $expiration
            ]);


            Mail::to($user->email)->send(new AuthenticationCodeEmail($code));

            $client = new Client();

            try {
                $response = $client->post('https://app.techsoft-sms.com/api/v3/sms/send', [
                    'headers' => [
                        'Authorization' => 'Bearer 9|NTTkQIJROPURdSkXnEDSiviZjff8d0SQBFV3EK0w57228ea5',
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                    'json' => [
                        'recipient' => intval($telephone),
                        'sender_id' => 'ISMP',
                        'type' => 'plain',
                        'message' => 'Votre code de vérification est : ' . $code,
                    ],
                ]);

                if ($response->getStatusCode() === 200) {
                    return response()->json([
                        'success' => 'Code envoyé par e-mail et SMS',
                        'user' => $user
                    ]);
                } else {
                    // return response()->json(['error' => 'Erreur lors de l\'envoi du SMS'], 500);
                }
            } catch (\Exception $e) {
                // return response()->json(['error' => 'Erreur lors de l\'envoi du SMS : ' . $e->getMessage()], 500);
            }
        } else {
            return response()->json(['error' => 'Adresse e-mail introuvable']);
        }

        return response()->json([
            'success' => 'Code envoyé par e-mail et SMS',
            'user' => $user
        ]);
    }

    // public function resetPasswordByEmail(Request $request)
    // {
    //     $email = $request->input('email');

    //     $user = DB::table('users')->where('email', $email)->first();

    //     if ($user) {
    //         $code = rand(100000, 999999);
    //         $expiration = Carbon::now()->addMinutes(1);

    //         DB::table('users')->where('email', $email)->update([
    //             'codegenere' => $code,
    //             'code_expiration' => $expiration
    //         ]);

    //         Mail::to($email)->send(new AuthenticationCodeEmail($code));

    //         return response()->json(['success' => true]);
    //     } else {
    //         return response()->json(['error' => 'Adresse e-mail introuvable']);
    //     }
    // }





    // public function resetPasswordByPhone(Request $request)
    // {
    //     $telephone = $request->telephone;
    //     $telephone = "+237" . $telephone;

    //     $user = DB::table('users')->where('telephone', $telephone)->first();

    //     if ($user) {
    //         $code = mt_rand(100000, 999999);
    //         $phoneNumber = $user->telephone;

    //         $expiration = Carbon::now()->addMinutes(1);

    //         DB::table('users')->where('telephone', $telephone)->update([
    //             'codegenere' => $code,
    //             'code_expiration' => $expiration
    //         ]);

    //         $client = new Client();
    //         $tel = intval($phoneNumber);

    //         try {
    //             $response = $client->post('https://app.techsoft-sms.com/api/v3/sms/send', [
    //                 'headers' => [
    //                     'Authorization' => 'Bearer 9|NTTkQIJROPURdSkXnEDSiviZjff8d0SQBFV3EK0w57228ea5',
    //                     'Content-Type' => 'application/json',
    //                     'Accept' => 'application/json',
    //                 ],
    //                 'json' => [
    //                     'recipient' => $tel,
    //                     'sender_id' => 'ISMP-PLANNING',
    //                     'type' => 'plain',
    //                     'message' => 'Votre code d\'authentification est : ' . $code,
    //                 ],
    //             ]);

    //             if ($response->getStatusCode() === 200) {
    //                 return response()->json(['success' => 'Code envoyé par SMS']);
    //             } else {
    //                 return response()->json(['error' => 'Erreur lors de l\'envoi du SMS'], 500);
    //             }
    //         } catch (\Exception $e) {
    //             return response()->json(['error' => 'Erreur lors de l\'envoi du SMS : ' . $e->getMessage()], 500);
    //         }
    //     } else {
    //         return response()->json(['error' => 'Numéro de téléphone introuvable']);
    //     }
    // }




    public function verifyCodeReset(Request $request)
    {
        $code = $request->code;

        $user = DB::table('users')->where('codegenere', $code)->first();

        if ($user) {
            $expiration = Carbon::parse($user->code_expiration);

            if ($expiration->isPast()) {
                // Code expiré, réinitialiser la valeur de la colonne `codegenere` et `code_expiration`
                DB::table('users')->where('codegenere', $code)->update([
                    'codegenere' => null,
                    'code_expiration' => null
                ]);

                return response()->json(['result' => false, 'error' => 'Le code a expiré']);
            }

            return response()->json(['result' => true]);
        } else {
            return response()->json(['result' => false, 'error' => 'Code invalide']);
        }
    }


    public function sendBulkMessage(Request $request)
    {
        $sujet = $request->input('sujet');
        $regroupement = $request->input('regroupement');
        $message = $request->input('message');

        $auditeurs = DB::select('call psAuditeurByIdreg(?)', [$regroupement]);

        $decryptedAuditeurs = collect($auditeurs)->map(function ($auditeur) {
            $auditeur->email = Crypt::decrypt($auditeur->email);
            $auditeur->tel = Crypt::decrypt($auditeur->tel);
            return $auditeur;
        });

        $emails = $decryptedAuditeurs->pluck('email');
        $phoneNumbers = $decryptedAuditeurs->pluck('tel');

        // Envoi des emails
        Mail::to($emails)->send(new BulkMessageEmail($sujet, $message));

        // Envoi des SMS
        $client = new Client();
        foreach ($phoneNumbers as $phoneNumber) {
            $cleanPhoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

            if (strlen($cleanPhoneNumber) === 9) {
                $response = $client->post('https://app.techsoft-sms.com/api/v3/sms/send', [
                    'headers' => [
                        'Authorization' => 'Bearer 9|NTTkQIJROPURdSkXnEDSiviZjff8d0SQBFV3EK0w57228ea5',
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                    'json' => [
                        'recipient' => intval($cleanPhoneNumber),
                        'sender_id' => 'ISMP',
                        'type' => 'plain',
                        'message' => "" . strtoupper($sujet) . "\n\n" . $message,
                    ],
                ]);
            }
        }

        return $decryptedAuditeurs;
    }



    public function getAuditeursNotesListDefinitive(Request $request, $idere, $ueid)
    {
        $auditeursListByRegroupement = DB::select('CALL psAuditeursNotes_ListDefinitive(?,?)', [$idere, $ueid]);

        $auditeursCollection = new Collection($auditeursListByRegroupement);

        $decryptedAuditeurs = $auditeursCollection->map(function ($auditeur) {
            $auditeur->nom = Crypt::decrypt($auditeur->nom);
            $auditeur->prenom = Crypt::decrypt($auditeur->prenom);

            return $auditeur;
        });

        return response()->json($decryptedAuditeurs);
    }

    public function getAuditeursNotesList(Request $request, $idere, $ueid, $idsession)
    {
        $auditeursListByRegroupement = DB::select('CALL psAuditeursNotesList(?,?,?)', [$idere, $ueid, $idsession]);

        $auditeursCollection = new Collection($auditeursListByRegroupement);

        $decryptedAuditeurs = $auditeursCollection->map(function ($auditeur) {
            $auditeur->nom = Crypt::decrypt($auditeur->nom);
            $auditeur->prenom = Crypt::decrypt($auditeur->prenom);

            return $auditeur;
        });

        return response()->json($decryptedAuditeurs);
    }


    //Controllers Cours
    public function getAllCoursesAPI(Request $request)
    {
        $user = Auth::id();
        $cours = DB::select('CALL psCours_List()');
        return response()->json($cours);
    }

    public function getAllCoursesByAuditeurAPI(Request $request)
    {
        $user = Auth::id();
        $cours = DB::select('CALL psCours_ListByAuditeur(?)', [$user]);
        return response()->json($cours);
    }

    // public function coursEvaluationInsert(Request $request)
    // {
    //     $data = $request->all();

    //     DB::statement('CALL psCoursEvaluation_Insert(?,?,?,?,?,?,?)', [
    //         $data['idue'],
    //         $data['idfichecriteres'],
    //         $data['idparcours'],
    //         $data['idauditeur'],
    //         $data['idregroupement'],
    //         $data['observations'],
    //         $data['valeur']
    //     ]);
    //     return response()->json(['success' => true]);
    // }


    public function coursEvaluationInsert(Request $request)
    {
        $data = $request->all();

        if (isset($data['notes']) && is_array($data['notes'])) {
            foreach ($data['notes'] as $note) {
                DB::statement('CALL psCoursEvaluation_Insert(?,?,?,?,?,?,?,?)', [
                    $data['idperiode'],
                    $data['idparcours'],
                    $data['idregroupement'],
                    $data['idue'],
                    $data['observations'],
                    $note['valeur'],
                    $note['idfichecriteres'],
                    $data['idauditeur']
                ]);
            }
        }

        return response()->json(['success' => true]);
    }


    // public function insertCoursProgramme(Request $request)
    // {
    //     $data = $request->all();

    //     DB::statement('CALL pscoursprogramme_deleteByUe(?,?,?,?)', [
    //         $data['idue'],
    //         $data['idparcours'],
    //         $data['idregroupements'],
    //         $data['user']
    //     ]);

    //     if (isset($data['cours']) && is_array($data['cours'])) {
    //         foreach ($data['cours'] as $cour) {
    //             DB::statement('CALL pscoursprogramme_insert(?,?,?,?,?,?,?,?,?,?,?)', [
    //                 $cour['idcp'],
    //                 $cour['idparcours'],
    //                 $cour['idregroupements'],
    //                 $cour['idue'],
    //                 $cour['idsalle'],
    //                 $cour['libelleFr'],
    //                 $cour['libelleUs'],
    //                 $cour['datejour'],
    //                 $cour['heuredeb'],
    //                 $cour['heurefin'],
    //                 $data['user']
    //             ]);


    //             if (isset($cour['enseignants']) && is_array($cour['enseignants'])) {
    //                 foreach ($cour['enseignants'] as $enseignant) {
    //                     DB::statement('CALL pscoursprogramme_EnsInsert(?,?,?,?,?)', [
    //                         $cour['idcp'],
    //                         $enseignant['id'],
    //                         $enseignant['nomens'],
    //                         $enseignant['emailens'],
    //                         $enseignant['telens']
    //                     ]);
    //                 }
    //             }
    //         }
    //     }

    //     return response()->json([$data]);
    // }




    public function insertCoursProgramme(Request $request)
    {
        $data = $request->all();

        DB::statement('CALL pscoursprogramme_deleteByUe(?,?,?,?)', [
            $data['idue'],
            $data['idparcours'],
            $data['idregroupements'],
            $data['user']
        ]);

        if (isset($data['cours']) && is_array($data['cours'])) {
            foreach ($data['cours'] as $cour) {
                DB::statement('CALL pscoursprogramme_insert(?,?,?,?,?,?,?,?,?,?,?)', [
                    $cour['idcp'],
                    $cour['idparcours'],
                    $cour['idregroupements'],
                    $cour['idue'],
                    $cour['idsalle'],
                    $cour['libelleFr'],
                    $cour['libelleUs'],
                    $cour['datejour'],
                    $cour['heuredeb'],
                    $cour['heurefin'],
                    $data['user']
                ]);

                if (isset($cour['enseignants']) && is_array($cour['enseignants'])) {
                    foreach ($cour['enseignants'] as $enseignant) {
                        DB::statement('CALL pscoursprogramme_EnsInsert(?,?,?,?,?)', [
                            $cour['idcp'],
                            $enseignant['id'],
                            $enseignant['nomens'],
                            $enseignant['emailens'],
                            $enseignant['telens']
                        ]);

                        //$this->sendEmail($enseignant['emailens'], $enseignant['nomens'], $cour['libelleFr']);

                        //$this->sendSMS($enseignant['telens'], $enseignant['nomens'], $cour['libelleFr']);
                    }
                }
            }
        }

        return response()->json([$data]);
    }

    private function sendEmail($email, $nomens, $libelleFr)
    {
        Mail::to($email)->send(new ProgrammationCours($nomens, $libelleFr));
    }

    private function sendSMS($telens, $nomens, $libelleFr)
    {
        $message = "Bonjour $nomens. Nous vous informons que vous avez un nouveau cours programmé : $libelleFr. Veuillez consulter votre emploi du temps pour plus de détails.";

        $client = new Client();
        $client->post('https://app.techsoft-sms.com/api/v3/sms/send', [
            'headers' => [
                'Authorization' => 'Bearer 9|NTTkQIJROPURdSkXnEDSiviZjff8d0SQBFV3EK0w57228ea5',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => [
                'recipient' => intval($telens),
                'sender_id' => 'ISMP',
                'type' => 'plain',
                'message' => $message,
            ],
        ]);
    }


    public function deleteCoursProgrammeUE(Request $request)
    {
        $data = $request->all();

        DB::statement('CALL pscoursprogramme_deleteByUe(?,?,?,?)', [
            $data['idue'],
            $data['idparcours'],
            $data['idregroupements'],
            $data['user']
        ]);

        if (isset($data['cours']) && is_array($data['cours'])) {
            foreach ($data['cours'] as $cours) {
                DB::statement('CALL pscoursprogramme_insert(?,?,?,?,?,?,?,?,?,?,?)', [
                    $data['idcp'],
                    $data['idparcours'],
                    $data['idregroupements'],
                    $data['idue'],
                    $data['idsalle'],
                    $cours['libelleFr'],
                    $cours['libelleUs'],
                    $cours['datejour'],
                    $cours['heuredeb'],
                    $cours['heurefin'],
                    $data['user']
                ]);
            }
        }

        return response()->json(['success' => true]);
    }



    public function noteUEInsert(Request $request)
    {
        $data = $request->all();

        if (isset($data['notes']) && is_array($data['notes'])) {
            foreach ($data['notes'] as $note) {
                DB::statement('CALL psNoteUE_Insert(?,?,?,?,?,?,?,?,?)', [
                    $note['idreg'],
                    $note['idue'],
                    $note['idsession'],
                    $note['idaudi'],
                    $note['note'],
                    $note['base'],
                    $note['poids'],
                    $note['valide'],
                    $note['idens']
                ]);
            }
        }
        if ($data['valide'] == 1) {
            if (isset($data['notes']) && is_array($data['notes'])) {
                foreach ($data['notes'] as $note) {
                    DB::statement('CALL psNoteUE_Anonymat_Insert(?,?,?,?,?,?,?,?,?)', [
                        $note['idreg'],
                        $note['idue'],
                        $note['idsession'],
                        $note['idaudi'],
                        $note['note'],
                        $note['base'],
                        $note['poids'],
                        $note['valide'],
                        $note['idens']
                    ]);
                    DB::statement('CALL psNoteUEDefinitive_Insert(?,?,?,?,?,?,?,?,?)', [
                        $note['idreg'],
                        $note['idue'],
                        $note['idsession'],
                        $note['idaudi'],
                        $note['note'],
                        $note['base'],
                        $note['poids'],
                        $note['type'],
                        $note['userValidation']
                    ]);
                }
            }
        }
        return response()->json(['success' => true]);
    }

    public function noteUEDefinitiveInsert(Request $request)
    {
        $data = $request->all();

        if (isset($data['notes']) && is_array($data['notes'])) {
            foreach ($data['notes'] as $note) {
                DB::statement('CALL psNoteUEDefinitive_Insert(?,?,?,?,?,?,?,?,?)', [
                    $note['idreg'],
                    $note['idue'],
                    $note['idsession'],
                    $note['idaudi'],
                    $note['note'],
                    $note['base'],
                    $note['poids'],
                    $note['type'],
                    $note['userValidation']
                ]);
            }
        }

        return response()->json(['success' => true]);
    }


    public function notationSessionCourInsert(Request $request)
    {
        $data = $request->all();

        DB::statement('CALL psNotation_SessionCourDelete(?)', [
            $data['courid']
        ]);

        if (isset($data['sessions']) && is_array($data['sessions'])) {
            foreach ($data['sessions'] as $session) {
                DB::statement('CALL psNotation_SessionCourInsert(?,?,?,?)', [
                    $session['id'],
                    $session['courid'],
                    $session['idsession'],
                    $session['poids']
                ]);
            }
        }

        return response()->json(['success' => true]);
    }



    public function getCoursProgrammeListeByRegroupement(Request $request, $idparcours, $idregroupements, $idue)
    {
        $coursProgrammeListeByRegroupement = DB::select('CALL pscoursprogramme_ListByRegroupement(?,?,?)', [$idparcours, $idregroupements, $idue]);
        return response()->json($coursProgrammeListeByRegroupement);
    }
    public function auditeursListByCp(Request $request, $idparcours, $idregroupements, $idcp)
    {
        $auditeursListByCp = DB::select('CALL psAuditeur_LisByCp(?,?,?)', [$idparcours, $idregroupements, $idcp]);

        $auditeursCollection = new Collection($auditeursListByCp);

        $decryptedAuditeurs = $auditeursCollection->map(function ($auditeur) {
            $auditeur->nomauditeur = Crypt::decrypt($auditeur->nomauditeur);
            $auditeur->prenomauditeur = Crypt::decrypt($auditeur->prenomauditeur);

            return $auditeur;
        });
        return response()->json($decryptedAuditeurs);
    }

    public function getSessionAllow(Request $request, $idperiode)
    {
        $sessionAllow = DB::select('CALL psSessionAllow(?)', [$idperiode]);
        return response()->json($sessionAllow);
    }
    public function soutenanceEtatByEns(Request $request, $idens)
    {
        $soutenanceEtatByEns = DB::select('CALL psSoutenance_EtatByEns(?)', [$idens]);
        return response()->json($soutenanceEtatByEns);
    }

    // Controller cours - Fin
    public function getUeListProgramme(Request $request, $idparcours, $idregroupements)
    {
        $uEListProgramme = DB::select('CALL psUe_ListProgramme(?,?)', [$idparcours, $idregroupements]);
        return response()->json($uEListProgramme);
    }

    public function coursEvaluationSyntheseDernier(Request $request, $l)
    {
        $coursEvaluationSyntheseDernier = DB::select('CALL psCourEvaluation_syntheseDernier(?)', [$l]);
        return response()->json($coursEvaluationSyntheseDernier);
    }
    //Controllers UE

    //Controllers UE - Fin


    //Controllers Session
    public function getAllSessionAPI(Request $request)
    {
        $sessions = DB::select('CALL psSession_List()');
        return response()->json($sessions);
    }

    //Controllers Enseignant
    public function getEnseignantByUeAPI(Request $request, $idue)
    {
        $enseignantByIdUe = DB::select('CALL psEnseignantByIdUe(?)', [$idue]);
        return response()->json($enseignantByIdUe);
    }
    public function getRessourceList(Request $request, $idparcours, $idregroupements, $idue)
    {
        $ressourceList = DB::select('CALL psRessouce_List(?,?,?)', [$idparcours, $idregroupements, $idue]);
        return response()->json($ressourceList);
    }
    //Controllers Enseignant
    public function getEnseignantByPeriodAPI(Request $request, $idperio)
    {
        $enseignantListByPeriod = DB::select('CALL psEnseignantListByPerio(?)', [$idperio]);
        return response()->json($enseignantListByPeriod);
    }

    //Auditeurs Controllers
    public function getAuditeurListByRegroupementAPI(Request $request, $idere)
    {
        $auditeursListByRegroupement = DB::select('CALL psAuditeurByReg(?)', [$idere]);

        $auditeursCollection = new Collection($auditeursListByRegroupement);

        $decryptedAuditeurs = $auditeursCollection->map(function ($auditeur) {
            $auditeur->nom = Crypt::decrypt($auditeur->nom);
            $auditeur->prenom = Crypt::decrypt($auditeur->prenom);
            $auditeur->genre = Crypt::decrypt($auditeur->genre);
            $auditeur->date = Crypt::decrypt($auditeur->date);
            $auditeur->email = Crypt::decrypt($auditeur->email);
            $auditeur->tel = Crypt::decrypt($auditeur->tel);

            return $auditeur;
        });

        return response()->json($decryptedAuditeurs);
    }

    //Auditeurs Controllers - Fin



    //Notations Controllers 
    public function getNotationSessionList(Request $request, $anneAccademiqueID, $parcourAccademiqueID, $coursID)
    {
        $notationSessionList = DB::select('CALL psNotation_SessionList(?,?,?)', [$anneAccademiqueID, $parcourAccademiqueID, $coursID]);
        return response()->json($notationSessionList);
    }

    public function getNotationSessionListByCour(Request $request, $courID)
    {
        $notationSessionListByCour = DB::select('CALL psNotation_SessionsListByCourID(?)', [$courID]);
        return response()->json($notationSessionListByCour);
    }

    public function notationInsert(Request $request)
    {
        $data = $request->all();

        DB::statement('CALL psNotation_Insert(?,?,?,?,?)', [
            $data['notationID'],
            $data['anneAccademiqueID'],
            $data['parcourAccademiqueID'],
            $data['regroupementID'],
            $data['coursID']
        ]);
        return response()->json(['success' => true]);
    }

    public function coursProgrammeValider(Request $request)
    {
        $data = $request->all();

        DB::statement('CALL pscoursprogramme_valider(?,?)', [
            $data['idue'],
            $data['idparcours']
        ]);
        return response()->json(['success' => true]);
    }




    public function assiduiteInsert(Request $request)
    {
        $data = $request->all();

        if (isset($data) && is_array($data)) {
            foreach ($data as $session) {
                DB::statement('CALL psAssiduite_Insert(?,?,?,?,?,?,?,?,?)', [
                    $session['idue'],
                    $session['idcp'],
                    $session['idauditeur'],
                    $session['observations'],
                    $session['present'],
                    $session['retard'],
                    $session['justifie'],
                    $session['valide'],
                    $session['datejour']
                ]);
            }
        }
        return response()->json(['success' => true]);
    }

    public function assiduitePointage(Request $request)
    {
        $session = $request->all();
        DB::statement('CALL psAssiduite_Pointage(?,?)', [
            $session['idauditeur'], $session['idcp']
        ]);

        return response()->json(['success' => true]);
    }


    // public function affecterEnseignant(Request $request)
    // {
    //     $data = $request->all();


    //     if (isset($data) && is_array($data)) {
    //         $element = $data[0];

    //         DB::statement('CALL psEnseignantUE_Delete(?)', [
    //             $element['idue']
    //         ]);

    //         foreach ($data as $session) {
    //             DB::statement('CALL psEnseignant_AffecterUE(?,?,?,?)', [
    //                 $session['id'],
    //                 $session['idue'],
    //                 $session['porteur'],
    //                 $session['noter']

    //             ]);
    //         }
    //     }
    //     return response()->json([$data]);
    // }




    public function affecterEnseignant(Request $request)
    {
        $data = $request->all();

        if (isset($data) && is_array($data)) {
            $element = $data[0];

            DB::statement('CALL psEnseignantUE_Delete(?)', [
                $element['idue']
            ]);

            foreach ($data as $session) {
                DB::statement('CALL psEnseignant_AffecterUE(?,?,?,?)', [
                    $session['id'],
                    $session['idue'],
                    $session['porteur'],
                    $session['noter']
                ]);

                $this->sendNotification($session['emailens'], $session['telens'], $session['idue'], $session['numeroens'], $session['nomens'], $session['prenomens']);
            }
        }

        return response()->json([$data]);
    }

    private function sendNotification($emailens, $telens, $idue, $numeroens, $nomens, $prenomens)
    {
        Mail::to($emailens)->send(new AffectationEnseignantMail($idue, $numeroens, $nomens, $prenomens));

        $message = "Bonjour $numeroens $nomens $prenomens. Vous avez été affecté à l'unité d'enseignement : $idue. Veuillez consulter votre espace pour plus de détails.";

        $client = new Client();
        $client->post('https://app.techsoft-sms.com/api/v3/sms/send', [
            'headers' => [
                'Authorization' => 'Bearer 9|NTTkQIJROPURdSkXnEDSiviZjff8d0SQBFV3EK0w57228ea5',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => [
                'recipient' => intval($telens),
                'sender_id' => 'ISMP',
                'type' => 'plain',
                'message' => $message,
            ],
        ]);
    }


    // Notations Controllers - Fin


    //Fiches, Evaluation Controllers
    public function getFicheGroupeList(Request $request, $idfichegroupe)
    {
        $ficheGroupeList = DB::select('CALL psFicheGroupe_List(?)', [$idfichegroupe]);
        return response()->json($ficheGroupeList);
    }
    public function coursEvaluabiliteListDernier(Request $request, $l)
    {
        $coursEvaluabiliteListDernier = DB::select('CALL psCoursEvaluabilite_ListDernier(?)', [$l]);
        return response()->json($coursEvaluabiliteListDernier);
    }
    public function getFicheCriteresList(Request $request)
    {
        $ficheCriteresList = DB::select('CALL psFicheCriteres_List()');
        return response()->json($ficheCriteresList);
    }
    public function getFicheCriteresByGroupeList(Request $request, $idfichegroupe)
    {
        $ficheGroupeList = DB::select('CALL psFicheCriteresByGroupe_List(?)', [$idfichegroupe]);
        return response()->json($ficheGroupeList);
    }

    //Fiches, Evaluation Controllers - Fin

    //Salles Controllers
    public function getSallesListAPI(Request $request)
    {
        $sallesList = DB::select('CALL psSalle_List()');
        return response()->json($sallesList);
    }


    public function getAllPeriodeAcademiqueAPI(Request $request)
    {
        $periodeAcademique = DB::select('CALL psPeriodeAcdemique()');
        return response()->json($periodeAcademique);
    }
    public function getAllParcoursAcademiqueAPI(Request $request, $idperio)
    {
        $parcoursAcademique = DB::select('CALL psParcoursListByPerio(?)', [$idperio]);
        return response()->json($parcoursAcademique);
    }


    public function getAllPromotionByParcAPI(Request $request, $idparc)
    {
        $promotionByParc = DB::select('CALL psPromotionByParc(?)', [$idparc]);
        return response()->json($promotionByParc);
    }
    public function getRegroupementListByPerioAPI(Request $request, $idperio)
    {
        $regroupementListByPerio = DB::select('CALL psRegroupementListByPerio(?)', [$idperio]);
        return response()->json($regroupementListByPerio);
    }

    public function getRegroupementListByParcours(Request $request, $idparcours)
    {
        $regroupementListByParcours = DB::select('CALL psRegroupeByParc(?)', [$idparcours]);
        return response()->json($regroupementListByParcours);
    }
    public function getDivisionCalendaireAPI(Request $request)
    {
        $divisionCalendaire = DB::select('CALL psDivisionCa_List()');
        return response()->json($divisionCalendaire);
    }
    public function getUniteEnseignementAPI(Request $request)
    {
        $uniteEnseignement = DB::select('CALL psUe_List()');
        return response()->json($uniteEnseignement);
    }

    public function getNotationListAPI(Request $request)
    {
        $notationList = DB::select('CALL psNotation_List()');
        return response()->json($notationList);
    }

    public function getUniteEnseignementListByParcoursAPI(Request $request, $idp)
    {
        $uniteEnseignementByParcours = DB::select('CALL psUe_ListByParcours(?)', [$idp]);
        return response()->json($uniteEnseignementByParcours);
    }




    public function deleteCoursProgramme(Request $request, $idcp)
    {
        $data = $request->all();

        DB::statement('CALL pscoursprogramme_delete(?,?,?)', [
            $data[$idcp],
            $data['motif'],
            $data['user']
        ]);
        return response()->json(['success' => true]);
    }



    public function ueListProgEns(Request $request, $idenseignant, $idregroupements)
    {
        $promotionByParc = DB::select('CALL psUe_ListProgEns(?,?)', [$idenseignant, $idregroupements]);
        return response()->json($promotionByParc);
    }



    public function annulerCoursProgramme(Request $request)
    {
        $data = $request->all();

        DB::statement('CALL `pscoursprogramme_annule`(?,?,?)', [
            $data['idcp'],
            $data['annulemotif'],
            $data['user']
        ]);
        return response()->json(['success' => true]);
    }

    public function reporterCoursProgramme(Request $request)
    {
        $data = $request->all();

        DB::statement('CALL pscoursprogramme_reporte(?,?,?,?,?,?)', [
            $data['idcp'],
            $data['datejour'],
            $data['heuredeb'],
            $data['heurefin'],
            $data['reportemotif'],
            $data['user']
        ]);
        return response()->json(['success' => true]);
    }

    public function coursEvaluabiliteInsert(Request $request)
    {
        $data = $request->all();

        DB::statement('CALL psCoursEvaluabilite_Insert(?,?,?,?,?)', [
            $data['statut'],
            $data['cloture'],
            $data['idue'],
            $data['idparcours'],
            $data['idregroupement']
        ]);


        return response()->json(['success' => true]);
    }



    public function coursEvaluabiliteList(Request $request, $idparcours)
    {
        $coursEvaluabiliteList = DB::select('CALL psCoursEvaluabilite_List(?)', [$idparcours]);
        return response()->json($coursEvaluabiliteList);
    }

    public function courEvaluationSynthese(Request $request, $idregroupement, $idue)
    {
        $courEvaluationSynthese = DB::select('CALL psCourEvaluation_synthese(?,?)', [$idregroupement, $idue]);
        return response()->json($courEvaluationSynthese);
    }
    public function auditeursListAnonimat(Request $request, $idreg, $idue, $idsession)
    {
        $auditeursListAnonimat = DB::select('CALL psAuditeurs_ListAnonimat(?,?,?)', [$idreg, $idue, $idsession]);

        $auditeursCollection = new Collection($auditeursListAnonimat);

        $decryptedAuditeurs = $auditeursCollection->map(function ($auditeur) {
            $auditeur->nom = Crypt::decrypt($auditeur->nom);
            $auditeur->prenom = Crypt::decrypt($auditeur->prenom);

            return $auditeur;
        });

        return response()->json($decryptedAuditeurs);
    }
    public function soutenanceListByAuditeur(Request $request, $idauditeur)
    {
        $soutenanceListByAuditeur = DB::select('CALL psSoutenance_ListByAuditeur(?)', [$idauditeur]);
        return response()->json($soutenanceListByAuditeur);
    }

    public function soutenanceListByEns(Request $request, $idens)
    {
        $soutenanceListByEns = DB::select('CALL psSoutenance_ListByEns(?)', [$idens]);

        $auditeursCollection = new Collection($soutenanceListByEns);

        $soutenanceListByEns = $auditeursCollection->map(function ($auditeur) {
            $auditeur->nom = Crypt::decrypt($auditeur->nom);
            $auditeur->prenom = Crypt::decrypt($auditeur->prenom);

            return $auditeur;
        });
        return response()->json($soutenanceListByEns);
    }
    public function testConnexion(Request $request)
    {
        return response()->json(['success' => true]);
    }

    public function etatScolarite(Request $request, $idaudi, $idreg)
    {
        $etatScolarite = DB::select('CALL psEtatScolarite(?,?)', [$idaudi, $idreg]);
        return response()->json($etatScolarite);
    }


    public function genererAnonymat(Request $request)
    {
        $data = $request->all();

        if (isset($data['anonymats']) && is_array($data['anonymats'])) {
            foreach ($data['anonymats'] as $anonymat) {
                DB::statement('CALL psEvaluationAnonyme_Insert(?,?,?,?)', [
                    $anonymat['ideva'],
                    $anonymat['idue'],
                    $anonymat['idaudi'],
                    $anonymat['anonymat']
                ]);
            }
        }

        return response()->json(['success' => true]);
    }

    public function saveNoteAnonymes(Request $request)
    {
        $data = $request->all();

        if (isset($data['notes']) && is_array($data['notes'])) {
            foreach ($data['notes'] as $note) {
                DB::statement('CALL psNoteUE_Anonymat_Insert(?,?,?,?,?,?,?,?,?)', [
                    $note['idreg'],
                    $note['idue'],
                    $note['idsession'],
                    $note['idaudi'],
                    $note['note'],
                    $note['base'],
                    $note['poids'],
                    $note['valide'],
                    $note['idens']
                ]);
            }
        }
        return response()->json(['success' => true]);
    }

    public function listeAuditeursAnonymes(Request $request, $ireg, $idue, $idsession)
    {
        $listeAuditeursAnonymes = DB::select('CALL psAuditeursAnonimatList(?,?,?)', [$ireg, $idue, $idsession]);


        $auditeursCollection = new Collection($listeAuditeursAnonymes);

        $decryptedAuditeurs = $auditeursCollection->map(function ($auditeur) {
            $auditeur->nom = Crypt::decrypt($auditeur->nom);
            $auditeur->prenom = Crypt::decrypt($auditeur->prenom);

            return $auditeur;
        });

        return response()->json($decryptedAuditeurs);
    }
    public function coursProgrammeListByAuditeur(Request $request, $idauditeur, $limit)
    {
        $coursProgrammeListByAuditeur = DB::select('CALL pscoursprogramme_ListByAuditeur(?,?)', [$idauditeur, $limit]);
        return response()->json($coursProgrammeListByAuditeur);
    } //----------------------------------------------------------------------------------------
    public function auditeurNotesPersoList(Request $request, $idauditeur, $limit)
    {
        $auditeurNotesPersoList = DB::select('CALL psAuditeursNotesPerso_List(?,?)', [$idauditeur, $limit]);

        $auditeursCollection = new Collection($auditeurNotesPersoList);

        $decryptedAuditeurs = $auditeursCollection->map(function ($auditeur) {
            $auditeur->nom = Crypt::decrypt($auditeur->nom);
            $auditeur->prenom = Crypt::decrypt($auditeur->prenom);

            return $auditeur;
        });

        return response()->json($decryptedAuditeurs);
    } //----------------------------------------------------------------------------------------

    public function auditeurAbsencesList(Request $request, $idauditeur)
    {
        $auditeurAbsencesList = DB::select('CALL psAssiduite_ListAbsencesByAuditeur(?)', [$idauditeur]);
        return response()->json($auditeurAbsencesList);
    } //----------------------------------------------------------------------------------------


    public function devoirUeByIdEns(Request $request, $idparcours, $idregroupements, $idens)
    {
        $devoirUeByIdEns = DB::select('CALL psDevoir_UeByIdEns(?,?,?)', [$idparcours, $idregroupements, $idens]);
        return response()->json($devoirUeByIdEns);
    } //----------------------------------------------------------------------------------------


    public function ressourceDevoirsListByAuditeur(Request $request, $idauditeur, $limit)
    {
        $ressourceDevoirsListByAuditeur = DB::select('CALL psRessourceDevoirs_ListByAuditeur(?,?)', [$idauditeur, $limit]);
        return response()->json($ressourceDevoirsListByAuditeur);
    } //----------------------------------------------------------------------------------------
    public function ressourceListByAuditeur(Request $request, $idauditeur, $limit)
    {
        $ressourceListByAuditeur = DB::select('CALL psRessource_ListByAuditeur(?,?)', [$idauditeur, $limit]);
        return response()->json($ressourceListByAuditeur);
    } //----------------------------------------------------------------------------------------

    public function listUeByRegEns(Request $request, $idparcours, $idens)
    {
        $listUeByRegEns = DB::select('CALL psUeByIdEns_ListByParcours(?,?)', [$idparcours, $idens]);
        return response()->json($listUeByRegEns);
    } //----------------------------------------------------------------------------------------

    public function listCoursParEns(Request $request, $idparcours, $idregroupements, $idue, $idens)
    {
        $listCoursParEns = DB::select('CALL pscoursprogramme_ListByEns(?,?,?,?)', [$idparcours, $idregroupements, $idue, $idens]);
        return response()->json($listCoursParEns);
    } //----------------------------------------------------------------------------------------




    public function ressourcesInsert(Request $request)
    {
        $data = $request->all();

        DB::statement('CALL psRessouce_Insert(?,?,?,?,?,?,?,?,?,?,?,?)', [
            $data['id'],
            $data['idparcours'],
            $data['idregroupements'],
            $data['idue'],
            $data['typeressources'],
            $data['delai'] ?? null,
            null,
            $data['created_by'],
            null,
            $data['description'] ?? null,
            $data['lien'],
            $data['idens'],
        ]);


        $users = DB::select('CALL psAuditeurByIdreg(?)', [$data['idregroupements']]);

        $usersCollection = collect($users);

        $decryptedUsers = $usersCollection->map(function ($user) {
            $user->email = Crypt::decrypt($user->email);
            $user->tel = Crypt::decrypt($user->tel);

            return $user;
        });

        foreach ($decryptedUsers as $user) {
            try {
                Mail::to($user->email)->send(new RessourcesBulkMessageEmail($data['libelleTypeRessource'], $data['nomue'], $data['dateEmission'], $data['delai'] ?? null, $data['description']));
            } catch (\Exception $e) {
            }
        }

        $client = new Client();
        foreach ($decryptedUsers as $user) {
            try {
                $telephone = $user->tel;
                $delai = Carbon::parse($data['delai'])->format('d/m/Y');
                $client->post('https://app.techsoft-sms.com/api/v3/sms/send', [
                    'headers' => [
                        'Authorization' => 'Bearer 9|NTTkQIJROPURdSkXnEDSiviZjff8d0SQBFV3EK0w57228ea5',
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                    'json' => [
                        'recipient' => intval($telephone),
                        'sender_id' => 'ISMP',
                        'type' => 'plain',
                        'message' => "Nous vous informons qu'une nouvelle ressource a été ajoutée au cours " . $data['nomue'] . ". Le délai est fixé le " . $delai . ". Veuillez vous connecter à votre espace Auditeur pour plus de détails.",
                    ],
                ]);
            } catch (\Exception $e) {
            }
        }

        return response()->json(['success' => true]);
    }


    public function ressourcesAuditeurInsert(Request $request)
    {
        $data = $request->all();

        DB::statement('CALL psRessouceAudi_Insert(?,?,?,?,?,?,?,?,?,?,?)', [
            $data['id'],
            $data['idressource'],
            $data['idaudi'],
            $data['idens'],
            $data['idparcours'],
            $data['idregroupements'],
            $data['idue'],
            $data['user_update'],
            $data['delaidevoir'],
            $data['ip_update'],
            $data['description'],
        ]);
        return response()->json(['success' => true]);
    }


    public function uploadImageRessourceAudit(Request $request)
    {
        $image = $request->file('file');
        $resourceImageId = $request->input('id');
        $type = $request->input('type');

        if ($image && $resourceImageId) {
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->putFileAs('images', $image, $filename);

            $imagePath = 'images/' . $filename;

            DB::table('ressourceaudi')->where('id', $resourceImageId)->update(['nomfichier' => $filename, 'cheminfichier' => $imagePath]);


            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Échec de lupload de limage'], 400);
    }

    public function uploadImageRessource(Request $request)
    {
        $image = $request->file('file');
        $resourceImageId = $request->input('id');
        $type = $request->input('type');

        if ($image && $resourceImageId) {
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->putFileAs('images', $image, $filename);

            $imagePath = 'images/' . $filename;

            DB::table('ressource')->where('id', $resourceImageId)->update(['nomfichier' => $filename, 'cheminfichier' => $imagePath]);


            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Échec de lupload de limage'], 400);
    }

    public function ressourceUeCoursInsert(Request $request)
    {
        $data = $request->all();

        DB::statement('CALL psUeRessouce_Insert(?,?,?,?,?,?,?)', [
            $data['id'],
            $data['idressource'],
            $data['idparcours'],
            $data['idregroupements'],
            $data['idue'],
            $data['created_by'],
            $data['lien']
        ]);

        if (isset($data['ressources']) && is_array($data['ressources'])) {
            foreach ($data['ressources'] as $ressource) {

                DB::statement('CALL psCourRessouce_Insert(?,?,?,?,?,?,?,?)', [
                    $ressource['id'],
                    $ressource['idressource'],
                    $ressource['idparcours'],
                    $ressource['idregroupements'],
                    $ressource['courid'],
                    $ressource['idue'],
                    $ressource['created_by'],
                    $data['lien']
                ]);
            }
        }

        return response()->json(['success' => true]);
    }

    public function getImageRessource($nomfichier)
    {
        $resource = DB::table('ressource')
            ->select('cheminfichier')
            ->where('nomfichier', $nomfichier)
            ->first();

        if ($resource) {
            $imagePath = 'images/' . $resource->cheminfichier;

            if (Storage::disk('public')->exists($imagePath)) {
                $file = Storage::disk('public')->get($imagePath);
                $mimeType = Storage::disk('public')->mimeType($imagePath);

                return response($file)->header('Content-Type', $mimeType);
            } else {
                return response()->json(['success' => true]);
            }
        } else {
            return response()->json(['error' => 'Ressource introuvable'], 404);
        }
    }


    public function ressourceDelete(Request $request, $idressource, $userID)
    {
        DB::statement('CALL psRessource_Delete(?,?)', [$idressource, $userID]);
        return response()->json(['success' => true]);
    }



    public function telechargerFichier(Request $request)
    {
        $data = $request->all();

        if (file_exists($data['cheminfichier'])) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($data['cheminfichier']) . '"');
            header('Content-Length: ' . filesize($data['cheminfichier']));
            readfile($data['cheminfichier']);
            exit;
        }
    }

    public function courssListByEnseignant(Request $request, $idens)
    {
        $courssListByEnseignant = DB::select('CALL pscoursprogramme_ByEnsList(?)', [$idens]);
        return response()->json($courssListByEnseignant);
    }

    public function ressourceListByEnseignant(Request $request, $iduser)
    {
        $ressourceListByEnseignant = DB::select('CALL psRessouce_ListByEnseignant(?)', [$iduser]);
        return response()->json($ressourceListByEnseignant);
    }

    public function ressourceAudiListByEnseignant(Request $request, $idens)
    {
        $ressourceAudiListByEnseignant = DB::select('CALL psRessouceAudi_ListByEnseignant(?)', [$idens]);
        return response()->json($ressourceAudiListByEnseignant);
    }

    public function noteNonValideListByEnseignant(Request $request, $idens)
    {
        $noteNonValideListByEnseignant = DB::select('CALL psNote_Non_Valide_ListByEnseignant(?)', [$idens]);
        return response()->json($noteNonValideListByEnseignant);
    }
    public function tauxAssiduiteByCoursByEnseignant(Request $request, $idens)
    {
        $tauxAssiduiteByCoursByEnseignant = DB::select('CALL psTauxAssiduite_ByCoursByEnseignant(?)', [$idens]);
        return response()->json($tauxAssiduiteByCoursByEnseignant);
    }

    public function ressourceAuditListByEnseignant(Request $request, $idens)
    {
        $ressourceAuditListByEnseignant = DB::select('CALL psRessouceAudi_ListByEnseignant(?)', [$idens]);

        $auditeursCollection = new Collection($ressourceAuditListByEnseignant);

        $decryptedAuditeurs = $auditeursCollection->map(function ($auditeur) {
            $auditeur->nom = Crypt::decrypt($auditeur->nom);
            $auditeur->prenom = Crypt::decrypt($auditeur->prenom);

            return $auditeur;
        });

        return response()->json($decryptedAuditeurs);
    }

    public function saveProfil(Request $request)
    {
        $data = $request->all();

        DB::statement('CALL psUser_Update(?,?,?,?)', [
            $data['id'],
            $data['name'],
            $data['password'],
            $data['telephone'],
        ]);

        return response()->json(['success' => true]);
    }

    public function sendcodesms(Request $request)
    {
        $client = new Client();
        $telephone = $request->input('telephone');
        $code = mt_rand(100000, 999999);

        // Vérification de l'existence de l'utilisateur dans la table "users"
        $user = User::where('telephone', $telephone)->first();

        if (!$user) {
            $message = "numéro de téléphone érroné.";
            return response()->json([$message => true]);
        }
        // Enregistrement du code et de la date de validité dans la table "users"
        $user->codemail = $code;
        $user->datecodemail = now();
        $user->save();

        try {
            $response = $client->post('https://app.techsoft-sms.com/api/v3/sms/send', [
                'headers' => [
                    'Authorization' => 'Bearer 9|NTTkQIJROPURdSkXnEDSiviZjff8d0SQBFV3EK0w57228ea5',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'recipient' => intval($user->telephone),
                    'sender_id' => 'ISMP',
                    'type' => 'plain',
                    'message' => 'Votre code de vérification est : ' . $code,
                ],
            ]);
            // Traitez la réponse de la requête ici si nécessaire
        } catch (\Exception $e) {
            // Gérez l'erreur ici
            $message = "Une erreur s'est produite lors de l'envoi du message!";
            session()->flash('message', $message);
            return response()->json([$message => true]);
        }
        $message = "Un message viens d'etre envoyé a votre numero de téléphone";
        return response()->json([$message => true]);
    }

    public function auditeurBulletinByID(Request $request, $idparcours, $idreg, $idaudi)
    {
        $auditeurBulletinByID = DB::select('CALL psAuditeur_BulletinByID(?,?,?)', [$idparcours, $idreg, $idaudi]);

        $auditeursCollection = new Collection($auditeurBulletinByID);

        $decryptedAuditeurs = $auditeursCollection->map(function ($auditeur) {
            $auditeur->nom = Crypt::decrypt($auditeur->nom);
            $auditeur->prenom = Crypt::decrypt($auditeur->prenom);

            return $auditeur;
        });

        return response()->json($decryptedAuditeurs);
    } //----------------------------------------------------------------------------------------

}
