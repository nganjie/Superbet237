
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="./imagesmod/logologin.jpg" rel="icon">
  <title>ISMP</title>
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('css/ruang-admin.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" >
<link href="{{asset('vendor/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" >
<link href="{{asset('vendor/clock-picker/clockpicker.css')}}" rel="stylesheet">
<script>
function printReceipt() {
  window.print();
}
</script>
<style>
      .clor{
  color: rgb(255, 255, 255);
background-color: #BE7A17;
input{
  color: #000000;
}
}

    </style>
</head>

<body id="page-top">
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion " id="accordionSidebar" >
      <a class="sidebar-brand d-flex align-items-center justify-content-center" style="background-color:#8B4C0B;">
        <div class="sidebar-brand-icon ">
          <img src="./imagesmod/logologin.jpg">
        </div>
        <div class="sidebar-brand-text mx-3" style="background-color:#8B4C0B; color:white;" >ISMP</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('AccueilAdmin')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

     

<?php
if ($paramValue == 1 || $paramValue == 2) {
    echo '<hr class="sidebar-divider">';
    echo '<div class="sidebar-heading">';
    echo '<span>Circuits académiques</span>';
    echo '</div>';
} else {
    // Ne rien afficher
}


if ($paramValue == 1) {
  // Afficher la période académique
  echo '<li class="nav-item">';
  echo ' <a class="nav-link collapsed" href="' . route('periodeAca') . '" >';
  echo '  <i class="far fa-fw fa-window-maximize"></i>';
 echo '   <span style="color: #000000; font-weight: bold;font-size: 10px;">PERIODES ACADEMIQUES</span>';
 echo ' </a>';
 echo ' </li>';

    echo ' <li class="nav-item">';
echo ' <a class="nav-link collapsed" href="' . route('parcoursAca') . '" >';
echo '    <i class="fas fa-fw fa-table"></i>';
echo '    <span style="color: #000000; font-weight: bold;font-size: 10px;">PARCOURS ACADEMIQUES</span>';
echo '  </a>';
echo ' </li>';

    echo ' <li class="nav-item">';
 echo '  <a class="nav-link collapsed" href="' . route('promotionAca') . '" >';
 echo ' <i class="fab fa-fw fa-wpforms"></i>';
echo '   <span style="color: #000000; font-weight: bold;font-size: 10px;">PROMOTIONS ACADEMIQUES</span>';
echo ' </a>';
echo ' </li>';

echo ' <li class="nav-item">';
echo ' <a class="nav-link collapsed" href="' . route('regroupement') . '" >';
echo '    <i class="fas fa-fw fa-table"></i>';
echo '    <span style="color: #000000; font-weight: bold;font-size: 10px;">REGROUPEMENTS</span>';
echo '  </a>';
echo ' </li>';
} else {
  // Ne rien afficher
}  




if ($paramValue == 5) {
// Afficher les Enseignats
echo ' <li class="nav-item">';
echo ' <a class="nav-link collapsed" href="' . route('enseignant') . '">';
echo '   <i class="fas fa-fw fa-chart-area"></i>';
echo '   <span style="color: #000000; font-weight: bold;font-size: 10px;">ENSEIGNANTS</span>';
echo ' </a>';
echo '  </li>';
} else {
    // Ne rien afficher
  }



if ($paramValue == 3) {
echo ' <hr class="sidebar-divider">';
echo '  <div class="sidebar-heading">';
  echo '  Matières';
 echo ' </div>';

// Afficher les groupes et unités d'enseignements
echo ' <li class="nav-item">';
echo ' <a class="nav-link collapsed" href="' . route('ue') . '" >';
echo ' <i class="fas fa-fw fa-columns"></i>';
echo ' <span style="color: #000000; font-weight: bold;font-size: 10px;">UNITES ENSEIGNEMENTS</span>';
echo '</a>';
echo '</li>';

echo '<li class="nav-item">';
echo '<a class="nav-link collapsed" href="' . route('gue') . '">';
echo ' <i class="fas fa-fw fa-chart-area"></i>';
echo '<span style="color: #000000; font-weight: bold;font-size: 10px;">GROUPES UNITES ENS</span>';
echo ' </a>';
echo ' </li>';

} else {
// Ne rien afficher
} 





if ($paramValue == 4) {
// Afficher les auditeurs
echo ' <li class="nav-item">';
echo ' <a class="nav-link collapsed" href="' . route('auditeur') . '">';
  echo '  <i class="fas fa-fw fa-chart-area"></i>';
  echo '  <span style="color: #000000; font-weight: bold;font-size: 10px;">AUDITEURS</span>';
echo '  </a>';
echo ' </li>';
} else {
    // Ne rien afficher
  }
 


if ($paramValue == 6) {
// Afficher les SEssions
echo ' <hr class="sidebar-divider">';
echo '<div class="sidebar-heading">';
echo '  SESSIONS';
echo ' </div>';

echo ' <li class="nav-item">';
 echo ' <a class="nav-link collapsed" href="' . route('session') . '" >';
    echo '<i class="fas fa-fw fa-columns"></i>';
   echo ' <span style="color: #000000; font-weight: bold;font-size: 10px;">SESSION EVALUATION</span>';
 echo ' </a>';
echo '</li>';

echo '<li class="nav-item">';
  echo '<a class="nav-link collapsed" href="' . route('typesession') . '">';
   echo ' <i class="fas fa-fw fa-chart-area"></i>';
   echo ' <span style="color: #000000; font-weight: bold;font-size: 10px;">TYPE SESSION</span>';
echo '  </a>';
echo ' </li>';
} else {
    // Ne rien afficher
  }

  if ($paramValue == 7) {
    // Afficher les enseignements programmé
    echo ' <hr class="sidebar-divider">';
    echo '<div class="sidebar-heading">';
    echo '  POGRAMME DES ENSEIGNEMENTS';
   echo ' </div>';

   echo '<li class="nav-item">';
 echo ' <a class="nav-link collapsed" href="emploidutemps.php">';
   echo ' <i class="fas fa-fw fa-chart-area"></i>';
   echo ' <span>Emploi du Temps</span>';
 echo ' </a>';
echo ' </li>';

echo '<li class="nav-item">';
 echo ' <a class="nav-link collapsed" href="' . route('programmation') . '">';
   echo ' <i class="fas fa-fw fa-chart-area"></i>';
   echo ' <span>Programmations</span>';
 echo ' </a>';
echo ' </li>';

echo '<li class="nav-item">';
 echo ' <a class="nav-link collapsed" href="Typeprogram.php">';
   echo ' <i class="fas fa-fw fa-chart-area"></i>';
   echo ' <span>Types Programmations</span>';
 echo ' </a>';
echo ' </li>';
} else {
// Ne rien afficher
}

if ($paramValue == 1) {
// Afficher les unités calendaire et division calendaires
echo '<hr class="sidebar-divider">';
echo ' <div class="sidebar-heading">';
echo '<span > Calendrier</span>';
echo ' </div>';

echo '<li class="nav-item">';
echo ' <a class="nav-link collapsed" href="' . route('divisionca') . '" >';
echo '  <i class="fas fa-fw fa-columns"></i>';
echo '   <span style="color: #000000; font-weight: bold;font-size: 10px;">DIVISIONS CALENDAIRES</span>';
echo ' </a>';
echo ' </li>';

echo ' <li class="nav-item">';
echo '  <a class="nav-link collapsed" href="' . route('uniteca') . '">';
 echo '   <i class="fas fa-fw fa-chart-area"></i>';
 echo '   <span style="color: #000000; font-weight: bold;font-size: 10px;">UNITES CALENDAIRES</span>';
 echo ' </a>';
 echo ' </li>';
} else {
// Ne rien afficher
} 



if ($paramValue == 8) {
// Afficher la scolrité
echo ' <li class="nav-item">';
echo ' <a class="nav-link collapsed" href="' . route('scolarite') . '">';
echo '   <i class="fas fa-fw fa-chart-area"></i>';
echo '   <span>Versements</span>';
echo ' </a>';
echo '  </li>';

echo ' <li class="nav-item">';
echo ' <a class="nav-link collapsed" href="' . route('versement') . '">';
echo '   <i class="fas fa-fw fa-chart-area"></i>';
echo '   <span>Frais Scolarite</span>';
echo ' </a>';
echo '  </li>';


} else {
    // Ne rien afficher
  }


  if ($paramValue == 9) {
    // Afficher la scolrité
    echo ' <li class="nav-item">';
    echo ' <a class="nav-link collapsed" href="' . route('soutenance') . '">';
    echo '   <i class="fas fa-fw fa-chart-area"></i>';
    echo '   <span>Soutenaces</span>';
    echo ' </a>';
    echo '  </li>';

   
  } else {
        // Ne rien afficher
      }

      if ($paramValue == 10) {
        // Afficher la scolrité
        echo ' <li class="nav-item">';
        echo ' <a class="nav-link collapsed" href="' . route('resultat') . '">';
        echo '   <i class="fas fa-fw fa-chart-area"></i>';
        echo '   <span>Resultats</span>';
        echo ' </a>';
        echo '  </li>';

         echo ' <li class="nav-item">';
        echo ' <a class="nav-link collapsed" href="bulletin.php">';
        echo '   <i class="fas fa-fw fa-chart-area"></i>';
        echo '   <span>Bulletins</span>';
        echo ' </a>';
        echo '  </li>';

        echo ' <li class="nav-item">';
        echo ' <a class="nav-link collapsed" href="attestation.php">';
        echo '   <i class="fas fa-fw fa-chart-area"></i>';
        echo '   <span>Attestations</span>';
        echo ' </a>';
        echo '  </li>';
  
       
      } else {
            // Ne rien afficher
          }


              if ($paramValue == 11) {
    // Afficher la notation
    echo ' <li class="nav-item">';
    echo '<a class="nav-link collapsed" href="' . route('evaluation') . '">';
    echo '   <i class="fas fa-fw fa-chart-area"></i>';
    echo '   <span style="color: #000000; font-weight: bold;font-size: 10px;">EVALUATIONS</span>';
    echo ' </a>';
    echo '  </li>';

   
  } else {
        // Ne rien afficher
      }

      

          if ($paramValue == 13) {
            // Afficher la notation
            echo ' <li class="nav-item">';
            echo ' <a class="nav-link collapsed" href="' . route('examennote') . '">';
            echo '   <i class="fas fa-fw fa-chart-area"></i>';
            echo '   <span style="color: #000000; font-weight: bold;font-size: 10px;">EXAMENS ANONYMES</span>';
            echo ' </a>';
            echo '  </li>';
      
           
          } else {
                // Ne rien afficher
              }



              if ($paramValue == 16) {
                // Afficher la notation
                echo ' <li class="nav-item">';
                echo ' <a class="nav-link collapsed" href="' . route('user') . '">';
                echo '   <i class="fas fa-fw fa-chart-area"></i>';
                echo '   <span style="color: #000000; font-weight: bold;font-size: 10px;">UTILISATEURS</span>';
                echo ' </a>';
                echo '  </li>';
          
                echo ' <li class="nav-item">';
                echo ' <a class="nav-link collapsed" href="' . route('groupe') . '">';
                echo '   <i class="fas fa-fw fa-chart-area"></i>';
                echo '   <span style="color: #000000; font-weight: bold;font-size: 10px;">GROUPES</span>';
                echo ' </a>';
                echo '  </li>';

                echo ' <li class="nav-item">';
                echo ' <a class="nav-link collapsed" href="' . route('role') . '">';
                echo '   <i class="fas fa-fw fa-chart-area"></i>';
                echo '   <span style="color: #000000; font-weight: bold;font-size: 10px;">ROLES</span>';
                echo ' </a>';
                echo '  </li>';
               
              } else {
                    // Ne rien afficher
                  }
?>
    
      <hr class="sidebar-divider">
      <div class="version" id="version-ruangadmin"></div>
    </ul>
    <!-- Sidebar -->

  

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top" -->
        <nav  class="navbar navbar-expand bg-navbar topbar mb-4 clor">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

         <a href="./home">
           <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
         <i class="fa fa-home" aria-hidden="true"></i>
          </button>
         </a>

          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw" style="color: white;"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?"
                      aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
               </form>
              </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw" style="color: white;"></i>
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
             <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                 </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">
                   December 2, 2019
                     </div>
                    Spending Alert: We have noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw" style="color: white;"></i>
                <span class="badge badge-warning badge-counter">2</span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                 Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="img/man.png" style="max-width: 60px" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                   <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I have been
                      having.</div>
                    <div class="small text-gray-500">Udin Cilok · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="img/girl.png" style="max-width: 60px" alt="">
                    <div class="status-indicator bg-default"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people
                      say this to all dogs, even if they arent good...</div>
                    <div class="small text-gray-500">Jaenab · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-tasks fa-fw" style="color: white;"></i>
                <span class="badge badge-success badge-counter">3</span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                 Task
                </h6>
                <a class="dropdown-item align-items-center" href="#">
                  <div class="mb-3">
                    <div class="small text-gray-500">Design Button
                      <div class="small float-right"><b>50%</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </a>
                <a class="dropdown-item align-items-center" href="#">
                  <div class="mb-3">
                    <div class="small text-gray-500">Make Beautiful Transitions
                      <div class="small float-right"><b>30%</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </a>
                <a class="dropdown-item align-items-center" href="#">
                  <div class="mb-3">
                    <div class="small text-gray-500">Create Pie Chart
                      <div class="small float-right"><b>75%</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">View All Taks</a>
              </div>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->

       <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">


        
          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Etes vous sur de vouloir vous déconnecter?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Annuler</button>
                  <a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-primary">Déconnexion</a>
                                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                </div>
              </div>
            </div>
          </div>
         

