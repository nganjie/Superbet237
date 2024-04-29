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
<form class="d-sm-flex align-items-center justify-content-between"   method="POST" action="{{route('parcours_List')}}">
    @csrf
    <select style="color: #000000;width:390%" class="select-single-placeholder form-control" name="state" id="selectOrganisation" required>
            <option value="" disabled selected>CHOISIR UNE ORGANISATION</option>
            @foreach($organisations as $organisation)
            <option name="state" value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
            @endforeach
        </select>

        <select style="color: #000000;width:270%" class="select-single-placeholder form-control ml-1" name="perio" id="selectPeriod" required>
            <option value="" disabled selected>CHOISIR UNE PERIODE</option>   
        </select>

        <button type="submit" class="btn btn-primary ml-1" style="width:100%">Rechercher</button>
    </form>
          </div>



          
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
             
       
                   
                 

<form id="myFormm"  method="POST" >
    @csrf
   
    <div style="margin-left: 2%; margin-right:2%;" class="form-group row mt-3 d-flex justify-content-between align-items-center">
    <div class="col-md-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" id="#modalCenter" style="width:100%">
            <i class="fas fa-plus"></i>
        </button>
    </div>
   
   
    <div class="col-md-2">
        <button class="btn btn-outline-danger" type="submit" style="width:100%" form="myFormm" id="deleteButtonparc">
            <i class="fas fa-trash-alt"></i>
        </button>
    </div>
</div>

           
                
                <div class="table-responsive p-3">
@if(isset($parcours) && !empty($parcours))
               <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                      <th style="width:1%"></th>
                      <th style="color: #000000;">CODES</th>
                        <th style="color: #000000;">LIBELLES</th>
                        <th style="width:28%;color: #000000;">ACTIONS</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th style="width:1%"></th>
                      <th style="color: #000000;">CODES</th>
                        <th style="color: #000000;">LIBELLES</th>
                        <th style="width:28%;color: #000000;">ACTIONS </th>
                      </tr>
                    </tfoot>
                    <tbody >
                    @foreach($parcours as $parcour)
                @php
                    $parcour = (object) $parcour;
                @endphp
                   
       
                       <tr style="color: #000000;">
                        <td> 
                        <input style="cursor:pointer;" type="checkbox" value="" id="checkbox'{{ $parcour->id }}'" data-id="{{ $parcour->id }}" onchange="updateSelectedElements('{{ $parcour->id }}', this.checked)">
                        </td> 
                        <td>{{ $parcour->codeparc }}</td> 
                        <td> {{ $parcour->nomparc }}  </td>
                    
                  
                        <td>
                        <a href="#" class="btn btn-sm btn-primary vau" data-toggle="modal" data-target="#eeeexampleModal"
                    id="#exampleModal" data-id="{{ $parcour->id }}" dataa-toggle="tooltip" data-original-title="Voir les auditeurs du parcours" data-id="{{ $parcour->id }}">
                    <i class="fas fa-eye"></i>
                  </a>
                        <a href="#" class="btn btn-sm btn-primary vreg" data-toggle="modal" data-target="#eeexampleModal"
                    id="#exampleModal" data-id="{{ $parcour->id }}" dataa-toggle="tooltip" data-original-title="Voir les regroupements du parcours" data-id="{{ $parcour->id }}">
                    <i class="fas fa-eye"></i>
                  </a>
                      
   <a href="#" class="btn btn-sm btn-primary vpro" data-toggle="modal" data-target="#exampleModal"
                    id="#exampleModal" data-id="{{ $parcour->id }}" dataa-toggle="tooltip" data-original-title="Voir les promotions du parcours" data-id="{{ $parcour->id }}">
                    <i class="fas fa-eye"></i>
                  </a>
                    <a href="#" data-id="{{ $parcour->id }}" class="btn btn-sm btn-primary vgue" data-toggle="modal" data-target="#eexampleModal" dataa-toggle="tooltip" data-original-title="Voir les groupes d'unités d'enseignements du parcours">
                    <i class="fas fa-eye"></i>
                  </a>
                    <a href="#" class="btn btn-sm btn-primary edit-btnn"  data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter" dataa-toggle="tooltip" data-original-title="Modifier un parcours" data-id="{{ $parcour->id }}"
                    data-nomparc="{{ $parcour->nomparc }}"
                  ><i class="fas fa-edit"></i></a>
                           <a href="#" class="btn btn-sm btn-outline-danger delete-btnn" data-toggle="modal" data-target="#deleteModal"  dataa-toggle="tooltip" data-original-title="Supprimer le parcours" data-id="{{ $parcour->id }}">
                              <i class="fas fa-trash-alt"></i>
                          </a> 
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @endif
                </div>
                </form>
                <!--   </form> -->
              </div>
            </div>
          </div>
          <!--Row-->
  
          <!-- Modale de confirmation de suppression -->
          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#BE7A17;">
        <h5 style="color: #000000;" class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer ce parcours ?
      </div>
      <div class="modal-footer">
        <form action="{{route('parcours_Delete')}}" method="POST">
        @csrf
      <input style="display:none;" type="text" class="form-control" name="iddparc" >
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
                  <h5 style="color:white;margin-left:25%" class="modal-title" id="exampleModalCenterTitle">EDITIONS PARCOURS ACADEMIQUES</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form action="{{route('parcours_Insert')}}" method="POST">
                            <input style="display:none;" type="text" class="form-control" name="idparc" >
                            @csrf

                            <div class="form-group">
    <label style="color: #000000;" for="selectSinglePlaceholder">Organisation</label>
    <select style="color: #000000;" class="select-single-placeholder form-control" name="organisation" id="selectOrg" required>
        <option value="" disabled selected>CHOISIR UNE ORGANISATION</option>
        @foreach($organisations as $organisation)
        <option value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label style="color: #000000;" for="selectSinglePlaceholder">Période</label>
    <select style="color: #000000;" class="select-single-placeholder form-control" name="perio" id="selectPe" required>
        <option value="" disabled selected>CHOISIR UNE PERIODE</option>
    </select>
</div>
<div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Code</label>
                    <input style="color: #000000;" type="text" class="form-control" id="libelle" name="code" placeholder="Code">
                  </div>
                  
                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Libellé</label>
                    <input style="color: #000000;" type="text" class="form-control" id="libelle" name="nomparc" placeholder="Libellé" required>
                  </div>
                  <div align="center">
                  <button type="submit" class="btn btn-primary">Sauvegarder</button>
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
                    <div class="modal fade" id="eexampleModal" tabindex="-1" role="dialog" aria-labelledby="eexampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 class="modal-title" id="eexampleModalLabel" style="color:white;margin-left:25%">GROUPES D'UNITES D'ENSEIGNEMENTS</h5>
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
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
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
                  <h5 style="color:white;margin-left:35%" class="modal-title" id="eeeexampleModalLabel">AUDITEURS</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                
                
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>MATRICULES</th>
              <th>NOMS</th>
              <th>PRENOMS</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>MATRICULES</th>
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
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>


          

                    <!-- Modal pour voir les gue -->
                    <div class="modal fade" id="eeexampleModal" tabindex="-1" role="dialog" aria-labelledby="eeexampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 class="modal-title" id="eeexampleModalLabel" style="color:white;margin-left:35%">REGROUPEMENTS</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                
                
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>NOMS</th>
              <th>HEURES DEBUTS</th>
              <th>HEURES FINS</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>NOMS</th>
              <th>HEURES DEBUTS</th>
              <th>HEURES FINS</th>
            </tr>
          </tfoot>
          <tbody id="regTableBody">
  <tr style="color: #000000;">
    <td id="champ1Cell"></td>
    <td id="champ2Cell"></td>
  
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


          


               <!-- Modal pour voir les promotions -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 class="modal-title" id="exampleModalCenterTitle" style="color:white;margin-left:39%">Promotions académiques</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
             
                 <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>Promotions académiques</th>
              <th>Rentrées officielles</th>
              <th>Actions</th>

            </tr>
          </thead>
          <tbody id="promotionsTableBody">
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
        Êtes-vous sûr de vouloir supprimer cette promotion de ce groupe?
      </div>
      <div class="modal-footer">
        <form action="{{route('promotionsparcours_Delete')}}" method="POST">
        @csrf
      <input style="display:none;" type="text" class="form-control" name="idppro" >
      <input style="display:none;" type="text" class="form-control" name="idparc" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-danger confirmDelete" id="confirmDelete">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>

                <!-- Modale de confirmation de suppression -->
                <div class="modal fade" id="dddeleteModal" tabindex="-1" role="dialog" aria-labelledby="dddeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#BE7A17;">
        <h5 class="modal-title" id="dddeleteModalLabel">Confirmation de suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer cette promotion de ce groupe?
      </div>
      <div class="modal-footer">
        <form action="{{route('gueparcours_Delete')}}" method="POST">
        @csrf
      <input style="display:none;"  type="text" class="form-control" name="idgue" >
      <input style="display:none;" type="text" class="form-control" name="iddparc" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-danger confirmDelete" id="confirmDelete">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>

@include('footer')