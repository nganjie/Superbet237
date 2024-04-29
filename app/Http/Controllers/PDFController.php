<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Crypt;


class PDFController extends Controller
{
   

public function getresultattravailgroupe(Request $request)
{
    $codeorg = $request->query('codeorg');
    $idperio = $request->query('idperio');
    $idparc = $request->query('idparc');
    $idre = $request->query('idre');
    $idgue = $request->query('idgue');
    $idue = $request->query('idue');
    
   // Exécutez la procédure stockée pour récupérer les données
   $results = DB::select('CALL psResultatFinal(?,?,?,?,?,?)',[ $codeorg,$idperio,$idparc,$idre,$idgue,$idue]);

    // Chemin de l'image
  $imagePath = public_path('imagesmod/logologin.jpg');

  // Encodage de l'image en base64
  $imageData = base64_encode(file_get_contents($imagePath));

  // Génération du contenu HTML avec les lignes et l'image
  $html = '<table style="width: 100%; border-collapse: collapse;">';
  $html .= '<tr>';
  $html .= '<td style="vertical-align: middle;width: 250px;"><img src="data:image/jpeg;base64,' . $imageData . '" alt="Image" style="width: 250px; height: 150px;"></td>';
  $html .= '<td>';
  $html .= '<h4 style="margin-left: 6%;">MASTER PROFESSIONNEL EN MANAGEMENT PUBLIC</h4>';
  $html .= '<p style="margin-left: 5%;"><b>Procès verbal des resultats partiels du 3ème semestre(2018-2020)</b></p>';
  $html .= '<h5 style="margin-left: 13%;">Option: Management Des Organisations Publiques</h5>';
  $html .= '<h5 style="margin-left: 15%;">GESTION DES RESSOURCES HUMAINES</h5>';
  $html .= '</td>';
  $html .= '</tr>';
  $html .= '</table>';

    // Génération du tableau HTML à partir des données
    $table = '<table style="width: 100%; border-collapse: collapse;">';
    $table .= '<thead>
    <tr>
    <th style="border: 1px solid #000; width: 15%;">MATRICULE</th>
    <th style="border: 1px solid #000; width: 47%;">NOMS ET PRENOMS</th>
    <th style="border: 1px solid #000; width: 10%;">TRAVAIL INDIVIDUEL 30%</th>
    <th style="border: 1px solid #000; width: 10%;">TRAVAIL DE GROUPE 30%</th>
    <th style="border: 1px solid #000; width: 10%;">EXAM SUR TABLE 40%</th>
    <th style="border: 1px solid #000; width: 10%;">NOTE/100</th>
    <th style="border: 1px solid #000; width: 13%;">DECISION</th>
    </tr>
    </thead>';
    $table .= '<tbody>';

    $groupedAuditeurs = [];

    foreach ($results as $row) {
        $auditeurId = $row->id_auditeur;

        if (!isset($groupedAuditeurs[$auditeurId])) {
            $groupedAuditeurs[$auditeurId] = [
                'matricule' => $row->matricule_auditeur,
                'nom' => Crypt::decrypt($row->nom_auditeur),
                'prenom' => Crypt::decrypt($row->prenom_auditeur),
                'noteIndividuel' => 0,
                'noteGroupe' => 0,
                'noteExam' => 0,
                
            ];
        }

        if ($row->anonymat == 0) {
            $groupedAuditeurs[$auditeurId]['noteGroupe'] = $row->note_auditeur;
        } elseif ($row->anonymat == 1) {
            $groupedAuditeurs[$auditeurId]['noteExam'] = $row->note_auditeur;
        }elseif($row->anonymat == 2){
            $groupedAuditeurs[$auditeurId]['noteIndividuel'] = $row->note_auditeur;
        }
    }

    foreach ($groupedAuditeurs as $auditeur) {
        $notesur100 = ((($auditeur['noteIndividuel']*30)/ 100) + (($auditeur['noteGroupe']*30)/ 100) + (($auditeur['noteExam']*40)/ 100))*3;
        $v='VALIDE';
        $a='AJOURNEE';
        $r='N/A';
        $table .= '<tr>';
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $auditeur['matricule'] . '</td>';
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $auditeur['nom'].' '.$auditeur['prenom'] . '</td>';
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $auditeur['noteIndividuel'] .'</td>';
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $auditeur['noteGroupe'] . '</td>';
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $auditeur['noteExam'] . '</td>';
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $notesur100 . '</td>';
        if($notesur100 >= 60){
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $v . '</td>';
        }elseif ($notesur100 < 60) {
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $a . '</td>';
        }else {
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $r . '</td>';
        }
        $table .= '</tr>';
    }

    $table .= '</tbody>';
    $table .= '</table>';
 
   // Génération du fichier PDF
 
   $dompdf = new Dompdf();
   $dompdf->loadHtml('<style>@page { size: landscape; }</style>' . $html .$table); 
   $dompdf->setPaper('A4', 'landscape');
   $dompdf->render();
 /*   $dompdf->setPaper('A4', 'landscape'); */
   // Téléchargement du fichier PDF
   $pdfContent = $dompdf->output();
  
   // Nom du fichier PDF à télécharger
   $filename = 'etat.pdf';

   // Enregistrement du fichier PDF sur le serveur
   file_put_contents($filename, $pdfContent);
 
   // Téléchargement du fichier PDF
   return response()->download($filename)->deleteFileAfterSend(true);
}



public function imprimerresultattravailgroupe(Request $request)
{
    $codeorg = $request->query('codeorg');
    $idperio = $request->query('idperio');
    $idparc = $request->query('idparc');
    $idre = $request->query('idre');
    $idgue = $request->query('idgue');
    $idue = $request->query('idue');
    
   // Exécutez la procédure stockée pour récupérer les données
   $results = DB::select('CALL psResultatFinal(?,?,?,?,?,?)',[ $codeorg,$idperio,$idparc,$idre,$idgue,$idue]);

  // Chemin de l'image
  $imagePath = public_path('imagesmod/logologin.jpg');

  // Encodage de l'image en base64
  $imageData = base64_encode(file_get_contents($imagePath));

  // Génération du contenu HTML avec les lignes et l'image
  $html = '<table style="width: 100%; border-collapse: collapse;">';
  $html .= '<tr>';
  $html .= '<td style="vertical-align: middle;width: 250px;"><img src="data:image/jpeg;base64,' . $imageData . '" alt="Image" style="width: 250px; height: 150px;"></td>';
  $html .= '<td>';
  $html .= '<h4 style="margin-left: 6%;">MASTER PROFESSIONNEL EN MANAGEMENT PUBLIC</h4>';
  $html .= '<p style="margin-left: 5%;"><b>Procès verbal des resultats partiels du 3ème semestre(2018-2020)</b></p>';
  $html .= '<h5 style="margin-left: 13%;">Option: Management Des Organisations Publiques</h5>';
  $html .= '<h5 style="margin-left: 15%;">GESTION DES RESSOURCES HUMAINES</h5>';
  $html .= '</td>';
  $html .= '</tr>';
  $html .= '</table>';

    // Génération du tableau HTML à partir des données
    $table = '<table style="width: 100%; border-collapse: collapse;">';
    $table .= '<thead>
    <tr>
    <th style="border: 1px solid #000; width: 15%;">MATRICULE</th>
    <th style="border: 1px solid #000; width: 47%;">NOMS ET PRENOMS</th>
    <th style="border: 1px solid #000; width: 10%;">TRAVAIL INDIVIDUEL 30%</th>
    <th style="border: 1px solid #000; width: 10%;">TRAVAIL DE GROUPE 30%</th>
    <th style="border: 1px solid #000; width: 10%;">EXAM SUR TABLE 40%</th>
    <th style="border: 1px solid #000; width: 10%;">NOTE/100</th>
    <th style="border: 1px solid #000; width: 13%;">DECISION</th>
    </tr>
    </thead>';
    $table .= '<tbody>';

    $groupedAuditeurs = [];

    foreach ($results as $row) {
        $auditeurId = $row->id_auditeur;

        if (!isset($groupedAuditeurs[$auditeurId])) {
            $groupedAuditeurs[$auditeurId] = [
                'matricule' => $row->matricule_auditeur,
                'nom' => Crypt::decrypt($row->nom_auditeur),
                'prenom' => Crypt::decrypt($row->prenom_auditeur),
                'noteIndividuel' => 0,
                'noteGroupe' => 0,
                'noteExam' => 0,
            ];
        }

        if ($row->anonymat == 0) {
            $groupedAuditeurs[$auditeurId]['noteGroupe'] = $row->note_auditeur;
        } elseif ($row->anonymat == 1) {
            $groupedAuditeurs[$auditeurId]['noteExam'] = $row->note_auditeur;
        }elseif($row->anonymat == 2){
            $groupedAuditeurs[$auditeurId]['noteIndividuel'] = $row->note_auditeur;
        }
    }

    foreach ($groupedAuditeurs as $auditeur) {
        $notesur100 = ((($auditeur['noteIndividuel']*30)/ 100) + (($auditeur['noteGroupe']*30)/ 100) + (($auditeur['noteExam']*40)/ 100))*3;
        $v='VALIDE';
        $a='AJOURNEE';
        $r='N/A';
        $table .= '<tr>';
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $auditeur['matricule'] . '</td>';
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $auditeur['nom'].' '.$auditeur['prenom'] . '</td>';
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $auditeur['noteIndividuel'] .'</td>';
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $auditeur['noteGroupe'] . '</td>';
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $auditeur['noteExam'] . '</td>';
        $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $notesur100 . '</td>';
        if($notesur100 >= 60){
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $v . '</td>';
        }elseif ($notesur100 < 60) {
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $a . '</td>';
        }else {
            $table .= '<td style="border: 1px solid #000; padding: 8px;">' . $r . '</td>';
        }
        $table .= '</tr>';
    }

    $table .= '</tbody>';
    $table .= '</table>';
 
   // Génération du fichier PDF
 
   $dompdf = new Dompdf();
   $dompdf->set_option('isRemoteEnabled', true);
   $dompdf->loadHtml('<style>@page { size: landscape; }</style>' . $html .$table); 
   $dompdf->setPaper('A4', 'landscape');
   $dompdf->render();
 /*   $dompdf->setPaper('A4', 'landscape'); */
   // Téléchargement du fichier PDF
   $pdfContent = $dompdf->output();
  
   // Retourner la réponse HTTP pour afficher le PDF dans une nouvelle fenêtre
   return response($pdfContent)
       ->header('Content-Type', 'application/pdf')
       ->header('Content-Disposition', 'inline; filename="etat.pdf"');
}



public function getauditeurreg(Request $request)
{
    $idreg = intval($request->query('idreg'));

    // Appelez votre procédure stockée avec le paramètre $idreg
    $auditeurs = DB::select('CALL psAuditeurByIdreg(?)', [$idreg]);

    // Déchiffrez les attributs des auditeurs
    $decryptedAuditeurs = collect($auditeurs)->map(function ($auditeur) {
        $auditeur->matricule;
        $auditeur->nom = Crypt::decrypt($auditeur->nom);
        $auditeur->prenom = Crypt::decrypt($auditeur->prenom);
        $auditeur->genre = Crypt::decrypt($auditeur->genre);
        $auditeur->date = Crypt::decrypt($auditeur->date);
        $auditeur->email = Crypt::decrypt($auditeur->email);
        $auditeur->tel = Crypt::decrypt($auditeur->tel);
        $auditeur->provenance;
        $auditeur->imageurl;

        return $auditeur;
    });

      // Chemin de l'image
  $imagePath = public_path('imagesmod/logologin.jpg');

  // Encodage de l'image en base64
  $imageData = base64_encode(file_get_contents($imagePath));

  // Génération du contenu HTML avec les lignes et l'image
  $html = '<table style="width: 100%; border-collapse: collapse;">';
  $html .= '<tr>';
  $html .= '<td style="vertical-align: middle;width: 250px;"><img src="data:image/jpeg;base64,' . $imageData . '" alt="Image" style="width: 250px; height: 150px;"></td>';
  $html .= '<td>';
  $html .= '<h4 style="margin-left: 6%;">MASTER PROFESSIONNEL EN MANAGEMENT PUBLIC</h4>';
  $html .= '<h5 style="margin-left: 13%;">Option: Management Des Organisations Publiques</h5>';
  $html .= '<h5 style="margin-left: 15%;">LISTE DES AUDITEURS CENTRALE</h5>';
  $html .= '</td>';
  $html .= '</tr>';
  $html .= '</table>';

    // Génération du contenu HTML avec la liste des auditeurs
    $table = '<table style="width: 100%; border-collapse: collapse;">';
    $table .= '<thead>
        <tr>
            <th style="border: 1px solid #000; width: 15%;">MATRICULES</th>
            <th style="border: 1px solid #000; width: 47%;">NOMS ET PRENOMS</th>
            <th style="border: 1px solid #000; width: 10%;">GENRES</th>
            <th style="border: 1px solid #000; width: 10%;">DATES</th>
            <th style="border: 1px solid #000; width: 10%;">TELEPHONE</th>
        </tr>
    </thead>';
    $table .= '<tbody>';

    foreach ($decryptedAuditeurs as $auditeur) {
        $table .= '<tr>';
        $table .= '<td style="border: 1px solid #000;">' . $auditeur->matricule . '</td>';
        $table .= '<td style="border: 1px solid #000;">' . $auditeur->nom . ' ' . $auditeur->prenom . '</td>';
        $table .= '<td style="border: 1px solid #000;">' . $auditeur->genre . '</td>';
        $table .= '<td style="border: 1px solid #000;">' . $auditeur->date . '</td>';
        $table .= '<td style="border: 1px solid #000;">' . $auditeur->tel . '</td>';
        $table .= '</tr>';
    }

    $table .= '</tbody>';
    $table .= '</table>';

    
    $dompdf = new Dompdf();
    $dompdf->loadHtml('<style>@page { size: landscape; }</style>' . $html .$table); 
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
  /*   $dompdf->setPaper('A4', 'landscape'); */
    // Téléchargement du fichier PDF
    $pdfContent = $dompdf->output();
   
    // Nom du fichier PDF à télécharger
    $filename = 'etat.pdf';
 
    // Enregistrement du fichier PDF sur le serveur
    file_put_contents($filename, $pdfContent);
  
    // Téléchargement du fichier PDF
    return response()->download($filename)->deleteFileAfterSend(true);
}






public function imprimerauditeurreg(Request $request){
    $idreg = intval($request->query('idreg'));

    // Appelez votre procédure stockée avec le paramètre $idreg
    $auditeurs = DB::select('CALL psAuditeurByIdreg(?)', [$idreg]);

    // Déchiffrez les attributs des auditeurs
    $decryptedAuditeurs = collect($auditeurs)->map(function ($auditeur) {
        $auditeur->matricule;
        $auditeur->nom = Crypt::decrypt($auditeur->nom);
        $auditeur->prenom = Crypt::decrypt($auditeur->prenom);
        $auditeur->genre = Crypt::decrypt($auditeur->genre);
        $auditeur->date = Crypt::decrypt($auditeur->date);
        $auditeur->email = Crypt::decrypt($auditeur->email);
        $auditeur->tel = Crypt::decrypt($auditeur->tel);
        $auditeur->provenance;
        $auditeur->imageurl;

        return $auditeur;
    });

      // Chemin de l'image
  $imagePath = public_path('imagesmod/logologin.jpg');

  // Encodage de l'image en base64
  $imageData = base64_encode(file_get_contents($imagePath));




  // Génération du contenu HTML avec les lignes et l'image
  $html = '<table style="width: 100%; border-collapse: collapse;">';
  $html .= '<tr>';
  $html .= '<td style="vertical-align: middle;width: 250px;"><img src="data:image/jpeg;base64,' . $imageData . '" alt="Image" style="width: 250px; height: 150px;"></td>';
  $html .= '<td>';
  $html .= '<h4 style="margin-left: 6%;">MASTER PROFESSIONNEL EN MANAGEMENT PUBLIC</h4>';
  $html .= '<h5 style="margin-left: 13%;">Option: Management Des Organisations Publiques</h5>';
  $html .= '<h5 style="margin-left: 15%;">LISTE DES AUDITEURS CENTRALE</h5>';
  $html .= '</td>';
  $html .= '</tr>';
  $html .= '</table>';

    // Génération du contenu HTML avec la liste des auditeurs
    $table = '<table style="width: 100%; border-collapse: collapse;">';
    $table .= '<thead>
        <tr>
            <th style="border: 1px solid #000; width: 15%;">MATRICULES</th>
            <th style="border: 1px solid #000; width: 47%;">NOMS ET PRENOMS</th>
            <th style="border: 1px solid #000; width: 10%;">GENRES</th>
            <th style="border: 1px solid #000; width: 10%;">DATES</th>
            <th style="border: 1px solid #000; width: 10%;">TELEPHONE</th>
        </tr>
    </thead>';
    $table .= '<tbody>';

    foreach ($decryptedAuditeurs as $auditeur) {
        $table .= '<tr>';
        $table .= '<td style="border: 1px solid #000;">' . $auditeur->matricule . '</td>';
        $table .= '<td style="border: 1px solid #000;">' . $auditeur->nom . ' ' . $auditeur->prenom . '</td>';
        $table .= '<td style="border: 1px solid #000;">' . $auditeur->genre . '</td>';
        $table .= '<td style="border: 1px solid #000;">' . $auditeur->date . '</td>';
        $table .= '<td style="border: 1px solid #000;">' . $auditeur->tel . '</td>';
        $table .= '</tr>';
    }

    $table .= '</tbody>';
    $table .= '</table>';


    $dompdf = new Dompdf();
    $dompdf->set_option('isRemoteEnabled', true);
    $dompdf->loadHtml('<style>@page { size: landscape; }</style>' . $html .$table); 
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
  /*   $dompdf->setPaper('A4', 'landscape'); */
    // Téléchargement du fichier PDF
    $pdfContent = $dompdf->output();
   
    // Retourner la réponse HTTP pour afficher le PDF dans une nouvelle fenêtre
    return response($pdfContent)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="etat.pdf"');
}
}