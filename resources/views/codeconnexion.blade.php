<!DOCTYPE html>
<html>
<head>
<link href="./imagesmod/logologin.jpg" rel="icon">  <title>ISMP</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="styles.css">

  <style>
    html,body{
//background-image: url("{{ asset('imagelog/abdou.png') }}");
background-size: cover;
background-repeat: no-repeat;
height: 100%;
font-family: 'Numans', sans-serif;
}

.container{
height: 100%;
align-content: center;
}

.card{
height: 400px;
margin-top: auto;
margin-bottom: auto;
width: 590px;
background-color: rgba(224, 219, 219, 0.5) !important;
}

.social_icon span{
font-size: 60px;
margin-left: 10px;
color: #FFC312;
}

.social_icon span:hover{
color: white;
cursor: pointer;
}

.card-header h3{
color: white;
}

.social_icon{
position: absolute;
right: 20px;
top: -45px;
}

.input-group-prepend span{
width: 50px;
background-color: #BE7A17;
color: black;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: rgb(255, 255, 255);
background-color: #BE7A17;
width: 230px;
}

.login_btn:hover{
color: black;
background-color: white;
}

.links{
color: white;
}

.links a{
margin-left: 4px;
}
  </style>
</head>
<body>


<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
                <h5 style="color:rgb(11, 141, 239);text-transform: uppercase;">
                    <span class="circle-icon">
                      <i class="fas fa-exclamation-circle"></i>
                    </span>
                    Saisissez votre email pour recevoir un code de connexion par sms et par email.
                  </h5>
			</div>

     <div style="text-align: center;">
    <span style="display: inline-block; margin-right: 10px;">Recevoir mail</span>
    <i class="fas fa-envelope" style="display: inline-block;"></i>
    <span style="display: inline-block; margin-left: 10px;">Recevoir SMS</span>
    <i class="fas fa-phone" style="display: inline-block;"></i>
</div>
            
			<div class="card-body">
            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        @if (session('message'))
    <div id="message" class="alert alert-danger">
        {{ session('message') }}
    </div>
@elseif (session('messagesuc'))
    <div id="message" class="alert alert-success" role="alert">
        {{ session('messagesuc') }}
    </div>
@endif

<script>
    setTimeout(function() {
        var messageElement = document.getElementById('message');
        if (messageElement) {
            messageElement.style.display = 'none';
        }
    }, 5000);
</script>

<div align="center">
    <p style="color:rgb(11, 141, 239);text-transform: none; font-size: 12px;">
        <span class="circle-icon">
          <i class="fas fa-exclamation-circle"></i>
        </span>
        Renseigner votre adresse email, ensuite cliquez sur recevoir le code.
        Un code de connexion sera envoyé a votre adresse email ainsi qu'a votre numéro de telephone, et vous permettra d'avoir accès a votre compte.
    </p>
</div>
    <form method="POST" action="{{ route('verification') }}">
    @csrf
    <div class="input-group form-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fas fa-envelope"></i> <!-- Icône du message -->
               <!-- <i class="fas fa-phone"></i>  Icône du téléphone -->
            </span>
        </div>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div align="center" class="form-group">
        <input type="submit" value="Envoyer le code" class="btn login_btn">
    </div>
</form>
<div class="d-flex justify-content-center">
    <a class="btn btn-link" href="#" onclick="goBack()">
        Retour
    </a>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>

			</div>
			
		</div>
	</div>
</div>
</body>
</html>