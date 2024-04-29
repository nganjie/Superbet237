<?php
session_start(); // Démarre la session

// Connexion à la base de données
$conn = new mysqli("localhost", "root", "0000Greco", "gescol");

// Vérification de la connexion
if ($conn->connect_error) {
  die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

//supression simple
$deleteId = intval($_POST['iddgue']);

//suppression multiple
$mutipledeleteId = [];
if (isset($_POST['selectedElements'])) {
  // Convertir la valeur de $_POST['selectedElements'] en un tableau
  $mutipledeleteId = json_decode($_POST['selectedElements'], true);

  // Effectuer le traitement avec le tableau $mutipledeleteId
  foreach ($mutipledeleteId as $element) {
    $id = intval($element); // Assurez-vous que l'ID est un entier

    // Préparez la requête de suppression
    $sql = "DELETE FROM gue WHERE id = $id";

    // Exécutez la requête
    if ($conn->query($sql) === TRUE) {
      // Suppression réussie
      $message = "parcours parcours supprimée avec succès.";
      $_SESSION['error_message'] = $message; // Enregistre $message dans la session
    } else {
      // Erreur lors de la suppression
      $message = "Une erreur s'est produite lors de la suppression de l'année académique : " . $conn->error;
      $_SESSION['error_message'] = $message; // Enregistre $message dans la session
    }
  }

  header("Location: ../GunitéEns.php"); // Redirige vers la page souhaitée
  exit();
}



if (isset($_POST['iddgue'])) {
  $sql = "DELETE FROM gue WHERE id=$deleteId";

  // Exécution de la requête
  if ($conn->query($sql) === TRUE) {
    // Insertion réussie
    //echo "Données sauvegardées avec succès.";
    // header("Location: ../PeriodeAca.php");

    $message = "Parcours académique Supprimée avec succès.";
    $_SESSION['error_message'] = $message; // Enregistre $message dans la session
    header("Location: ../GunitéEns.php"); // Redirige vers la page souhaitée
    exit();
  } else {
    // Erreur lors de l'insertion
    echo "Erreur lors de la sauvegarde des données : " . $conn->error;
  }
} else {

  $id = intval($_POST['idgue']);
  $nomgue = $_POST['nomgue'];

  // Vérification des valeurs non vides
  if (!empty($nomgue)) {
    // Toutes les valeurs sont présentes, procéder à l'insertion dans la base de données

    if ($id === 0) {

      // Requête d'insertion
      $sql = "INSERT INTO gue (nomgue) VALUES ('$nomgue')";
    } else {

      $sql = "UPDATE gue SET nomgue='$nomgue' WHERE id=$id";
    }



    // Exécution de la requête
    if ($conn->query($sql) === TRUE) {
      // Insertion réussie
      //echo "Données sauvegardées avec succès.";
      // header("Location: ../PeriodeAca.php");

      $message = "Parcours académique enregistré avec succès.";
      $_SESSION['error_message'] = $message; // Enregistre $message dans la session
      header("Location: ../GunitéEns.php"); // Redirige vers la page souhaitée
      exit();
    } else {
      // Erreur lors de l'insertion
      echo "Erreur lors de la sauvegarde des données : " . $conn->error;
    }
  } else {
    // Au moins une des valeurs est vide, afficher un message d'erreur ou effectuer une action appropriée
    // echo "Veuillez remplir tous les champs du formulaire.";
    $message = "Veuillez remplir tous les champs du formulaire.";
    $_SESSION['error'] = $message; // Enregistre $message dans la session
    header("Location: ../GunitéEns.php");
    exit();
  }
}
