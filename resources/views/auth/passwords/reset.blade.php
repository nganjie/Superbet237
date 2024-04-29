
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
height: 370px;
margin-top: auto;
margin-bottom: auto;
width: 400px;
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
			<div class="card-header">
				<h5 style="color:rgb(11, 141, 239);text-transform: uppercase;">
                    <span class="circle-icon">
                      <i class="fas fa-exclamation-circle"></i>
                    </span>
                    Renitialiser le mot de passe
                  </h5>
			</div>
			<div class="card-body">
				<div align="center">
					<p style="color:rgb(11, 141, 239);text-transform: none; font-size: 12px;">
						<span class="circle-icon">
						  <i class="fas fa-exclamation-circle"></i>
						</span>
						Veuillez renseigner votre nouveau mot de passe et ensuite cliquez sur renitialiser.
					</p>
				</div>
            <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input readonly id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
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
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="button" id="showPasswordToggle">
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
						const passwordInput = document.getElementById('password');
						const showPasswordToggle = document.getElementById('showPasswordToggle');
					
						showPasswordToggle.addEventListener('click', function() {
							if (passwordInput.type === 'password') {
								passwordInput.type = 'text';
								showPasswordToggle.innerHTML = '<i class="fa fa-eye-slash"></i>';
							} else {
								passwordInput.type = 'password';
								showPasswordToggle.innerHTML = '<i class="fa fa-eye"></i>';
							}
						});
					</script>

<div class="input-group form-group">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-key"></i></span>
    </div>
    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
    <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" id="showConfirmPasswordToggle">
            <i class="fa fa-eye"></i>
        </button>
    </div>
</div>

<script>
    const confirmPasswordInput = document.getElementById('password-confirm');
    const showConfirmPasswordToggle = document.getElementById('showConfirmPasswordToggle');

    showConfirmPasswordToggle.addEventListener('click', function() {
        if (confirmPasswordInput.type === 'password') {
            confirmPasswordInput.type = 'text';
            showConfirmPasswordToggle.innerHTML = '<i class="fa fa-eye-slash"></i>';
        } else {
            confirmPasswordInput.type = 'password';
            showConfirmPasswordToggle.innerHTML = '<i class="fa fa-eye"></i>';
        }
    });
</script>

					<div align="center" class="form-group">
                    <input type="submit" value="Renitialiser" class="btn login_btn">
					</div>
				</form>
			</div>
			
		</div>
	</div>
</div>
</body>
</html>

