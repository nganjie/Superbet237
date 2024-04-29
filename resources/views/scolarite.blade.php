@include('header')

<div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white">
<!--             <h1 class="h3 mb-0 text-gray-800">Auditeurs</h1>
 -->           
  <form class="d-sm-flex align-items-center justify-content-between" action="{{route('scolarite_List')}}" method="POST">
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
          @if(isset($auditeurs) && !empty($auditeurs))
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
              <form  id="myForm" method="POST" action="">
    @csrf
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Matricules</th>
                        <th >Noms</th>
                        <th>Prenoms</th>
                        <th>Dates Naissances</th>
                       
                        
                        <th >Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                      <th>Matricules</th>
                        <th >Noms</th>
                        <th >Prenoms</th>
                        <th>Dates Naissances</th>
                        <th >Action </th>
                      </tr>
                    </tfoot>
                    <tbody>
                    @foreach($auditeurs as $auditeur)
                @php
                    $auditeur = (object) $auditeur;
                @endphp
                      <tr style="background-color: {{ $auditeur->reste === null ? '#C8E6C9' : ($auditeur->reste <= 0 ? 'green' : '#C8E6C9')  }}; color: #000000;">
                     
                        <td>{{$auditeur->matricule}}</td>
                        <td>{{$auditeur->nom}}</td>
                        <td>{{$auditeur->prenom}}</td>
                        <td>{{$auditeur->date}}</td>
                
                        <td>
                        <a href="#" class="btn btn-sm btn-primary adit-btnaudi" data-toggle="modal" data-target="#eeexampleModalCenter"
                    id="#modalCenter" dataa-toggle="tooltip" data-original-title="Effectuer un paiement" data-id="{{ $auditeur->id }}">
    <i class="fas fa-plus"></i> </a>    
                                 <a href="#" class="btn btn-sm btn-primary btn-etatsco" data-toggle="modal"  data-target="#eexampleModalCenter"
                    id="#modalCenter" dataa-toggle="tooltip" data-original-title="Détails de la scolarité">
    <i class="fas fa-address-book"></i>
  </a>          
 
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
          @endif
          <!--Row-->




          <!-- Modal datails auditeur-->
          <div class="modal fade" id="eexampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="eexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="eexampleModalCenterTitle">Détails Scolarité</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->
                       <!--      <span id="montant"></span>
                            <span id="paye"></span>
<span id="reste"></span> -->
<!-- 
<h3>Montants :</h3>
<ul id="montants"></ul>

<h3>Dates d'inscription :</h3>
<ul id="dateinscrip"></ul> -->
<p>Reste : <span id="reste"></span></p>
<p>Total : <span id="total"></span></p>
<p>Payé : <span id="paye"></span></p>


<table id="table-montants">
  <thead>
    <tr>
      <th>Montant</th>
      <th>Date d'inscription</th>
    </tr>
  </thead>
  <tbody id="body-montants"></tbody>
</table>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
                  <button type="button" class="btn btn-primary">Imprimer</button>
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
        Êtes-vous sûr de vouloir supprimer cet auditeur ?
      </div>
      <div class="modal-footer">
        <form action="{{route('auditeur_Delete')}}" method="POST">
        @csrf
      <input style="display:none;" type="text" class="form-control" name="iddaudi" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-danger confirmDelete" id="confirmDelete">Supprimer</button>
        </form>
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
                  <h5 class="modal-title" id="eeexampleModalCenterTitle">Payer l'inscription</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form action="{{route('scolarite_Insert')}}" method="POST">
                            @csrf
                      
                            <input style="display:none;" type="text" class="form-control" name="idaudia" >
                            <div class="form-group">
                    <label for="selectSinglePlaceholder">Montant</label>
                    <input type="number" class="form-control" name="montantinscrip" min="0" >
                    
                  </div>
                  <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
            
                </div>
              </div>
            </div>
          </div>





          @include('footer')