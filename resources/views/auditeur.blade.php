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
<!--             <h1 class="h3 mb-0 text-gray-800">Auditeurs</h1>
 -->           
  <form class="d-sm-flex align-items-center justify-content-between" action="{{route('auditeur_List')}}" method="POST">
                            @csrf
                      
  <select style="width:60%;color: #000000;" class="select-single-placeholder form-control" name="organisation" id="selectOrg" required>
        <option value="" disabled selected>CHOISIR UNE ORGANISATION</option>
        @foreach($organisations as $organisation)
        <option value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
        @endforeach
    </select>
  <select style="width:60%;color: #000000;" class="select-single-placeholder form-control ml-1" name="perio" id="selectPe" required>
        <option value="" disabled selected>CHOISIR UNE PERIODE</option>
    </select>
 <select style="width:60%;color: #000000;" class="select-single-placeholder form-control ml-1" name="parc" id="selectPa" required>
        <option value="" disabled selected>CHOISIR UN PARCOURS</option>
    </select>
  <select style="width:60%;color: #000000;" class="select-single-placeholder form-control ml-1" name="re" id="selectre" required>
        <option value="" disabled selected>CHOISIR UN REGROUPEMENT</option>
    </select>
           <!--  <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./AccueilAdmin.php">Accueil</a></li>
              <li class="breadcrumb-item active" aria-current="page">Auditeurs</li>
            </ol> -->                  <button style="width:20%;"  type="submit" class="btn btn-primary ml-1">RECHERCHER</button>
</form>
          </div>



          
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                 @if(isset($auditeurslist))
                @foreach ($auditeurslist as $index => $firstAuditeur)
                <h6 class="m-0 font-weight-bold text-primary">
                    @if ($index === 0)

                    @foreach(session('user_roles') as $role)
    @if($role->code === 'TFAU') 
                        <button class="btnaudi-download-pdf" data-idreg="{{ $firstAuditeur->idreg }}" >Télécharger PDF</button>
                         @break
            @endif
        @endforeach 

                        @foreach(session('user_roles') as $role)
    @if($role->code === 'IFAU') 
                        <button class="btnaudi-print" data-idreg="{{ $firstAuditeur->idreg }}">Imprimer</button>
                        @break
                        @endif
                    @endforeach 

                        @endif
                </h6>
            @endforeach
            @endif
              <form  id="myFormaudi" method="POST" action="">
    @csrf
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">

                    @foreach(session('user_roles') as $role)
                    @if($role->code === 'AJAU') 
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter" style="width:300%;"  dataa-toggle="tooltip" data-original-title="Nouvel auditeur"><i class="fas fa-plus"></i></button></h6>
                    @break
                    @endif
                @endforeach 

                    @foreach(session('user_roles') as $role)
                    @if($role->code === 'AJARE') 
                    <button data-toggle="modal" data-target="#eeeeexampleModalCenter" dataa-toggle="tooltip" data-original-title="Ajouter dans regroupement" class="btn btn-primary" type="button" style="width:10%"  id="regroupementButton">
                      <i class="fas fa-share"></i>
                  </button>
                  @break
                  @endif
              @endforeach 

                 {{--  <button data-toggle="modal" data-target="#eeeeeexampleModalCenter" dataa-toggle="tooltip" data-original-title="Enlever du regroupement" class="btn btn-primary" type="button" style="width:10%"  id="regroupementButtondelete">
                    <i class="fas fa-share"></i>
                </button> --}}
                @foreach(session('user_roles') as $role)
                @if($role->code === 'SPAUDI') 
                    <button class="btn btn-outline-danger" type="submit" class="btn btn-primary" style="width:10%"  dataa-toggle="tooltip" data-original-title="Supprimer tous ces auditeurs"><i class="fas fa-trash-alt"></i></button>
                    @break
                    @endif
                @endforeach 

                  </div>
                <div class="table-responsive p-3">
                  @if(isset($auditeurs) && !empty($auditeurs))
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr style="color: #000000;">
                      <th style="width:1%;color: #000000;"></th>
                        <th style="color: #000000;">MATRICULES</th>
                        <th style="color: #000000;">NOMS</th>
                        <th style="color: #000000;">PRENOMS</th>
                        <th style="color: #000000;">DATES NAISSANCES</th>
                        <th style="color: #000000;">ACTIONS</th>
                      </tr>
                    </thead>
                    <tfoot >
                      <tr style="width:1%">
                      <th></th>
                      <th>MATRICULES</th>
                        <th >NOMS</th>
                        <th >PRENOMS</th>
                        <th>DATES NAISSANCES</th>
                        <th >ACTIONS</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    @foreach($auditeurs as $auditeur)
                @php
                    $auditeur = (object) $auditeur;
                @endphp
                      <tr style="color: #000000;">
                      <td><input style="cursor:pointer;" type="checkbox" value="" id="checkbox'{{$auditeur->id}}'" data-id="{{$auditeur->id}}" onchange="updateSelectedElements('{{$auditeur->id}}', this.checked)">
                      </td>
                        <td>{{$auditeur->matricule}}</td>
                        <td>{{$auditeur->nom}}</td>
                        <td>{{$auditeur->prenom}}</td>
                        <td>{{$auditeur->date}}</td>
                
                        <td>
{{--                         <a href="#" class="btn btn-sm btn-primary compte-audi" data-toggle="modal" data-target="#ddddeleteModal"  dataa-toggle="tooltip" data-original-title="céer compte" data-email="{{ $auditeur->email }}" data-iduser="{{ $auditeur->iduser }}" data-tel="{{ $auditeur->tel }}">add</a>
 --}}                        <a href="#" class="btn btn-sm btn-primary adit-btnaudi" data-toggle="modal" data-target="#eeexampleModalCenter"
                    id="#modalCenter" dataa-toggle="tooltip" data-original-title="Ajouter cet auditeur dans un regroupement" data-id="{{ $auditeur->id }}">
    <i class="fas fa-plus"></i> </a>    
                                 <a href="#" data-id="{{ $auditeur->id }}" data-matricule="{{ $auditeur->matricule }}" data-nom="{{ $auditeur->nom }}" data-prenom="{{ $auditeur->prenom }}" data-date="{{ $auditeur->date }}" data-email="{{ $auditeur->email }}" data-tel="{{ $auditeur->tel }}" data-provenance="{{ $auditeur->provenance }}" data-imageurl="{{ $auditeur->imageurl }}" class="btn btn-sm btn-primary details-audi" data-toggle="modal" data-target="#eexampleModalCenter"
                    id="#modalCenter" dataa-toggle="tooltip" data-original-title="Détails de l'auditeur">
    <i class="fas fa-address-book"></i>
  </a>
   <a href="#" class="btn btn-sm btn-primary edit-btnaudi" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter" dataa-toggle="tooltip" data-original-title="Modifier l'auditeur" data-id="{{ $auditeur->id }}"
  data-nom="{{ $auditeur->nom }}" data-prenom="{{ $auditeur->prenom }}" data-date="{{ $auditeur->date }}" data-genre="{{ $auditeur->genre }}" data-email="{{ $auditeur->email }}" data-tel="{{ $auditeur->tel }}" data-iduser="{{ $auditeur->iduser }}"> 
    <i class="fas fa-edit"></i>
  </a>          
  <a href="#" class="btn btn-sm btn-outline-danger delete-btnau" data-toggle="modal" data-target="#deleteModal" dataa-toggle="tooltip" data-original-title="Supprimer l'auditeur" data-id="{{ $auditeur->id }}">
    <i class="fas fa-trash-alt"></i>
  </a>
                        </td>
                      </tr>
                   
                      @endforeach
                    </tbody>
                  </table>
                  @endif




                  @if(isset($auditeurslist) && !empty($auditeurslist))
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr style="color: #000000;">
                      <th style="color: #000000;"></th>
                        <th style="color: #000000;">MATRICULES</th>
                        <th style="color: #000000;">NOMS</th>
                        <th style="color: #000000;">PRENOMS</th>
                        <th style="color: #000000;">DATES NAISSANCES</th>
                        <th style="color: #000000;">ACTIONS</th>
                      </tr>
                    </thead>
                    <tfoot >
                      <tr style="color: #000000;">
                      <th></th>
                      <th>MATRICULES</th>
                        <th >NOMS</th>
                        <th >PRENOMS</th>
                        <th>DATES NAISSANCES</th>
                        <th >ACTIONS</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    @foreach($auditeurslist as $auditeur)
                @php
                    $auditeur = (object) $auditeur;
                @endphp
                      <tr style="color: #000000;">
                      <td><input style="cursor:pointer;" type="checkbox" value="" id="checkbox'{{$auditeur->id}}'" data-id="{{$auditeur->id}}" onchange="updateSelectedElements('{{$auditeur->id}}', this.checked)"></td>
                        <td>{{$auditeur->matricule}}</td>
                        <td>{{$auditeur->nom}}</td>
                        <td>{{$auditeur->prenom}}</td>
                        <td>{{$auditeur->date}}</td>
                
                        <td>
                          @foreach(session('user_roles') as $role)
                          @if($role->code === 'CCAU') 
                        <a href="#" class="btn btn-sm btn-primary compte-audi" data-toggle="modal" data-target="#ddddeleteModal"  dataa-toggle="tooltip" data-original-title="céer compte" data-email="{{ $auditeur->email }}" data-iduser="{{ $auditeur->iduser }}" data-tel="{{ $auditeur->tel }}" data-nom="{{ $auditeur->nom }}"><i class="fas fa-user-plus"></i></a>
                        @break
                    @endif
                @endforeach 

                        @foreach(session('user_roles') as $role)
                        @if($role->code === 'AJARE') 
                        <a href="#" class="btn btn-sm btn-primary adit-btnaudi" data-toggle="modal" data-target="#eeexampleModalCenter"
                    id="#modalCenter" dataa-toggle="tooltip" data-original-title="Ajouter cet auditeur dans un regroupement" data-id="{{ $auditeur->id }}">
    <i class="fas fa-plus"></i> </a>  
    @break
    @endif
@endforeach 
    
    @foreach(session('user_roles') as $role)
    @if($role->code === 'DEAU') 
                                 <a href="#" data-id="{{ $auditeur->id }}" data-matricule="{{ $auditeur->matricule }}" data-nom="{{ $auditeur->nom }}" data-prenom="{{ $auditeur->prenom }}" data-date="{{ $auditeur->date }}" data-email="{{ $auditeur->email }}" data-tel="{{ $auditeur->tel }}" data-provenance="{{ $auditeur->provenance }}" data-imageurl="{{ $auditeur->imageurl }}" class="btn btn-sm btn-primary details-audi" data-toggle="modal" data-target="#eexampleModalCenter"
                    id="#modalCenter" dataa-toggle="tooltip" data-original-title="Détails de l'auditeur">
    <i class="fas fa-address-book"></i>
  </a>
  @break
  @endif
@endforeach 

  @foreach(session('user_roles') as $role)
  @if($role->code === 'MOAU') 
   <a href="#" class="btn btn-sm btn-primary edit-btnaudi" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter" dataa-toggle="tooltip" data-original-title="Modifier l'auditeur" data-id="{{ $auditeur->id }}"
  data-nom="{{ $auditeur->nom }}" data-prenom="{{ $auditeur->prenom }}" data-date="{{ $auditeur->date }}" data-genre="{{ $auditeur->genre }}" data-email="{{ $auditeur->email }}" data-tel="{{ $auditeur->tel }}" data-iduser="{{ $auditeur->iduser }}">
    <i class="fas fa-edit"></i>
  </a>  
  @break
  @endif
@endforeach 
  
  @foreach(session('user_roles') as $role)
  @if($role->code === 'SUAU') 
  <a href="#" class="btn btn-sm btn-outline-danger delete-btnau" data-toggle="modal" data-target="#deleteModal" dataa-toggle="tooltip" data-original-title="Supprimer l'auditeur" data-id="{{ $auditeur->id }}">
    <i class="fas fa-trash-alt"></i>
  </a>
  @break
  @endif
@endforeach 
                        </td>
                      </tr>
                   
                      @endforeach
                    </tbody>
                  </table>
                  @endif
                </div>
                </form>
              </div>
            </div>
          </div>
          <!--Row-->




          <!-- Modal datails auditeur-->
          <div class="modal fade" id="eexampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="eexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 class="modal-title" id="eexampleModalCenterTitle" style="color:white;margin-left:25%;">DETAILS SUR L'AUDITEURS</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                  

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
                </div>
              </div>
            </div>
          </div>
         
                    <!-- Modale de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#BE7A17;">
        <h5 style="margin-left:25%" class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p style="color: #000000;" >Êtes-vous sûr de vouloir supprimer cet auditeur ?</p>  
      </div>
      <div class="modal-footer">
        <form action="{{route('auditeur_Delete')}}" method="POST">
        @csrf
      <input style="display:none;" type="text" class="form-control" name="iddaudi" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-danger confirmDelete" id="confirmDelete">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>


          <!-- Modal Center -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 class="modal-title" id="exampleModalCenterTitle" style="color:white;margin-left:35%">EDITION AUDITEURS</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form action="{{route('auditeur_Insert')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input style="display:none;" type="text" class="form-control" name="idau" >
                            <input style="display:none;" type="text" class="form-control" name="iduser" >

                            

                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Nom</label>
                    <input style="color: #000000;" type="text" class="form-control" id="inputEmail3" placeholder="nom" name="nom" required>
                  </div>
                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Prenom</label>
                    <input style="color: #000000;" type="text" class="form-control" id="inputEmail3" placeholder="prenom" name="prenom" >
                  </div>

                  <div class="form-group">
                            <label style="color: #000000;" for="select2SinglePlaceholder">Genre</label>
                    <select style="color: #000000;" class="select-single-placeholder form-control" name="genre" id="selectSinglePlaceholder" required>
                      <option value="" disabled selected>choisir le genre</option>
                      <option value="Male">Masculin</option>
                      <option value="Femele">Féminin</option>
                    
             
                    </select>
                  </div>

                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Email</label>
                    <input style="color: #000000;" type="email" class="form-control" id="inputEmail3" placeholder="email" name="email" >
                  </div>

                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Téléphone</label>
                    <input style="color: #000000;" type="text" class="form-control" id="inputEmail3" placeholder="téléphone" name="tel" >
                  </div>

                  <div class="form-group" id="simple-date2">
                    <label style="color: #000000;" for="oneYearView">Date Naissance</label>
                      <div class="input-group date">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input style="color: #000000;" type="text" class="form-control" value="01/06/2020" id="oneYearView" name="date" >
                      </div>
                  </div>

                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Organistaion provenance</label>
                    <input style="color: #000000;" type="text" class="form-control"  placeholder="provenance" name="provenance" >
                  </div>

                  <div class="form-group">
  <label style="color: #000000;" for="select2SinglePlaceholder">photo</label>
  <input type="file" name="image" id="imageInput">
</div>

<div align="center" id="imagePreview"></div>

<script>
  const imageInput = document.getElementById('imageInput');
  const imagePreview = document.getElementById('imagePreview');

  imageInput.addEventListener('change', function() {
    const file = this.files[0];
    const reader = new FileReader();

    reader.addEventListener('load', function() {
      const image = new Image();
      image.src = reader.result;
      image.style.maxWidth = '100%';
      image.style.maxHeight = '200px';
      imagePreview.innerHTML = '';
      imagePreview.appendChild(image);
    });

    if (file) {
      reader.readAsDataURL(file);
    }
  });
</script>
<div align="center">
<button  type="submit" class="btn btn-primary">ENREGISTRER</button>
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
          <div class="modal fade" id="eeexampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="eeexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                <div style="margin-left:25%">
                <h5 class="modal-title" id="eeexampleModalCenterTitle" style="color:white;">METTRE DANS UN REGROUPEMENT</h5>
                </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form action="{{route('auditeurregrou_Insert')}}" method="POST">
                            @csrf
                      
                            <input style="display:none;" type="text" class="form-control" name="idaudia" >

                  <div class="form-group">
    <label style="color: #000000;" for="selectSinglePlaceholder">Organisation</label>
    <select style="color: #000000;" class="select-single-placeholder form-control" name="organisation" id="selectOrggg" required>
        <option value="" disabled selected>Choisir une organisation</option>
        @foreach($organisations as $organisation)
        <option value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
        @endforeach
    </select>
</div>
<input style="display:none;" type="text" class="form-control" name="idafpro" >

<div class="form-group">
    <label style="color: #000000;" for="selectSinglePlaceholder">Période</label>
    <select style="color: #000000;" class="select-single-placeholder form-control" name="perio" id="selectPeee" required>
        <option value="" disabled selected>Choisir une période</option>
    </select>
</div>

<div class="form-group">
    <label style="color: #000000;" for="selectSinglePlaceholder">Parcours</label>
    <select style="color: #000000;" class="select-single-placeholder form-control" name="parc" id="selectPaaa" required>
        <option value="" disabled selected>Choisir un Parcours</option>
    </select>
</div>

<div class="form-group">
    <label style="color: #000000;" for="selectSinglePlaceholder">Regroupement</label>
    <select style="color: #000000;" class="select-single-placeholder form-control" name="re" id="selectreee" required>
        <option value="" disabled selected>Choisir un regroupement</option>
    </select>
</div>

              <div align="center"><button type="submit" class="btn btn-primary">METTRE</button></div>
                  
</form>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
            
                </div>
              </div>
            </div>
          </div>



                   <!-- Modale de confirmation de suppression -->
                   <div class="modal fade" id="ddddeleteModal" tabindex="-1" role="dialog" aria-labelledby="ddddeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#BE7A17;">
        <h5 style="margin-left:25%" class="modal-title" id="ddddeleteModalLabel">Confirmation de création de compte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p style="color: #000000;" >Êtes-vous sûr de vouloir créer un compte a cet auditeur ?</p>  
      </div>
      <div class="modal-footer">
      <form method="POST" action="{{ route('audimail') }}">
                        @csrf
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            
            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
					</div>
          <input  type="text" class="form-control" name="iduser" >   
            <input  type="text" class="form-control" name="tel" > 
            <input  type="text" class="form-control" name="nom" > 
				
					<div align="center" class="form-group">
						<input type="submit" value="Créer son compte" class="btn login_btn">
					</div>
				</form>
      </div>
    </div>
  </div>
</div>







           <!-- Modal Center -->
           <div class="modal fade" id="eeeeexampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="eeeeexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 class="modal-title" id="eeeeexampleModalCenterTitle" style="color:white;margin-left:25%">AFFECTER DES PROMOTIONS A DES PARCOURS ACADEMIQUES</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form id="myFormaudi" action="{{route('auditeurregrou_Insertm')}}" method="POST">
                            @csrf
                            <input type="hidden" name="selectedElementsaudi" id="selectedElementsField">
                            <input style="display:none;" type="text" class="form-control" name="idaudi" >

                           
                  <div class="form-group">
                    <label style="color: #000000;" for="selectSinglePlaceholder">Organisation</label>
                    <select style="color: #000000;" class="select-single-placeholder form-control" name="organisation" id="selectOrgggg" required>
                        <option value="" disabled selected>Choisir une organisation</option>
                        @foreach($organisations as $organisation)
                        <option value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
                        @endforeach
                    </select>
                </div>
                <input style="display:none;" type="text" class="form-control" name="idafpro" >
                
                <div class="form-group">
                    <label style="color: #000000;" for="selectSinglePlaceholder">Période</label>
                    <select style="color: #000000;" class="select-single-placeholder form-control" name="perio" id="selectPeeee" required>
                        <option value="" disabled selected>Choisir une période</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label style="color: #000000;" for="selectSinglePlaceholder">Parcours</label>
                    <select style="color: #000000;" class="select-single-placeholder form-control" name="parc" id="selectPaaaa" required>
                        <option value="" disabled selected>Choisir un Parcours</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label style="color: #000000;" for="selectSinglePlaceholder">Regroupement</label>
                    <select style="color: #000000;" class="select-single-placeholder form-control" name="re" id="selectreeee" required>
                        <option value="" disabled selected>Choisir un regroupement</option>
                    </select>
                </div>

<div align="center">
<button type="submit" class="btn btn-primary">AJOUTER</button>
</div>
                  
</form>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
                
                </div>
              </div>
            </div>
          </div>


          @include('footer')