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
                    id="#modalCenter" style="width:300%"><i class="fas fa-plus"></i></button></h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Libellés</th>
                        <th>Durée (Jours)</th>
                      
                        
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Noms</th>
                        <th>Durée (Jours)</th>
                      
                        
                        <th>Actions</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    @foreach($unitesca as $unitesca)
                @php
                    $unitesca = (object) $unitesca;
                @endphp
                   
                      <tr style="color: #000000;">
                        <td>{{$unitesca->nom}}</td>
                        <td>{{$unitesca->durée}}</td>
                       
                        <td>
                               <a href="#" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{$unitesca->id}}" data-nom="{{$unitesca->nom}}" data-durée="{{$unitesca->durée}}" class="btn btn-sm btn-primary edit-uc" dataa-toggle="tooltip" data-original-title="    Modifier l'unité calendaire"><i class="fas fa-edit"></i></a>
                            <a href="#" data-id="{{$unitesca->id}}" data-toggle="modal" data-target="#deleteModal" class="btn btn-sm btn-outline-danger delete-uc" dataa-toggle="tooltip" data-original-title=" Supprimer l'unité calendaire"><i class="fas fa-trash-alt"></i></a> 
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
        Êtes-vous sûr de vouloir supprimer cette unité ?
      </div>
      <div class="modal-footer">
        <form action="{{route('uniteca_Delete')}}" method="POST">
        @csrf
      <input style="display:none;" type="text" class="form-control" name="idduc" >
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
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Edition des unités calendaires</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form method="POST" action="{{route('uniteca_Insert')}}">
                  @csrf
                  <div class="form-group">
                    <label for="select2SinglePlaceholder">Nom</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Libellé" name="nom">
                  </div>
                        <input style="display:none;" type="number" name="iduc" >
                  <div class="form-group">
                    <label for="select2SinglePlaceholder">Durée jours</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Durée" name="duree">
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