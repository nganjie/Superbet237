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
<form class="d-sm-flex align-items-center justify-content-between" action="{{route('gue_List')}}" method="POST">
                            @csrf
                            <select style="color: #000000;" class="select-single-placeholder form-control" name="organisation" id="selectOrg" required>
        <option value="" disabled selected>CHOISIR UNE ORGANISATION</option>
        @foreach($organisations as $organisation)
        <option style="color: #000000;" value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
        @endforeach
    </select>
<select style="color: #000000;" class="select-single-placeholder form-control ml-1" name="perio" id="selectPe" required>
        <option value="" disabled selected>CHOISIR UNE PERIODE</option>
    </select>
  <select style="color: #000000;" class="select-single-placeholder form-control ml-1" name="parc" id="selectPa" required>
        <option value="" disabled selected>CHOISIR UN PARCOURS</option>
    </select>
                 <button style="width:auto;"  type="submit" class="btn btn-primary ml-1">RECHERCHER</button>
</form>
          </div>



          
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
              <form id="myFormgue" action="./traitement/tgue.php" method="POST">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter"  style="width:300%"><i class="fas fa-plus"></i></button></h6>  <button class="btn btn-outline-danger" type="submit" class="btn btn-primary" style="width:10%"><i class="fas fa-trash-alt"></i></button>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr style="color: #000000;">
                        <th style="width:2%;"></th>
                        <th style="color: #000000;">CODES</th>
                        <th style="color: #000000;">DESIGNATIONS</th>
                 
                        <th style="color: #000000;">ACTIONS</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr style="color: #000000;">
                        <th style="width:2%;"></th>
                        <th>CODES</th>
                      <th>DESIGNATIONS</th>
                    
                        <th>ACTIONS</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    @foreach($gues as $gue)
                @php
                    $gue = (object) $gue;
                @endphp
                      <tr style="color: #000000;">
                      <td>
                      <input style="cursor:pointer;" type="checkbox" value="" id="checkbox'  {{$gue->id  }}'" data-id=" {{$gue->id }}" onchange="updateSelectedElements({{$gue->id}}, this.checked)">
                      </td>
                      <td>  {{$gue->codegue}} </td>
                        <td> {{ $gue->nomgue}} </td>
                    
                        <td>
                        <a href="#" class="btn btn-sm btn-primary edit-btnguee" data-toggle="modal" data-target="#eexampleModalCenter" id="#eexampleModalCenter" data-id="{{$gue->id }}"  dataa-toggle="tooltip" data-original-title="Ajouter a un parcours"><i class="fas fa-plus"></i></a>
                    <a href="#" class="btn btn-sm btn-primary vue" data-toggle="modal" data-target="#exampleModal" id="#exampleModal" data-id="{{$gue->id }}"  dataa-toggle="tooltip" data-original-title="voir les unités denseignements de ce groupe"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-primary edit-btngue" data-toggle="modal" data-target="#exampleModalCenter"
                            id="#modalCenter" dataa-toggle="tooltip" data-original-title="Modifier le groupe dunité denseignement" data-id="{{$gue->id}} "
                            data-nomgue=" {{$gue->nomgue }}"><i class="fas fa-edit"></i></a>
  <a href="#" class="btn btn-sm btn-outline-danger delete-btngue" data-toggle="modal" data-target="#deleteModal"  dataa-toggle="tooltip" data-original-title="Supprimer le groupe dunité denseignement" data-id=" {{$gue->id }}">
    <i class="fas fa-trash-alt"></i>
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
        Êtes-vous sûr de vouloir supprimer ce groupe d'unité d'enseignement ?
      </div>
      <div class="modal-footer">
        <form action="{{route('gue_Delete')}}" method="POST">
           @csrf
      <input style="display:none;" type="text" class="form-control" name="iddgue" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-danger confirmDelete" id="confirmDelete">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>

     


               <!-- Modal pour voir les unités d'enseignements d'un groupe -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 style="color:white;margin-left:25%"  class="modal-title" id="exampleModalCenterTitle">UNITES D'ENSEIGNEMENTS</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
             

 
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr style="color: #000000;">
              <th style="color: #000000;">NOMS</th>
             <th style="color: #000000;">COEFFICIENTS</th>
              <th style="color: #000000;">ACTIONS</th>

            </tr>
          </thead>
          <tbody id="ueTableBody">
  <tr style="color: #000000;">
    <td style="color: #000000;" id="champ1Cell"></td>
  
    <td style="color: #000000;" id="champaction"><td>
  
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
       

          

          <!-- Modal Center -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 style="color:white;margin-left:20%"  class="modal-title" id="exampleModalCenterTitle">EDITION DES GROUPES D'UNITES</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

       

                  
                            <!--corps  -->

                            <form action="{{route('gue_Insert')}}" method="POST" >
                            @csrf
                            <input style="display:none;" type="text" class="form-control" name="idgue" >
                            <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Code</label>
                    <input style="color: #000000;" type="text" class="form-control" id="inputEmail3" placeholder="Code" name="codegue" required>
                  </div>
                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Désignation</label>
                    <input style="color: #000000;" type="text" class="form-control" id="inputEmail3" placeholder="Libellé" name="nomgue" required>
                  </div>
<div align="center">
<button type="submit" class="btn btn-primary">Sauvegarder</button>
</div>
                 

</form>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">FERMER</button>
             
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
        Êtes-vous sûr de vouloir supprimer cette unité de ce groupe?
      </div>
      <div class="modal-footer">
        <form action="{{route('ue_gue_Delete')}}" method="POST">
        @csrf
      <input style="display:none;" type="text" class="form-control" name="iddegue" >
      <input style="display:none;" type="text" class="form-control" name="idue" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-danger confirmDelete" id="confirmDelete">Supprimer</button>
        </form>
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
                  <h5 style="color:white;margin-left:25%"  class="modal-title" id="eexampleModalCenterTitle">AJOUTER DANS UN PARCOURS</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
           <!--corps  -->

                            <form action="{{route('parcoursgue_Insert')}}" method="POST" >
                            @csrf
                            <input style="display:none;" type="text" class="form-control" name="idguee" >
                            <div class="form-group">
    <label style="color: #000000;" for="selectSinglePlaceholder">Organisation</label>
    <select style="color: #000000;" class="select-single-placeholder form-control" name="organisation" id="selectOrggg" required>
        <option value="" disabled selected>Choisir une organisation</option>
        @foreach($organisations as $organisation)
        <option value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
        @endforeach
    </select>
</div>
<input style="display:none;" type="text" class="form-control" name="idafpro" >

<div class="form-group">
    <label style="color: #000000;" for="selectSinglePlaceholder">Période</label>
    <select style="color: #000000;" class="select-single-placeholder form-control" name="perio" id="selectPeee" required>
        <option value="" disabled selected>Choisir une période</option>
    </select>
</div>

<div class="form-group">
    <label style="color: #000000;" for="selectSinglePlaceholder">Parcours</label>
    <select style="color: #000000;" class="select-single-placeholder form-control" name="parc" id="selectPaaa" required>
        <option value="" disabled selected>Choisir un Parcours</option>
    </select>
</div>

<div align="center">
<button type="submit" class="btn btn-primary">AFFECTER</button>
</div>


</form>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
             
                </div>
              </div>
            </div>
          </div>
@include('footer')