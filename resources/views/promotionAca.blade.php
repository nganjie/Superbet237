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
<form class="d-sm-flex align-items-center justify-content-between"   method="POST" action="{{route('promotions_List')}}">
    @csrf
    <select style="color: #000000;" class="select-single-placeholder form-control" name="state" id="seletOrg" >
            <option value="" disabled selected>CHOISIR UNE ORGANISATION</option>
            @foreach($organisations as $organisation)
            <option name="state" value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
            @endforeach
        </select>
 <select style="color: #000000;" class="select-single-placeholder form-control ml-1" name="perio" id="seletPe">
            <option value="" disabled selected>CHOISIR UNE PERIODE</option>
           </select>
  <select style="color: #000000;" class="select-single-placeholder form-control ml-1" name="parc" id="seletPa">
            <option value="" disabled selected>CHOISIR UN PARCOURS</option>
           </select>
        <button type="submit" class="btn btn-primary ml-1" style="width:100%">Rechercher</button>
    </form>
          </div>


          <style>
            .white-icon {
  color: white;
}
          </style>

          
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
              <form id="myFormpro"  method="POST" >
    @csrf
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"> <button dataa-toggle="tooltip" data-original-title="Ajouter une nouvelle promotion" type="button" style="width:300%" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" id="#modalCenter" style="width:100%">
            <i class="fas fa-plus"></i>
        </button>     </h6>
        <button data-toggle="modal" data-target="#eeexampleModalCenter" dataa-toggle="tooltip" data-original-title="Affecter a un parcours" class="btn btn-primary" type="button" style="width:10%"  id="affecteButton">
            <i class="fas fa-share"></i>
        </button>

        <button dataa-toggle="tooltip" data-original-title="Supprimer ces promotions" class="btn btn-outline-danger" type="submit" style="width:10%"  id="deleteButton">
            <i class="fas fa-trash-alt"></i>
        </button>
                </div>
   
    

                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th style="width:1%;color: #000000;"></th>
                      
                        <th style="color: #000000;">NOMS PROMOTIONS</th>
                        <th style="color: #000000;">NOMS BAPTEME</th>
                        
                        <th style="color: #000000;">RENTREES OFFICIELLES</th>
                        <th style="color: #000000;">SORTIES OFFICIELLES</th>
                        
                        <th style="width:15%;color: #000000;">ACTIONS</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th style="width:1%"></th>
                     
                        <th style="color: #000000;">NOMS PROMOTIONS</th>
                        <th style="color: #000000;">NOMS BAPTEME</th>
                       
                        <th style="color: #000000;">RENTREES OFFICIELLES</th>
                        <th style="color: #000000;">SORTIES OFFICIELLES</th>
                        
                        <th style="width:15%;color: #000000;">ACTIONS </th>
                      </tr>
                    </tfoot>
                    <tbody>
                    @foreach($promos as $promo)
                @php
                    $promo = (object) $promo;
                @endphp
                   
                    <tr style="color: #000000;">
                    <td>
                  <input style="cursor:pointer;" type="checkbox" value="" id="checkbox'{{$promo->id}}'" data-id="{{$promo->id}}" onchange="updateSelectedElements('{{$promo->id}}', this.checked)">
                  </td>
                       
                        <td> {{$promo->nompromo}} </td>
                    
                        <td> {{$promo->nombapteme}} </td>
                       
                        <td>{{$promo->rentréeofficielle}}</td>
                        <td>{{$promo->sortieofficielle }}</td>
                        <td>
                        <a href="#" class="btn btn-sm btn-primary btnidfpro" data-toggle="modal" data-target="#eexampleModalCenter"  dataa-toggle="tooltip" data-original-title="Affecter la Promotion Académique a un Parcours" data-id="{{$promo->id}}"><i class="fas fa-plus"></i></a>

                            <a href="#" class="btn btn-sm btn-primary edit-btnpro" dataa-toggle="tooltip" data-toggle="modal" data-target="#exampleModalCenter"
                            id="#modalCenter" data-original-title="Modifier Promotion Académique" data-id="{{$promo->id}}"
                            data-nompromo="{{$promo->nompromo}}" data-nombapteme="{{$promo->nombapteme}}" data-rentréeofficielle="{{$promo->rentréeofficielle}}" data-sortieofficielle="{{$promo->sortieofficielle}}"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-outline-danger delete-btnpro" data-toggle="modal" data-target="#deleteModal"  dataa-toggle="tooltip" data-original-title="Supprimer Promotion Académique" data-id="{{$promo->id}}"><i class="fas fa-trash-alt"></i></a>

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

           <!-- Modal Center -->
           <div class="modal fade" id="eeexampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="eeexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 class="modal-title" id="eeexampleModalCenterTitle" style="color:white;margin-left:25%">AFFECTER DES PROMOTIONS A DES PARCOURS ACADEMIQUES</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form id="myFormmpro" action="{{route('promotionparcoursm_Insert')}}" method="POST">
                            @csrf
                            <input type="hidden" name="selectedElements" id="selectedElementsField">
                            <input style="display:none;" type="text" class="form-control" name="idpro" >
                            <div class="form-group">
    <label style="color: #000000;" for="selectSinglePlaceholder">Organisation</label>
    <select style="color: #000000;" class="select-single-placeholder form-control" name="organisation" id="selectOrg">
        <option value="" disabled selected>CHOISIR UNE ORGANISATION</option>
        @foreach($organisations as $organisation)
        <option value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
        @endforeach
    </select>
</div>
<input style="display:none;" type="text" class="form-control" name="idafpro" >

<div class="form-group">
    <label style="color: #000000;" for="selectSinglePlaceholder">Période</label>
    <select style="color: #000000;" class="select-single-placeholder form-control" name="perio" id="selectPe">
        <option value="" disabled selected>CHOISIR UNE PERIODE</option>
    </select>
</div>

<div class="form-group">
    <label style="color: #000000;" for="selectSinglePlaceholder">Parcours</label>
    <select style="color: #000000;" class="select-single-placeholder form-control" name="parc" id="selectPa">
        <option value="" disabled selected>CHOISIR UN PARCOURS</option>
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




                    <!-- Modal Center -->
                    <div class="modal fade" id="eexampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="eexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 class="modal-title" id="eexampleModalCenterTitle" style="color:white;margin-left:25%">AFFECTER DES PROMOTIONS A DES PARCOURS ACADEMIQUES</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form action="{{route('promotionparcours_Insert')}}" method="POST">
                            @csrf
                            <input style="display:none;" type="text" class="form-control" name="idpro" >
                            <div class="form-group">
    <label style="color: #000000;" for="selectSinglePlaceholder">Organisation</label>
    <select style="color: #000000;" class="select-single-placeholder form-control" name="organisation" id="selectOrg">
        <option value="" disabled selected>CHOISIR UNE ORGANISATION</option>
        @foreach($organisations as $organisation)
        <option value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
        @endforeach
    </select>
</div>
<input style="display:none;" type="text" class="form-control" name="idafpro" >

<div class="form-group">
    <label style="color: #000000;" for="selectSinglePlaceholder">Période</label>
    <select style="color: #000000;" class="select-single-placeholder form-control" name="perio" id="selectPe">
        <option value="" disabled selected>CHOISIR UNE PERIODE</option>
    </select>
</div>

<div class="form-group">
    <label style="color: #000000;" for="selectSinglePlaceholder">Parcours</label>
    <select style="color: #000000;" class="select-single-placeholder form-control" name="parc" id="selectPa">
        <option value="" disabled selected>CHOISIR UN PARCOURS</option>
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


         


          <!-- Modal Center -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 class="modal-title" id="exampleModalCenterTitle" style="color:white;margin-left:25%">EDITION DES PROMOTIONS ACADEMIQUES</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form action="{{route('promotions_Insert')}}" method="POST">
                            @csrf
                            <input style="display:none;" type="text" class="form-control" name="idpro" >
                    
                  
                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Libellé</label>
                    <input style="color: #000000;" type="text" name="nompromo" class="form-control" id="inputEmail3" placeholder="Libellé">
                  </div>

                  <div class="form-group">
                    <label style="color: #000000;" for="select2SinglePlaceholder">Bapteme</label>
                    <input style="color: #000000;" type="text" name="nombapt" class="form-control" id="inputEmail3" placeholder="Bapteme">
                  </div>

                  <div class="form-group" id="simple-date2">
                    <label style="color: #000000;" for="oneYearView">Rentrée officiel</label>
                      <div class="input-group date">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input style="color: #000000;" type="text" name="ro" class="form-control" value="01/06/2020" id="oneYearView">
                      </div>
                  </div>

                  <div class="form-group" id="simple-date2">
                    <label style="color: #000000;" for="oneYearView">Sortie officiel</label>
                      <div class="input-group date">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input style="color: #000000;" type="text" name="so" class="form-control" value="01/06/2020" id="oneYearView">
                      </div>
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
        Êtes-vous sûr de vouloir supprimer ce parcours ?
      </div>
      <div class="modal-footer">
        <form action="{{route('promotions_Delete')}}" method="POST">
        @csrf
      <input style="display:none;" type="text" class="form-control" name="iddpro" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-danger confirmDelete" id="confirmDelete">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>

@include('footer')