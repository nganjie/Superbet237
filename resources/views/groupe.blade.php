@include('header')

<div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white">
           
          </div>



          
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter" style="width:300%;"><i class="fas fa-plus"></i></button></h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Codes</th>
                        <th>Noms</th>
                        <th>Descriptions</th> 
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                      <th>Codes</th>
                      <th>Noms</th>
                       <th>Descriptions</th> 
                       <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    @foreach($groupes as $groupe)
                @php
                    $groupe = (object) $groupe;
                @endphp
                      <tr style="color: #000000;">
                        <td>{{ $groupe->code}}</td>
                        <td>{{ $groupe->nom}}</td>
                        <td>{{ $groupe->description}}</td>
                       
                        <td>
                        <a data-id="{{ $groupe->id }}" href="#" class="btn btn-sm btn-primary ajoutgrouperole" data-toggle="modal" data-target="#eexampleModalCenter"
                    id="#modalCenter"  dataa-toggle="tooltip" data-original-title="Affecter ce role a un groupe">
    <i class="fas fa-plus"></i>   </a>
    <a data-id="{{ $groupe->id }}" href="#" class="btn btn-sm btn-primary voirgrouperole" data-toggle="modal" data-target="#eeexampleModalCenter"
                    id="#modalCenter"  dataa-toggle="tooltip" data-original-title="Voir les roles de ce groupe">
    <i class="fas fa-eye"></i>
  </a>
                             <a data-id="{{ $groupe->id }}" data-code="{{ $groupe->code }}" 
                             data-nom="{{ $groupe->nom }}" data-description="{{ $groupe->description }}" href="#" class="btn btn-sm btn-primary edit-groupe" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter" dataa-toggle="tooltip" data-original-title="Modifier le type de session">
    <i class="fas fa-edit"></i>
  </a>
  <a data-id="{{ $groupe->id }}" href="#" class="btn btn-sm btn-outline-danger delete-groupe" data-toggle="modal" data-target="#deleteModal" dataa-toggle="tooltip" data-original-title="Supprimer le type de session">
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
        Êtes-vous sûr de vouloir supprimer ce groupe ?
      </div>
      <div class="modal-footer">
        <form action="{{route('groupe_Delete')}}" method="POST">
        @csrf
      <input style="display:none;" type="text" class="form-control" name="idgroupe" >
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
                  <h5 class="modal-title" id="exampleModalCenterTitle">Edition Des Groupes</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form method="POST" action="{{('groupe_Insert')}}">
                            @csrf
                            <input style="display:none;" type="text" name="idgroupe">
                            <div class="form-group">
  <div class="input-label">
  <label class="ml-5" for="select2SinglePlaceholder">Code</label>
    <input style="width:60%; margin-left: 60px;" type="text" class="form-control" id="inputEmail3" placeholder="code" name="code">
    
  </div>
</div>

                  
                  <div class="form-group">
                    <div class="input-label">
                    <label class="ml-5" for="select2SinglePlaceholder">Libellé</label>
                    <input style="width:60%;margin-left: 50px;" type="text" class="form-control" id="inputEmail3" placeholder="libellé" name="nom">
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="input-label">
                    <label class="ml-5" for="select2SinglePlaceholder">Description</label>
                    <input style="width:60%;margin-left: 22px;" type="text" class="form-control" id="inputEmail3" placeholder="description" name="description">
                    </div>
                  </div>
                
                  <button type="submit" class="btn btn-primary">Sauvegarder</button>


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
                  <h5 class="modal-title" id="eexampleModalCenterTitle">Affecter des roles </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form method="POST"  action="{{route('grouperole_Insert_')}}">
                            @csrf
                            <input style="display:none;" type="text" class="form-control" name="idgroupe" >
                            <select class="select-single-placeholder form-control" name="idrole" id="selectSinglePlaceholder">
            <option value="" disabled selected>Choisir un groupe</option>
            @foreach($roles as $role)
            <option name="idrole" value="{{ $role->id }}">{{ $role->nom }}</option>
            @endforeach
        </select>

               
                  <button type="submit" class="btn btn-primary">Sauvegarder</button>


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
                  <h5 class="modal-title" id="eeexampleModalCenterTitle">Voir roles</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

            
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>Codes</th>
              <th>Noms</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>Codes</th>
              <th>Noms</th>
              <th>Actions</th>
            </tr>
          </tfoot>
          <tbody id="gueTableBody">
  <tr style="color: #000000;">
    <td id="champ1Cell"></td>
    <td id="champ2Cell"></td>
  
    <td id="champaction"><td>
  
  </tr>
</tbody>
        </table>
      






          

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
      <div class="modal-header">
        <h5 class="modal-title" id="ddeleteModalLabel">Confirmation de suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir enlever ce role au groupe?
      </div>
      <div class="modal-footer">
      <form action="{{route('rolegroupe_Delete')}}" method="POST">
        @csrf
      <input style="display:none;" type="text" class="form-control" name="idrrole" >
      <input style="display:none;" type="text" class="form-control" name="idggroupe" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-danger confirmDelete" id="confirmDelete">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>
@include('footer')