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
<form class="d-sm-flex align-items-center justify-content-between" action="{{route('ue_List')}}" method="POST">
                            @csrf
                      
  <select style="color: #000000;" style="width:auto;" class="select-single-placeholder form-control" name="idgue" id="selectOrg" required>
        <option value="" disabled selected>CHOISIR UN GROUPE D'UNITE</option>
        @foreach($gues as $gue)
        <option style="color: #000000;" value="{{ $gue->id }}">{{ $gue->nomgue }}</option>
        @endforeach
    </select>
                 <button style="width:auto;"  type="submit" class="btn btn-primary ml-1">RECHERCHER</button>
</form>
          </div>



          
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
              <form id="myFormue" action="./traitement/tue.php" method="POST">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter" style="width:300%"><i class="fas fa-plus"></i></button></h6> <button class="btn btn-outline-danger" type="submit" class="btn btn-primary" style="width:10%"><i class="fas fa-trash-alt"></i></button>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                  <thead class="thead-light">
                      <tr style="color: #000000;">
                        <th style="width:2%"></th>
                        <th style="color: #000000;">CODES</th>
                        <th style="color: #000000;">NOMS</th>
                        <th style="color: #000000;">CREDITS</th>
                        <th style="color: #000000;">COUTS</th>
                        <th style="color: #000000;">ACTIONS</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr style="color: #000000;">
                        <th style="width:2%"></th>
                        <th>CODES</th>
                        <th>NOMS</th>
                        <th>CREDITS</th>
                        <th>COUTS</th>
                        <th>ACTIONS </th>
                      </tr>
                    </tfoot>
                    <tbody>
                    @foreach($ues as $ue)
                @php
                    $ue = (object) $ue;
                @endphp
                      <tr style="color: #000000;">
                      <td>
                      <input style="cursor:pointer;" type="checkbox" value="" id="checkbox' . $ue->id . '" data-id="' . $ue->id . '" onchange="updateSelectedElements(' . $ue->id . ', this.checked)">
                      </td>
                      <td>{{$ue->codeu }} </td>
                        <td>  {{$ue->nomue }} </td>
                        <td>  {{$ue->coefficient}} </td>
                        <td>  {{$ue->cout}} </td>
                 
                        <td>
                        <a href="#" class="btn btn-sm btn-primary vgrue" data-toggle="modal" data-target="#eeeexampleModal"
                    id="#exampleModal" data-id="{{ $ue->id }}" dataa-toggle="tooltip" data-original-title="Voir les enseignants liés a cette unité">
                    <i class="fas fa-eye"></i>
                  </a>
                  <a href="#" class="btn btn-sm btn-primary  vparc" data-toggle="modal" data-target="#eeeeexampleModal"
                    id="#exampleModal" data-id="{{ $ue->id }}" dataa-toggle="tooltip" data-original-title="Voir les parcours liés a cette unité">
                    <i class="fas fa-eye"></i>
                  </a>

                       <a href="#" class="btn btn-sm btn-primary btnueparc" data-toggle="modal" data-target="#eeeeeeexampleModal"
                    id="#exampleModal" dataa-toggle="tooltip" data-id="{{ $ue->id }}" data-original-title="Ajouter cette unité dans un parcours"><i class="fas fa-plus"></i></a> 
                      
                        <a href="#" class="btn btn-sm btn-primary btnaue" data-toggle="modal" data-target="#exampleModal"
                    id="#exampleModal" dataa-toggle="tooltip" data-id="{{ $ue->id }}" data-original-title="Ajouter cette unité dans un groupe dunité denseignement"><i class="fas fa-plus"></i></a> 
                    <a href="#" class="btn btn-sm btn-primary edit-btnue" dataa-toggle="tooltip" data-original-title="Modifier l unité denseignement" data-id="{{ $ue->id }}" 
                    data-nomue="{{ $ue->nomue }}"  data-prerequis="{{ $ue->prerequis }}" data-objectifs="{{ $ue->objectifs }}" data-coefficient="{{ $ue->coefficient }}" data-cout="{{ $ue->cout }}" ><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-outline-danger delete-btnue" data-toggle="modal" data-target="#deleteModal" dataa-toggle="tooltip" data-original-title="Supprimer l unité denseignement" data-id="{{ $ue->id }}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                </form>
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
       <p style="color: #000000;">Êtes-vous sûr de vouloir supprimer cette unité d'enseignement ?</p> 
      </div>
      <div class="modal-footer">
        <form action="{{route('ue_Delete')}}" method="POST">
        @csrf
      <input style="display:none;" type="text" class="form-control" name="iddue" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-danger confirmDelete" id="confirmDelete">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Modal pour ajouter une ue dans un group d'ue -->
<div class="modal fade" id="eeeeeeexampleModal" tabindex="-1" role="dialog"
aria-labelledby="eeeeeeexampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header" style="background-color:#BE7A17;">
      <h5 style="color:white;margin-left:25%" class="modal-title" id="eeeeeeexampleModalCenterTitle">AFFECTER A UN PARCOURS</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      
    <form action="{{route('ueparcours_Insert')}}" method="POST">
    @csrf
    <input style="display:none;" type="text" class="form-control" name="idaue" >
    <div class="form-group">
      <select style="color: #000000;" class="select-single-placeholder form-control" name="organisation" id="selectOrgg">
        <option value="" disabled selected>CHOISIR UNE ORGANISATION</option>
        @foreach($organisations as $organisation)
        <option value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group">
    <select style="color: #000000;" class="select-single-placeholder form-control ml-1" name="perio" id="selectPee">
        <option value="" disabled selected>CHOISIR UNE PERIODE</option>
    </select>
  </div>
  <div class="form-group">
<select style="color: #000000;" class="select-single-placeholder form-control ml-1" name="parc" id="selectPaa">
        <option value="" disabled selected>CHOISIR UN PARCOURS</option>
    </select> 
  </div>
      <div align="center">
      <button type="submit" class="btn btn-primary">SAUVEGARDER</button>
      </div>
     

    </form>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>

                <!-- Modal pour ajouter une ue dans un group d'ue -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 style="color:white;margin-left:25%" class="modal-title" id="exampleModalCenterTitle">AFFECTER A UN GROUPES D'UNITES </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                <form action="{{route('gueue_Insert')}}" method="POST">
                @csrf
                <input style="display:none;" type="text" class="form-control" name="idaue" >
                            <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Groupes d'unités</label>
                    <select style="color: #000000;" class="select-single-placeholder form-control" name="gue" id="selectSinglePlaceholder" required>
                      <option value="" disabled selected>choisir un groupe d'ue</option>
                      @foreach($gues as $gue)
                      <option value="{{$gue->id}}">{{$gue->nomgue}}</option>
                   @endforeach
                     

             
                    </select>
                  </div>
                  <div align="center">
                  <button type="submit" class="btn btn-primary">SAUVEGARDER</button>
                  </div>
                 

                </form>

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
                  <h5 style="color:white;margin-left:30%" class="modal-title" id="exampleModalCenterTitle">EDITION DES UNITES </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form action="{{route('ue_Insert')}}" method="POST">
                            @csrf
                            <input style="display:none;" type="text" class="form-control" name="idue" >
                            <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Code</label>
                    <input style="color: #000000;" type="text" class="form-control" id="inputEmail3" placeholder="Code" name="codeue">
                  </div>
                  
                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Libellé</label>
                    <input style="color: #000000;" type="text" class="form-control" id="inputEmail3" placeholder="Libellé" name="nomue" required>
                  </div>

                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Prérequis</label>
                    <input style="color: #000000;" type="text" class="form-control" id="inputEmail3" placeholder="prérequis" name="prerequis">
                  </div>

                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Objectifs</label>
                    <input style="color: #000000;" type="text" class="form-control" id="inputEmail3" placeholder="objectifs" name="objectif">
                  </div>

                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Cout</label>
                    <input style="color: #000000;" type="text" class="form-control" id="inputEmail3" placeholder="cout" name="cout">
                  </div>
                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Coefficient</label>
                    <input style="color: #000000;" type="number" class="form-control" id="inputEmail3" placeholder="coéfficient" name="coefficient" required>
                  </div>
                  <div align="center">
                  <button type="submit" class="btn btn-primary">SAUVEGARDER</button>
                  </div>
                 

</form>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
                </div>
              </div>
            </div>
          </div>



                    <!-- Modal pour voir les gue -->
                    <div class="modal fade" id="eeeexampleModal" tabindex="-1" role="dialog" aria-labelledby="eeeexampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 style="color:white;margin-left:20%" class="modal-title" id="eeeexampleModalLabel">ENSEIGNANTS</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                
                
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>NUMEROS</th>
              <th>NOMS</th>
              <th>PRENOMS</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>NUMEROS</th>
              <th>NOMS</th>
              <th>PRENOMS</th>
            </tr>
          </tfoot>
          <tbody id="audiTableBody">
  <tr style="color: #000000;">
    <td id="champ1Cell"></td>
    <td id="champ2Cell"></td>
  
    <td id="champaction"><td>
  
  </tr>
</tbody>
        </table>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">FERMER</button>
                </div>
              </div>
            </div>
          </div>


          
                    <!-- Modal pour voir les gue -->
                    <div class="modal fade" id="eeeeexampleModal" tabindex="-1" role="dialog" aria-labelledby="eeeeexampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 style="color:white;margin-left:20%" class="modal-title" id="eeeeexampleModalLabel"> PARCOURS</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                
                
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr style="color: #000000;">
              <th style="color: #000000;">CODES</th>
              <th style="color: #000000;">NOMS</th>
            </tr>
          </thead>
          
          <tbody id="pTableBody">
  <tr style="color: #000000;">
    <td id="champ1Cell"></td>
    <td id="champ2Cell"></td>
  
    <td id="champaction"><td>
  
  </tr>
</tbody>
        </table>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">FERMER</button>
                </div>
              </div>
            </div>
          </div>


          @include('footer')