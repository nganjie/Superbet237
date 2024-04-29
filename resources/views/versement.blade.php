@include('header')

<div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white">
          <!--   <h1 class="h3 mb-0 text-gray-800">Versements</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./AccueilAdmin.php">Accueil</a></li>
              <li class="breadcrumb-item active" aria-current="page">Versements</li>
            </ol> -->
            <form class="d-sm-flex align-items-center justify-content-between" action="{{route('versement_List')}}" method="POST">
                            @csrf
                      
  <select style="width:60%;" class="select-single-placeholder form-control" name="organisation" id="selectOrg">
        <option value="" disabled selected>Choisir une organisation</option>
        @foreach($organisations as $organisation)
        <option value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
        @endforeach
    </select>
  <select style="width:60%;" class="select-single-placeholder form-control ml-1" name="perio" id="selectPe">
        <option value="" disabled selected>Choisir une période</option>
    </select>
 <select style="width:60%;" class="select-single-placeholder form-control ml-1" name="parc" id="selectPa">
        <option value="" disabled selected>Choisir un Parcours</option>
    </select>
  <select style="width:60%;" class="select-single-placeholder form-control ml-1" name="re" id="selectre">
        <option value="" disabled selected>Choisir un regroupement</option>
    </select>
           <!--  <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./AccueilAdmin.php">Accueil</a></li>
              <li class="breadcrumb-item active" aria-current="page">Auditeurs</li>
            </ol> -->                  <button style="width:20%;"  type="submit" class="btn btn-primary ml-1">Rechercher</button>
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
                      
                        <th>Noms Frais </th>
                        <th>Montants </th>
                        <th>Délais de payements</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($versements as $versement)
                @php
                    $versement = (object) $versement;
                @endphp
                      <tr style="color: #000000;">
                      
                        <td>{{$versement->libelle_frais}}</td>
                        <td>{{$versement->montant_total}}</td>
                        <td>{{$versement->delai}}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary edit-btfs" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter" data-id="{{ $versement->id }}" data-libelle_frais="{{ $versement->libelle_frais }}" data-montant_total="{{ $versement->montant_total }}" data-delai="{{ $versement->delai }}"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-outline-danger delete-btnfs" data-toggle="modal" data-target="#deleteModal"  dataa-toggle="tooltip" data-original-title="Supprimer le frais" data-id="{{ $versement->id }}"><i class="fas fa-trash-alt"></i></a>
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
        Êtes-vous sûr de vouloir supprimer ce frais?
      </div>
      <div class="modal-footer">
        <form action="{{route('versement_Delete')}}" method="POST">
        @csrf
      <input style="display:none;" type="text" class="form-control" name="iddfs" >
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
                  <h5 class="modal-title" id="exampleModalCenterTitle">Gestion des frais</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form action="{{route('versement_Insert')}}" method="POST">
                            @csrf
                            <div class="form-group">
                    <select  class="select-single-placeholder form-control" name="organisation" id="selectOrgg">
        <option value="" disabled selected>Choisir une organisation</option>
        @foreach($organisations as $organisation)
        <option value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
        @endforeach
    </select>
                  </div>
                  <div class="form-group">
  <select class="select-single-placeholder form-control ml-1" name="perio" id="selectPee">
        <option value="" disabled selected>Choisir une période</option>
    </select>
    </div>

    <div class="form-group">
 <select class="select-single-placeholder form-control ml-1" name="parc" id="selectPaa">
        <option value="" disabled selected>Choisir un Parcours</option>
    </select>
    </div>

    <div class="form-group">
  <select  class="select-single-placeholder form-control ml-1" name="re" id="selectree">
        <option value="" disabled selected>Choisir un regroupement</option>
    </select>
    </div>
    <div class="form-group">
                    <label for="select2SinglePlaceholder">Libellé</label>
                    <input type="text" class="form-control" id="" name="nom" placeholder="libellé ">
                  </div>
                  <div class="form-group">
  <label for="select2SinglePlaceholder">Montant</label>
  <input type="number" min="0" class="form-control" id="montantInput" name="montant" placeholder="100000" >
</div>

<input style="display:none;" type="text" class="form-control" name="idfrais" > 

                  <div class="form-group" id="simple-date2">
                    <label for="oneYearView">Délai du versement </label>
                      <div class="input-group date">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control" value="01/06/2020" name="delai" id="oneYearView">
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