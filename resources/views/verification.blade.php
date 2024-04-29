
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
height: 300px;
margin-top: auto;
margin-bottom: auto;
width: 500px;
background-color: rgba(224, 219, 219, 0.5) !important;}

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

        .code-input {
            width: 40px;
            height: 20px;
        }
 
  </style>
</head>
<body>
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
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
                <h5 style="color:rgb(11, 141, 239);text-transform: uppercase;">
                    <span class="circle-icon">
                      <i class="fas fa-exclamation-circle"></i>
                    </span>
                    Saisissez le code reçu mail ou par sms.
                  </h5>
			</div>
			<div class="card-body">
          
                <div align="center">
					<p style="color:rgb(11, 141, 239);text-transform: none; font-size: 12px;">
						<span class="circle-icon">
						  <i class="fas fa-exclamation-circle"></i>
						</span>
						Entrer le code que vous avez recu par sms ou par mail. Ensuite cliquer sur le bouton valider pour pouvoir vous connceter.
					</p>
				</div>
                    <form method="POST" action="{{ route('verificationretour') }}">
                        @csrf
                       <div align="center">
    <input class="code-input" type="text" name="digit1" pattern="[0-9]" maxlength="1" required oninput="moveToNextInput(this, 'digit2')">
    <input class="code-input" type="text" name="digit2" pattern="[0-9]" maxlength="1" required oninput="moveToNextInput(this, 'digit3')">
    <input class="code-input" type="text" name="digit3" pattern="[0-9]" maxlength="1" required oninput="moveToNextInput(this, 'digit4')">
    <input class="code-input" type="text" name="digit4" pattern="[0-9]" maxlength="1" required oninput="moveToNextInput(this, 'digit5')">
    <input class="code-input" type="text" name="digit5" pattern="[0-9]" maxlength="1" required oninput="moveToNextInput(this, 'digit6')">
    <input class="code-input" type="text" name="digit6" pattern="[0-9]" maxlength="1" required>
    <br><br>
    <input class="btn btn-primary" type="submit" value="Valider">
</div>

<script>
    function moveToNextInput(currentInput, nextInputName) {
        if (currentInput.value.length === currentInput.maxLength) {
            const nextInput = document.getElementsByName(nextInputName)[0];
            nextInput.focus();
        }
    }
</script>
                        <div align="center">
                            <a class="btn btn-link" href="{{ route('code') }}">
                                Retour
                                </a>
                        </div>
				</form>
			</div>
			
		</div>
	</div>
</div>
</body>
</html>