@include('header')

<div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white">
<form class="d-sm-flex align-items-center justify-content-between" action="">
    @csrf
    <select class="select-single-placeholder form-control" name="state" id="seletOrg" >
            <option value="" disabled selected>Choisir une organisation</option>
            @foreach($organisations as $organisation)
            <option name="state" value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
            @endforeach
        </select>
 <select class="select-single-placeholder form-control ml-1" name="perio" id="seletPe">
            <option value="" disabled selected>Choisir une période</option>
           </select>

        <button type="submit" class="btn btn-primary ml-1" style="width:100%">Rechercher</button>
    </form>
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
                        <th>Noms</th>
                        <th>Unité Calendaire</th>
                        <th>Durée </th>
                        <th>Debut</th>
                        <th>Fin</th>
                        
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Noms</th>
                        <th>Unité Calendaire</th>
                        <th>Durée</th>
                        <th>Debut</th>
                        <th>Fin</th>
                        
                        <th>Action </th>
                      </tr>
                    </tfoot>
                    <tbody>
                    @foreach($divisionsca as $divisionsca)
                @php
                    $divisionsca = (object) $divisionsca;
                @endphp
                      <tr style="color: #000000;">
                        <td>{{$divisionsca->nom}}</td>
                        <td>{{$divisionsca->nomunite}}</td>
                        <td>{{$divisionsca->duree}}</td>
                        <td>{{$divisionsca->datedebut}}</td>
                        <td>{{$divisionsca->datefin}}</td>
                        <td>
                        <a href="#" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{$divisionsca->id}}" data-perio="{{$divisionsca->idperio}}" data-iduc="{{$divisionsca->iduc}}" data-nom="{{$divisionsca->nom}}" data-datefin="{{$divisionsca->datefin}}" data-datedebut="{{$divisionsca->datedebut}}" class="btn btn-sm btn-primary edit-dc" dataa-toggle="tooltip" data-original-title=" Modifier la division calendaire"><i class="fas fa-edit"></i></a>
                            <a href="#" data-toggle="modal" data-target="#deleteModal" data-id="{{$divisionsca->id}}" class="btn btn-sm btn-outline-danger delete-dc" dataa-toggle="tooltip" data-original-title=" Supprimer la division calendaire"><i class="fas fa-trash-alt"></i></a>
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
        Êtes-vous sûr de vouloir supprimer cette division ?
      </div>
      <div class="modal-footer">
        <form action="{{route('divisionca_Delete')}}" method="POST">
        @csrf
      <input style="display:none;" type="text" class="form-control" name="idddc" >
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
                  <h5 class="modal-title" id="exampleModalCenterTitle">Edition Divisions calendaires</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form method="POST" action="{{route('divisionca_Insert')}}">
                              @csrf
                            <div class="form-group">
    <label for="selectSinglePlaceholder">Organisation</label>
    <select class="select-single-placeholder form-control" name="organisation" id="selectOrg">
        <option value="" disabled selected>Choisir une organisation</option>
        @foreach($organisations as $organisation)
        <option value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
        @endforeach
    </select>
</div>
<input style="display:none;" type="number" name="iddc" >
<div class="form-group">
    <label for="selectSinglePlaceholder">Période</label>
    <select class="select-single-placeholder form-control" name="perio" id="selectPe">
        <option value="" disabled selected>Choisir une période</option>
    </select>
</div>

                  <div class="form-group">
                    <label for="select2SinglePlaceholder">Unité calendaire</label>
                    <select class="select-single-placeholder form-control" name="uniteca" id="selectSinglePlaceholder">
                      <option value="">choisir une Unité calendaire</option>
                      @foreach($unitesca as $unitesca)
        <option value="{{ $unitesca->id }}">{{ $unitesca->nom }}</option>
        @endforeach
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="select2SinglePlaceholder">Nom</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Libellé" name="nom">
            

                  <div class="form-group" id="simple-date2">
                    <label for="oneYearView">Début</label>
                      <div class="input-group date">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control" value="01/06/2020" id="oneYearView" name="debut">
                      </div>
                  </div>

                  <div class="form-group" id="simple-date2">
                    <label for="oneYearView">Fin</label>
                      <div class="input-group date">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control" value="01/06/2020" id="oneYearView" name="fin">
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
          </div>



@include('footer')