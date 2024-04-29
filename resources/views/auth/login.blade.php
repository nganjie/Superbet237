
<!DOCTYPE html>
<html>
<head>
<link href="./imagesmod/logologin.jpg" rel="icon">
  <title>ISMP</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="styles.css">

  <style>
    html,body{
/*background-image: url("{{ asset('imagelog/abdou.png') }}");*/
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
width: 800px;
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
width: 100px;
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
			<div class="card-header text-center">
					<h3 class="text-center "> <span style="color:rgb(11, 141, 239);">ESPACE ADMINISTRATEUR</span></h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-6">
						<img src="./imagelog/ismp.png" style="height: 100%; width: 100%;" alt="">
					</div>
					<div class="col-6">
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
				 <form method="POST" action="{{ route('userlogin') }}">
                        @csrf
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
					</div>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="button" id="showCurrentPasswordToggle">
								<i class="fa fa-eye"></i>
							</button>
						</div>
						@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					
					<script>
						const currentPasswordInput = document.querySelector('input[name="password"]');
						const showCurrentPasswordToggle = document.getElementById('showCurrentPasswordToggle');
					
						showCurrentPasswordToggle.addEventListener('click', function() {
							if (currentPasswordInput.type === 'password') {
								currentPasswordInput.type = 'text';
								showCurrentPasswordToggle.innerHTML = '<i class="fa fa-eye-slash"></i>';
							} else {
								currentPasswordInput.type = 'password';
								showCurrentPasswordToggle.innerHTML = '<i class="fa fa-eye"></i>';
							}
						});
					</script>

					<div class="row align-items-center remember" >
						<input type="checkbox"  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>Se souvenir de moi
					</div>
					<div align="center" class="form-group">
						<input type="submit" value="Connexion" class="btn login_btn">
					</div>
				</form> 
			</div>
			</div>

            
			<div class="card-footer" >
				<div class="d-flex justify-content-center">
                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Mot de passe oublie?
                                    </a>
                                @endif
				</div>
				
			
			</div>
		</div>
	</div>
</div>
</body>
</html>
