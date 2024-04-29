@include('header')

<div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white">
<!--             <h1 class="h3 mb-0 text-gray-800">Auditeurs</h1>
 -->           
  <form class="d-sm-flex align-items-center justify-content-between" action="{{route('soutenance_List')}}" method="POST">
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



          @if(isset($auditeurs) && !empty($auditeurs))
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
              <form  id="myForm" method="POST" action="">
    @csrf
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"> </h6>
         
                    
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
                      <tr style="color: #000000;">
                     
                        <td>{{$auditeur->matricule}}</td>
                        <td>{{$auditeur->nom}}</td>
                        <td>{{$auditeur->prenom}}</td>
                        <td>{{$auditeur->date}}</td>
                
                        <td>
                          @foreach(session('user_roles') as $role)
                          @if($role->code === 'PRST')  
                        <a href="#" class="btn btn-sm btn-primary ajoutsoute" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter" dataa-toggle="tooltip" data-original-title="Programmer une soutenance" data-nom="{{ $auditeur->nom }}" data-email="{{ $auditeur->email }}" data-tel="{{ $auditeur->tel }}" data-id="{{ $auditeur->id }}" data-idreg="{{ $auditeur->idreg }}">
    <i class="fas fa-plus"></i> </a>  
    @break
    @endif
@endforeach   
         {{--                         <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#eexampleModalCenter"
                    id="#modalCenter" dataa-toggle="tooltip" data-original-title="Détails de l'auditeur">
    <i class="fas fa-address-book"></i>
  </a>    --}}      
  
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



         @if(isset($soutenances) && !empty($soutenances))
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"></h6><button class="btn btn-outline-danger" type="submit" class="btn btn-primary" style="width:10%"  dataa-toggle="tooltip" data-original-title="Ajouter ces auditeurs dans un regroupement"><i class="fas fa-trash-alt"></i></button>
                </div>
                <div class="table-responsive p-3">
           
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Années </th>
                        <th>Parcours</th>
                        <th>Promotions</th>
                        <th>Noms</th>
                        <!-- <th>Dates </th>
                        <th>Sujets</th> -->
                        
                        <th style="width:15%;">Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                  
                      <tr>
                     <th>Années </th> 
                     <th>Parcours</th>
                      <th>Promotions</th>
                        <th>Noms</th>
                     <!--    <th>Dates </th>
                        <th>Sujets</th> -->
                        
                        <th style="width:15%;">Action </th>
                      </tr>
                    </tfoot>
                    <tbody>
                      @foreach($soutenances as $soutenance)
                      @php
                          $soutenance = (object) $soutenance;
                      @endphp
                      <tr style="color: #000000;">
                       <th>{{$soutenance->nomperio}}</th> 
                       <th>{{$soutenance->nomparc}}</th>
                        <td>{{$soutenance->nompromo}}</td>
                        <td>{{$soutenance->nom}} {{$soutenance->prenom}}</td>
                       <!--  <td>{{$soutenance->datesoutenance}}</td>
                        <td>{{$soutenance->sujet}}</td> -->
                        
                   
                        <td>
                          @foreach(session('user_roles') as $role)
                          @if($role->code === 'DSOUT')  
                        <a href="#" data-id="{{ $soutenance->id }}" data-datesoutenance="{{ $soutenance->datesoutenance }}"
                        data-sujet="{{ $soutenance->sujet }}"
                        data-presidentjury="{{ $soutenance->presidentjury }}"
                         data-directeurthese="{{ $soutenance->directeurthese }}"
                         data-codirecteur="{{ $soutenance->codirecteur }}" class="btn btn-sm btn-primary detailssoutenance" data-toggle="modal" data-target="#eeexampleModal"  dataa-toggle="tooltip" data-original-title="Détails de la soutenance">    <i class="fas fa-eye"></i></a>
                         @break
                         @endif
                     @endforeach 
                 
                          
                         @foreach(session('user_roles') as $role)
                         @if($role->code === 'MOST')  
                         <a href="#" data-toggle="modal" data-id="{{ $soutenance->id }}" data-datesoutenance="{{ $soutenance->datesoutenance }}"
                        data-sujet="{{ $soutenance->sujet }}"
                        data-presidentjury="{{ $soutenance->presidentjury }}"
                         data-directeurthese="{{ $soutenance->directeurthese }}"
                         data-codirecteur="{{ $soutenance->codirecteur }}" data-target="#exampleModalCenter"
                    id="#modalCenter" class="btn btn-sm btn-primary btn-editsoute" dataa-toggle="tooltip" data-original-title="Modifier la soutenance"><i class="fas fa-edit"></i></a>
                    @break
                    @endif
                @endforeach 
            
                           
                    @foreach(session('user_roles') as $role)
                    @if($role->code === 'SPSOT')  
                    <a href="#" data-id="{{ $soutenance->id }}" data-toggle="modal" data-target="#deleteModal" class="btn btn-sm btn-outline-danger deletesou" dataa-toggle="tooltip" data-original-title="Supprimer la soutenance">
                              <i class="fas fa-trash-alt"></i>
                          </a>
                          @break
                          @endif
                      @endforeach 
                  
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
           @endif 

                    <!-- Modal pour voir les ue -->
                    <div class="modal fade" id="eeexampleModal" tabindex="-1" role="dialog" aria-labelledby="eeexampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="eeexampleModalLabel">Détails de la soutenance</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                
                
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
                <th>Sujets</th>
                <th>Dates</th>
              <th>Président Jury</th>
              <th>Directeur thèse</th>
              <th>Co Directeur thèse</th>
         
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>Sujets</th>
                <th>Dates</th>
              <th>Président Jury</th>
              <th>Directeur thèse</th>
              <th>Co Directeur thèse</th>
           
            </tr>
          </tfoot>
          <tbody id="tableaudetailssoute">
            
              

          </tbody>
        </table>

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
                  <h5 class="modal-title" id="exampleModalCenterTitle">Edition des soutenances</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">



                <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">informations Soutenances</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Détails Soutenances</a>
  </li>
 
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

  <form action="{{route('soutenance_Insert')}}" method="POST">
  @csrf
  <input style="display:none;" type="text"  name="idsou">
  <div class="form-group">
                    <label for="select2SinglePlaceholder">Thème</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="" name="sujet">
                  </div>

<input style="display:none;" type="text"  name="idaudi">
<input style="display:none;" type="text"  name="idreg">
<input style="display:none;" type="text"  name="tel">
<input style="display:none;" type="text"  name="email">
<input style="display:none;" type="text"  name="nom">

<div class="form-group" id="simple-date2">
  <label for="oneYearView">Date Soutenance</label>
    <div class="input-group date">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
      </div>
      <input type="text" class="form-control" value="01/06/2020" id="oneYearView" name="date">
    </div>
</div>

<div class="form-group">
  <select style="color: #000000; width:100%" class="select-single-placeholder form-control ml-1" name="cp" id="selectSinglePlaceholder13" required>
    <option value="" disabled selected>CHEF DE PROJET</option>
    @foreach($enseignants as $enseignant)
    <option style="color: #000000;"  value="{{ $enseignant->id }}">{{ $enseignant->nomens }} {{ $enseignant->prenomens }}</option>
    @endforeach
</select>
</div>

  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

 
   
                  <div class="form-group">
                    <select style="color: #000000; width:100%" class="select-single-placeholder form-control ml-1" name="pr" id="selectSinglePlaceholder10" required>
                      <option value="" disabled selected>PRESIDENT DU JURY</option>
                      @foreach($enseignants as $enseignant)
                      <option style="color: #000000;"  value="{{ $enseignant->id }}">{{ $enseignant->nomens }} {{ $enseignant->prenomens }}</option>
                      @endforeach
                  </select>
                  </div>

                  <div class="form-group">
                    <select style="color: #000000; width:100%" class="select-single-placeholder form-control ml-1" name="direct" id="selectSinglePlaceholder11" required>
                      <option value="" disabled selected>DIRECTEUR</option>
                      @foreach($enseignants as $enseignant)
                      <option style="color: #000000;"  value="{{ $enseignant->id }}">{{ $enseignant->nomens }} {{ $enseignant->prenomens }}</option>
                      @endforeach
                  </select>
                  </div>

                  <div class="form-group">
                    <select style="color: #000000; width:100%" class="select-single-placeholder form-control ml-1" name="codirect" id="selectSinglePlaceholder12" required>
                      <option value="" disabled selected>CO-DIRECTEUR</option>
                      @foreach($enseignants as $enseignant)
                      <option style="color: #000000;"  value="{{ $enseignant->id }}">{{ $enseignant->nomens }} {{ $enseignant->prenomens }}</option>
                      @endforeach
                  </select>
                  </div>
                 
                  <button type="submit" class="btn btn-primary">Sauvegarder</button>
                  </form>
  </div>
</div>  
                            <!--corps  -->
                           
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
                  
                </div>
              </div>
            </div>
          </div>






          <!-- Modal datails auditeur-->
          <div class="modal fade" id="eexampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="eexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="eexampleModalCenterTitle">Détails Auditeurs</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                  

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
                  <button type="button" class="btn btn-primary">Sauvegarder</button>
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
        Êtes-vous sûr de vouloir supprimer cette soutenance?
      </div>
      <div class="modal-footer">
        <form action="{{route('soutenance_Delete')}}" method="POST">
        @csrf
      <input style="display:none;" type="text" class="form-control" name="idsou" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-danger confirmDelete" id="confirmDelete">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>







         





          @include('footer')