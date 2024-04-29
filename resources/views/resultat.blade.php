@include('header')


<form class="d-sm-flex align-items-center justify-content-between" action="{{route('getresultat')}}" method="POST">
                            @csrf
  <select style="width:16%"  class="select-single-placeholder form-control" name="organisation" id="selectOrgg">
        <option value="" disabled selected>Choisir une organisation</option>
        @foreach($organisations as $organisation)
        <option value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
        @endforeach
    </select>

    <select style="width:16%" class="select-single-placeholder form-control ml-1" name="perio" id="selectPee">
        <option value="" disabled selected>Choisir une période</option>
    </select>

    <select style="width:16%" class="select-single-placeholder form-control ml-1" name="parc" id="selectPaa">
        <option value="" disabled selected>Choisir un Parcours</option>
    </select>

    <select style="width:16%" class="select-single-placeholder form-control ml-1" name="re" id="selectree">
        <option value="" disabled selected>Choisir un regroupement</option>
    </select>

    <select style="width:16%" class="select-single-placeholder form-control ml-1" name="gue" id="selectgue">
        <option value="" disabled selected>Choisir un groupe ue</option>
    </select>
                    <select style="width:16%" class="select-single-placeholder form-control" name="ue" id="selectue">
                      <option value="" disabled selected>choisir une de vos unités</option>
                                        
             
                    </select>              

                  
                    <button style="width:20%;"  type="submit" class="btn btn-primary ml-1">Rechercher</button>

                  </form>



   <!-- Row -->
   @if(isset($groupedAuditeurs))
   <div class="row" >
  
            <div class="col-lg-12">
              <div class="card mb-4">
               
             
                <div class="card-header py-3 d-flex flex-column align-items-start">
                @foreach ($results as $index => $firstAuditeur)
    <h6 class="m-0 font-weight-bold text-primary">
        @if ($index === 0)
            <button class="btn-download-pdf" data-codeorg="{{ $firstAuditeur->codeorg }}" data-idperio="{{ $firstAuditeur->idperio }}"
            data-idparc="{{ $firstAuditeur->idparc }}" data-idre="{{ $firstAuditeur->idre }}" data-idgue="{{ $firstAuditeur->idgue }}" data-idue="{{ $firstAuditeur->idue }}">Télécharger PDF</button>
            <button class="btn-print" data-codeorg="{{ $firstAuditeur->codeorg }}" data-idperio="{{ $firstAuditeur->idperio }}"
            data-idparc="{{ $firstAuditeur->idparc }}" data-idre="{{ $firstAuditeur->idre }}" data-idgue="{{ $firstAuditeur->idgue }}" data-idue="{{ $firstAuditeur->idue }}">Imprimer</button>
        @endif
    </h6>
@endforeach
                 
  <div class="d-flex align-items-center">
    <div class="d-flex flex-column text-center">

    </div>
  </div>

</div>


<caption style="margin-left:50%" >Titre du tableau</caption>



                <div class="table-responsive p-1">
                
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
             
    <thead class="thead-light">
        <tr>
            <th style="width:10%;">MATRICULES</th>
            <th style="width:40%;">NOMS ET PRENOMS</th>
            <th style="width:10%;">TRAVAIL INDIVIDUEL 30%</th>
            <th style="width:10%;">TRAVAIL GROUPE 30%</th>
            <th style="width:10%;">EXAMEN SUR TABLE 40%</th>
            <th style="width:10%;">NOTE/100</th>
            <th style="width:10%;">DECISION</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th style="width:10%;"></th>
            <th style="width:40%;"></th>
            <th style="width:10%;"></th>
            <th style="width:10%;"></th>
            <th style="width:10%;"></th>
            <th style="width:10%;"></th>
            <th style="width:10%;"></th>
        </tr>
    </tfoot>
    <tbody>
    @foreach ($groupedAuditeurs as $auditeur)
        <tr>
            <td>{{ $auditeur['matricule'] }}</td>
            <td>{{ $auditeur['nom'] }} {{ $auditeur['prenom'] }}</td>
            <td>{{ $auditeur['noteIndividuel'] }}</td>
            <td>{{ $auditeur['noteGroupe'] }}</td>
            <td>{{ $auditeur['noteExam'] }}</td>
            <td>{{ ($auditeur['noteIndividuel'] *30/100 +  $auditeur['noteGroupe'] *30/100 + $auditeur['noteExam'] *40/100)*3}}</td>
            <td>
    @if (($auditeur['noteIndividuel'] * 30/100 + $auditeur['noteGroupe'] * 30/100 + $auditeur['noteExam'] * 40/100) >= 60)
        VALIDE
    @elseif (($auditeur['noteIndividuel'] * 30/100 + $auditeur['noteGroupe'] * 30/100 + $auditeur['noteExam'] * 40/100) < 60)
        AJOURNEE
    @else
        N/A
    @endif
</td>
        </tr>
        @endforeach
    </tbody>
</table>

                
                </div>
           
              </div>
            </div>
            
          </div>
          @endif 
          <!--Row-->

          <script>
function printTable() {
  window.location.href = 'Resultatpdf.php';
}
</script>

<script>
function printTablepdf() {
  window.location.href = 'Resultatimpression.php';
}
</script>

@include('footer')

