<?php
 session_start(); // Démarre la session

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "0000Greco", "gescol");

// Vérification de la connexion
if ($conn->connect_error) {
  die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

   
 $deleteId = intval($_POST['iddperio']); 
$mutipledeleteId = [];
if (isset($_POST['selectedElements'])) {
  // Convertir la valeur de $_POST['selectedElements'] en un tableau
  $mutipledeleteId = json_decode($_POST['selectedElements'], true);

  // Effectuer le traitement avec le tableau $mutipledeleteId
  foreach ($mutipledeleteId as $element) {
      $id = intval($element); // Assurez-vous que l'ID est un entier

      // Préparez la requête de suppression
      $sql = "DELETE FROM periodeacademique WHERE id = $id";

      // Exécutez la requête
      if ($conn->query($sql) === TRUE) {
          // Suppression réussie
          $message = "Année académique supprimée avec succès.";
          $_SESSION['error_message'] = $message; // Enregistre $message dans la session
      } else {
          // Erreur lors de la suppression
          $message = "Une erreur s'est produite lors de la suppression de l'année académique : " . $conn->error;
          $_SESSION['error_message'] = $message; // Enregistre $message dans la session
      }
  }

  header("Location: ../PeriodeAca.php"); // Redirige vers la page souhaitée
  exit();
}



if (isset($_POST['iddperio'])) {
  $sql = "DELETE FROM periodeacademique WHERE id=$deleteId"; 

  // Exécution de la requête
if ($conn->query($sql) === TRUE) {
  // Insertion réussie
  //echo "Données sauvegardées avec succès.";
 // header("Location: ../PeriodeAca.php");

 $message = "Année académique Supprimée avec succès.";
  $_SESSION['error_message'] = $message; // Enregistre $message dans la session
header("Location: ../PeriodeAca.php"); // Redirige vers la page souhaitée
exit();
} else {
  // Erreur lors de l'insertion
  echo "Erreur lors de la sauvegarde des données : " . $conn->error;
}
}else{

  $id = intval($_POST['idperio']);
  $orgcode = $_POST['state'];
  $libelle = $_POST['libelleperio'];
  $dateDebut = $_POST['start'];
  $dateFin = $_POST['end']; 
// Vérification des valeurs non vides
if (!empty($orgcode) && !empty($libelle) && !empty($dateDebut) && !empty($dateFin)) {
  // Toutes les valeurs sont présentes, procéder à l'insertion dans la base de données

  if($dateDebut > $dateFin){
   // echo "l'année de debut doit etre inférieur a l'année de fin.";
    $message = "l'année de debut doit etre inférieur a l'année de fin.";
    $_SESSION['error'] = $message; // Enregistre $message dans la session
    header("Location: ../PeriodeAca.php");
    exit();

  }else{

    if($id === 0){

      // Requête d'insertion
$sql = "INSERT INTO periodeacademique (nomperio, anneedebut, anneefin, codeorg) VALUES ('$libelle', '$dateDebut', '$dateFin', '$orgcode')";
    }else{

      $sql = "UPDATE periodeacademique SET nomperio='$libelle', anneedebut='$dateDebut', anneefin='$dateFin', codeorg='$orgcode' WHERE id=$id";    }



// Exécution de la requête
if ($conn->query($sql) === TRUE) {
  // Insertion réussie
  //echo "Données sauvegardées avec succès.";
 // header("Location: ../PeriodeAca.php");

 $message = "Année académique enregistré avec succès.";
  $_SESSION['error_message'] = $message; // Enregistre $message dans la session
header("Location: ../PeriodeAca.php"); // Redirige vers la page souhaitée
exit();
} else {
  // Erreur lors de l'insertion
  echo "Erreur lors de la sauvegarde des données : " . $conn->error;
}


}



} else {
  // Au moins une des valeurs est vide, afficher un message d'erreur ou effectuer une action appropriée
 // echo "Veuillez remplir tous les champs du formulaire.";
  $message = "Veuillez remplir tous les champs du formulaire.";
  $_SESSION['error'] = $message; // Enregistre $message dans la session
header("Location: ../PeriodeAca.php");
exit();
} 
  
} 
?>
