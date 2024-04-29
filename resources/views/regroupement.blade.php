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
<form class="d-sm-flex align-items-center justify-content-between"  action="{{route('regroupement_List')}}" method="POST">
              @csrf
              <select style="color: #000000;" class="select-single-placeholder form-control" name="organisation" id="selectOrg">
        <option value="" disabled selected>CHOISIR UNE ORGANISATION</option>
        @foreach($organisations as $organisation)
        <option value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
        @endforeach
    </select>
    <select style="color: #000000;" class="select-single-placeholder form-control ml-1" name="perio" id="selectPe">
        <option value="" disabled selected>CHOISIR UNE PERIODE</option>
    </select>
<select style="color: #000000;" class="select-single-placeholder form-control ml-1" name="parc" id="selectPa">
        <option value="" disabled selected>CHOISIR UN PARCOURS</option>
    </select> 
        <button type="submit" class="btn btn-primary ml-1" style="width:100%">Rechercher</button>

        </form>
          </div>



          
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
              <form id="formreg"  method="POST" >
    @csrf
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter" style="width:300%"><i class="fas fa-plus"></i></button>     </h6>
                    <button class="btn btn-outline-danger" type="submit" class="btn btn-primary" style="width:10%"><i class="fas fa-trash-alt" id="deletebottonreg"></i></button></h6>
                </div>
                <div class="table-responsive p-3">
                  <table  class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>

                      <th style="width:2%"></th>
                        <th style="color: #000000;">NOMS</th>
                        <th style="color: #000000;">DESCRIPTIONS </th>
                        <th style="color: #000000;">HEURE DEBUT</th>
                        <th style="color: #000000;">HEURE FIN</th>
                        
                        <th style="color: #000000;">ACTIONS</th>
                      </tr>
                    </thead>
                    <tfoot>
                    <tr>

                      <th style="width:2%"></th>
                        <th style="color: #000000;">NOMS</th>
                        <th style="color: #000000;">DESCRIPTIONS </th>
                        <th style="color: #000000;">HEURE DEBUT</th>
                        <th style="color: #000000;">HEURE FIN</th>
                        
                        <th  style="color: #000000;">ACTIONS</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    @foreach($regroupements as $regroupement)
                @php
                    $regroupement = (object) $regroupement;
                @endphp
                    <tr style="color: #000000;">
                    <td>
                    <input style="color: #000000;" style="cursor:pointer;" type="checkbox" value="" id="checkbox' {{$regroupement->id}}'" data-id="{{$regroupement->id}}" onchange="updateSelectedElements({{$regroupement->id}}, this.checked)">
                    </td>
                    <td> {{ $regroupement->nomreg}} </td>
                        <td>  {{$regroupement->descriptionreg}}</td>
                       
                        <td> {{ $regroupement->heuredebut}} </td>
                        <td> {{ $regroupement->heurefin}}</td>
                        <td>
                        <a href="#" data-toggle="modal" data-target="#eeexampleModal"
                    id="#eeexampleModal" class="btn btn-sm btn-primary btnvoiraudi" dataa-toggle="tooltip" data-original-title="voir auditeurs" data-id="{{$regroupement->id}}"
                        ><i class="fas fa-eye"></i></a>
                        <a href="#" data-toggle="modal" data-target="#eeeexampleModal"
                    id="#eeeexampleModal" class="btn btn-sm btn-primary btnvoirparc" dataa-toggle="tooltip" data-original-title="voir parcours" data-id="{{$regroupement->id}}"
                        ><i class="fas fa-eye"></i></a>
                        <a href="#" data-toggle="modal" data-target="#eexampleModalCenter"
                        id="#modalCenter" class="btn btn-sm btn-primary btnafpar" dataa-toggle="tooltip" data-original-title="Ajouter a un parcours" data-id="{{$regroupement->id}}"
                        ><i class="fas fa-plus"></i></a>
                        <a href="#" data-toggle="modal" data-target="#exampleModalCenter"
                        id="#modalCenter" class="btn btn-sm btn-primary edit-btnreg" dataa-toggle="tooltip" data-original-title="   Modifier regroupemnt" data-id="{{$regroupement->id}}"
                        data-nomreg="{{$regroupement->nomreg}}"
                        data-descriptionreg="{{$regroupement->descriptionreg}}"
                        data-heuredebut="{{$regroupement->heuredebut}}"
                        data-heurefin="{{$regroupement->heurefin}}"><i class="fas fa-edit"></i></a>

                        <a href="#" class="btn btn-sm btn-outline-danger delete-btnreg" data-toggle="modal" data-target="#deleteModal"  dataa-toggle="tooltip" data-original-title=" Supprimer un regroupement" data-id="{{$regroupement->id}}"><i class="fas fa-trash-alt"></i></a>
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
        Êtes-vous sûr de vouloir supprimer ce regroupement?
      </div>
      <div class="modal-footer">
        <form action="{{route('regroupement_Delete')}}" method="POST">
        @csrf
      <input style="color: #000000;" style="display:none;" type="text" class="form-control" name="iddreg" >
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
                  <h5 class="modal-title" id="exampleModalCenterTitle" style="color:white;margin-left:25%">EDITION DES  REGROUPEMENTS</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form action="{{route('regroupement_Insert')}}" method="POST">
                            @csrf
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

                  
                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Nom</label>
                    <input style="color: #000000;" type="text" class="form-control" id="inputEmail3" placeholder="Libellé" name="nom">
                  </div>
                  <input style="display:none;" type="text" class="form-control" name="idreg" >
                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Description</label>
                    <input style="color: #000000;" type="text" class="form-control" id="inputEmail3" placeholder="Bapteme" name="description">
                  </div>

                  <div class="form-group">
                  <label style="color: #000000;" for="heure">Heure de debut:</label> 
                  <input style="color: #000000;" type="time" class="form-control" id="heure" name="heuredebut">
                  </div>

                  <div class="form-group">
                  <label style="color: #000000;" for="heure">Heure de fin:</label> 
                  <input style="color: #000000;" type="time" class="form-control" id="heure" name="heurefin">
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








             <!-- Modal Center -->
             <div class="modal fade" id="eexampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="eexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 class="modal-title" id="eexampleModalCenterTitle" style="color:white;margin-left:25%">AJOUTER CE REGROUPEMENTS A UN PARCOURS</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->
                            <form action="{{route('regroupementparcours')}}" method="POST">
                            @csrf
                            <input  style="display:none;" type="text" class="form-control" name="idreg" >

<div class="form-group">
                            <label style="color: #000000;" for="selectSinglePlaceholder">Organisation</label>
    <select style="color: #000000;" class="select-single-placeholder form-control" name="organisation" id="selectOrggg">
        <option value="" disabled selected>CHOISIR UNE ORGANISATION</option>
        @foreach($organisations as $organisation)
        <option value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
        @endforeach
    </select>
</div>
<input style="display:none;" type="text" class="form-control" name="idafpro" >

<div class="form-group">
    <label style="color: #000000;" for="selectSinglePlaceholder">Période</label>
    <select style="color: #000000;" class="select-single-placeholder form-control" name="perio" id="selectPeee">
        <option value="" disabled selected>CHOISIR UNE PERIODE</option>
    </select>
</div>

<div class="form-group">
    <label style="color: #000000;" for="selectSinglePlaceholder">Parcours</label>
    <select style="color: #000000;" class="select-single-placeholder form-control" name="parc" id="selectPaaa">
        <option value="" disabled selected>CHOISIR UN PARCOURS</option>
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


 <!-- Modal pour voir les auditeurs -->
 <div class="modal fade" id="eeexampleModal" tabindex="-1" role="dialog"
            aria-labelledby="eeexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 style="color:white;margin-left:40%" class="modal-title" id="eeexampleModalCenterTitle">Auditeurs</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
             
                 <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>matricule</th>
              <th>nom</th>
              <th>genre</th>
              <th>date</th>
              <th>email</th>
              <th>tel</th>
              <th>Actions</th>

            </tr>
          </thead>
          <tbody id="auditeursTableBody">
  <tr style="color: #000000;">
    <td id="champ1Cell"></td>
    <td id="champ2Cell"></td>
    <td id="champ3Cell"></td>
    <td id="champ4Cell"></td>
    <td id="champ5Cell"></td>
    <td id="champ6Cell"></td>
    <td id="champ7Cell"></td>
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


          
 <!-- Modal pour voir les parcours -->
 <div class="modal fade" id="eeeexampleModal" tabindex="-1" role="dialog"
            aria-labelledby="eeeexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 style="color:white;margin-left:40%" class="modal-title" id="eeeexampleModalCenterTitle">Parcours</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
             
                 <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>nom</th>

            </tr>
          </thead>
          <tbody id="parcoursTableBody">
  <tr style="color: #000000;">
    <td id="champ1Cell"></td>
  
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


               <!-- Modale de confirmation de suppression -->
               <div class="modal fade" id="ddeleteModal" tabindex="-1" role="dialog" aria-labelledby="ddeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#BE7A17;">
        <h5 class="modal-title" id="ddeleteModalLabel">Confirmation de suppression auditeur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer cet auditeur de ce regroupement ?
      </div>
      <div class="modal-footer">
        <form action="{{route('auditeur_regroupement_Delete')}}" method="POST">
        @csrf
      <input style="color: #000000;" style="display:none;" type="text" class="form-control" name="idauditeur" >
      <input style="color: #000000;" style="display:none;" type="text" class="form-control" name="iddregg" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-danger confirmDelete" id="confirmDelete">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>
@include('footer')