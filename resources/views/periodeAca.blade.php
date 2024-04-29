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
<form id="myForm" class="d-sm-flex align-items-center justify-content-between"  method="POST" action="{{ route('periodesorg') }}">
    @csrf
   
        <select style="color: #000000; width:400%" class="select-single-placeholder form-control ml-1" name="state" id="selectSinglePlaceholder" required>
            <option value="" disabled selected>CHOISIR UNE ORGANISATION</option>
            @foreach($organisations as $organisation)
            <option style="color: #000000;" name="state" value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
            @endforeach
        </select>
   
        <button type="submit" class="btn btn-primary ml-1" style="width:100%">Rechercher</button>
    
    </form>
          </div>



          
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
              <form id="myForm"  method="POST">
       @csrf
    <div class="form-group row mt-3 d-flex justify-content-between align-items-center">
    <div class="col-md-3">
        <button type="button" dataa-toggle="tooltip" data-original-title="Ajouter une nouvelle période académique" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
            id="#modalCenter" style="width:60%">
            <i class="fas fa-plus"></i>
        </button>
    </div>
  
   
    <div class="col-md-2">
   
    <button dataa-toggle="tooltip" data-original-title="Supprimer plusieurs périodes académiques"  class="btn btn-outline-danger" type="submit" style="width:100%;" form="myForm" id="deleteButtonn">
            <i class="fas fa-trash-alt"></i>
        </button>
       
    </div>
</div>

           
                
                <div class="table-responsive p-3">
@if(isset($periodes) && !empty($periodes))
               <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr style="color: #000000;">
                        <th></th>
                        <th style="color: #000000;" >LIBELLES</th>
                        <th style="color: #000000;" >ANNEES DEBUTS</th>
                        <th style="color: #000000;" >ANNEES FINS</th>
                       
                        <th style="color: #000000;" >ACTIONS</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th style="color: #000000;" >LIBELLES</th>
                        <th style="color: #000000;" >ANNEES DEBUTS</th>
                        <th style="color: #000000;" >ANNEES FINS</th>
                       
                        <th style="color: #000000;" >ACTIONS </th>
                      </tr>
                    </tfoot>
                    <tbody >
                    @foreach($periodes as $periode)
                @php
                    $periode = (object) $periode;
                @endphp
                   
       
                       <tr style="color: #000000;">
                        <td> 
                        <input style="cursor:pointer;" type="checkbox" value="" id="checkbox'{{ $periode->id }}'" data-id="{{ $periode->id }}" onchange="updateSelectedElements('{{ $periode->id }}', this.checked)">
                        </td> 
                        <td>{{ $periode->nomperio }}</td> 
                        <td> {{ $periode->anneedebut }}  </td>
                        <td> {{ $periode->anneefin }} </td>
                  
                        <td>
                        <a href="#" class="btn btn-sm btn-primary details-btn" data-toggle="modal" data-target="#eexampleModalCenter"
                        id="#modalCenter" dataa-toggle="tooltip" data-original-title="Détails de la période académique" data-id="{{ $periode->id }}" ><i class="fas fa-info"></i></a>&nbsp;
                        <a href="#" class="btn btn-sm btn-primary edit-btn" data-toggle="modal" data-target="#exampleModalCenter" id="#modalCenter" dataa-toggle="tooltip" data-original-title="Modifier une période académique" data-id="{{ $periode->id }}" data-nomperio="{{ $periode->nomperio }}" data-anneedebut="{{ $periode->anneedebut }}" data-anneefin="{{ $periode->anneefin }}" data-nomorg="{{ $periode->nomorg }}" ><i class="fas fa-edit"></i></a>&nbsp;
                            <a href="#" class="btn btn-sm btn-outline-danger delete-btn" data-toggle="modal" data-target="#deleteModal"  dataa-toggle="tooltip" data-original-title=" Supprimer une période académique" data-id="{{ $periode->id }}"><i class="fas fa-trash-alt"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @endif
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
        <h5 class="modal-title" id="deleteModalLabel" style="color:white;margin-left:10%" >Confirmation de suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="color: #000000;" >
        Êtes-vous sûr de vouloir supprimer cette période académique ?
      </div>
      <div class="modal-footer">
        <form action="{{ route('periodes_Delete') }}" method="POST">
        @csrf
      <input style="display:none;" type="text" class="form-control" name="iddperio" >
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
                  <h5 class="modal-title" id="exampleModalCenterTitle" style="color:white;margin-left:25%" >EDITION DES PERIODES ACADEMIQUES</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form id="myForm" action="{{ route('periodes_Insert') }}" method="POST">
                            @csrf

                  <div class="form-group">
  <label style="color: #000000;" for="selectSinglePlaceholder">Organisation</label>
  <select style="color: #000000;" class="select-single-placeholder form-control" name="state" id="selectSinglePlaceholder" required>
  <option value="" disabled selected>CHOISIR UNE ORGANISATION</option>
  @foreach($organisations as $organisation)
                    <option style="color: #000000;" name="state" value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
                @endforeach
  </select>
</div>
      
                  <div class="form-group">
                    <label style="color: #000000;" for="selectSinglePlaceholder">Libellé</label>
                    <input type="text" class="form-control" style="color: #000000;" name="libelleperio" placeholder="Libellé">
                    
                  </div>
                  <input style="display:none;" type="text" class="form-control" name="idperio" > 

                  <div class="form-group" id="simple-date4">
                    <label style="color: #000000;" for="dateRangePicker"><span>Date de debut de la période académique</span>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>Date de fin de la période académique</span> </label>
                    <div class="input-daterange input-group">
                      <input type="text" class="input-sm form-control" style="color: #000000;" name="start" required/>
                      <div class="input-group-prepend">
                        <span class="input-group-text">to</span>
                      </div>
                      <input type="text" class="input-sm form-control" style="color: #000000;" name="end" required/>
                    </div>
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


          
          <!-- Modal Center -->
          <div class="modal fade" id="eexampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="eexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 class="modal-title" id="eexampleModalCenterTitle" style="color:white;margin-left:30%" >DETAILS DE LA PERIODE</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
               

  
<div class="container">
  <div class="row">
    <div class="col-md-3">
    <a data-toggle="modal" data-target="#eeexampleModalCenter"
                        id="#modalCenter" href="#">
    <div  class="col-md-6 col-lg-3 col-sm-12 column text-center"
            >
              <img src="" style="height: 100px; width: 100px" alt=""
                class="img-responsive mon-img" />
              <div class="txt"> <h5 style="color: #000000; font-weight: bold;"><span id="nbrepar"></span>&nbsp;PARCOURS</h5> </div>
            </div>
            </a>
    </div>
    <div class="col-md-3">
    <a data-toggle="modal" data-target="#eeeexampleModalCenter"
                        id="#modalCenter" href="#">
    <div  class="col-md-6 col-lg-3 col-sm-12 column text-center"
            >
              <img src="" style="height: 100px; width: 100px" alt=""
                class="img-responsive mon-img" />
              <div class="txt"> <h5 style="color: #000000; font-weight: bold;"><span id="nbrepro"></span>&nbsp;PROMOTIONS</h5> </div>
            </div>
            </a>
    </div>
    <div class="col-md-3">
    <a data-toggle="modal" data-target="#eeeeexampleModalCenter"
                        id="#modalCenter" href="#">
    <div  class="col-md-6 col-lg-3 col-sm-12 column text-center"
            >
              <img src="" style="height: 100px; width: 100px" alt=""
                class="img-responsive mon-img" />
              <div class="txt"> <h5 style="color: #000000; font-weight: bold;"><span id="nbrere"></span>&nbsp;REGROUPEMENTS</h5> </div>
            </div>
            </a>
    </div>
    <div class="col-md-3">
    <a data-toggle="modal" data-target="#eeeeeexampleModalCenter"
                        id="#modalCenter" href="#">
    <div  class="col-md-6 col-lg-3 col-sm-12 column text-center"
            >
              <img src="imagesmod/auditeur.png" style="height: 100px; width: 100px" alt=""
                class="img-responsive mon-img" />
              <div class="txt"> <h5 style="color: #000000; font-weight: bold;"><span id="nbreau"></span>&nbsp;AUDITEURS</h5> </div>
            </div>
            </a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
    <a data-toggle="modal" data-target="#eeeeeeexampleModalCenter"
                        id="#modalCenter" href="#">
    <div  class="col-md-6 col-lg-3 col-sm-12 column text-center"
            >
              <img src="" style="height: 100px; width: 100px" alt=""
                class="img-responsive mon-img" />
              <div class="txt"> <h5 style="color: #000000; font-weight: bold;"><span id="nbreen"></span>&nbsp;ENSEIGNANTS</h5> </div>
            </div>
            </a>
    </div>
    <div class="col-md-3">
    <a data-toggle="modal" data-target="#eeeeeeeexampleModalCenter"
                        id="#modalCenter" href="#">
    <div  class="col-md-6 col-lg-3 col-sm-12 column text-center"
            >
              <img src="" style="height: 100px; width: 100px" alt=""
                class="img-responsive mon-img" />
              <div class="txt"> <h5 style="color: #000000; font-weight: bold;"><span id="nbreue"></span>&nbsp;MATIERES</h5> </div>
            </div>
            </a>
    </div>
    <div class="col-md-3">
    <a data-toggle="modal" data-target="#eeeeeeeeexampleModalCenter"
                        id="#modalCenter" href="#">
    <div  class="col-md-6 col-lg-3 col-sm-12 column text-center"
            >
              <img src="" style="height: 100px; width: 100px" alt=""
                class="img-responsive mon-img" />
              <div class="txt"> <h5 style="color: #000000; font-weight: bold;"><span id="nbredv"></span>&nbsp;CALENDRIER</h5> </div>
            </div>
            </a>
    </div>
    <div class="col-md-3">
    
    </div>
  </div>
</div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
             
                </div>
              </div>
            </div>
          </div>



          <!-- Modal parcours -->
          <div class="modal fade" id="eeexampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="eeexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 class="modal-title" id="eeexampleModalCenterTitle" style="color:white;margin-left:25%" >DETAILS SUR LES PARCOURS ACADEMIQUES</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">


                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>NOMS</th>
              <!-- <th>ACTIONS</th> -->

            </tr>
          </thead>
          <tbody id="parcoursTableBody">
  <tr style="color: #000000;">
    <td id="champ1Cell"></td>
  
  <!--   <td id="champaction"><td> -->
  
  </tr>
</tbody>
        </table>


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
             
                </div>
              </div>
            </div>
          </div>

          
          <!-- Modal parcours -->
          <div class="modal fade" id="eeeexampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="eeeexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 class="modal-title" id="eeeexampleModalCenterTitle" style="color:white;margin-left:25%" >DETAILS SUR LES PROMOTIONS ACADEMIQUES</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">


                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>NOMS</th>
              <!-- <th>ACTIONS</th> -->

            </tr>
          </thead>
          <tbody id="promotionTableBody">
  <tr style="color: #000000;">
    <td id="champ1Cell"></td>
  
  <!--   <td id="champaction"><td> -->
  
  </tr>
</tbody>
        </table>


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
             
                </div>
              </div>
            </div>
          </div>


          
          <!-- Modal parcours -->
          <div class="modal fade" id="eeeeexampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="eeeeexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 class="modal-title" id="eeeeexampleModalCenterTitle" style="color:white;margin-left:25%" >DETAILS SUR LES REGROUPEMENTS ACADEMIQUES</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">


                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>NOMS</th>
              <!-- <th>ACTIONS</th> -->

            </tr>
          </thead>
          <tbody id="regroupementTableBody">
  <tr style="color: #000000;">
    <td id="champ1Cell"></td>
  
  <!--   <td id="champaction"><td> -->
  
  </tr>
</tbody>
        </table>


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
             
                </div>
              </div>
            </div>
          </div>



          
          <!-- Modal parcours -->
          <div class="modal fade" id="eeeeeexampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="eeeeeexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 class="modal-title" id="eeeeeexampleModalCenterTitle" style="color:white;margin-left:25%" >DETAILS SUR LES AUDITEURS ACADEMIQUES</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">


                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>NOMS</th>
              <th>PRENOMS</th>
              <!-- <th>ACTIONS</th> -->

            </tr>
          </thead>
          <tbody id="auditeurTableBody">
  <tr style="color: #000000;">
    <td id="champ1Cell"></td>
    <td id="champ2Cell"></td>
  <!--   <td id="champaction"><td> -->
  
  </tr>
</tbody>
        </table>


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
             
                </div>
              </div>
            </div>
          </div>



          
          <!-- Modal parcours -->
          <div class="modal fade" id="eeeeeeexampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="eeeeeeexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 class="modal-title" id="eeeeeeexampleModalCenterTitle" style="color:white;margin-left:25%" >DETAILS SUR LES ENSEIGNANTS ACADEMIQUES</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">


                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>NOMS</th>
              <th>PRENOMS</th>
              <!-- <th>ACTIONS</th> -->

            </tr>
          </thead>
          <tbody id="enseignantTableBody">
  <tr style="color: #000000;">
    <td id="champ1Cell"></td>
    <td id="champ2Cell"></td>
  <!--   <td id="champaction"><td> -->
  
  </tr>
</tbody>
        </table>


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
             
                </div>
              </div>
            </div>
          </div>


          
          <!-- Modal parcours -->
          <div class="modal fade" id="eeeeeeeexampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="eeeeeeeexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;"
                >
                  <h5 class="modal-title" id="eeeeeeexampleModalCenterTitle" style="color:white;margin-left:25%" >DETAILS SUR LES UNITE D'ENSEIGNEMENTS ACADEMIQUES</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">


                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr style="color: #000000;">
              <th style="color: #000000;">NOMS</th>
              <th style="color: #000000;">PRENOMS</th>
              <!-- <th>ACTIONS</th> -->

            </tr>
          </thead>
          <tbody id="ueTableBody">
  <tr style="color: #000000;">
    <td style="color: #000000;" id="champ1Cell"></td>
    <td style="color: #000000;" id="champ2Cell"></td>
  <!--   <td id="champaction"><td> -->
  
  </tr>
</tbody>
        </table>


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
             
                </div>
              </div>
            </div>
          </div>


          
          <!-- Modal parcours -->
          <div class="modal fade" id="eeeeeeeeexampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="eeeeeeeeexampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#BE7A17;">
                  <h5 class="modal-title" id="eeeeeeeeexampleModalCenterTitle" style="color:white;margin-left:25%" >DETAILS SUR LES DIVISIONS ACADEMIQUES</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">


                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr style="color: #000000;">
              <th style="color: #000000;">NOMS</th>
              <th style="color: #000000;">DATES DEBUTS</th>
              <th style="color: #000000;">DATES FINS</th>
              <!-- <th>ACTIONS</th> -->

            </tr>
          </thead>
          <tbody id="divTableBody">
  <tr style="color: #000000;">
    <td style="color: #000000;" id="champ1Cell"></td>
    <td style="color: #000000;" id="champ2Cell"></td>
  <!--   <td id="champaction"><td> -->
  
  </tr>
</tbody>
        </table>


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fermer</button>
             
                </div>
              </div>
            </div>
          </div>
@include('footer')