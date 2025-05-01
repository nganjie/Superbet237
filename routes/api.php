<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAPIController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\PDFController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/slt', function (Request $request) {
    return $request->slt();
});

//Login Route
Route::post('login', [UserAPIController::class, 'login'])->name('login');
Route::post('changePassword', [UserAPIController::class, 'changePassword'])->name('changePassword');
Route::post('loginAndroid', [UserAPIController::class, 'loginAndroid'])->name('loginAndroid');
Route::post('loginByCode', [UserAPIController::class, 'loginByCode'])->name('loginByCode');


/* KENO API */

Route::get('kenologin/{email}/{password}', [UserAPIController::class, 'kenologin']);
Route::get('organisationList/{organisationID}', [APIController::class, 'organisationList']);
Route::get('salleList/{organisationID}', [APIController::class, 'salleList']);



Route::post('organisationInsert', [APIController::class, 'organisationInsert'])->name('organisationInsert');
Route::post('salleInsert', [APIController::class, 'salleInsert'])->name('salleInsert');
Route::post('paramSalleInsert', [APIController::class, 'paramSalleInsert'])->name('paramSalleInsert');


Route::post('insertMise', [APIController::class, 'insertMise'])->name('insertMise');

/* ************************************* 31/05/2024 ********************************************* */

Route::post('tirageInsert', [APIController::class, 'tirageInsert'])->name('tirageInsert');

Route::get('algoD/{code_salle}/{tirageID}', [APIController::class, 'algorithmeDistribution']);
Route::get('dernierstirages/{code_salle}', [APIController::class, 'dernierstirages']);
Route::get('bouleslesplustirees/{code_salle}', [APIController::class, 'bouleslesplustirees']);
Route::get('bouleslesmoinstirees/{code_salle}', [APIController::class, 'bouleslesmoinstirees']);
Route::get('derniersmultiplicateurs/{code_salle}', [APIController::class, 'derniersmultiplicateurs']);
Route::get('cycleMouvement/{organisationID}/{code_salle}', [APIController::class, 'cycleMouvement']);
Route::get('salleSynchUpdate/{code_salle}', [APIController::class, 'salleSynchUpdate']);
Route::get('synchro/{code_salle}', [APIController::class, 'synchro']);
Route::get('repAlgoList/{code_salle}', [APIController::class, 'repAlgoList']);
// Route::get('entetecaisse/{code_salle}', [APIController::class, 'entetecaisse']);

/* ************************************* 31/05/2024 ********************************************* */


/* ************************************* 01/06/2024 ********************************************* */
Route::get('caisseList/{organisationID}', [APIController::class, 'caisseList']);
Route::get('operationList/{code_salle}', [APIController::class, 'operationList']);
Route::post('insertOperation', [APIController::class, 'insertOperation'])->name('insertOperation');

/* ************************************* 01/06/2024 ********************************************* */


/* ************************************* 02/06/2024 ********************************************* */
Route::get('verifieTicket/{codebarre}/{code_salle}', [APIController::class, 'verifieTicket']);
Route::get('tirage/{code_salle}/{dateDebut}/{heureDebut}', [APIController::class, 'tirage']);
Route::post('payer', [APIController::class, 'payer'])->name('payer');

/* ************************************* 02/06/2024 ********************************************* */


/* ************************************* 04/06/2024 ********************************************* */
Route::get('userList/{organisationID}/{userID}', [APIController::class, 'userList']);
Route::post('userInsert', [APIController::class, 'userInsert'])->name('userInsert');
Route::post('ticketList', [APIController::class, 'ticketList'])->name('ticketList');
/* ************************************* 04/06/2024 ********************************************* */

/* ************************************* 05/06/2024 ********************************************* */
Route::get('userActive/{userID}/{action}', [APIController::class, 'userActive']);
/* ************************************* 05/06/2024 ********************************************* */

/* ************************************* 23/06/2024 ********************************************* */
Route::get('enteteCaisse/{code_salle}', [APIController::class, 'enteteCaisse']);
Route::get('tirages/{organisationID}/{code_salle}', [APIController::class, 'tirages']);
/* ************************************* 23/06/2024 ********************************************* */

Route::get('message', [APIController::class, 'onMessage']);



Route::get('jeuxLogin/{cle}', [APIController::class, 'jeuxLogin']);
Route::get('jeuxAcces/{token}', [APIController::class, 'jeuxAcces']);
Route::get('jeuxLogout/{token}', [APIController::class, 'jeuxLogout']);

/* Route::post('/send-data2', [APIController::class, 'sendData']);

Route::post('/send-data', [APIController::class, 'onMessage']); */




















//API Controller
Route::get('cours', [APIController::class, 'getAllCoursesAPI'])->name('cours');
Route::get('coursListByAuditeur/{id}', [APIController::class, 'getAllCoursesByAuditeurAPI'])->name('cours');

Route::get('sessions', [APIController::class, 'getAllSessionAPI']);
Route::get('periodesAcademique', [APIController::class, 'getAllPeriodeAcademiqueAPI']);



Route::get('parcoursAcademique/{idperio}', [APIController::class, 'getAllParcoursAcademiqueAPI']);
Route::get('promotionByParc/{idparc}', [APIController::class, 'getAllPromotionByParcAPI']);
Route::get('regroupementListByPerio/{idperio}', [APIController::class, 'getRegroupementListByPerioAPI']);
Route::get('divisionCalendaire', [APIController::class, 'getDivisionCalendaireAPI']);
Route::get('uniteEnseignement', [APIController::class, 'getUniteEnseignementAPI']);
Route::get('notations', [APIController::class, 'getNotationListAPI']);
Route::get('ueListByParcours/{idp}', [APIController::class, 'getUniteEnseignementListByParcoursAPI']);
Route::get('enseignantListByPeriod/{idperio}', [APIController::class, 'getEnseignantByPeriodAPI']);
Route::get('enseignantListByUe/{idue}', [APIController::class, 'getEnseignantByUeAPI']);
Route::get('auditeursListByRegroupement/{idere}', [APIController::class, 'getAuditeurListByRegroupementAPI']);
Route::get('sallesList', [APIController::class, 'getSallesListAPI']);
Route::get('notationSessionList/{anneAccademiqueID}/{parcourAccademiqueID}/{coursID}', [APIController::class, 'getNotationSessionList']);
Route::get('notationSessionListByCour/{courID}', [APIController::class, 'getNotationSessionListByCour']);
Route::get('ficheGroupeList/{idfichegroupe}', [APIController::class, 'getFicheGroupeList']);
Route::get('ficheCriteresByGroupe_List/{idfichegroupe}', [APIController::class, 'getFicheCriteresByGroupeList']);
Route::get('ficheCriteresList', [APIController::class, 'getFicheCriteresList']);
Route::get('coursProgrammeListeByRegroupement/{idparcours}/{idregroupements}/{idue}', [APIController::class, 'getCoursProgrammeListeByRegroupement']);
Route::get('sessionAllow/{idperiode}', [APIController::class, 'getSessionAllow']);
Route::get('ueListProgramme/{idparcours}/{idregroupements}', [APIController::class, 'getUeListProgramme']);
Route::get('auditeursNotesList/{idreg}/{idue}/{idsession}', [APIController::class, 'getAuditeursNotesList']);
Route::get('auditeursNotesListDefinitive/{idreg}/{idue}', [APIController::class, 'getAuditeursNotesListDefinitive']);
Route::get('ueListProgEns/{idenseignant}/{idregroupements}', [APIController::class, 'ueListProgEns']);
Route::get('auditeursListByCp/{idparcours}/{idregroupements}/{idcp}', [APIController::class, 'auditeursListByCp']);
Route::get('ressourceList/{idparcours}/{idregroupements}/{idue}', [APIController::class, 'getRessourceList']);
Route::get('listeAuditeursAnonymes/{idreg}/{idue}/{idsession}', [APIController::class, 'listeAuditeursAnonymes']);
Route::get('coursProgrammeListByAuditeur/{idauditeur}/{limit}', [APIController::class, 'coursProgrammeListByAuditeur']);
Route::get('auditeurNotesPersoList/{idauditeur}/{limit}', [APIController::class, 'auditeurNotesPersoList']);
Route::get('auditeurAbsencesList/{idauditeur}', [APIController::class, 'auditeurAbsencesList']);
Route::get('coursEvaluabiliteList/{idparcours}', [APIController::class, 'coursEvaluabiliteList']);
Route::get('etatScolarite/{idaudi}/{idreg}', [APIController::class, 'etatScolarite']);
Route::get('auditeursListAnonimat/{idreg}/{idue}/{idsession}', [APIController::class, 'auditeursListAnonimat']);
Route::get('soutenanceListByAuditeur/{idauditeur}', [APIController::class, 'soutenanceListByAuditeur']);
Route::get('courEvaluationSynthese/{idregroupement}/{idue}', [APIController::class, 'courEvaluationSynthese']);
Route::get('getImageRessource/{nomfichier}/images', [APIController::class, 'getImageRessource']);
Route::get('ressourceDevoirsListByAuditeur/{idauditeur}/{limit}', [APIController::class, 'ressourceDevoirsListByAuditeur']);
Route::get('ressourceListByAuditeur/{idauditeur}/{limit}', [APIController::class, 'ressourceListByAuditeur']);
Route::get('devoirUeByIdEns/{idparcours}/{idregroupements}/{idens}', [APIController::class, 'devoirUeByIdEns']);
Route::get('listUeByRegEns/{idparcours}/{idens}', [APIController::class, 'listUeByRegEns']);
Route::get('listCoursParEns/{idparcours}/{idregroupements}/{idue}/{idens}', [APIController::class, 'listCoursParEns']);
Route::get('regroupementListByParcours/{idparcours}', [APIController::class, 'getRegroupementListByParcours']);
Route::get('auditeursNotesListDefinitive/{idreg}/{idue}', [APIController::class, 'getAuditeursNotesListDefinitive']);
Route::get('ressourceDelete/{idressource}/{userID}', [APIController::class, 'ressourceDelete']);
Route::get('ressourceListByEnseignant/{iduser}', [APIController::class, 'ressourceListByEnseignant']);
Route::get('ressourceAudiListByEnseignant/{idens}', [APIController::class, 'ressourceAudiListByEnseignant']);
Route::get('courssListByEnseignant/{idens}', [APIController::class, 'courssListByEnseignant']);
Route::get('noteNonValideListByEnseignant/{idens}', [APIController::class, 'noteNonValideListByEnseignant']);
Route::get('tauxAssiduiteByCoursByEnseignant/{idens}', [APIController::class, 'tauxAssiduiteByCoursByEnseignant']);
Route::get('coursEvaluabiliteListDernier/{l}', [APIController::class, 'coursEvaluabiliteListDernier']);
Route::get('coursEvaluationSyntheseDernier/{l}', [APIController::class, 'coursEvaluationSyntheseDernier']);
Route::get('soutenanceEtatByEns/{idens}', [APIController::class, 'soutenanceEtatByEns']);
Route::get('soutenanceListByEns/{idens}', [APIController::class, 'soutenanceListByEns']);
Route::get('ressourceAuditListByEnseignant/{idens}', [APIController::class, 'ressourceAuditListByEnseignant']);
Route::get('testConnexion', [APIController::class, 'testConnexion']);
Route::get('fichePresence1', [PDFController::class, 'fichePresence1']);


Route::get('auditeurBulletinByID/{idparcours}/{idreg}/{idaudi}', [APIController::class, 'auditeurBulletinByID']);




Route::post('coursProgrammeInsert', [APIController::class, 'insertCoursProgramme'])->name('insertCoursProgramme');
Route::post('bulletinAuditeur', [PDFController::class, 'bulletinAuditeur'])->name('bulletinAuditeur');

Route::post('deleteCoursProgramme', [APIController::class, 'deleteCoursProgramme'])->name('deleteCoursProgramme');
Route::post('annulerCoursProgramme', [APIController::class, 'annulerCoursProgramme']);
Route::post('reporterCoursProgramme', [APIController::class, 'reporterCoursProgramme']);
Route::post('coursProgrammeList', [APIController::class, 'coursProgrammeList'])->name('coursProgrammeList');
Route::post('notationInsert', [APIController::class, 'notationInsert']);
Route::post('notationSessionCourInsert', [APIController::class, 'notationSessionCourInsert'])->name('notationSessionCourInsert');
Route::post('deleteCoursProgrammeUE', [APIController::class, 'deleteCoursProgrammeUE'])->name('deleteCoursProgrammeUE');
Route::post('noteUEInsert', [APIController::class, 'noteUEInsert'])->name('noteUEInsert');
Route::post('noteUEDefinitiveInsert', [APIController::class, 'noteUEDefinitiveInsert'])->name('noteUEDefinitiveInsert

');
Route::post('coursEvaluationInsert', [APIController::class, 'coursEvaluationInsert'])->name('coursEvaluationInsert');
Route::post('assiduiteInsert', [APIController::class, 'assiduiteInsert'])->name('assiduiteInsert');
Route::post('assiduitePointage', [APIController::class, 'assiduitePointage'])->name('assiduitePointage');
Route::post('ressourcesInsert', [APIController::class, 'ressourcesInsert'])->name('ressourcesInsert');
Route::post('ressourceAuditeurInsert', [APIController::class, 'ressourcesAuditeurInsert'])->name('ressourcesAuditeurInsert');
Route::post('uploadImageRessource', [APIController::class, 'uploadImageRessource'])->name('uploadImageRessource');
Route::post('uploadImageRessourceAudit', [APIController::class, 'uploadImageRessourceAudit'])->name('uploadImageRessourceAudit');
Route::post('ressourceUeCoursInsert', [APIController::class, 'ressourceUeCoursInsert'])->name('ressourceUeCoursInsert');
Route::post('genererAnonymat', [APIController::class, 'genererAnonymat'])->name('genererAnonymat');
Route::post('saveNoteAnonymes', [APIController::class, 'saveNoteAnonymes'])->name('saveNoteAnonymes');
Route::post('coursEvaluabiliteInsert', [APIController::class, 'coursEvaluabiliteInsert'])->name('coursEvaluabiliteInsert');
Route::post('affecterEnseignant', [APIController::class, 'affecterEnseignant'])->name('affecterEnseignant');
Route::post('resetPassword', [APIController::class, 'resetPassword'])->name('resetPassword');
Route::post('verifyCodeReset', [APIController::class, 'verifyCodeReset'])->name('verifyCodeReset');
Route::post('telechargerFichier', [APIController::class, 'telechargerFichier'])->name('telechargerFichier');
Route::post('noteUEDefinitiveInsert', [APIController::class, 'noteUEDefinitiveInsert'])->name('noteUEDefinitiveInsert');
Route::post('sendBulkMessage', [APIController::class, 'sendBulkMessage'])->name('sendBulkMessage');
Route::post('saveProfil', [APIController::class, 'saveProfil'])->name('saveProfil');
Route::post('sendcodesms', [APIController::class, 'sendcodesms'])->name('sendcodesms');
Route::post('coursProgrammeValider', [APIController::class, 'coursProgrammeValider'])->name('coursProgrammeValider');

Route::post('tikestsBySalle', [APIController::class, 'tikestsBySalle'])->name('tikestsBySalle');
Route::get('tiragesBySalle/{organisationID}/{code_salle}', [APIController::class, 'tiragesBySalle']);
Route::get('tikestsBySalle', [APIController::class, 'tikestsBySalle']);
Route::get('cyclesBySalle/{organisationID}/{code_salle}', [APIController::class, 'cyclesBySalle']);













Route::post('sendSMS', [APIController::class, 'sendSMS'])->name('sendSMS');