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
<form class="d-sm-flex align-items-center justify-content-between"  action="{{route('enseignant_List')}}" method="POST">
              @csrf
              <select style="color: #000000;" style="width:300%" class="select-single-placeholder form-control" name="idue" id="selectOrg" required>
        <option value="" disabled selected>CHOISIR UNE UNITE D'ENSEIGNEMENT</option>
        @foreach($ues as $ue)
        <option value="{{ $ue->id }}">{{ $ue->nomue }}</option>
        @endforeach
    </select>
  
        <button type="submit" class="btn btn-primary ml-1" style="width:100%">RECHERCHER</button>

        </form>
          </div>



          
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">

                    @foreach(session('user_roles') as $role)
                    @if($role->code === 'AJENS') 
                     <button style="width:300%" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter"> <i class="fas fa-plus"></i></button>
                    @break
                    @endif
                  @endforeach 
                  </h6>

                  @foreach(session('user_roles') as $role)
                    @if($role->code === 'SPPENS') 
                    <button class="btn btn-outline-danger" type="submit" class="btn btn-primary" style="width:10%"><i class="fas fa-trash-alt"></i></button>
                    @break
                    @endif
                  @endforeach 
                  </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr style="color: #000000;">
                      <th style="width:2%"></th>
                        <th style="color: #000000;">GRADES</th>
                        <th style="color: #000000;">NOMS</th>
                        <th style="color: #000000;">PRENOMS</th>
                        <th style="color: #000000;">QUALITES</th>    
                        <th style="color: #000000;">ACTIONS</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr style="color: #000000;">
                      <th style="width:2%"></th>
                      <th>GRADES</th>
                        <th>NOMS</th>
                        <th>PRENOMS</th>
                        <th>QUALITES</th>
                        <th>ACTIONS </th>
                      </tr>
                    </tfoot>
                    <tbody>
                    @foreach($enseignants as $enseignant)
                @php
                    $enseignant = (object) $enseignant;
                @endphp
                   
                      <tr style="color: #000000;">
                      <td>
                    <input style="cursor:pointer;" type="checkbox" value="" id="checkbox' {{$enseignant->id}}'" data-id="{{$enseignant->id}}" onchange="updateSelectedElements({{$enseignant->id}}, this.checked)">
                    </td>
                        <td>{{$enseignant->numeroens}}</td>
                        <td>{{$enseignant->nomens}}</td>
                        <td>{{$enseignant->prenomens}}</td>
                       <td>{{$enseignant->gradeEns}}</td>
                     
                        <td>
                          @foreach(session('user_roles') as $role)
                    @if($role->code === 'CCENS') 
                          <a href="#" class="btn btn-sm btn-primary compte-ens" data-toggle="modal" data-target="#ddddeleteModal"  dataa-toggle="tooltip" data-original-title="céer compte" data-emailens="{{ $enseignant->emailens }}" data-telens="{{ $enseignant->telens }}" data-iduser="{{ $enseignant->iduser }}" data-nomens="{{ $enseignant->nomens }}"><i class="fas fa-user-plus"></i></a>
                          @break
                          @endif
                        @endforeach 

                          @foreach(session('user_roles') as $role)
                    @if($role->code === 'AFENS') 
                          <a href="#" class="btn btn-sm btn-primary btn-afens" data-id="{{ $enseignant->id }}" data-toggle="modal" data-target="#eeeexampleModal" onclick="openModallee()" dataa-toggle="tooltip" data-original-title="Affecter cet enseignant a une matière">    <i class="fas fa-plus"></i></a>
                         @break
  @endif
@endforeach 

                          @foreach(session('user_roles') as $role)
                    @if($role->code === 'VMMENS') 
                          <a href="#" class="btn btn-sm btn-primary vueens" data-id="{{ $enseignant->id }}" data-toggle="modal" data-target="#eeexampleModal" onclick="openModallee()" dataa-toggle="tooltip" data-original-title="Voir les unité d'enseignements dispensées par cet enseignant"> <i class="fas fa-eye"></i></a>
             </a>
             @break
             @endif
           @endforeach 

             @foreach(session('user_roles') as $role)
             @if($role->code === 'MOENS') 
             <a href="#" data-id="{{ $enseignant->id }}" 
    data-numeroens="{{ $enseignant->numeroens }}"
    data-nomens="{{ $enseignant->nomens }}"
    data-prenomens="{{ $enseignant->prenomens }}" 
    data-emailens="{{ $enseignant->emailens }}"
    data-telens="{{ $enseignant->telens }}" 
    data-gradeEns="{{(string) $enseignant->gradeEns }}" data-iduser="{{ $enseignant->iduser }}"  class="btn btn-sm btn-primary btn-editens" data-toggle="modal" data-target="#exampleModalCenter" id="#modalCenter" data-toggle="tooltip" data-original-title="Modifier l'enseignant">
    <i class="fas fa-edit"></i>
</a>
@break
@endif
@endforeach 

@foreach(session('user_roles') as $role)
                    @if($role->code === 'SPENS') 
  <a href="#" data-id="{{ $enseignant->id }}"  class="btn btn-sm btn-outline-danger btnensde" data-toggle="modal" data-target="#deleteModal" dataa-toggle="tooltip" data-original-title="Supprimer l'enseignant">
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
                </div>
              </div>
            </div>
          </div>
          <!--Row-->



          

          <!-- Modale de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#BE7A17;">
        <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <p style="color: #000000;">Êtes-vous sûr de vouloir supprimer cet enseignant ?</p> 
      </div>
      <div class="modal-footer">
        <form action="{{route('enseignant_Delete')}}" method="POST">
        @csrf
      <input style="display:none;" type="text" class="form-control" name="iddens" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-danger confirmDelete" id="confirmDelete">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>




              <!-- Modal pour ajouter une ue a un enseignant-->
              <div class="modal fade" id="eeeexampleModal" tabindex="-1" role="dialog" aria-labelledby="eeeexampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 class="modal-title" id="eeeexampleModalLabel" style="color:white;margin-left:35%">AFFECTER A DES UNITES D'ENSEIGNEMENTS</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                
                <form action="{{route('ueenseignant_Insert')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Unité d'enseignement</label>
                    <select style="color: #000000;" class="select2-single-placeholder form-control" style="width:100%; height:1000%" name="idue" id="select2SinglePlaceholder" required>
                    <option value="">Selectionner l'Unité d'enseignement</option> 
                    @foreach($ues as $ue)
                    <option value="{{ $ue->id }}">{{ $ue->nomue }}</option>
                    @endforeach
                    </select>
                  </div>
                  <input style="display:none;" type="text" class="form-control" name="idens" >
<div align="center">
<button type="submit" class="btn btn-primary">ENREGISTRER</button>
</div>
                
                </form>
    

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
         


          
          
                    <!-- Modal pour voir les ue -->
                    <div class="modal fade" id="eeexampleModal" tabindex="-1" role="dialog" aria-labelledby="eeexampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 style="color:white;margin-left:35%" class="modal-title" id="eeexampleModalLabel">VOIR UNITES D'ENSEIGNEMENTS</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr style="color: #000000;">
              <th>NOMS</th>
             <th>COEFFICIENT</th>
              <th>ACTIONS</th>

            </tr>
          </thead>
          <tbody id="ueTableBody">
  <tr style="color: #000000;">
    <td id="champ1Cell"></td>
  
    <td id="champaction"><td>
  
  </tr>
</tbody>

        </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
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
                  <h5 style="color:white;margin-left:35%" class="modal-title" id="exampleModalCenterTitle" style="color:white;">EDITION DES ENSEIGNANTS</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form action="{{route('enseignant_Insert')}}" method="POST">
                            @csrf
                            <input style="display:none;" type="text" class="form-control" name="idens" >
                            <input style="display:none;" type="text" class="form-control" name="iduser" >

                            <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Grade</label>
                    <input style="color: #000000;" type="text" class="form-control" id="inputEmail3" placeholder="grade" name="numero" required>
                  </div>
                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Nom</label>
                    <input style="color: #000000;" type="text" class="form-control" id="inputEmail3" placeholder="nom" name="nom" required>
                  </div>

                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Prenom</label>
                    <input style="color: #000000;" type="text" class="form-control" id="inputEmail3" placeholder="prenom" name="prenom" >
                  </div>

                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Email</label>
                    <input style="color: #000000;" type="text" class="form-control" id="inputEmail3" placeholder="email" name="email" >
                  </div>

                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Téléphone</label>
                    <input style="color: #000000;" type="text" class="form-control" id="inputEmail3" placeholder="téléphone" name="tel" required>
                  </div>
                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Qualité</label>
                    <input style="color: #000000;" type="text" class="form-control" id="inputEmail3" placeholder="qualité" name="grade" >
                  </div>
                  <div align="center">
                  <button type="submit" class="btn btn-primary">ENREGISTRER</button>
                  </div>
                  
</form>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
               
                </div>
              </div>
            </div>
          </div>



          <!-- Modale de confirmation de suppression -->
          <div class="modal fade" id="ddeleteModal" tabindex="-1" role="dialog" aria-labelledby="ddeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#BE7A17;">
        <h5 class="modal-title" id="ddeleteModalLabel">Confirmation de suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p style="color: #000000;">Êtes-vous sûr de vouloir supprimer cette unité a cet enseignant?</p>
      </div>
      <div class="modal-footer">
        <form action="{{route('ue_ens_Delete')}}" method="POST">
        @csrf
      <input style="display:none;" type="text" class="form-control" name="iddegue" >
      <input style="display:none;" type="text" class="form-control" name="idue" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-danger confirmDelete" id="confirmDelete">Supprimer</button>
        </form>
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
                  <p style="color: #000000;" >Êtes-vous sûr de vouloir envoyer les informations de connexion du compte?</p>  
                  </div>
                  <div class="modal-footer">
                  <form method="POST" action="{{ route('ensmail') }}">
                                    @csrf
                      <div class="input-group form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input  id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" >
                                    @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                      </div>
                      <input   type="text" name="telens" >
                         <input  type="text" name="iduser" >
                    <input   type="text" name="nomens" >
                      <div align="center" class="form-group">
                        <input type="submit" value="CREER LE COMPTE" class="btn login_btn">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>


          @include('footer')