
<!DOCTYPE html>
<html lang="en">

<head>

<style>
        @import url("https://fonts.googleapis.com/css?family=Oswald:300,400,500,700");

@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800");




* {
  transition: 0.5s;
}

.h-100 {
  height: 15vh !important;
  background-color: transparent;
}

.align-middle {
  position: relative;
  top: 0%;
  transform: translateY(-3%);
}
.br {
  background: red;
}
.column {
  margin-top: 3rem;
  padding-left: 3rem;
  background-color: transparent;

  &:hover {
    padding-left: 0;
    cursor: pointer;
    .card .txt {
      margin-left: 1rem;

      h5,
      p {
        color: rgba(255, 255, 255, 1);
        opacity: 1;
      }
    }

    a {
      color: rgba(255, 255, 255, 1);

      &:after {
        width: 10%;
      }
    }
    h5 {
      color: rgb(149, 146, 146);
      opacity: 1;
      text-shadow: 2px 4px 4px rgba(46, 120, 173, 0.28);
      &:after {
        width: 10%;
      }
    }
  }
}
h5{
    text-transform: uppercase;
}
.card {
  border-radius: 8px;
  min-height: 50px;
  margin: 0;
  padding: 1.2rem 1.2rem;
  border: none;
  color: rgb(250, 250, 250);
  letter-spacing: 0.05rem;
  font-family: "Oswald", sans-serif;
  box-shadow: 0 0 21px rgba(0, 0, 0, 0.27);

  .txt {
   /*  //margin-left: -3rem; */
    z-index: 1;

    h1 {
      font-size: 1.5rem;
      font-weight: 300;
      text-transform: uppercase;
    }

    p {
      /* // font-size: .7rem; */
      font-size: 14px;
      font-family: "Open Sans", sans-serif;
      letter-spacing: 0rem;
      margin-top: 33px;
      opacity: 1;
      color: rgba(255, 255, 255, 1);
    }
  }

  a {
    z-index: 3;
    font-size: 0.7rem;
    color: rgba(0, 0, 0, 1);
    margin-left: 1rem;
    position: relative;
    /* // bottom: -.5rem; */
    text-transform: uppercase;

    &:after {
      content: "";
      display: inline-block;
      height: 0.5em;
      width: 0;
      margin-right: -100%;
      margin-left: 10px;
      border-top: 1px solid rgb(161, 46, 46);
      /* //border-top: 1px solid rgba(255, 255, 255, 1); */
      transition: 0.5s;
    }
  }

  .ico-card {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
  }

  i {
    position: relative;
    right: -50%;
    top: 60%;
    font-size: 12rem;
    line-height: 0;
    opacity: 0.2;
    color: rgba(255, 255, 255, 1);
    z-index: 0;
  }
}

.grand-menu-item:hover {
  cursor: pointer;
}

.ele {
  margin-top: 1%;
}
.corp {
 
  background-image: url("imagesmod/bg3.jpg");
  background-repeat: no-repeat;
  background-size: cover;
height:580px;
}

.icconf{
  font-size: 32px;
}
.smgOnlineOk{
  font-size: 18px;
  font-weight: 500;
  text-align: center;
  color: #16729c;
}



.ronNav{
  background-color: rgba(220, 224, 223, 0.893);
  line-height: 2.6;
}

.clor{
  color: rgb(255, 255, 255);
background-color: #BE7A17;
}

.login_btn{
color: rgb(255, 255, 255);
background-color: #BE7A17;

}
    </style>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="./imagesmod/logologin.jpg" rel="icon">
  <title>ISMP</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">



</head>

<body class="bg-gradient-login ">


    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand mb-0 clor">
 <!--  -->
  @foreach(session('user_roles') as $role)
 @if($role->code === 'VP')  
        <a style="cursor:pointer;" onclick="redirectToAccueil(16)" class="btn btn-sm "><i class="fas fa-gea"></i>Paramètres</a>
        @break
        @endif
    @endforeach 

        <div class="ml-auto">
        <button style="color: #000000; font-weight: bold;" class="btn login_btn" data-toggle="modal" data-target="#logoutModal">DECONNEXION</button>
        </div>
        </nav>
        <!-- Topbar -->

    
           

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
                  <p>etes vous sur de vouloir vous déconnecter?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Annuler</button>
                  <a class="dropdown-item login_btn" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                </div>
              </div>
            </div>
          </div>

        </div>
     

















<div class="corp mb-0">
      
        <div class="container">
          
          <div class="row align-middle">

            
           @foreach($userRoles as $role)
          @if($role->code === 'VMAA') 
            <div  class="col-md-6 col-lg-3 col-sm-12 column text-center"
            onclick="redirectToAccueil(1)">
              <img src="imagesmod/annee.png" style="height: 100px; width: 100px" alt=""
                class="img-responsive mon-img" />
              <div class="txt"> <h5 style="color: #000000; font-weight: bold;">ANNEE ACADEMIQUE</h5> </div>
            </div>
             @break
            @endif
        @endforeach 
      
         @foreach($userRoles as $role)
        @if($role->code === 'VMUE') 
            <div  class="col-md-6 col-lg-3 col-sm-12 column text-center"
            onclick="redirectToAccueil(3)">
              <img src="imagesmod/matiere.png" style="height: 100px; width: 100px" alt=""
                class="img-responsive mon-img" />
              <div class="txt"> <h5 style="color: #000000; font-weight: bold;">UNITE D'ENSEIGNEMENT</h5> </div>
            </div>
             @break
            @endif
        @endforeach 


         @foreach($userRoles as $role)
    @if($role->code === 'VMENS') 
            <div  class="col-md-6 col-lg-3 col-sm-12 column text-center"
            onclick="redirectToAccueil(5)">
              <img src="imagesmod/teacher.png" style="height: 100px; width: 100px" alt=""
                class="img-responsive mon-img" />
              <div class="txt"> <h5 style="color: #000000; font-weight: bold;">ENSEIGNANTS</h5> </div>
            </div>
             @break
            @endif
        @endforeach 

         
        @foreach($userRoles as $role)
        @if($role->code === 'VMAUDI') 
            <div  class="col-md-6 col-lg-3 col-sm-12 column text-center"
            onclick="redirectToAccueil(4)">
              <img src="imagesmod/auditeur.png" style="height: 100px; width: 100px" alt=""
                class="img-responsive mon-img" />
              <div class="txt"> <h5 style="color: #000000; font-weight: bold;">AUDITEURS</h5> </div>
            </div>
             @break
            @endif
        @endforeach 
       
          </div>

          <!-- 2ème ligne -->
          <div class="row" style="height: 10px;"> </div>
          <div class="row align-middle">

             @foreach($userRoles as $role)
    @if($role->code === 'VMSCO') 
          <div  class="col-md-6 col-lg-3 col-sm-12 column text-center"
            onclick="redirectToAccueil(8)">
              <img src="imagesmod/scolarite.png" style="height: 100px; width: 100px; border-radius: 8px;" alt=""
                class="img-responsive mon-img" />
              <div class="txt"> <h5 style="color: #000000; font-weight: bold;">SCOLARITE</h5> </div>
            </div>
             @break
            @endif
        @endforeach 

         @foreach($userRoles as $role)
        @if($role->code === 'VMPRO') 
          <div  class="col-md-6 col-lg-3 col-sm-12 column text-center"
            onclick="redirectToAccueil(7)">
              <img src="imagesmod/emploitemp.png" style="height: 100px; width: 100px" alt=""
                class="img-responsive mon-img" />
              <div class="txt">
                <h5 style="color: #000000; font-weight: bold;">PROGRAMMATION </h5>
              </div>
            </div>
             @break
            @endif
        @endforeach 

         @foreach($userRoles as $role)
        @if($role->code === 'VMSESS') 
            <div  class="col-md-6 col-lg-3 col-sm-12 column text-center"
            onclick="redirectToAccueil(6)">
              <img src="imagesmod/session.png" style="height: 100px; width: 100px" alt=""
                class="img-responsive mon-img" />
              <div class="txt"> <h5 style="color: #000000; font-weight: bold;">SESSIONS</h5> </div>
            </div>
             @break
            @endif
        @endforeach 

         @foreach($userRoles as $role)
    @if($role->code === 'VMEVA') 
            <div  class="col-md-6 col-lg-3 col-sm-12 column text-center"
            onclick="redirectToAccueil(11)">
              <img src="imagesmod/evaluation.png" style="height: 100px; width: 100px" alt=""
                class="img-responsive mon-img" />
              <div class="txt">
                <h5 style="color: #000000; font-weight: bold;">NOTES DES AUDITEURS</h5>
              </div>
            </div>
             @break
            @endif
        @endforeach 
         
            </div>


   <!-- 3ème ligne -->
 <div class="row" style="height: 10px;"> </div>
          <div class="row align-middle">

             @foreach($userRoles as $role)
            @if($role->code === 'VMEVAANO') 
          <div *ngIf="habilitation('PFNL08')" class="col-md-6 col-lg-3 col-sm-12 column text-center"
            onclick="redirectToAccueil(13)">
              <img src="imagesmod/examenano.png" style="height: 100px; width: 100px" alt=""
                class="img-responsive mon-img" />
              <div class="txt">
                <h5 style="color: #000000; font-weight: bold;">EXAMENS ANONYMES</h5>
              </div>
            </div>
             @break
            @endif
        @endforeach 
        
         @foreach($userRoles as $role)
        @if($role->code === 'VMEVAENS') 
            <div *ngIf="habilitation('PFNL05')" class="col-md-6 col-lg-3 col-sm-12 column text-center"
            onclick="redirectToAccueil(8)">
              <img src="imagesmod/noter.png" style="height: 100px; width: 100px" alt=""
                class="img-responsive mon-img" />
              <div class="txt"> <h5 style="color: #000000; font-weight: bold;">EVALUER ENSEIGNANTS</h5> </div>
            </div>
             @break
            @endif
        @endforeach 

         @foreach($userRoles as $role)
    @if($role->code === 'VMSOUT') 
            <div *ngIf="habilitation('PFNL07')" class="col-md-6 col-lg-3 col-sm-12 column text-center"
            onclick="redirectToAccueil(9)">
              <img src="imagesmod/gaduation.jpg" style="height: 100px; width: 100px" alt=""
                class="img-responsive mon-img" />
              <div class="txt"> <h5 style="color: #000000; font-weight: bold;">SOUTENANCES</h5> </div>
            </div>
             @break
            @endif
        @endforeach 
       
      
        @foreach($userRoles as $role)
        @if($role->code === 'VMRESULT')
            <div *ngIf="habilitation('PFNL08')" class="col-md-6 col-lg-3 col-sm-12 column text-center"
            onclick="redirectToAccueil(10)">
              <img src="{{ asset('imagesmod/resultat.png')}}" style="height: 100px; width: 100px" alt=""
                class="img-responsive mon-img" />
              <div class="txt">
                <h5 style="color: #000000; font-weight: bold;">RESULTATS ACADEMIQUES</h5>
              </div>
            </div>
            @break
            @endif
        @endforeach

            
            
          </div>



            
          </div>

         


        </div>
      </div>
      

     


  <!-- Login Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>




<script>
function redirectToAccueil(value) {
  console.log(value);
  // Rediriger l'utilisateur vers header.php, PeriodeAca.php et AccueilAdmin.php en passant la valeur en tant que paramètre de requête
  window.location.href = '{{ route("set_param") }}?param=' + value;
  // Rediriger vers d'autres pages si nécessaire, en passant également la valeur en tant que paramètre
}
</script>
</body>
@include('footer')
</html>