<?php
 session_start(); // Démarre la session

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "0000Greco", "gescol");

// Vérification de la connexion
if ($conn->connect_error) {
  die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

   var_dump(  $perio = $_POST['perio'] );
 $deleteId = intval($_POST['iddreg']); 
$mutipledeleteId = [];
if (isset($_POST['selectedElements'])) {
  // Convertir la valeur de $_POST['selectedElements'] en un tableau
  $mutipledeleteId = json_decode($_POST['selectedElements'], true);

  // Effectuer le traitement avec le tableau $mutipledeleteId
  foreach ($mutipledeleteId as $element) {
      $id = intval($element); // Assurez-vous que l'ID est un entier

      // Préparez la requête de suppression
      $sql = "DELETE FROM regroupement WHERE id = $id";

      // Exécutez la requête
      if ($conn->query($sql) === TRUE) {
          // Suppression réussie
          $message = "Regroupement supprimée avec succès.";
          $_SESSION['error_message'] = $message; // Enregistre $message dans la session
      } else {
          // Erreur lors de la suppression
          $message = "Une erreur s'est produite lors de la suppression du regroupement : " . $conn->error;
          $_SESSION['error_message'] = $message; // Enregistre $message dans la session
      }
  }

  header("Location: ../regroupement.php"); // Redirige vers la page souhaitée
  exit();
}



if (isset($_POST['iddreg'])) {
  $sql = "DELETE FROM regroupement WHERE id=$deleteId"; 

  // Exécution de la requête
if ($conn->query($sql) === TRUE) {
  // Insertion réussie
  //echo "Données sauvegardées avec succès.";
 // header("Location: ../regroupement.php");

 $message = "Regroupent Supprimée avec succès.";
  $_SESSION['error_message'] = $message; // Enregistre $message dans la session
header("Location: ../regroupement.php"); // Redirige vers la page souhaitée
exit();
} else {
  // Erreur lors de l'insertion
  echo "Erreur lors de la sauvegarde des données : " . $conn->error;
}
}else{

  $id = intval($_POST['idreg']);
  $nom = $_POST['nom'];
  $description = $_POST['description'];
  $debut = $_POST['heuredebut'];
  $fin = $_POST['heurefin']; 
  $org = intval($_POST['org']);
  $perio = intval($_POST['perio']); 
  $pro = intval($_POST['pro']);  
  $parc = intval($_POST['parc']); 
// Vérification des valeurs non vides
if (!empty($nom) && !empty($description) && !empty($debut) && !empty($fin)) {
  // Toutes les valeurs sont présentes, procéder à l'insertion dans la base de données

  if($debut > $fin){
   // echo "l'année de debut doit etre inférieur a l'année de fin.";
    $message = "l'heure de debut doit etre inférieur a l'heure de fin.";
    $_SESSION['error'] = $message; // Enregistre $message dans la session
    header("Location: ../regroupement.php");
    exit();

  }else{

    if($id === 0){
//,`idorg`,`idperio`,`idpro`,`idparc`
      // Requête d'insertion
$sql = "INSERT INTO `regroupement`(`nomreg`,`descriptionreg`,`heuredebut`,`heurefin`,`idorg`,`idperio`,`idpro`,`idparc`) VALUES ('$nom','$description','$debut','$fin',$org,$perio,$pro,$parc)";
    }else{

      $sql = "UPDATE `regroupement` SET nomreg='$nom', descriptionreg='$description', heuredebut='$debut', heurefin='$fin' WHERE id=$id";    }



// Exécution de la requête
if ($conn->query($sql) === TRUE) {
  // Insertion réussie
  //echo "Données sauvegardées avec succès.";
 // header("Location: ../regroupement.php");

 $message = "Regroupement enregistré avec succès.";
  $_SESSION['error_message'] = $message; // Enregistre $message dans la session
header("Location: ../regroupement.php"); // Redirige vers la page souhaitée
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
header("Location: ../regroupement.php");
exit();
} 
  
} 
?>
