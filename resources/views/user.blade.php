@include('header')

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
<div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white">
<form class="d-sm-flex align-items-center justify-content-between" action="{{route('user_List')}}" method="POST">
                            @csrf
                      
  <select s class="select-single-placeholder form-control" name="idgroupe" >
        <option value="" disabled selected>Choisir un groupe</option>
        @foreach($groupes as $groupe)
        <option value="{{ $groupe->id }}">{{ $groupe->nom }}</option>
        @endforeach
    </select>
                  <button   type="submit" class="btn btn-primary ml-1">Rechercher</button>
</form>
          </div>



          
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter">+</button></h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Noms</th>
                        <th>Emails</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                      <th>Noms</th>
                      <th>Emails</th>
                       <th>Actions</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    @foreach($users as $user)
                @php
                    $user = (object) $user;
                @endphp
                      <tr style="color: #000000;">
                        <td>{{ $user->name}}</td>
                        <td>{{ $user->email}}</td>
                       
                        <td>
                        <a data-id="{{ $user->id }}" href="#" class="btn btn-sm btn-primary ajoutusergroupe" data-toggle="modal" data-target="#eexampleModalCenter"
                    id="#modalCenter" dataa-toggle="tooltip" data-original-title="Ajouter cet utilisateur dans un groupe">
    <i class="fas fa-plus"></i>
  </a>
  <a data-id="{{ $user->id }}" href="#" class="btn btn-sm btn-primary attribprofil" data-toggle="modal" data-target="#eeexampleModalCenter"
    id="#modalCenter" dataa-toggle="tooltip" data-original-title="Attribuer un profil a cet utilisateur">
<i class="fas fa-plus"></i>
</a>
                             <a data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-password="{{ $user->password }}" data-telephone="{{ $user->telephone }}" href="#" class="btn btn-sm btn-primary edit-user" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter" dataa-toggle="tooltip" data-original-title="Modifier l'utilisateur'">
    <i class="fas fa-edit"></i>
  </a>
  <a href="#" class="btn btn-sm btn-outline-danger delete-user" data-toggle="modal" data-target="#deleteModal" data-id="{{ $user->id }}" dataa-toggle="tooltip" data-original-title="Supprimer le type de session">
    <i class="fas fa-trash-alt"></i>
  </a>
                        </td>
                      </tr>
                  
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->

                 <!-- Modale de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer cet utilisateur ?
      </div>
      <div class="modal-footer">
        <form action="{{route('user_Destroy')}}" method="POST">
          @csrf
      <input style="display:none;" type="text" class="form-control" name="iduser" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-danger confirmDelete" id="confirmDelete">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>


         
<style>
  .input-label {
  display: flex;
  align-items: center;
}

.input-label input {
  margin-right: 10px;

 
}
</style>

          <!-- Modal Center -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">EDITION DES UTILISATEURS</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
    
                    <form method="POST" action="{{ route('user_Insert') }}">
                        @csrf

                        <input style="display:none;" type="text" class="form-control" name="iduser" >
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                           <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Téléphone</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="telephone" placeholder="685471526">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Profile</label>

                            <div class="col-md-6">
                            <select style="color: #000000;" class="select-single-placeholder form-control" name="profile" id="selectPeee" required>
        <option value="" disabled selected>CHOISIR UN PROFIL</option>
        <option value="ADMINISTRATEUR">ADMINISTRATEUR</option>
        <option value="REGISTER">REGISTER</option>
        <option value="ENSEIGNANT">ENSEIGNANT</option>
        <option value="AUDITEUR">AUDITEUR</option>
        <option value="DSFR">DSFR</option>
        <option value="DNEP">DNEP</option>
    </select>                            </div>
                        </div>


           

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
          


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
                </div>
              </div>
            </div>
          </div>





          
          <!-- Modal Center -->
          <div class="modal fade" id="eexampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="eexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="eexampleModalCenterTitle">Mettre dans un groupe</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <form method="POST"  action="{{route('usergroupe_Insert')}}">
                            @csrf
                            <input style="display:none;" type="text" class="form-control" name="iduser" >
                            <select class="select-single-placeholder form-control" name="idgroupe" id="selectSinglePlaceholder">
            <option value="" disabled selected>Choisir un groupe</option>
            @foreach($groupes as $groupe)
            <option name="idgroupe" value="{{ $groupe->id }}">{{ $groupe->nom }}</option>
            @endforeach
        </select>
        <br>
        <div align="center"><button type="submit" class="btn btn-primary">Sauvegarder</button></div>
                  
</form>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
                </div>
              </div>
            </div>
          </div>






          
          
          <!-- Modal Center -->
          <div class="modal fade" id="eeexampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="eeexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="eeexampleModalCenterTitle">ATTRIBUER UN PROFIL</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <form method="POST"  action="{{route('userprofile_Insert')}}">
                            @csrf
                            <input style="display:none;" type="text" class="form-control" name="iduser" >
                            <div class="row mb-3">
                              <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Profile</label>
  
                              <div class="col-md-6">
                              <select style="color: #000000;" class="select-single-placeholder form-control" name="profile" id="selectPeee" required>
          <option value="" disabled selected>CHOISIR UN PROFIL</option>
          <option value="ADMINISTRATEUR">ADMINISTRATEUR</option>
          <option value="REGISTER">REGISTER</option>
          <option value="ENSEIGNANT">ENSEIGNANT</option>
          <option value="AUDITEUR">AUDITEUR</option>
          <option value="DSFR">DSFR</option>
          <option value="DNEP">DNEP</option>
      </select>                            </div>
                          </div>
                          <div align="center"><button type="submit" class="btn btn-primary">Sauvegarder</button></div>
                  
</form>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
                </div>
              </div>
            </div>
          </div>



          
  

@include('footer')