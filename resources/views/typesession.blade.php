@include('header')

<div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white">
            <h1 class="h3 mb-0 text-gray-800">Types Sessions</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./AccueilAdmin.php">Accueil</a></li>
              <li class="breadcrumb-item active" aria-current="page">Types Sessions</li>
            </ol>
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
                        <th>Anonymat</th> 
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                      <th>Codes</th>
                      <th>Noms</th>
                       <th>Anonymat</th> 
                       <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    @foreach($typesessions as $typesession)
                @php
                    $typesession = (object) $typesession;
                @endphp
                      <tr style="color: #000000;">
                        <td>{{$typesession->nom}}</td>
                        <td>{{$typesession->description}}</td>
                        <td>{{$typesession->anonymat}}</td>
                       
                        <td>
                             <a href="#" data-id="{{$typesession->id}}" data-nom="{{$typesession->nom}}" data-description="{{$typesession->description}}" data-anonymat="{{$typesession->anonymat}}" class="btn btn-sm btn-primary edit-typesess" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter" dataa-toggle="tooltip" data-original-title="Modifier le type de session">
    <i class="fas fa-edit"></i>
  </a>
  <a href="#" data-id="{{$typesession->id}}" class="btn btn-sm btn-outline-danger delete-typesess" data-toggle="modal" data-target="#deleteModal" dataa-toggle="tooltip" data-original-title="Supprimer le type de session">
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
        Êtes-vous sûr de vouloir supprimer ce type de session?
      </div>
      <div class="modal-footer">
        <form action="{{route('typesession_Delete')}}" method="POST">
        @csrf
      <input style="display:none;" type="text" class="form-control" name="iddtype" >
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
                  <h5 class="modal-title" id="exampleModalCenterTitle">Edition Types Sessions</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form method="POST"  action="{{route('typesession_Insert')}}">
                            @csrf
                            <div class="form-group">
  <div class="input-label">
  <label class="ml-5" for="select2SinglePlaceholder">Nom</label>
    <input style="width:60%; margin-left: 60px;" type="text" class="form-control" id="inputEmail3" placeholder="code" name="code">
    
  </div>
</div>

                  <input style="display:none;" type="number" name="idtype" >
                  <div class="form-group">
                    <div class="input-label">
                    <label class="ml-5" for="select2SinglePlaceholder">Description</label>
                    <input style="width:60%;margin-left: 50px;" type="text" class="form-control" id="inputEmail3" placeholder="libellé" name="nom">
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="input-label">
                    <label class="ml-5" for="select2SinglePlaceholder">Anonymat</label>
                    <input style="width:60%;margin-left: 22px;" type="number" min="0" max="1" class="form-control" id="inputEmail3" placeholder="anonymat" name="anonyme">
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



@include('footer')