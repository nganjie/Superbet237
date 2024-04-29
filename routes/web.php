<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParamController;
use App\Http\Controllers\PeriodeAcaController;
use App\Http\Controllers\ParcoursAcaController;
use App\Http\Controllers\PromotionAcaController;
use App\Http\Controllers\RegroupementController;
use App\Http\Controllers\UeController;
use App\Http\Controllers\GueController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\AuditeurController;
use App\Http\Controllers\ScolariteController;
use App\Http\Controllers\VersementController;
use App\Http\Controllers\ProgrammationController;
use App\Http\Controllers\SoutenanceController;
use App\Http\Controllers\TypeSessionController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\DivisionCaController;
use App\Http\Controllers\UniteCaController;
use App\Http\Controllers\ExamenNoteController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ResultatController;
use App\Http\Controllers\CodeVerificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/slt', function () {
    return view('header');
});

Route::get('/home', function () {
    return view('module');
});

/* Route::get('/', function () {
    return view('auth.login');
}); */

Route::get('/', function () {
    return view('accueil');
});

Route::get('/flog', function () {
    return view('forgot_password');
});

Route::get('/setparam', function () {
    return view('set_param');
});

Route::get('/code', function () {
    return view('codeconnexion');
})->name('code');

Route::get('/verif', function () {
    return view('verification');
})->name('verif');

Route::get('/sms', function () {
    return view('smsconnexion');
})->name('sms');

Route::get('/verifsms', function () {
    return view('verificationsms');
})->name('verifsms');

Route::get('/reset_password', function () {
    return view('reset_password');
})->name('reset_password');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('examennote_noter_audit_Insert', [ExamenNoteController::class, 'storenoter'])->name('examennote_noter_audit_Insert');
Route::get('get_evanoteexaa', [ExamenNoteController::class, 'getevanoteexaa'])->name('get_evanoteexaa');
Route::post('examennote_anonymat_audit_Insert', [ExamenNoteController::class, 'storenote'])->name('examennote_anonymat_audit_Insert');
Route::get('/examennote',[ExamenNoteController::class, 'getParamexanote'], function () {
    return view('examennote');
})->name('examennote');



Route::post('evaluation_note_Insert', [EvaluationController::class, 'storenote'])->name('evaluation_note_Insert');
Route::post('evaluation_Insert', [EvaluationController::class, 'store'])->name('evaluation_Insert');
Route::get('get_evanote', [EvaluationController::class, 'getevanote'])->name('get_evanote');
Route::post('evaluation_Insert', [EvaluationController::class, 'store'])->name('evaluation_Insert');
Route::get('/evaluation',[EvaluationController::class, 'getParamnote'], function () {
    return view('evaluation');
})->name('evaluation');

Route::post('/userlogin', [UserController::class, 'login'])->name('userlogin');
Route::post('/user_List', [UserController::class, 'users'])->name('user_List');
Route::post('/user_Destroy', [UserController::class, 'destroy'])->name('user_Destroy');
Route::post('/user_Insert', [UserController::class, 'store'])->name('user_Insert');
Route::post('usergroupe_Insert', [UserController::class, 'storeug'])->name('usergroupe_Insert');
Route::post('userprofile_Insert', [UserController::class, 'storeup'])->name('userprofile_Insert');
Route::get('user', [UserController::class, 'getParamuser'])->name('user');


Route::post('grouperole_Insert_', [GroupeController::class, 'storerg'])->name('grouperole_Insert_');
Route::post('groupe_Insert', [GroupeController::class, 'store'])->name('groupe_Insert');
Route::post('groupe_Delete', [GroupeController::class, 'destroy'])->name('groupe_Delete');
Route::post('rolegroupe_Delete', [GroupeController::class, 'destroygroupe'])->name('rolegroupe_Delete');
Route::get('groupe', [GroupeController::class, 'getParamgroupe'])->name('groupe');
Route::get('/get_rolegroupe', [GroupeController::class, 'getrolegroupe'])->name('get_rolegroupe');

Route::post('rolegroupe_Insert_', [RoleController::class, 'storerg'])->name('rolegroupe_Insert_');
Route::post('role_Insert', [RoleController::class, 'store'])->name('role_Insert');
Route::post('role_Delete', [RoleController::class, 'destroy'])->name('role_Delete');
Route::post('grouperole_Delete', [RoleController::class, 'destroygroupe'])->name('grouperole_Delete');
Route::get('role', [RoleController::class, 'getParamrole'])->name('role');
Route::get('/get_grouperole', [RoleController::class, 'getgrouperole'])->name('get_grouperole');

Route::get('set_param', [ParamController::class, 'setParam'])->name('set_param');

//route AccueilAmin
Route::get('AccueilAdmin',[ParamController::class, 'getParamValue'], function () {
    return view('AccueilAdmin');
})->name('AccueilAdmin');

//route AccueilAmin
Route::get('AccueilAdmin',[ParamController::class, 'getParamValue'], function () {
    return view('AccueilAdmin');
})->name('AccueilAdmin');



Route::get('/periodeAca',[PeriodeAcaController::class, 'periodes'], function () {
    return view('periodeAca');
})->name('periodeAca');

Route::get('/parcoursAca',[ParcoursAcaController::class, 'getParamparc'], function () {
    return view('parcoursAca');
})->name('parcoursAca');



Route::get('/promotionAca',[PromotionAcaController::class, 'getParampromo'], function () {
    return view('promotionAca');
})->name('promotionAca');






//periodes
/* liste des  periodes par organisation */
Route::post('/periodesorg', [PeriodeAcaController::class, 'periodes'])->name('periodesorg');
/* Insertion et modification des périodes */
Route::post('/periodes_Insert', [periodeAcaController::class, 'store'])->name('periodes_Insert');
/* suppression des periodes */
Route::post('/periodes_Delete', [PeriodeAcaController::class, 'destroy'])->name('periodes_Delete');
/* supprimer plusieurs périodes */
Route::match(['GET', 'POST'],'/periodes_Deletem', [PeriodeAcaController::class, 'destroyp'])->name('periodes_Deletem');


//Parcours
/* liste des  parcours par organisation */
Route::post('/parcours_List', [ParcoursAcaController::class, 'parcours'])->name('parcours_List');
/* Insertion et modification des parcours */
Route::post('/parcours_Insert', [ParcoursAcaController::class, 'store'])->name('parcours_Insert');
/* suppression des parcours */
Route::post('/parcours_Delete', [ParcoursAcaController::class, 'destroy'])->name('parcours_Delete');
Route::match(['GET','POST'],'/parcours_Deletem', [ParcoursAcaController::class, 'destroyp'])->name('parcours_Deletem');
Route::post('/promotionsparcours_Delete', [ParcoursAcaController::class, 'destroypromoparc'])->name('promotionsparcours_Delete');
Route::get('/get-periodes-aca', [ParcoursAcaController::class, 'getPeriodesAca'])->name('get-periodes-aca');
Route::get('/get-parcous-aca', [ParcoursAcaController::class, 'getParcoursAca'])->name('get-parcours-aca');



//promotions académiques
/* liste des  protions par organisation */

Route::post('/promotions_List', [PromotionAcaController::class, 'promotions'])->name('promotions_List');
/* Insertion et modification des promotions */
Route::post('/promotions_Insert', [PromotionAcaController::class, 'store'])->name('promotions_Insert');

/* suppression des promotions */
Route::post('/promotions_Delete', [PromotionAcaController::class, 'destroypromo'])->name('promotions_Delete');
Route::match(['GET','POST'],'/promo_Deletem', [PromotionAcaController::class, 'destroyp'])->name('promo_Deletem');
Route::post('/gueparcours_Delete', [ParcoursAcaController::class, 'destroygue'])->name('gueparcours_Delete');
Route::get('/get-periodes-aca', [ParcoursAcaController::class, 'getPeriodesAca'])->name('get-periodes-aca');
Route::get('/get-parcours-acap', [ParcoursAcaController::class, 'getParcoursAcap'])->name('get-parcours-acap');
Route::get('/get-regrou-acap', [ParcoursAcaController::class, 'getregroupe'])->name('get-regrou-acap');
Route::get('/get-ue', [ParcoursAcaController::class, 'getEnsUe'])->name('get-ue');
Route::get('/get-gue-acap', [ParcoursAcaController::class, 'getgue'])->name('get-gue-acap');
Route::get('/get-ue-acap', [ParcoursAcaController::class, 'getue'])->name('get-ue-acap');


Route::post('/promotionparcours_Insert', [PromotionAcaController::class, 'storepp'])->name('promotionparcours_Insert');
Route::post('/promotionparcoursm_Insert', [PromotionAcaController::class, 'storeppm'])->name('promotionparcoursm_Insert');
Route::get('/get_promotionsparc', [ParcoursAcaController::class, 'getpromotionParcoursAcap'])->name('get_promotionsparc');
Route::get('/get_gueparc', [ParcoursAcaController::class, 'getgueParcoursAcap'])->name('get_gueparc');








//promotions académiques
/* liste des  protions par organisation */

Route::post('/regroupement_List', [RegroupementController::class, 'regroupements'])->name('regroupement_List');
/* Insertion et modification des promotions */
Route::post('/regroupement_Insert', [RegroupementController::class, 'store'])->name('regroupement_Insert');
Route::post('/regroupementparcours', [RegroupementController::class, 'storerp'])->name('regroupementparcours');

/* suppression des promotions */
Route::post('/regroupement_Delete', [RegroupementController::class, 'destroy'])->name('regroupement_Delete');
Route::match(['GET','POST'],'/regrou_Deletem', [RegroupementController::class, 'destroyp'])->name('regrou_Deletem');
Route::post('/auditeur_regroupement_Delete', [RegroupementController::class, 'destroy_audi'])->name('auditeur_regroupement_Delete');
Route::get('/get-parcours-aca', [RegroupementController::class, 'getParcoursAca'])->name('get-parcours-aca');
Route::get('/get_regauditeur', [RegroupementController::class, 'getauditeur'])->name('get_regauditeur');
Route::get('/get_regauditeuranonyme', [RegroupementController::class, 'getauditeuranonyme'])->name('get_regauditeuranonyme');
Route::get('/get_regparcours', [RegroupementController::class, 'getparcours'])->name('get_regparcours');
Route::get('/regroupement',[RegroupementController::class, 'getParamregrou'], function () {
    return view('regroupement');
})->name('regroupement');

Route::get('/get-periodes-acareg', [ParcoursAcaController::class, 'getPeriodesAca'::class, 'getPeriodesAcareg'])->name('get-periodes-acareg');
Route::get('/get-parcous-acareg', [ParcoursAcaController::class, 'getParcoursAca'])->name('get-parcous-acareg');




//unité d'enseignements
/* liste des  protions par organisation */

Route::post('/ue_List', [UeController::class, 'ue'])->name('ue_List');
/* Insertion et modification des promotions */
Route::post('/ue_Insert', [UeController::class, 'store'])->name('ue_Insert');
Route::post('/gueue_Insert', [UeController::class, 'storegu'])->name('gueue_Insert');

Route::post('/ueparcours_Insert', [UeController::class, 'storepu'])->name('ueparcours_Insert');

/* suppression des promotions */
Route::post('/ue_Delete', [UeController::class, 'destroy'])->name('ue_Delete');
Route::get('/ue',[UeController::class, 'getParamue'], function () {
    return view('ue');
})->name('ue');


//unité d'enseignements
/* liste des  protions par organisation */

Route::post('/gue_List', [GueController::class, 'gue'])->name('gue_List');
/* Insertion et modification des promotions */
Route::post('/gue_Insert', [GueController::class, 'store'])->name('gue_Insert');
Route::post('/parcoursgue_Insert', [GueController::class, 'storepg'])->name('parcoursgue_Insert');
/* suppression des promotions */
Route::post('/gue_Delete', [GueController::class, 'destroy'])->name('gue_Delete');
Route::get('/gue',[GueController::class, 'getParamgue'], function () {
    return view('gue');
})->name('gue');
Route::get('/get_uebygue', [GueController::class, 'getuebygue'])->name('get_uebygue');
Route::post('/ue_gue_Delete', [GueController::class, 'destroyue'])->name('ue_gue_Delete');



//Enseignant
/* liste des  protions par organisation */

Route::post('/enseignant_List', [EnseignantController::class, 'enseignant'])->name('enseignant_List');
/* Insertion et modification des promotions */
Route::post('/enseignant_Insert', [EnseignantController::class, 'store'])->name('enseignant_Insert');
Route::post('/ueenseignant_Insert', [EnseignantController::class, 'storeensue'])->name('ueenseignant_Insert');
/* suppression des promotions */
Route::post('/enseignant_Delete', [EnseignantController::class, 'destroy'])->name('enseignant_Delete');
Route::get('/enseignant',[EnseignantController::class, 'getParamens'], function () {
    return view('enseignant');
})->name('enseignant');
Route::get('/get_uebyens', [EnseignantController::class, 'getuebyens'])->name('get_uebyens');
Route::post('/ue_ens_Delete', [EnseignantController::class, 'destroyue'])->name('ue_ens_Delete');


//Auditeur
/* liste des  protions par organisation */

Route::post('/auditeur_List', [AuditeurController::class, 'auditeur'])->name('auditeur_List');
/* Insertion et modification des promotions */
Route::post('/auditeur_Insert', [AuditeurController::class, 'store'])->name('auditeur_Insert');
Route::post('/auditeurregrou_Insert', [AuditeurController::class, 'storeag'])->name('auditeurregrou_Insert');
Route::post('/auditeurregrou_Insertm', [AuditeurController::class, 'storeagp'])->name('auditeurregrou_Insertm');
/* suppression des promotions */
Route::post('/auditeur_Delete', [AuditeurController::class, 'destroy'])->name('auditeur_Delete');
Route::get('/auditeur',[AuditeurController::class, 'getParamraudi'], function () {
    return view('auditeur');
})->name('auditeur');


//Soutenance
/* liste des  protions par organisation */

Route::post('/soutenance_List', [SoutenanceController::class, 'soutenance'])->name('soutenance_List');
/* Insertion et modification des promotions */
Route::post('/soutenance_Insert', [SoutenanceController::class, 'store'])->name('soutenance_Insert');
/* suppression des promotions */
Route::post('/soutenance_Delete', [SoutenanceController::class, 'destroy'])->name('soutenance_Delete');
Route::get('/soutenance',[SoutenanceController::class, 'getParamsou'], function () {
    return view('soutenance');
})->name('soutenance');

//Scolarite
/* liste des  protions par organisation */
Route::post('/scolarite_List', [ScolariteController::class, 'auditeur'])->name('scolarite_List');
/* Insertion et modification des promotions */
Route::post('/scolarite_Insert', [ScolariteController::class, 'store'])->name('scolarite_Insert');
/* suppression des promotions */
Route::post('/scolarite_Delete', [ScolariteController::class, 'destroy'])->name('scolarite_Delete');
Route::get('/scolarite',[ScolariteController::class, 'getParamsco'], function () {
    return view('scolarite');
})->name('scolarite');
Route::get('/etatsco', [ScolariteController::class, 'sco'])->name('etatsco');


//Versements qui est devenu frais de scolarite
/* liste des  protions par organisation */

Route::post('/versement_List', [VersementController::class, 'versement'])->name('versement_List');
/* Insertion et modification des promotions */
Route::post('/versement_Insert', [VersementController::class, 'store'])->name('versement_Insert');
/* suppression des promotions */
Route::post('/versement_Delete', [VersementController::class, 'destroy'])->name('versement_Delete');
Route::get('/versement',[VersementController::class, 'getParamvers'], function () {
    return view('versement');
})->name('versement');


//programmation
Route::post('/programmation_List', [ProgrammationController::class, 'programmation'])->name('programmation_List');
/* Insertion et modification des promotions */
Route::post('/programmation_Insert', [ProgrammationController::class, 'store'])->name('programmation_Insert');
/* suppression des promotions */
Route::post('/programmation_Delete', [ProgrammationController::class, 'destroy'])->name('programmation_Delete');
Route::get('/programmation',[ProgrammationController::class, 'getParampro'], function () {
    return view('programmation');
})->name('programmation');

//Session

Route::post('/session_List', [SessionController::class, 'soutenance'])->name('session_List');
/* Insertion et modification des promotions */
Route::post('/session_Insert', [SessionController::class, 'store'])->name('session_Insert');
/* suppression des promotions */
Route::post('/session_Delete', [SessionController::class, 'destroy'])->name('session_Delete');
Route::get('/session',[SessionController::class, 'getParamsess'], function () {
    return view('session');
})->name('session');


//Session

Route::post('/typesession_List', [TypeSessionController::class, 'soutenance'])->name('typesession_List');
/* Insertion et modification des promotions */
Route::post('/typesession_Insert', [TypeSessionController::class, 'store'])->name('typesession_Insert');
/* suppression des promotions */
Route::post('/typesession_Delete', [TypeSessionController::class, 'destroy'])->name('typesession_Delete');
Route::get('/typesession',[TypeSessionController::class, 'getParamtypsess'], function () {
    return view('typesession');
})->name('typesession');

//Unite calendaire

Route::post('/uniteca_List', [UniteCaController::class, 'soutenance'])->name('typesession_List');
/* Insertion et modification des promotions */
Route::post('/uniteca_Insert', [UniteCaController::class, 'store'])->name('uniteca_Insert');
/* suppression des promotions */
Route::post('/uniteca_Delete', [UniteCaController::class, 'destroy'])->name('uniteca_Delete');
Route::get('/uniteca',[UniteCaController::class, 'getParamuc'], function () {
    return view('uniteca');
})->name('uniteca');

//Division calendaire

Route::post('/divisionca_List', [DivisionCaController::class, 'soutenance'])->name('divisionca_List');
/* Insertion et modification des promotions */
Route::post('/divisionca_Insert', [DivisionCaController::class, 'store'])->name('divisionca_Insert');
/* suppression des promotions */
Route::post('/divisionca_Delete', [DivisionCaController::class, 'destroy'])->name('divisionca_Delete');
Route::get('/divisionca',[DivisionCaController::class, 'getParamdc'], function () {
    return view('divisionca');
})->name('divisionca');




Route::get('/get_promotiondelaperiode', [PeriodeAcaController::class, 'getpromo'])->name('get_promotiondelaperiode');
Route::get('/get_parcoursdelaperiode', [PeriodeAcaController::class, 'getparcours'])->name('get_parcoursdelaperiode');
Route::get('/get_regroupementdelaperiode', [PeriodeAcaController::class, 'getregroupements'])->name('get_regroupementdelaperiode');
Route::get('/get_auditeurdelaperiode', [PeriodeAcaController::class, 'getauditeurs'])->name('get_auditeurdelaperiode');
Route::get('/get_enseignantdelaperiode', [PeriodeAcaController::class, 'getenseignants'])->name('get_enseignantdelaperiode');
Route::get('/get_matieredelaperiode', [PeriodeAcaController::class, 'getmatieres'])->name('get_matieredelaperiode');
Route::get('/get_divisiondelaperiode', [PeriodeAcaController::class, 'getdivisions'])->name('get_divisiondelaperiode');

Route::get('/get_auditeurduparcours', [ParcoursAcaController::class, 'getaudi'])->name('get_auditeurduparcours');
Route::get('/get_regroupementduparcours', [ParcoursAcaController::class, 'getreg'])->name('get_regroupementduparcours');

Route::get('/get_enseigantdelue', [UeController::class, 'getens'])->name('get_enseigantdelue');
Route::get('/get_parcoursdelue', [UeController::class, 'getparc'])->name('get_parcoursdelue');

Route::get('/auditeurregroupdf', [PDFController::class, 'getauditeurreg'])->name('auditeurregroupdf');
Route::get('/imprimerauditeurregroupdf', [PDFController::class, 'imprimerauditeurreg'])->name('imprimerauditeurregroupdf');
Route::get('/genererpdf', [PDFController::class, 'getresultattravailgroupe'])->name('genererpdf');
Route::get('/imprimerpdf', [PDFController::class, 'imprimerresultattravailgroupe'])->name('imprimerpdf');

Route::get('/resultat',[ResultatController::class, 'getParamre'], function () {
    return view('resultat');
})->name('resultat');
Route::post('/getresultat', [ResultatController::class, 'getresultat'])->name('getresultat');


Route::post('/audimail', [AuditeurController::class, 'sendMail'])->name('audimail');
Route::post('/ensmail', [EnseignantController::class, 'sendMail'])->name('ensmail');

Route::post('/verification', [CodeVerificationController::class, 'sendcodemail'])->name('verification');
Route::post('/verificationretour', [CodeVerificationController::class, 'confirmcodemail'])->name('verificationretour');

Route::post('/verificationsms', [CodeVerificationController::class, 'confirmcodesms'])->name('verificationsms');
Route::post('/verificationcodesms', [CodeVerificationController::class, 'sendcodesms'])->name('verificationcodesms');