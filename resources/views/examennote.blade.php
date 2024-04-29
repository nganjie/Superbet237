@include('header')

<div id="succesMessage" class="alert alert-success" style="display: none;"></div>
<div id="errorMessage" class="alert alert-danger" style="display: none;"></div>

<div class="d-sm-flex align-items-center justify-content-between mb-2 bg-white">
<form class="d-sm-flex align-items-center justify-content-between" action="{{route('auditeur_List')}}" method="POST">
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
                     <button style="width:20%;"  type="submit" class="btn btn-primary ml-1">Rechercher</button>
</form>
          </div>

          <style>
    .input-row {
      display:flex ;
      justify-content: space-between;
    }
.s{
    width: 25%;
     height: 40px; 
}
 .container{
    margin-bottom:1%;
    margin-left:0%;
 }

 .align-top {
  margin-top: 3%;
}
.btn-noter{
  width: 10%;
  margin-left:90%;
}
.tn{
  width:10%;
}
.i{
  width:50%;
}
.ac{
  width:13%;
}

  </style>


          
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
                      <th>Parcours</th>
                      <th>Regroupements</th>
                        <th>Matières</th>
                        <th>Dates</th>
                        <th>Publier les notes</th>
                        <th class="ac">Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        
                      <th>Parcours</th>
                        <th>Regroupements</th>
                      <th>Matières</th>
                        <th>Dates</th>
                        <th>Publier les notes</th>
                        <th class="ac" >Action </th>
                      </tr>
                    </tfoot>
                    <tbody>
                    @foreach($evaluations as $evaluation)
                @php
                    $evaluation = (object) $evaluation;
                @endphp
                      <tr style="color: #000000;">
                       
                      <td>{{ $evaluation->nomparc }}</td>
                        <td>{{ $evaluation->nomreg }}</td>
                        <td>{{ $evaluation->nomue }}</td>                      
                        <td>{{ $evaluation->date }}</td>
                        <td>   
                        <input style="cursor:pointer;" type="checkbox" value="" id="checkbox">
          </td>
                        <td>
                             <a href="#" class="btn btn-sm btn-primary anonymat" data-id="{{ $evaluation->id }}" data-idre="{{ $evaluation->idre }}" data-toggle="modal" data-target="#eeexampleModal" dataa-toggle="tooltip" data-original-title="Anonymer les auditeurs" ><i class="fas fa-user-secret"></i></a>
                             <a href="#" class="btn btn-sm btn-primary attribnoteexaa" data-id="{{ $evaluation->id }}" data-idre="{{ $evaluation->idre }}" data-toggle="modal" data-target="#eeeeexampleModal" dataa-toggle="tooltip" data-original-title="Attribuer les notes" ><i class="fas fa-share"></i></a>
                             <a href="#" class="btn btn-sm btn-primary voirnoteexaa" data-id="{{ $evaluation->id }}" data-idre="{{ $evaluation->idre }}" data-toggle="modal" data-target="#eeeexampleModal" dataa-toggle="tooltip" data-original-title="Voir les notes" ><i class="fas fa-eye"></i></a>
                             <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter" dataa-toggle="tooltip" data-original-title="Attribuer les notes"><i class="fas fa-edit"></i>
  </a>
  <a href="#" class="btn btn-sm btn-outline-danger delete-btn" data-toggle="modal" data-target="#deleteModal" dataa-toggle="tooltip" data-original-title="Supprimer l'évaluation"><i class="fas fa-trash-alt"></i></a>
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






                <!-- Modal pour noter -->
                <div class="modal fade" id="eeeeexampleModal" tabindex="-1" role="dialog" aria-labelledby="eeeeexampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="eeeeexampleModalLabel">Noter les auditeurs</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                
                
               
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"></h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                     
                        <th>codes anonymes</th>
                        <th>Note/20</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                  
                        <th>codes anonymes</th>
                        <th>Note/20</th>
                        <th>Actions</th>
                      </tr>
                    </tfoot>
                    <tbody id="auditeursTableBody">
                     
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->
          <form action="">
          <button type="button"class="btn btn-primary btn-noter">Noter</button>
          </form>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>



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
        Êtes-vous sûr de vouloir supprimer cette période académique ?
      </div>
      <div class="modal-footer">
        <form action="" method="POST">
      <input style="display:none;" type="text" class="form-control" name="iddperio" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-danger confirmDelete" id="confirmDelete">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>
          
          
                    <!-- Modal pour noter -->
                    <div class="modal fade" id="eeexampleModal" tabindex="-1" role="dialog" aria-labelledby="eeexampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="eeexampleModalLabel">Anonymer les auditeurs</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                
                
               
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"></h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                     
                        <th>Noms</th>
                        <th>Prenoms</th>
                        <th>Anonymats</th>
                 
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                  
                        <th>Noms</th>
                        <th>Prenoms</th>
                        <th>Anonymats</th>
                     
                      
                        <th>Actions</th>
                      </tr>
                    </tfoot>
                    <tbody id="auditeursTableBodya">
                     
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->
          <form action="">
          <button type="button"class="btn btn-primary btn-noter">Noter</button>
          </form>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>



             <!-- Modal pour noter -->
             <div class="modal fade" id="eeeexampleModal" tabindex="-1" role="dialog" aria-labelledby="eeeexampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="eeeexampleModalLabel">Notes des auditeurs</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                
                
               
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"></h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                     
                        <th>Noms</th>
                        <th>Prenoms</th>
                        <th>Notes</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                  
                        <th>Noms</th>
                        <th>Prenoms</th>
                        <th>Notes</th>
                        <th>Actions</th>
                      </tr>
                    </tfoot>
                    <tbody id="auditeursTableBodnote">
                     
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->
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
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">attribuer la note</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form action="{{route('evaluation_Insert')}}" method="POST">
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
  <select  class="select-single-placeholder form-control ml-1" name="perio" id="selectPee">
        <option value="" disabled selected>Choisir une période</option>
    </select>
    </div>
    <div class="form-group">
 <select  class="select-single-placeholder form-control ml-1" name="parc" id="selectPaa">
        <option value="" disabled selected>Choisir un Parcours</option>
    </select>
    </div>
    <div class="form-group">
  <select  class="select-single-placeholder form-control ml-1" name="re" id="selectree">
        <option value="" disabled selected>Choisir un regroupement</option>
    </select>
    </div>
    <div class="form-group">
    <select  class="select-single-placeholder form-control ml-1" name="gue" id="selectgue">
        <option value="" disabled selected>Choisir un groupe ue</option>
    </select>
    </div>
<input type="text" style="display:none;" name="ideva" id="ideva">
                  <div class="form-group">
                    <label for="select2SinglePlaceholder">Unité d'enseignement*</label>
                    <select class="select-single-placeholder form-control" name="ue" id="selectue">
                      <option value="" disabled selected>choisir une de vos unités</option>
                                        
             
                    </select>              
                      </div>

                  <div class="form-group">
                    <label for="select2SinglePlaceholder">Description</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="titre" name="description">
                  </div>

                  <div class="form-group">
                            <label for="select2SinglePlaceholder">Type d'évaluation*</label>
                    <select class="select-single-placeholder form-control" name="session" id="selectSinglePlaceholder">
                      <option disabled selected>choisir une session d'évaluation</option>
                      @foreach($typessessions as $typessession)
                      <option value="{{$typessession->id}}">{{$typessession->nom}}</option>
                      @endforeach
                    </select>
                  </div>

                 
                  <div class="form-group">
                            <label for="select2SinglePlaceholder">Salle d'évaluation</label>
                    <select class="select-single-placeholder form-control" name="salle" >
                      <option value="">choisir la salle</option>
                      @foreach($salles as $salle)
                      <option value="{{$salle->id}}">{{$salle->nom}}</option>
                      @endforeach
                     
             
                    </select>
                  </div>

                  <div class="form-group" id="simple-date2">
                    <label for="oneYearView">Date*</label>
                      <div class="input-group date">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="text"  class="form-control" value="01/06/2020" name="date" id="oneYearView">
                      </div>
                  </div>

                  <div class="form-group">
                  <label for="heure">Heure de debut:</label> 
                  <input type="time" class="form-control" id="heure" name="heured">
                  </div>

                  <div class="form-group">
                  <label for="heure">Heure de fin:</label> 
                  <input type="time" class="form-control" id="heure" name="heuref">
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





          <!-- Modale de confirmation de suppression -->
          <div class="modal fade" id="dddeleteModal" tabindex="-1" role="dialog" aria-labelledby="dddeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dddeleteModalLabel">Confirmation de suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir anonymer cet auditeur ?
      </div>
      <div class="modal-footer">
        <form action="{{route('examennote_anonymat_audit_Insert')}}" method="POST">
            @csrf
        <input style="display:none;"  type="text" class="form-control" name="anonymat" >
      <input style="display:none;" type="text" class="form-control" name="idev" >
      <input style="display:none;" type="text" class="form-control" name="idaudi" >
      
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-danger confirmDelete" id="confirmDelete">Anonymer</button>
        </form>
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
        Êtes-vous sûr de vouloir attribuer cette note a cet auditeur ?
      </div>
      <div class="modal-footer">
        <form action="{{route('examennote_noter_audit_Insert')}}" method="POST">
            @csrf
        <input style=""  type="text" class="form-control" name="note" >
      <input style="display:none;" type="text" class="form-control" name="idev" >
      <input style="display:none;" type="text" class="form-control" name="idaudi" >
      
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-danger confirmDelete" id="confirmDelete">Noter</button>
        </form>
      </div>
    </div>
  </div>
</div>






@include('footer')