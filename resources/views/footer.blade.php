</div>
</div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white b" style="height: 110px;">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
          ISMPY
          </div>
        </div>

      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>




  <script src="vendor/select2/dist/js/select2.min.js"></script>

<script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script src="vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>

<script src="vendor/clock-picker/clockpicker.js"></script>




  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>



<script>
    $(document).ready(function () {


      $('.select2-single').select2();

      // Select2 Single  with Placeholder
      $('.select2-single-placeholder').select2({
        placeholder: "Selectionner l'étudiant",
        allowClear: true
      });      

      // Select2 Multiple
      $('.select2-multiple').select2();

      // Bootstrap Date Picker
      $('#simple-date1 .input-group.date').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true,        
      });

      $('#simple-date2 .input-group.date').datepicker({
        startView: 1,
        format: 'dd/mm/yyyy',        
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked',
      });

      $('#simple-date3 .input-group.date').datepicker({
        startView: 2,
        format: 'dd/mm/yyyy',        
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked',
      });

      $('#simple-date4 .input-daterange').datepicker({        
        //format: 'dd/mm/yyyy',   
        format: 'yyyy',        
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked',
        minViewMode: 'years'
      });    

      // TouchSpin

      $('#touchSpin1').TouchSpin({
        min: 0,
        max: 100,                
        boostat: 5,
        maxboostedstep: 10,        
        initval: 0
      });

      $('#touchSpin2').TouchSpin({
        min:0,
        max: 100,
        decimals: 2,
        step: 0.1,
        postfix: '%',
        initval: 0,
        boostat: 5,
        maxboostedstep: 10
      });

      $('#touchSpin3').TouchSpin({
        min: 0,
        max: 100,
        initval: 0,
        boostat: 5,
        maxboostedstep: 10,
        verticalbuttons: true,
      });

      $('#clockPicker1').clockpicker({
        donetext: 'Done'
      });

      $('#clockPicker2').clockpicker({
        autoclose: true
      });

      let input = $('#clockPicker3').clockpicker({
        autoclose: true,
        'default': 'now',
        placement: 'top',
        align: 'left',
      });

      $('#check-minutes').click(function(e){        
        e.stopPropagation();
        input.clockpicker('show').clockpicker('toggleView', 'minutes');
      });

    });
  </script>



<script>
  $(function () {
    $('[dataa-toggle="tooltip"]').tooltip();
  });
</script>


<!-- script envoyer les valeur de la période a modale lors d'une modif période -->
        <script>
  $(document).ready(function() {
    $(document).on('click', '.edit-btn', function() {
      var id = $(this).data('id');
      var nomperio = $(this).data('nomperio');
      var anneedebut = $(this).data('anneedebut');
      var anneefin = $(this).data('anneefin');
      var nomorg = $(this).data('nomorg');
console.log(id);
console.log(nomorg);
      $('select[name="state"]').val(nomorg);
      $('input[name="libelleperio"]').val(nomperio);
      $('input[name="start"]').val(anneedebut);
      $('input[name="end"]').val(anneefin);
      $('input[name="idperio"]').val(id);

      $('#exampleModalCenter').modal('show');
    });
  });
</script>



<!-- script envoyer les valeur de la période a modale lors d'une modif période -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.edit-typesess', function() {
      var id = $(this).data('id');
      var nom = $(this).data('nom');
      var description = $(this).data('description');
      var anonymat = $(this).data('anonymat');
console.log(id);
      $('input[name="idtype"]').val(id);
      $('input[name="code"]').val(nom);
      $('input[name="nom"]').val(description);
      $('input[name="anonyme"]').val(anonymat);

    });
  });
</script>



<!-- script envoyer les valeur de la période a modale lors d'une modif période -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.edit-btn', function() {
      var id = $(this).data('id');
    
console.log(id);

      $('input[name="re"]').val(id);

      $('#exampleModalCenter').modal('show');
    });
  });
</script>

<!-- script envoyer les valeur du parcours a modale lors d'une modif parcours -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.edit-btnn', function() {
      var id = $(this).data('id');
      var nomparc = $(this).data('nomparc');
      
console.log(id);

     
      $('input[name="nomparc"]').val(nomparc);
      $('input[name="idparc"]').val(id);

      $('#exampleModalCenter').modal('show');
    });
  });
</script>

<!-- script envoyer les valeur du enseignant a modale lors d'une modif enseignant -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.btn-editens', function() {
      var id = $(this).data('id');
      var numeroens = $(this).data('numeroens');
      var nomens = $(this).data('nomens');
      var prenomens = $(this).data('prenomens');
      var gradeEns = $(this).data('gradeEns');
      var emailens = $(this).data('emailens');
      var telens = $(this).data('telens');
      var iduser = $(this).data('iduser');
      
console.log(id);

     
      $('input[name="numero"]').val(numeroens);
      $('input[name="nom"]').val(nomens);
      $('input[name="prenom"]').val(prenomens);
      $('input[name="grade"]').val(gradeEns);
      $('input[name="email"]').val(emailens);
      $('input[name="tel"]').val(telens);
      $('input[name="idens"]').val(id);
      $('input[name="iduser"]').val(iduser);


    });
  });
</script>


<!-- script envoyer les valeur du parcours a modale lors d'une modif frais sco -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.edit-btfs', function() {
      var id = $(this).data('id');
      var lib = $(this).data('libelle_frais');
      var mt = $(this).data('montant_total');
      var delai = $(this).data('delai');

      
console.log(id);

     
      $('input[name="idfrais"]').val(id);
      $('input[name="nom"]').val(lib);
      $('input[name="montant"]').val(mt);
      $('input[name="delai"]').val(delai);

      $('#exampleModalCenter').modal('show');
    });
  });
</script>


<!-- script envoyer les valeur de l'auditeur a modale lors d'une modif de l'auditeur -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.edit-btnaudi', function() {
      var id = $(this).data('id');
      var nom = $(this).data('nom');
      var prenom = $(this).data('prenom');
      var genre = $(this).data('genre');
      var date = $(this).data('date');
      var email = $(this).data('email');
      var tel = $(this).data('tel');
      var iduser = $(this).data('iduser');
      
console.log(id);
console.log(iduser);


     
      $('input[name="nom"]').val(nom);
      $('input[name="prenom"]').val(prenom);
      $('select[name="genre"]').val(genre);
      $('input[name="date"]').val(date);
      $('input[name="email"]').val(email);
      $('input[name="tel"]').val(tel);
      $('input[name="idau"]').val(id);
      $('input[name="idre"]').val(id);
      $('input[name="iduser"]').val(iduser);

      $('#exampleModalCenter').modal('show');
    });
  });
</script>


<!-- script voir l'état de la scolarité -->
<!-- <script>
  $(document).ready(function() {
    $(document).on('click', '.btn-etatsco', function() {
      var id = $(this).data('id');
      var nom = $(this).data('nom');
      var prenom = $(this).data('prenom');
      var genre = $(this).data('genre');
      var date = $(this).data('date');
      var email = $(this).data('email');
      var tel = $(this).data('tel');
      
console.log(id);


     
      $('input[name="nom"]').val(nom);
      $('input[name="prenom"]').val(prenom);
      $('input[name="genre"]').val(genre);
      $('input[name="date"]').val(date);
      $('input[name="email"]').val(email);
      $('input[name="tel"]').val(tel);
      $('input[name="idau"]').val(id);
      $('input[name="idre"]').val(id); 

      $('#exampleModalCenter').modal('show');
    });
  });
</script> -->

<!-- script envoyer les valeur de la promotion a modale lors d'une modif d'une promotion -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.edit-btnpro', function() {
      var id = $(this).data('id');
      var nompromo = $(this).data('nompromo');
      var nombapt = $(this).data('nombapteme');
      var ro = $(this).data('rentréeofficielle');
      var so = $(this).data('sortieofficielle');

      $('input[name="idpro"]').val(id);
      $('input[name="nompromo"]').val(nompromo);
      $('input[name="nombapt"]').val(nombapt);
      $('input[name="ro"]').val(ro);
      $('input[name="so"]').val(so);

      $('#exampleModalCenter').modal('show');
    });
  });
</script>




<!-- script envoyer les valeur du regroupement a modale lors d'une modif du regroupent -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.edit-btnreg', function() {
      var id = $(this).data('id');
      var nom = $(this).data('nomreg');
      var description = $(this).data('descriptionreg');
      var debut = $(this).data('heuredebut');
      var fin = $(this).data('heurefin');

      $('input[name="idreg"]').val(id);
      $('input[name="nom"]').val(nom);
      $('input[name="description"]').val(description);
      $('input[name="heuredebut"]').val(debut);
      $('input[name="heurefin"]').val(fin);

      $('#exampleModalCenter').modal('show');
    });
  });
</script>

<!-- script envoyer les valeur du parcours a modale lors d'un groupe d'unité -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.edit-btngue', function() {
      var id = $(this).data('id');
      var nomgue = $(this).data('nomgue');
      
console.log(id);

     
      $('input[name="nomgue"]').val(nomgue);
      $('input[name="idgue"]').val(id);

      $('#exampleModalCenter').modal('show');
    });
  });
</script>


<script>
  $(document).ready(function() {
    $(document).on('click', '.edit-btnguee', function() {
      var id = $(this).data('id');
      
console.log(id);

     
      $('input[name="idguee"]').val(id);

    });
  });
</script>

<!-- script envoyer les valeur du parcours a modale lors d'une d'unité d'enseignement -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.edit-btnue', function() {
      var id = $(this).data('id');
      var nomue = $(this).data('nomue');
      var prerequis = $(this).data('prerequis');
      var objectif = $(this).data('objectifs');
      var cout = $(this).data('cout');
      var coefficient = $(this).data('coefficient');
console.log(id);

$('input[name="coefficient"]').val(coefficient);
$('input[name="cout"]').val(cout);
$('input[name="objectif"]').val(objectif);
$('input[name="prerequis"]').val(prerequis);
      $('input[name="nomue"]').val(nomue);
      $('input[name="idue"]').val(id);

      $('#exampleModalCenter').modal('show');
    });
  });
</script>

<!-- script pour supprimer la periode académique -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.delete-btn', function() {
      var id = $(this).data('id');
   
console.log(id);

      $('input[name="iddperio"]').val(id);

     
    });
  });
</script>

<script>
  $(document).ready(function() {
    $(document).on('click', '.delete-user', function() {
      var id = $(this).data('id');
   
console.log(id);

      $('input[name="iduser"]').val(id);

     
    });
  });
</script>

<script>
  $(document).ready(function() {
    $(document).on('click', '.edit-user', function() {
      var id = $(this).data('id');
      var name = $(this).data('name');
      var email = $(this).data('email');
      var password = $(this).data('password');
      var telephone = $(this).data('telephone');
   
console.log(id);
console.log(name);
console.log(email);
console.log(password);
console.log(telephone);

      $('input[name="iduser"]').val(id);
      $('input[name="name"]').val(name);
      $('input[name="email"]').val(email);
      $('input[name="password"]').val(password);
      $('input[name="telephone"]').val(telephone);
     

     
    });
  });
</script>


<!-- script pour supprimer la periode académique -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.delete-typesess', function() {
      var id = $(this).data('id');
   
console.log(id);

      $('input[name="iddtype"]').val(id);

     
    });
  });
</script>
<!-- script pour supprimer l'auditeur'-->
<script>
  $(document).ready(function() {
    $(document).on('click', '.delete-btnau', function() {
      var id = $(this).data('id');
   
console.log(id);

      $('input[name="iddaudi"]').val(id);

     
    });
  });
</script>

<!-- script pour supprimer le parcours -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.delete-btnn', function() {
      var id = $(this).data('id');
   
console.log(id);

      $('input[name="iddparc"]').val(id);

     
    });
  });
</script>


<!-- script pour supprimer le frais de scolarité -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.delete-btnfs', function() {
      var id = $(this).data('id');
   
console.log(id);

      $('input[name="iddfs"]').val(id);

     
    });
  });
</script>

<!-- script pour supprimer le regroupement -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.delete-btnreg', function() {
      var id = $(this).data('id');
   
console.log(id);

      $('input[name="iddreg"]').val(id);

     
    });
  });
</script>

<!-- script pour supprimer la promotion -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.delete-btnpro', function() {
      var id = $(this).data('id');
   
console.log(id);

      $('input[name="iddpro"]').val(id);

     
    });
  });
</script>


<!-- script pour affecter le promotion a un parcours-->
<script>
  $(document).ready(function() {
    $(document).on('click', '.btnidfpro', function() {
      var id = $(this).data('id');
   
console.log(id);

      $('input[name="idafpro"]').val(id);

     
    });
  });
</script>


<!-- script pour supprimer le  groupe d'unité d'enseignement -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.delete-btngue', function() {
      var id = $(this).data('id');
   
console.log(id);

      $('input[name="iddgue"]').val(id);

     
    });
  });
</script>

<!-- script pour supprimer l'unité d'enseignement -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.delete-btnue', function() {
      var id = $(this).data('id');
   
console.log(id);

      $('input[name="iddue"]').val(id);

     
    });
  });
</script>


<!-- script pour supprimer plusieurs éléments de période aca-->
<script>
    var selectedElements = [];

// Fonction pour ajouter ou supprimer les éléments sélectionnés du tableau
function updateSelectedElements(id, checked) {
    if (checked) {
        // Ajouter l'élément au tableau
        selectedElements.push(id);
        console.log(selectedElements);
    } else {
        // Supprimer l'élément du tableau
        var index = selectedElements.indexOf(id);
        if (index !== -1) {
            selectedElements.splice(index, 1);
            console.log(selectedElements);
        }
    }
    
       
}

// Écouter la soumission du formulaire
document.getElementById('deleteButtonn').addEventListener('click', function(event) {
    event.preventDefault();

    // Ajouter les éléments sélectionnés au champ de formulaire "selectedElements"
    var selectedElementsField = document.createElement('input');
    selectedElementsField.setAttribute('type', 'hidden');
    selectedElementsField.setAttribute('name', 'selectedElements');
    selectedElementsField.setAttribute('value', JSON.stringify(selectedElements));
    this.appendChild(selectedElementsField);
    console.log(selectedElements);

     
    // Récupérer le jeton CSRF du formulaire
    var csrfToken = document.querySelector('input[name="_token"]').value;

   // Construire l'URL avec les paramètres
   var url = 'periodes_Deletem?tableau=' + JSON.stringify(selectedElements);

// Rediriger vers l'URL avec les paramètres
window.location.href = url;
});
</script>

<!-- script pour supprimer plusieurs éléments du parcours academique-->
<script>
    var selectedElements = [];

    // Fonction pour ajouter ou supprimer les éléments sélectionnés du tableau
    function updateSelectedElements(id, checked) {
        if (checked) {
            // Ajouter l'élément au tableau
            selectedElements.push(id);
            console.log(selectedElements);
        } else {
            // Supprimer l'élément du tableau
            var index = selectedElements.indexOf(id);
            if (index !== -1) {
                selectedElements.splice(index, 1);
                console.log(selectedElements);
            }
        }

       
    }

    // Écouter la soumission du formulaire
    document.getElementById('myFormm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Ajouter les éléments sélectionnés au champ de formulaire "selectedElements"
        var selectedElementsField = document.createElement('input');
        selectedElementsField.setAttribute('type', 'hidden');
        selectedElementsField.setAttribute('name', 'selectedElements');
        selectedElementsField.setAttribute('value', JSON.stringify(selectedElements));
        this.appendChild(selectedElementsField);
        console.log(selectedElements);
        
         
    // Récupérer le jeton CSRF du formulaire
    var csrfToken = document.querySelector('input[name="_token"]').value;

// Construire l'URL avec les paramètres
var url = 'parcours_Deletem?tableau=' + JSON.stringify(selectedElements);

// Rediriger vers l'URL avec les paramètres
window.location.href = url;
    });
</script>

<!-- script pour supprimer plusieurs éléments de la promotion académique-->
<script>
    var selectedElements = [];

    // Fonction pour ajouter ou supprimer les éléments sélectionnés du tableau
    function updateSelectedElements(id, checked) {
        if (checked) {
            // Ajouter l'élément au tableau
            selectedElements.push(id);
            console.log(selectedElements);
        } else {
            // Supprimer l'élément du tableau
            var index = selectedElements.indexOf(id);
            if (index !== -1) {
                selectedElements.splice(index, 1);
                console.log(selectedElements);
            }
        }
    }

// Écouter le clic sur le bouton de suppression
document.getElementById('deleteButton').addEventListener('click', function(event) {
    event.preventDefault();

    // Ajouter les éléments sélectionnés au champ de formulaire "selectedElements"
    var selectedElementsField = document.createElement('input');
    selectedElementsField.setAttribute('type', 'hidden');
    selectedElementsField.setAttribute('name', 'selectedElements');
    selectedElementsField.setAttribute('value', JSON.stringify(selectedElements));
    document.getElementById('myFormpro').appendChild(selectedElementsField);
    console.log(selectedElements);

    // Récupérer le jeton CSRF du formulaire
    var csrfToken = document.querySelector('input[name="_token"]').value;

    // Construire l'URL avec les paramètres
    var url = 'promo_Deletem?tableau=' + JSON.stringify(selectedElements);

    // Rediriger vers l'URL avec les paramètres
    window.location.href = url;
});

// Écouter le clic sur le bouton de affectation
document.getElementById('affecteButton').addEventListener('click', function(event) {
    event.preventDefault();

    // Ajouter les éléments sélectionnés au champ de formulaire "selectedElements"
    var selectedElementsField = document.createElement('input');
    selectedElementsField.setAttribute('type', 'hidden');
    selectedElementsField.setAttribute('name', 'selectedElements');
    selectedElementsField.setAttribute('value', JSON.stringify(selectedElements));
    document.getElementById('myFormpro').appendChild(selectedElementsField);
    console.log(selectedElements);

    $('input[name="selectedElements"]').val(selectedElements);
    
});


</script>



<script>
  var selectedElements = [];

  // Fonction pour ajouter ou supprimer les éléments sélectionnés du tableau
  function updateSelectedElements(id, checked) {
      if (checked) {
          // Ajouter l'élément au tableau
          selectedElements.push(id);
          console.log(selectedElements);
      } else {
          // Supprimer l'élément du tableau
          var index = selectedElements.indexOf(id);
          if (index !== -1) {
              selectedElements.splice(index, 1);
              console.log(selectedElements);
          }
      }
  }

/* // Écouter le clic sur le bouton de suppression
document.getElementById('deleteButton').addEventListener('click', function(event) {
  event.preventDefault();

  // Ajouter les éléments sélectionnés au champ de formulaire "selectedElements"
  var selectedElementsField = document.createElement('input');
  selectedElementsField.setAttribute('type', 'hidden');
  selectedElementsField.setAttribute('name', 'selectedElements');
  selectedElementsField.setAttribute('value', JSON.stringify(selectedElements));
  document.getElementById('myFormpro').appendChild(selectedElementsField);
  console.log(selectedElements);

  // Récupérer le jeton CSRF du formulaire
  var csrfToken = document.querySelector('input[name="_token"]').value;

  // Construire l'URL avec les paramètres
  var url = 'promo_Deletem?tableau=' + JSON.stringify(selectedElements);

  // Rediriger vers l'URL avec les paramètres
  window.location.href = url;
}); */

// Écouter le clic sur le bouton de affectation
document.getElementById('regroupementButton').addEventListener('click', function(event) {
    event.preventDefault();

    // Ajouter les éléments sélectionnés au champ de formulaire "selectedElements"
    var selectedElementsField = document.createElement('input');
    selectedElementsField.setAttribute('type', 'hidden');
    selectedElementsField.setAttribute('name', 'selectedElements');
    selectedElementsField.setAttribute('value', JSON.stringify(selectedElements));
    document.getElementById('myFormaudi').appendChild(selectedElementsField);
    console.log(selectedElements);

    $('input[name="selectedElementsaudi"]').val(selectedElements);
    
});


</script>

<!-- script pour supprimer plusieurs éléments du groupe d'enseignement-->
<script>
    var selectedElements = [];

    // Fonction pour ajouter ou supprimer les éléments sélectionnés du tableau
    function updateSelectedElements(id, checked) {
        if (checked) {
            // Ajouter l'élément au tableau
            selectedElements.push(id);
            console.log(selectedElements);
        } else {
            // Supprimer l'élément du tableau
            var index = selectedElements.indexOf(id);
            if (index !== -1) {
                selectedElements.splice(index, 1);
                console.log(selectedElements);
            }
        }
    }

    // Écouter la soumission du formulaire
    document.getElementById('myFormgue').addEventListener('submit', function(event) {
        event.preventDefault();

        // Ajouter les éléments sélectionnés au champ de formulaire "selectedElements"
        var selectedElementsField = document.createElement('input');
        selectedElementsField.setAttribute('type', 'hidden');
        selectedElementsField.setAttribute('name', 'selectedElements');
        selectedElementsField.setAttribute('value', JSON.stringify(selectedElements));
        this.appendChild(selectedElementsField);
        console.log(selectedElements);
        
        // Envoyer le formulaire
        this.submit();
    });
</script>



<!-- script pour supprimer plusieurs éléments d'unité d'enseignement-->
<script>
    var selectedElements = [];

    // Fonction pour ajouter ou supprimer les éléments sélectionnés du tableau
    function updateSelectedElements(id, checked) {
        if (checked) {
            // Ajouter l'élément au tableau
            selectedElements.push(id);
            console.log(selectedElements);
        } else {
            // Supprimer l'élément du tableau
            var index = selectedElements.indexOf(id);
            if (index !== -1) {
                selectedElements.splice(index, 1);
                console.log(selectedElements);
            }
        }
    }

    // Écouter la soumission du formulaire
    document.getElementById('myFormue').addEventListener('submit', function(event) {
        event.preventDefault();

        // Ajouter les éléments sélectionnés au champ de formulaire "selectedElements"
        var selectedElementsField = document.createElement('input');
        selectedElementsField.setAttribute('type', 'hidden');
        selectedElementsField.setAttribute('name', 'selectedElements');
        selectedElementsField.setAttribute('value', JSON.stringify(selectedElements));
        this.appendChild(selectedElementsField);
        console.log(selectedElements);
        
        // Envoyer le formulaire
        this.submit();
    });
</script>

<!-- script pour supprimer plusieurs éléments du regroupement-->
<script>
    var selectedElements = [];

    // Fonction pour ajouter ou supprimer les éléments sélectionnés du tableau
    function updateSelectedElements(id, checked) {
        if (checked) {
            // Ajouter l'élément au tableau
            selectedElements.push(id);
            console.log(selectedElements);
        } else {
            // Supprimer l'élément du tableau
            var index = selectedElements.indexOf(id);
            if (index !== -1) {
                selectedElements.splice(index, 1);
                console.log(selectedElements);
            }
        }
    }

    // Écouter la soumission du formulaire
    document.getElementById('formreg').addEventListener('submit', function(event) {
        event.preventDefault();

        // Ajouter les éléments sélectionnés au champ de formulaire "selectedElements"
        var selectedElementsField = document.createElement('input');
        selectedElementsField.setAttribute('type', 'hidden');
        selectedElementsField.setAttribute('name', 'selectedElements');
        selectedElementsField.setAttribute('value', JSON.stringify(selectedElements));
        this.appendChild(selectedElementsField);
        console.log(selectedElements);
        
       // Récupérer le jeton CSRF du formulaire
    var csrfToken = document.querySelector('input[name="_token"]').value;

// Construire l'URL avec les paramètres
var url = 'regrou_Deletem?tableau=' + JSON.stringify(selectedElements);

// Rediriger vers l'URL avec les paramètres
window.location.href = url;
    });
</script>



<!-- afficher le tableau de resultat -->

<!-- <script>
$(document).ready(function() {
  $('#bouton-rechercher').click(function() {
    var selectedValue = $('.s').val();
    if (selectedValue !== '' && selectedValue !== null) {
      $('#element-suivant').show();
    }
  });
});
</script> -->

<!-- afficher le tableau des auditeurs dans inscription -->
<script>
$(document).ready(function() {
  $('#bouton-recherchersco').click(function() {
    var selectedValue = $('.i').val();
    if (selectedValue !== '' && selectedValue !== null) {
      $('#element-suivantsco').show();
    }
  });
});
</script>

<!-- afficher le tableau des acodes des auditeurs -->
<script>
$(document).ready(function() {
  $('#bouton-recherchereetu').click(function() {
    var selectedValue = $('.j').val();
    if (selectedValue !== '' && selectedValue !== null) {
      $('#element-suivanttt').show();
    }
  });
});
</script>

<!-- afficher les périodes en fonction de l'organisation -->
<script>
document.getElementById('selectOrganisation').addEventListener('change', function() {
  var selectedOrganisation = this.value;

  // Utilisez une requête AJAX pour récupérer les périodes académiques correspondantes
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get_periods.php?organisation=' + selectedOrganisation, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Mettez à jour le contenu du deuxième select avec les périodes académiques récupérées
      var selectPeriod = document.getElementById('selectPeriod');
      selectPeriod.innerHTML = xhr.responseText;
    }
  };
  xhr.send();
});
</script>

<!-- afficher les promo en fonction de la periode -->
<script>
document.getElementById('selectPeriod').addEventListener('change', function() {
  var selectedPeriod = this.value;

  // Utilisez une requête AJAX pour récupérer les promotions correspondantes
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get_promotions.php?period=' + selectedPeriod, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Mettez à jour le contenu du troisième select avec les promotions récupérées
      var selectPromotion = document.getElementById('selectPromotion');
      selectPromotion.innerHTML = xhr.responseText;
    }
  };
  xhr.send();
});
</script>

<!-- afficher les parcours en fonction de la promo -->
<script>
document.getElementById('selectPromotion').addEventListener('change', function() {
  var selectedPromotion = this.value;

  // Utilisez une requête AJAX pour récupérer les parcours correspondants
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get_parcours.php?promotion=' + selectedPromotion, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Mettez à jour le contenu du quatrième select avec les parcours récupérés
      var selectParcours = document.getElementById('selectParcours');
      selectParcours.innerHTML = xhr.responseText;
    }
  };
  xhr.send();
});
</script>


<!-- script pour récupérer les ue du gue  de l'ecran gue-->
<script>

   // Sélectionner tous les éléments avec la classe "vpro"
   var vproElements = document.querySelectorAll('.vue');

// Parcourir les éléments et attacher le gestionnaire d'événement à chacun d'eux
vproElements.forEach(function(element) {
element.addEventListener('click', function() {
  // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
  var gueId = this.getAttribute('data-id');
  console.log(gueId);
  $('input[name="iddegue"]').val(gueId);
  // Effectuer une requête AJAX pour récupérer les promotions du parcours
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get_uebygue?gueId=' + gueId, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Désencoder la réponse JSON
      var ues = JSON.parse(xhr.responseText);

      // Mettre à jour le contenu de la modal avec les promotions récupérées
      var promotionsTableBody = document.getElementById('ueTableBody');
      promotionsTableBody.innerHTML = ues;

     // Mettre à jour le contenu de la modal avec les auditeurs récupérés
     var auditeursTableBody = document.getElementById('ueTableBody');
auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

// Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
ues.forEach(function(ue) {
  var row = document.createElement('tr'); // Créer une nouvelle ligne

  // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
  var champ1Cell = document.createElement('td');
  champ1Cell.textContent = ue.nomue;
  row.appendChild(champ1Cell);

  var champ2Cell = document.createElement('td');
  champ2Cell.textContent = ue.coefficient;
  row.appendChild(champ2Cell);

  
 // Créer la cellule de tableau pour le bouton de suppression
var champActionCell = document.createElement('td');
var deleteButton = document.createElement('a');
deleteButton.href = '#';
deleteButton.className = 'btn btn-sm btn-outline-danger enlue';
deleteButton.setAttribute('data-toggle', 'modal');
deleteButton.setAttribute('data-target', '#ddeleteModal');
deleteButton.setAttribute('data-id', ue.id); // Remplacez `auditeur.id` par la propriété correspondante dans votre objet auditeur
deleteButton.setAttribute('dataa-toggl', 'tooltip');
deleteButton.setAttribute('data-original-title', "Supprimer ");
deleteButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
champActionCell.appendChild(deleteButton);
row.appendChild(champActionCell);

  // Ajouter la ligne au corps du tableau
  auditeursTableBody.appendChild(row);
});
     
      
    }
  };
  xhr.send();
});
});

</script>

<!-- afficher les périodes en fonction de l'organisation pour affichage de parcours-->
<script>



document.getElementById('selectOrganisation').addEventListener('change', function() {
  var selectedOrganisation = this.value;
console.log(selectedOrganisation);
  // Utilisez une requête AJAX pour récupérer les périodes académiques correspondantes
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get-periodes-aca?organisation=' + selectedOrganisation, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Mettez à jour le contenu du deuxième select avec les périodes académiques récupérées
      var selectPeriod = document.getElementById('selectPeriod');
      selectPeriod.innerHTML = xhr.responseText;
    }
  };
  xhr.send();
});
</script>
<!-- afficher les périodes en fonction de l'organisation pour insertion du parcours-->
<script>
document.getElementById('selectOrg').addEventListener('change', function() {
  var selectedOrganisation = this.value;
console.log(selectedOrganisation);
  // Utilisez une requête AJAX pour récupérer les périodes académiques correspondantes
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get-periodes-aca?organisation=' + selectedOrganisation, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var periodes = JSON.parse(xhr.responseText);
      // Mettez à jour le contenu du deuxième select avec les périodes académiques récupérées
      var selectPeriod = document.getElementById('selectPe');
      selectPeriod.innerHTML = periodes;
    }
  };
  xhr.send();
});

document.getElementById('selectPe').addEventListener('change', function() {
  var selectedPeriode = this.value;
selectedPeriode = selectedPeriode.replace(/\\/g, '');
let parsedNumber = parseInt(selectedPeriode.replace(/"/g, ''));
console.log(parsedNumber);
//console.log(selectedPeriode);
//console.log("eerte",selectedPeriode);
  // Utilisez une requête AJAX pour récupérer les périodes académiques correspondantes
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get-parcours-acap?periode=' + parsedNumber, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var parcours = JSON.parse(xhr.responseText);

      // Mettez à jour le contenu du deuxième select avec les périodes académiques récupérées
      var selectPeriod = document.getElementById('selectPa');
      selectPeriod.innerHTML = parcours;
    }
  };
  xhr.send();
});


document.getElementById('selectPa').addEventListener('change', function() {
  var selectedPeriode = this.value;
selectedPeriode = selectedPeriode.replace(/\\/g, '');
let parsedNumber = parseInt(selectedPeriode.replace(/"/g, ''));
console.log(parsedNumber);
//console.log(selectedPeriode);
//console.log("eerte",selectedPeriode);
  // Utilisez une requête AJAX pour récupérer les périodes académiques correspondantes
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get-regrou-acap?parcour=' + parsedNumber, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var parcours = JSON.parse(xhr.responseText);

      // Mettez à jour le contenu du deuxième select avec les périodes académiques récupérées
      var selectPeriod = document.getElementById('selectre');
      selectPeriod.innerHTML = parcours;
    }
  };
  xhr.send();
});


document.getElementById('selectEns').addEventListener('change', function() {
  var selectedPeriode = this.value;
selectedPeriode = selectedPeriode.replace(/\\/g, '');
let parsedNumber = parseInt(selectedPeriode.replace(/"/g, ''));
console.log(parsedNumber);
//console.log(selectedPeriode);
//console.log("eerte",selectedPeriode);
  // Utilisez une requête AJAX pour récupérer les périodes académiques correspondantes
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get-ue?parcour=' + parsedNumber, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var parcours = JSON.parse(xhr.responseText);

      // Mettez à jour le contenu du deuxième select avec les périodes académiques récupérées
      var selectPeriod = document.getElementById('selectUe');
      selectPeriod.innerHTML = parcours;
    }
  };
  xhr.send();
});
</script>


<!-- afficher les périodes en fonction de l'organisation pour insertion du parcours-->
<script>
document.getElementById('selectOrggg').addEventListener('change', function() {
  var selectedOrganisation = this.value;
console.log(selectedOrganisation);
  // Utilisez une requête AJAX pour récupérer les périodes académiques correspondantes
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get-periodes-aca?organisation=' + selectedOrganisation, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var periodes = JSON.parse(xhr.responseText);
      // Mettez à jour le contenu du deuxième select avec les périodes académiques récupérées
      var selectPeriod = document.getElementById('selectPeee');
      selectPeriod.innerHTML = periodes;
    }
  };
  xhr.send();
});

document.getElementById('selectPeee').addEventListener('change', function() {
  var selectedPeriode = this.value;
selectedPeriode = selectedPeriode.replace(/\\/g, '');
let parsedNumber = parseInt(selectedPeriode.replace(/"/g, ''));
console.log(parsedNumber);
//console.log(selectedPeriode);
//console.log("eerte",selectedPeriode);
  // Utilisez une requête AJAX pour récupérer les périodes académiques correspondantes
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get-parcours-acap?periode=' + parsedNumber, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var parcours = JSON.parse(xhr.responseText);

      // Mettez à jour le contenu du deuxième select avec les périodes académiques récupérées
      var selectPeriod = document.getElementById('selectPaaa');
      selectPeriod.innerHTML = parcours;
    }
  };
  xhr.send();
});


document.getElementById('selectPaaa').addEventListener('change', function() {
  var selectedPeriode = this.value;
selectedPeriode = selectedPeriode.replace(/\\/g, '');
let parsedNumber = parseInt(selectedPeriode.replace(/"/g, ''));
console.log(parsedNumber);
//console.log(selectedPeriode);
//console.log("eerte",selectedPeriode);
  // Utilisez une requête AJAX pour récupérer les périodes académiques correspondantes
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get-regrou-acap?parcour=' + parsedNumber, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var parcours = JSON.parse(xhr.responseText);

      // Mettez à jour le contenu du deuxième select avec les périodes académiques récupérées
      var selectPeriod = document.getElementById('selectreee');
      selectPeriod.innerHTML = parcours;
    }
  };
  xhr.send();
});
</script>





<!-- afficher les périodes en fonction de l'organisation pour insertion du parcours-->
<script>
  document.getElementById('selectOrgggg').addEventListener('change', function() {
    var selectedOrganisation = this.value;
  console.log(selectedOrganisation);
    // Utilisez une requête AJAX pour récupérer les périodes académiques correspondantes
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get-periodes-aca?organisation=' + selectedOrganisation, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        var periodes = JSON.parse(xhr.responseText);
        // Mettez à jour le contenu du deuxième select avec les périodes académiques récupérées
        var selectPeriod = document.getElementById('selectPeeee');
        selectPeriod.innerHTML = periodes;
      }
    };
    xhr.send();
  });
  
  document.getElementById('selectPeeee').addEventListener('change', function() {
    var selectedPeriode = this.value;
  selectedPeriode = selectedPeriode.replace(/\\/g, '');
  let parsedNumber = parseInt(selectedPeriode.replace(/"/g, ''));
  console.log(parsedNumber);
  //console.log(selectedPeriode);
  //console.log("eerte",selectedPeriode);
    // Utilisez une requête AJAX pour récupérer les périodes académiques correspondantes
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get-parcours-acap?periode=' + parsedNumber, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        var parcours = JSON.parse(xhr.responseText);
  
        // Mettez à jour le contenu du deuxième select avec les périodes académiques récupérées
        var selectPeriod = document.getElementById('selectPaaaa');
        selectPeriod.innerHTML = parcours;
      }
    };
    xhr.send();
  });
  
  
  document.getElementById('selectPaaaa').addEventListener('change', function() {
    var selectedPeriode = this.value;
  selectedPeriode = selectedPeriode.replace(/\\/g, '');
  let parsedNumber = parseInt(selectedPeriode.replace(/"/g, ''));
  console.log(parsedNumber);
  //console.log(selectedPeriode);
  //console.log("eerte",selectedPeriode);
    // Utilisez une requête AJAX pour récupérer les périodes académiques correspondantes
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get-regrou-acap?parcour=' + parsedNumber, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        var parcours = JSON.parse(xhr.responseText);
  
        // Mettez à jour le contenu du deuxième select avec les périodes académiques récupérées
        var selectPeriod = document.getElementById('selectreeee');
        selectPeriod.innerHTML = parcours;
      }
    };
    xhr.send();
  });
  </script>
















<!-- afficher les périodes en fonction de l'organisation insertion des frais scolarité-->
<script>
document.getElementById('selectOrgg').addEventListener('change', function() {
  var selectedOrganisation = this.value;
console.log(selectedOrganisation);
  // Utilisez une requête AJAX pour récupérer les périodes académiques correspondantes
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get-periodes-aca?organisation=' + selectedOrganisation, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var periodes = JSON.parse(xhr.responseText);
      // Mettez à jour le contenu du deuxième select avec les périodes académiques récupérées
      var selectPeriod = document.getElementById('selectPee');
      selectPeriod.innerHTML = periodes;
    }
  };
  xhr.send();
});

document.getElementById('selectPee').addEventListener('change', function() {
  var selectedPeriode = this.value;
selectedPeriode = selectedPeriode.replace(/\\/g, '');
let parsedNumber = parseInt(selectedPeriode.replace(/"/g, ''));
console.log(parsedNumber);
//console.log(selectedPeriode);
//console.log("eerte",selectedPeriode);
  // Utilisez une requête AJAX pour récupérer les périodes académiques correspondantes
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get-parcours-acap?periode=' + parsedNumber, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var parcours = JSON.parse(xhr.responseText);

      // Mettez à jour le contenu du deuxième select avec les périodes académiques récupérées
      var selectPeriod = document.getElementById('selectPaa');
      selectPeriod.innerHTML = parcours;
    }
  };
  xhr.send();
});


document.getElementById('selectPaa').addEventListener('change', function() {
  var selectedPeriode = this.value;
selectedPeriode = selectedPeriode.replace(/\\/g, '');
let parsedNumber = parseInt(selectedPeriode.replace(/"/g, ''));
console.log(parsedNumber);
//console.log(selectedPeriode);
//console.log("eerte",selectedPeriode);
  // Utilisez une requête AJAX pour récupérer les périodes académiques correspondantes
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get-regrou-acap?parcour=' + parsedNumber, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var parcours = JSON.parse(xhr.responseText);

      // Mettez à jour le contenu du deuxième select avec les périodes académiques récupérées
      var selectPeriod = document.getElementById('selectree');
      selectPeriod.innerHTML = parcours;
    }
  };
  xhr.send();
});


document.getElementById('selectPaa').addEventListener('change', function() {
  var selectedPeriode = this.value;
selectedPeriode = selectedPeriode.replace(/\\/g, '');
let parsedNumber = parseInt(selectedPeriode.replace(/"/g, ''));
console.log(parsedNumber);
//console.log(selectedPeriode);
//console.log("eerte",selectedPeriode);
  // Utilisez une requête AJAX pour récupérer les périodes académiques correspondantes
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get-gue-acap?gue=' + parsedNumber, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var gues = JSON.parse(xhr.responseText);

      // Mettez à jour le contenu du deuxième select avec les périodes académiques récupérées
      var selectPeriod = document.getElementById('selectgue');
      selectPeriod.innerHTML = gues;
    }
  };
  xhr.send();
});

document.getElementById('selectgue').addEventListener('change', function() {
  var selectedPeriode = this.value;
selectedPeriode = selectedPeriode.replace(/\\/g, '');
let parsedNumber = parseInt(selectedPeriode.replace(/"/g, ''));
console.log(parsedNumber);
//console.log(selectedPeriode);
//console.log("eerte",selectedPeriode);
  // Utilisez une requête AJAX pour récupérer les périodes académiques correspondantes
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get-ue-acap?ue=' + parsedNumber, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var ues = JSON.parse(xhr.responseText);

      // Mettez à jour le contenu du deuxième select avec les périodes académiques récupérées
      var selectPeriod = document.getElementById('selectue');
      selectPeriod.innerHTML = ues;
    }
  };
  xhr.send();
});
</script>

</script>
<!-- afficher les périodes en fonction de l'organisation pour insertion du promotions-->
<script>
document.getElementById('seletOrg').addEventListener('change', function() {
  var selectedOrganisation = this.value;

  // Utilisez une requête AJAX pour récupérer les périodes académiques correspondantes
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get-periodes-aca?organisation=' + selectedOrganisation, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Décoder la réponse JSON
      var decodedResponse = JSON.parse(xhr.responseText);

      // Mettez à jour le contenu du deuxième select avec les périodes académiques récupérées
      var selectPeriod = document.getElementById('seletPe');
      selectPeriod.innerHTML = decodedResponse;
    }
  };
  xhr.send();
});

document.getElementById('seletPe').addEventListener('change', function() {
  var selectedPeriode = this.value;
  selectedPeriode = selectedPeriode.replace(/\\/g, '');
  let parsedNumber = parseInt(selectedPeriode.replace(/"/g, ''));

  // Utilisez une requête AJAX pour récupérer les parcours académiques correspondants
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get-parcours-acap?periode=' + parsedNumber, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Décoder la réponse JSON
      var decodedResponse = JSON.parse(xhr.responseText);

      // Mettez à jour le contenu du troisième select avec les parcours académiques récupérés
      var selectPeriod = document.getElementById('seletPa');
      selectPeriod.innerHTML = decodedResponse;
    }
  };
  xhr.send();
});
</script>
<!-- afficher les parcours en fonction des periodes pour recherche du promotions-->

<!-- script pour supprimer la periode académique -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.btnafpar', function() {
      var id = $(this).data('id');
   
console.log(id);

      $('input[name="idreg"]').val(id);

     
    });
  });
</script>

<!-- script pour supprimer la periode académique -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.adit-btnaudi', function() {
      var id = $(this).data('id');
   
console.log(id);

      $('input[name="idaudia"]').val(id);

     
    });
  });
</script>

<script>
  $(document).ready(function() {
    $(document).on('click', '.btnaue', function() {
      var id = $(this).data('id');
   
console.log(id);

      $('input[name="idaue"]').val(id);

     
    });
  });
</script>

<!-- Etat de la scolarité d'un auditeur -->
<script>

    const btnEtatsco = document.querySelector('.btn-etatsco');
const resteElement = document.getElementById('reste');
const montantElement = document.getElementById('total');
const payeElement = document.getElementById('paye');
const montantsElement = document.getElementById('montants');
const dateInscripElement = document.getElementById('dateinscrip');

btnEtatsco.addEventListener('click', function(event) {
    event.preventDefault();

    const id = this.getAttribute('data-id');
    const idreg = this.getAttribute('data-idreg');
    console.log("ddd", id);
    console.log("reg", idreg);
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'etatsco?id=' + id + '&idreg=' + idreg, true);
/*     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
 */    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response.montant);
            resteElement.textContent = response.reste;
            montantElement.textContent = response.montant;
            payeElement.textContent = response.paye;

            // Traitez les tableaux de montants et de dates d'inscription
const tableMontants = document.getElementById('table-montants');
const bodyMontants = document.getElementById('body-montants');
bodyMontants.innerHTML = '';

response.montants.forEach(function(montant, index) {
  const dateinscrip = response.dateinscrip[index];

  const row = document.createElement('tr');
  const montantCell = document.createElement('td');
  const dateInscripCell = document.createElement('td');

  montantCell.textContent = montant;
  dateInscripCell.textContent = dateinscrip;

  row.appendChild(montantCell);
  row.appendChild(dateInscripCell);

  bodyMontants.appendChild(row);
});

       
        }
    };
    xhr.send();
});
</script>

<!-- script pour récupérer les auditeurs d'un regroupement-->
<script>
  // Sélectionner tous les éléments avec la classe "vpro"
  var vproElements = document.querySelectorAll('.btnvoiraudi');

  // Parcourir les éléments et attacher le gestionnaire d'événement à chacun d'eux
 vproElements.forEach(function(element) {
  element.addEventListener('click', function() {
    // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
    var regId = this.getAttribute('data-id');
    console.log(regId);
    $('input[name="iddregg"]').val(regId);
    // Effectuer une requête AJAX pour récupérer les promotions du parcours
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_regauditeur?regId=' + regId, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // Désencoder la réponse JSON
        var auditeurs = JSON.parse(xhr.responseText);

        // Mettre à jour le contenu de la modal avec les promotions récupérées
        var auditeursTableBody = document.getElementById('auditeursTableBody');
        auditeursTableBody.innerHTML = auditeurs;

        // Mettre à jour le contenu de la modal avec les auditeurs récupérés
var auditeursTableBody = document.getElementById('auditeursTableBody');
auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

// Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
auditeurs.forEach(function(auditeur) {
  var row = document.createElement('tr'); // Créer une nouvelle ligne

  // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
  var champ1Cell = document.createElement('td');
  champ1Cell.textContent = auditeur.matricule;
  row.appendChild(champ1Cell);

  var champ2Cell = document.createElement('td');
  champ2Cell.textContent = auditeur.nom;
  row.appendChild(champ2Cell);

  var champ3Cell = document.createElement('td');
  champ3Cell.textContent = auditeur.genre;
  row.appendChild(champ3Cell);

  var champ4Cell = document.createElement('td');
  champ4Cell.textContent = auditeur.date;
  row.appendChild(champ4Cell);

  var champ5Cell = document.createElement('td');
  champ5Cell.textContent = auditeur.email;
  row.appendChild(champ5Cell);

  var champ6Cell = document.createElement('td');
  champ6Cell.textContent = auditeur.tel;
  row.appendChild(champ6Cell);

 // Créer la cellule de tableau pour le bouton de suppression
var champActionCell = document.createElement('td');
var deleteButton = document.createElement('a');
deleteButton.href = '#';
deleteButton.className = 'btn btn-sm btn-outline-danger enlevaudi';
deleteButton.setAttribute('data-toggle', 'modal');
deleteButton.setAttribute('data-target', '#ddeleteModal');
deleteButton.setAttribute('data-id', auditeur.id); // Remplacez `auditeur.id` par la propriété correspondante dans votre objet auditeur
deleteButton.setAttribute('dataa-toggl', 'tooltip');
deleteButton.setAttribute('data-original-title', "Supprimer l'auditeur");
deleteButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
champActionCell.appendChild(deleteButton);
row.appendChild(champActionCell);


  // Ajouter la ligne au corps du tableau
  auditeursTableBody.appendChild(row);
});
      }
    };
    xhr.send();
  });
});
</script>

<!-- script pour récupérer les parcours d'un regroupement-->
<script>
  // Sélectionner tous les éléments avec la classe "vpro"
  var vproElements = document.querySelectorAll('.btnvoirparc');

  // Parcourir les éléments et attacher le gestionnaire d'événement à chacun d'eux
 vproElements.forEach(function(element) {
  element.addEventListener('click', function() {
    // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
    var regId = this.getAttribute('data-id');
    console.log(regId);

    // Effectuer une requête AJAX pour récupérer les promotions du parcours
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_regparcours?regId=' + regId, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // Désencoder la réponse JSON
        var parcours = JSON.parse(xhr.responseText);

        // Mettre à jour le contenu de la modal avec les promotions récupérées
        var parcoursTableBody = document.getElementById('parcoursTableBody');
        parcoursTableBody.innerHTML = parcours;
        
     // Mettre à jour le contenu de la modal avec les auditeurs récupérés
var auditeursTableBody = document.getElementById('parcoursTableBody');
auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

// Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
parcours.forEach(function(parcour) {
  var row = document.createElement('tr'); // Créer une nouvelle ligne

  // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
  var champ1Cell = document.createElement('td');
  champ1Cell.textContent = parcour.nomparc;
  row.appendChild(champ1Cell);

  // Ajouter la ligne au corps du tableau
  auditeursTableBody.appendChild(row);
});
      }



    };
    xhr.send();
  });
});
</script>


<!-- enlever auditeur dans un regroupement-->
<script>
  $(document).ready(function() {
    $(document).on('click', '.enlevaudi', function() {
      var id = $(this).data('id');
   
console.log(id);

      $('input[name="idauditeur"]').val(id);

     
    });
  });
</script>

<!-- enlever auditeur dans un regroupement-->
<script>
  $(document).ready(function() {
    $(document).on('click', '.enlue', function() {
      var id = $(this).data('id');
   
console.log(id);

      $('input[name="idue"]').val(id);

     
    });
  });
</script>

<!-- enlever auditeur dans un regroupement-->
<script>
  $(document).ready(function() {
    $(document).on('click', '.enlpro', function() {
      var id = $(this).data('id');
   
console.log(id);

      $('input[name="idppro"]').val(id);

     
    });
  });
</script>

<script>
  $(document).ready(function() {
    $(document).on('click', '.btn-afens', function() {
      var id = $(this).data('id');
      
console.log(id);

           $('input[name="idens"]').val(id);
    });
  });
</script>

<!-- script pour récupérer les ue de l'enseignant de l'ecran enseignant-->
<script>

   // Sélectionner tous les éléments avec la classe "vpro"
   var vproElements = document.querySelectorAll('.vueens');

// Parcourir les éléments et attacher le gestionnaire d'événement à chacun d'eux
vproElements.forEach(function(element) {
element.addEventListener('click', function() {
  // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
  var ensId = this.getAttribute('data-id');
  console.log(ensId);
  $('input[name="iddegue"]').val(ensId);
  // Effectuer une requête AJAX pour récupérer les promotions du parcours
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'get_uebyens?ensId=' + ensId, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Désencoder la réponse JSON
      var ues = JSON.parse(xhr.responseText);

      // Mettre à jour le contenu de la modal avec les promotions récupérées
      var promotionsTableBody = document.getElementById('ueTableBody');
      promotionsTableBody.innerHTML = ues;

     // Mettre à jour le contenu de la modal avec les auditeurs récupérés
     var auditeursTableBody = document.getElementById('ueTableBody');
auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

// Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
ues.forEach(function(ue) {
  var row = document.createElement('tr'); // Créer une nouvelle ligne

  // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
  var champ1Cell = document.createElement('td');
  champ1Cell.textContent = ue.nomue;
  row.appendChild(champ1Cell);

  var champ2Cell = document.createElement('td');
  champ2Cell.textContent = ue.coefficient;
  row.appendChild(champ2Cell);

  
 // Créer la cellule de tableau pour le bouton de suppression
var champActionCell = document.createElement('td');
var deleteButton = document.createElement('a');
deleteButton.href = '#';
deleteButton.className = 'btn btn-sm btn-outline-danger enlue';
deleteButton.setAttribute('data-toggle', 'modal');
deleteButton.setAttribute('data-target', '#ddeleteModal');
deleteButton.setAttribute('data-id', ue.id); // Remplacez `auditeur.id` par la propriété correspondante dans votre objet auditeur
deleteButton.setAttribute('dataa-toggl', 'tooltip');
deleteButton.setAttribute('data-original-title', "Supprimer ");
deleteButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
champActionCell.appendChild(deleteButton);
row.appendChild(champActionCell);

  // Ajouter la ligne au corps du tableau
  auditeursTableBody.appendChild(row);
});
     
      
    }
  };
  xhr.send();
});
});

</script>


<!-- script pour récupérer les promtion du parcours  de l'ecran parcours-->
<script>
  // Sélectionner tous les éléments avec la classe "vpro"
  var vproElements = document.querySelectorAll('.vpro');

  // Parcourir les éléments et attacher le gestionnaire d'événement à chacun d'eux
 vproElements.forEach(function(element) {
  element.addEventListener('click', function() {
    // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
    var parcoursId = this.getAttribute('data-id');
    $('input[name="idparc"]').val(parcoursId );
    console.log(parcoursId);

    // Effectuer une requête AJAX pour récupérer les promotions du parcours
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_promotionsparc?parcoursId=' + parcoursId, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // Désencoder la réponse JSON
        var promotions = JSON.parse(xhr.responseText);

        // Mettre à jour le contenu de la modal avec les promotions récupérées
        var promotionsTableBody = document.getElementById('promotionsTableBody');
        promotionsTableBody.innerHTML = promotions;

        
     // Mettre à jour le contenu de la modal avec les auditeurs récupérés
     var auditeursTableBody = document.getElementById('promotionsTableBody');
auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

// Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
promotions.forEach(function(promotion) {
  var row = document.createElement('tr'); // Créer une nouvelle ligne

  // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
  var champ1Cell = document.createElement('td');
  champ1Cell.textContent = promotion.nompromo;
  row.appendChild(champ1Cell);

  var champ2Cell = document.createElement('td');
  champ2Cell.textContent = promotion.rentréeofficielle;
  row.appendChild(champ2Cell);

  
 // Créer la cellule de tableau pour le bouton de suppression
var champActionCell = document.createElement('td');
var deleteButton = document.createElement('a');
deleteButton.href = '#';
deleteButton.className = 'btn btn-sm btn-outline-danger enlpro';
deleteButton.setAttribute('data-toggle', 'modal');
deleteButton.setAttribute('data-target', '#ddeleteModal');
deleteButton.setAttribute('data-id', promotion.id); // Remplacez `auditeur.id` par la propriété correspondante dans votre objet auditeur
deleteButton.setAttribute('dataa-toggl', 'tooltip');
deleteButton.setAttribute('data-original-title', "Supprimer ");
deleteButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
champActionCell.appendChild(deleteButton);
row.appendChild(champActionCell);

  // Ajouter la ligne au corps du tableau
  auditeursTableBody.appendChild(row);
});
      }
    };
    xhr.send();
  });
});
</script>

<script>
  $(document).ready(function() {
    $(document).on('click', '.btnensde', function() {
      var id = $(this).data('id');
      
console.log(id);

           $('input[name="iddens"]').val(id);
    });
  });
</script>



<!-- script pour récupérer les promtion du parcours  de l'ecran parcours-->
<script>
  // Sélectionner tous les éléments avec la classe "vpro"
  var vproElements = document.querySelectorAll('.vgue');

  // Parcourir les éléments et attacher le gestionnaire d'événement à chacun d'eux
 vproElements.forEach(function(element) {
  element.addEventListener('click', function() {
    // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
    var parcoursId = this.getAttribute('data-id');
    $('input[name="iddparc"]').val(parcoursId );
    console.log(parcoursId);

    // Effectuer une requête AJAX pour récupérer les promotions du parcours
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_gueparc?parcoursId=' + parcoursId, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // Désencoder la réponse JSON
        var gues = JSON.parse(xhr.responseText);

        // Mettre à jour le contenu de la modal avec les promotions récupérées
        var promotionsTableBody = document.getElementById('gueTableBody');
        promotionsTableBody.innerHTML = gues;

        
     // Mettre à jour le contenu de la modal avec les auditeurs récupérés
     var auditeursTableBody = document.getElementById('gueTableBody');
auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

// Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
gues.forEach(function(gue) {
  var row = document.createElement('tr'); // Créer une nouvelle ligne

  // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
  var champ1Cell = document.createElement('td');
  champ1Cell.textContent = gue.codegue;
  row.appendChild(champ1Cell);

  var champ2Cell = document.createElement('td');
  champ2Cell.textContent = gue.nomgue;
  row.appendChild(champ2Cell);


  
 // Créer la cellule de tableau pour le bouton de suppression
var champActionCell = document.createElement('td');
var deleteButton = document.createElement('a');
deleteButton.href = '#';
deleteButton.className = 'btn btn-sm btn-outline-danger enlgueparc';
deleteButton.setAttribute('data-toggle', 'modal');
deleteButton.setAttribute('data-target', '#dddeleteModal');
deleteButton.setAttribute('data-id', gue.id); // Remplacez `auditeur.id` par la propriété correspondante dans votre objet auditeur
deleteButton.setAttribute('dataa-toggl', 'tooltip');
deleteButton.setAttribute('data-original-title', "Supprimer ");
deleteButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
champActionCell.appendChild(deleteButton);
row.appendChild(champActionCell);

  // Ajouter la ligne au corps du tableau
  auditeursTableBody.appendChild(row);
});
      }
    };
    xhr.send();
  });
});
</script>
<script>
  $(document).ready(function() {
    $(document).on('click', '.enlgueparc', function() {
      var id = $(this).data('id');
      
console.log(id);

           $('input[name="idgue"]').val(id);
    });
  });
</script>
<!-- details soutenances -->
<script>
    $(document).ready(function() {
        $('.detailssoutenance').click(function() {
            // Récupérer les données du bouton
           
            var datesoutenance = $(this).data('datesoutenance');
            var sujet = $(this).data('sujet');
            var presidentjury = $(this).data('presidentjury');
            var directeurthese = $(this).data('directeurthese');
            var codirecteur = $(this).data('codirecteur');
            
            // Insérer les données dans les cellules du tableau
            var html = `
                <tr>
                    <td>${sujet}</td>
                    <td>${datesoutenance}</td>
                    <td>${presidentjury}</td>
                    <td>${directeurthese}</td>
                    <td>${codirecteur}</td>
                </tr>
            `;
            
            $('#tableaudetailssoute').html(html);
            
            // Afficher le modal
            $('#eeexampleModal').modal('show');
        });
    });
</script>

<!-- Edition soutenance -->
<script>
    $(document).ready(function() {
        $('.btn-editsoute').click(function() {
            // Récupérer les données du bouton
            var id = $(this).data('id');
            var datesoutenance = $(this).data('datesoutenance');
            var sujet = $(this).data('sujet');
            var presidentjury = $(this).data('presidentjury');
            var directeurthese = $(this).data('directeurthese');
            var codirecteur = $(this).data('codirecteur');
            console.log(codirecteur);
            // Renvoyer les valeurs pour la modification
            $('input[name="idsou"]').val(id);
            $('input[name="date"]').val(datesoutenance);
            $('input[name="sujet"]').val(sujet);
            $('select[name="pr"]').val(presidentjury);
            $('select[name="direct"]').val(directeurthese);
            $('select[name="codirect"]').val(codirecteur);
            
            // Afficher le modal de modification
            $('#exampleModalCenter').modal('show');
        });
    });
</script>

<!-- Edition groupe -->
<script>
    $(document).ready(function() {
        $('.edit-groupe').click(function() {
            // Récupérer les données du bouton
            var id = $(this).data('id');
            var code = $(this).data('code');
            var nom = $(this).data('nom');
            var description = $(this).data('description');
            console.log(id);
            
            // Renvoyer les valeurs pour la modification
            $('input[name="idgroupe"]').val(id);
            $('input[name="code"]').val(code);
            $('input[name="nom"]').val(nom);  
            $('input[name="description"]').val(description);         
        });
    });
</script>

<!-- Edition groupe -->
<script>
    $(document).ready(function() {
        $('.edit-uc').click(function() {
            // Récupérer les données du bouton
            var id = $(this).data('id');
            var nom = $(this).data('nom');
            var duree = $(this).data('durée');
            console.log(id);
            
            // Renvoyer les valeurs pour la modification
            $('input[name="iduc"]').val(id);
            $('input[name="nom"]').val(nom);  
            $('input[name="duree"]').val(duree);         
        });
    });
</script>


<!-- Edition groupe -->
<script>
    $(document).ready(function() {
        $('.edit-session').click(function() {
            // Récupérer les données du bouton
            var id = $(this).data('id');
            var idtype = $(this).data('idtypesess');
            var nom = $(this).data('nom');
            var description = $(this).data('description');
            console.log(id);
            
            // Renvoyer les valeurs pour la modification
            $('input[name="idsess"]').val(id);
            $('input[name="idtype"]').val(idtype);
            $('input[name="nom"]').val(nom);  
            $('input[name="description"]').val(description);         
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.edit-dc').click(function() {
            // Récupérer les données du bouton
            var id = $(this).data('id');
            var perio = $(this).data('idperio');
            var iduc = $(this).data('iduc');
            var nom = $(this).data('nom');
            var datedebut = $(this).data('datedebut');
            var datefin = $(this).data('datefin');
            console.log(id);
            
            // Renvoyer les valeurs pour la modification
            $('input[name="iddc"]').val(id);
            $('input[name="perio"]').val(perio);
            $('input[name="uniteca"]').val(iduc);  
            $('input[name="nom"]').val(nom); 
            $('input[name="debut"]').val(datedebut); 
            $('input[name="fin"]').val(datefin);         
        });
    });
</script>

<!-- Suppression groupe -->
<script>
    $(document).ready(function() {
        $('.delete-groupe').click(function() {
            // Récupérer les données du bouton
            var id = $(this).data('id');
           
            console.log(id);
            
            // Renvoyer les valeurs pour la modification
            $('input[name="idgroupe"]').val(id);
             
        });
    });
</script>

<!-- Suppression groupe -->
<script>
    $(document).ready(function() {
        $('.delete-dc').click(function() {
            // Récupérer les données du bouton
            var id = $(this).data('id');
           
            console.log(id);
            
            // Renvoyer les valeurs pour la modification
            $('input[name="idddc"]').val(id);
             
        });
    });
</script>
<!-- Suppression groupe -->
<script>
    $(document).ready(function() {
        $('.delete-uc').click(function() {
            // Récupérer les données du bouton
            var id = $(this).data('id');
           
            console.log(id);
            
            // Renvoyer les valeurs pour la modification
            $('input[name="idduc"]').val(id);
             
        });
    });
</script>

<!-- Suppression groupe -->
<script>
    $(document).ready(function() {
        $('.delete-session').click(function() {
            // Récupérer les données du bouton
            var id = $(this).data('id');
           
            console.log(id);
            
            // Renvoyer les valeurs pour la modification
            $('input[name="iddsess"]').val(id);
             
        });
    });
</script>

<!-- Suppression role -->
<script>
    $(document).ready(function() {
        $('.delete-role').click(function() {
            // Récupérer les données du bouton
            var id = $(this).data('id');
           
            console.log(id);
            
            // Renvoyer les valeurs pour la modification
            $('input[name="idrole"]').val(id);
             
        });
    });
</script>

<!-- Edition groupe -->
<script>
    $(document).ready(function() {
        $('.edit-role').click(function() {
            // Récupérer les données du bouton
            var id = $(this).data('id');
            var code = $(this).data('code');
            var nom = $(this).data('nom');
            var description = $(this).data('description');
 
            console.log(id);
            // Renvoyer les valeurs pour la modification
            $('input[name="idrole"]').val(id);
            $('input[name="code"]').val(code);
            $('input[name="nom"]').val(nom);  
            $('input[name="description"]').val(description);         
        });
    });
</script>

<!-- ajout soutenance -->
<script>
    $(document).ready(function() {
        $('.ajoutsoute').click(function() {
            // Récupérer les données du bouton
            var id = $(this).data('id');
            var idreg = $(this).data('idreg');
            var tel = $(this).data('tel');
            var email = $(this).data('email');
            var nom = $(this).data('nom');

            console.log(id);
            console.log(idreg);
            console.log(tel);
            console.log(email);
            // Renvoyer les valeurs pour la modification
            $('input[name="idaudi"]').val(id);
            $('input[name="idreg"]').val(idreg);
            $('input[name="tel"]').val(tel);
            $('input[name="email"]').val(email);
            $('input[name="nom"]').val(nom);
        
        });
    });
</script>

<!-- supprimer soutenance -->
<script>
    $(document).ready(function() {
        $('.deletesou').click(function() {
            // Récupérer les données du bouton
            var id = $(this).data('id');
           
            console.log(id);
            // Renvoyer les valeurs pour la modification
            $('input[name="idsou"]').val(id);
           
        
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.ajoutrolegroupe').click(function() {
            // Récupérer les données du bouton
            var id = $(this).data('id');
           
            console.log(id);
            
            // Renvoyer les valeurs pour la modification
            $('input[name="idrole"]').val(id);
             
        });
    });
</script>



<!-- script pour récupérer les groupes du role  de l'ecran role-->
<script>
  // Sélectionner tous les éléments avec la classe "vpro"
  var vproElements = document.querySelectorAll('.voirrolegroupe');

  // Parcourir les éléments et attacher le gestionnaire d'événement à chacun d'eux
 vproElements.forEach(function(element) {
  element.addEventListener('click', function() {
    // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
    var roleId = this.getAttribute('data-id');
    $('input[name="idrrole"]').val(roleId );
    console.log(roleId);

    // Effectuer une requête AJAX pour récupérer les promotions du parcours
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_grouperole?roleId=' + roleId, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // Désencoder la réponse JSON
        var groupes = JSON.parse(xhr.responseText);

        // Mettre à jour le contenu de la modal avec les promotions récupérées
        var promotionsTableBody = document.getElementById('gueTableBody');
        promotionsTableBody.innerHTML = groupes;

        
     // Mettre à jour le contenu de la modal avec les auditeurs récupérés
     var auditeursTableBody = document.getElementById('gueTableBody');
auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

// Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
groupes.forEach(function(groupe) {
  var row = document.createElement('tr'); // Créer une nouvelle ligne

  // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
  var champ1Cell = document.createElement('td');
  champ1Cell.textContent = groupe.code;
  row.appendChild(champ1Cell);

  var champ2Cell = document.createElement('td');
  champ2Cell.textContent = groupe.nom;
  row.appendChild(champ2Cell);


 // Créer la cellule de tableau pour le bouton de suppression
var champActionCell = document.createElement('td');
var deleteButton = document.createElement('a');
deleteButton.href = '#';
deleteButton.className = 'btn btn-sm btn-outline-danger d';
deleteButton.setAttribute('data-toggle', 'modal');
deleteButton.setAttribute('data-target', '#ddeleteModal');
deleteButton.setAttribute('data-id', groupe.id); // Remplacez `auditeur.id` par la propriété correspondante dans votre objet auditeur
deleteButton.setAttribute('dataa-toggl', 'tooltip');
deleteButton.setAttribute('data-original-title', "Supprimer ");
deleteButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
champActionCell.appendChild(deleteButton);
row.appendChild(champActionCell);

  // Ajouter la ligne au corps du tableau
  auditeursTableBody.appendChild(row);
});
      }
    };
    xhr.send();
  });
});
</script>

<script>
$(document).ready(function() {
    $(document).on('click', '.d', function() {
        // Récupérer les données du bouton
        var id = $(this).data('id');

        console.log(id);

        // Renvoyer les valeurs pour la modification
        $('input[name="idggroupe"]').val(id);
    });
});
</script>


<script>
    $(document).ready(function() {
        $('.ajoutgrouperole').click(function() {
            // Récupérer les données du bouton
            var id = $(this).data('id');
           
            console.log(id);
            
            // Renvoyer les valeurs pour la modification
            $('input[name="idgroupe"]').val(id);
             
        });
    });
</script>


<!-- script pour récupérer les groupes du role  de l'ecran role-->
<script>
  // Sélectionner tous les éléments avec la classe "vpro"
  var vproElements = document.querySelectorAll('.voirgrouperole');

  // Parcourir les éléments et attacher le gestionnaire d'événement à chacun d'eux
 vproElements.forEach(function(element) {
  element.addEventListener('click', function() {
    // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
    var groupeId = this.getAttribute('data-id');
    $('input[name="idggroupe"]').val(groupeId );
    console.log(groupeId);

    // Effectuer une requête AJAX pour récupérer les promotions du parcours
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_rolegroupe?groupeId=' + groupeId, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // Désencoder la réponse JSON
        var roles = JSON.parse(xhr.responseText);

        // Mettre à jour le contenu de la modal avec les promotions récupérées
        var promotionsTableBody = document.getElementById('gueTableBody');
        promotionsTableBody.innerHTML = roles;

        
     // Mettre à jour le contenu de la modal avec les auditeurs récupérés
     var auditeursTableBody = document.getElementById('gueTableBody');
auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

// Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
roles.forEach(function(role) {
  var row = document.createElement('tr'); // Créer une nouvelle ligne

  // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
  var champ1Cell = document.createElement('td');
  champ1Cell.textContent = role.code;
  row.appendChild(champ1Cell);

  var champ2Cell = document.createElement('td');
  champ2Cell.textContent = role.nom;
  row.appendChild(champ2Cell);


 // Créer la cellule de tableau pour le bouton de suppression
var champActionCell = document.createElement('td');
var deleteButton = document.createElement('a');
deleteButton.href = '#';
deleteButton.className = 'btn btn-sm btn-outline-danger r';
deleteButton.setAttribute('data-toggle', 'modal');
deleteButton.setAttribute('data-target', '#ddeleteModal');
deleteButton.setAttribute('data-id', role.id); // Remplacez `auditeur.id` par la propriété correspondante dans votre objet auditeur
deleteButton.setAttribute('dataa-toggl', 'tooltip');
deleteButton.setAttribute('data-original-title', "Supprimer ");
deleteButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
champActionCell.appendChild(deleteButton);
row.appendChild(champActionCell);

  // Ajouter la ligne au corps du tableau
  auditeursTableBody.appendChild(row);
});
      }
    };
    xhr.send();
  });
});
</script>

<script>
$(document).ready(function() {
    $(document).on('click', '.r', function() {
        // Récupérer les données du bouton
        var id = $(this).data('id');

        console.log(id);

        // Renvoyer les valeurs pour la modification
        $('input[name="idrrole"]').val(id);
    });
});
</script>

<script>
$(document).ready(function() {
    $(document).on('click', '.ajoutusergroupe', function() {
        // Récupérer les données du bouton
        var id = $(this).data('id');

        console.log(id);

        // Renvoyer les valeurs pour la modification
        $('input[name="iduser"]').val(id);
    });
});
</script>

<script>
  $(document).ready(function() {
      $(document).on('click', '.attribprofil', function() {
          // Récupérer les données du bouton
          var id = $(this).data('id');
  
          console.log(id);
  
          // Renvoyer les valeurs pour la modification
          $('input[name="iduser"]').val(id);
      });
  });
  </script>

<!-- script pour récupérer les auditeurs d'un regroupement-->
<script>
  // Sélectionner tous les éléments avec la classe "vpro"
  var vproElements = document.querySelectorAll('.attribnote');

  // Parcourir les éléments et attacher le gestionnaire d'événement à chacun d'eux
  vproElements.forEach(function(element) {
    element.addEventListener('click', function() {
      // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
      var regId = this.getAttribute('data-idre');
      var evaId = this.getAttribute('data-id');
      console.log(evaId);
      console.log(regId);

      // Effectuer une requête AJAX pour récupérer les promotions du parcours
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_regauditeur?regId=' + regId, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Désencoder la réponse JSON
          var auditeurs = JSON.parse(xhr.responseText);

          // Mettre à jour le contenu de la modal avec les auditeurs récupérés
          var auditeursTableBody = document.getElementById('auditeursTableBody');
          auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

          // Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
          auditeurs.forEach(function(auditeur) {
            var row = document.createElement('tr'); // Créer une nouvelle ligne

            // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
            var champ1Cell = document.createElement('td');
            champ1Cell.textContent = auditeur.matricule;
            row.appendChild(champ1Cell);

            var champ2Cell = document.createElement('td');
            champ2Cell.textContent = auditeur.nom;
            row.appendChild(champ2Cell);

            var champ3Cell = document.createElement('td');
            champ3Cell.textContent = auditeur.prenom;
            row.appendChild(champ3Cell);

            var champ4Cell = document.createElement('td');
            champ4Cell.textContent = auditeur.date;
            row.appendChild(champ4Cell);

            var champ5Cell = document.createElement('td');
            var checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            champ5Cell.appendChild(checkbox);
            row.appendChild(champ5Cell);

            var champ6Cell = document.createElement('td');
            var textbox = document.createElement('input');
            textbox.type = 'text';
            champ6Cell.appendChild(textbox);
            row.appendChild(champ6Cell);

          // Créer la cellule de tableau pour le bouton de suppression
var champActionCell = document.createElement('td');
var deleteButton = document.createElement('a');
deleteButton.href = '#';
deleteButton.className = 'btn btn-sm btn-primary';
deleteButton.setAttribute('data-id', auditeur.id); // Remplacez `auditeur.id` par la propriété correspondante dans votre objet auditeur
deleteButton.setAttribute('data-toggle', 'modal');
deleteButton.setAttribute('data-target', '#ddeleteModal'); // Remplacez 'deleteModal' par l'ID de votre modale
deleteButton.setAttribute('data-original-title', "Noter");
deleteButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
champActionCell.appendChild(deleteButton);
row.appendChild(champActionCell);

            // Ajouter la ligne au corps du tableau
            auditeursTableBody.appendChild(row);

        // Écouter le clic sur le bouton de suppression
deleteButton.addEventListener('click', function(event) {
  event.preventDefault();

  // Récupérer la valeur du champ de texte
  var inputValue = textbox.value;

  // Récupérer l'ID de l'auditeur
  var auditeurId = deleteButton.getAttribute('data-id');
  console.log(evaId);
  console.log(inputValue);
  console.log(auditeurId);
  $('input[name="idev"]').val(evaId);
  $('input[name="note"]').val(inputValue);
  $('input[name="idaudi"]').val(auditeurId);

  // Créer un objet contenant les données à envoyer
  var data = {
    valeur: inputValue,
    auditeurId: auditeurId,
    evaId: evaId
  };

  // Effectuer la requête AJAX avec la méthode POST
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'evaluation_note_Insert', true);

  // Avant d'ouvrir la requête AJAX
  var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Traitement à effectuer après la réussite de la requête
      console.log('Requête POST réussie !');
    }
  };
  xhr.send(JSON.stringify(data));
});
          });
        }
      };
      xhr.send();
    });
  });
</script>



<!-- script pour récupérer les auditeurs d'un regroupement-->
<script>
  // Sélectionner tous les éléments avec la classe "vpro"
  var vproElements = document.querySelectorAll('.voirnote');

  // Parcourir les éléments et attacher le gestionnaire d'événement à chacun d'eux
  vproElements.forEach(function(element) {
    element.addEventListener('click', function() {
      // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
      var regId = this.getAttribute('data-idre');
      var evaId = this.getAttribute('data-id');
      console.log(evaId);

      // Effectuer une requête AJAX pour récupérer les promotions du parcours
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_evanote?evaId=' + evaId, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Désencoder la réponse JSON
          var auditeurs = JSON.parse(xhr.responseText);

          // Mettre à jour le contenu de la modal avec les auditeurs récupérés
          var auditeursTableBody = document.getElementById('auditeursTableBodnote');
          auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

          // Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
          auditeurs.forEach(function(auditeur) {
            var row = document.createElement('tr'); // Créer une nouvelle ligne
            // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne

            var champ2Cell = document.createElement('td');
            champ2Cell.textContent = auditeur.nom;
            row.appendChild(champ2Cell);

            var champ3Cell = document.createElement('td');
            champ3Cell.textContent = auditeur.prenom;
            row.appendChild(champ3Cell);

            var champ4Cell = document.createElement('td');
            champ4Cell.textContent = auditeur.note;
            row.appendChild(champ4Cell);

          // Créer la cellule de tableau pour le bouton de suppression
var champActionCell = document.createElement('td');
var deleteButton = document.createElement('a');
deleteButton.href = '#';
deleteButton.className = 'btn btn-sm btn-primary';
deleteButton.setAttribute('data-id', auditeur.id); // Remplacez `auditeur.id` par la propriété correspondante dans votre objet auditeur
deleteButton.setAttribute('data-toggle', 'modal');
deleteButton.setAttribute('data-target', '#ddeleteModal'); // Remplacez 'deleteModal' par l'ID de votre modale
deleteButton.setAttribute('data-original-title', "Noter");
deleteButton.innerHTML = '<i class="fas fa-edit"></i>';
champActionCell.appendChild(deleteButton);
row.appendChild(champActionCell);

            // Ajouter la ligne au corps du tableau
            auditeursTableBody.appendChild(row);
/* 
        // Écouter le clic sur le bouton de suppression
deleteButton.addEventListener('click', function(event) {
  event.preventDefault();

  // Récupérer la valeur du champ de texte
  var inputValue = textbox.value;

  // Récupérer l'ID de l'auditeur
  var auditeurId = deleteButton.getAttribute('data-id');
  console.log(evaId);
  console.log(inputValue);
  console.log(auditeurId);
  $('input[name="idev"]').val(evaId);
  $('input[name="note"]').val(inputValue);
  $('input[name="idaudi"]').val(auditeurId);

  // Créer un objet contenant les données à envoyer
  var data = {
    valeur: inputValue,
    auditeurId: auditeurId,
    evaId: evaId
  };

  // Effectuer la requête AJAX avec la méthode POST
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'evaluation_note_Insert', true);

  // Avant d'ouvrir la requête AJAX
  var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Traitement à effectuer après la réussite de la requête
      console.log('Requête POST réussie !');
    }
  };
  xhr.send(JSON.stringify(data));
}); */
          });
        }
      };
      xhr.send();
    });
  });
</script>

<script>
  $(document).ready(function() {
    $(document).on('click', '.btnueparc', function() {
      var id = $(this).data('id');
   
console.log(id);

      $('input[name="idaue"]').val(id);

     
    });
  });
</script>

<!-- script pour récupérer les auditeurs d'un regroupement-->
<script>
  // Sélectionner tous les éléments avec la classe "vpro"
  var vproElements = document.querySelectorAll('.voirnoteexaa');

  // Parcourir les éléments et attacher le gestionnaire d'événement à chacun d'eux
  vproElements.forEach(function(element) {
    element.addEventListener('click', function() {
      // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
      var regId = this.getAttribute('data-idre');
      var evaId = this.getAttribute('data-id');
      console.log(evaId);

      // Effectuer une requête AJAX pour récupérer les promotions du parcours
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_evanoteexaa?evaId=' + evaId, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Désencoder la réponse JSON
          var auditeurs = JSON.parse(xhr.responseText);

          // Mettre à jour le contenu de la modal avec les auditeurs récupérés
          var auditeursTableBody = document.getElementById('auditeursTableBodnote');
          auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

          // Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
          auditeurs.forEach(function(auditeur) {
            var row = document.createElement('tr'); // Créer une nouvelle ligne
            // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne

            var champ2Cell = document.createElement('td');
            champ2Cell.textContent = auditeur.nom;
            row.appendChild(champ2Cell);

            var champ3Cell = document.createElement('td');
            champ3Cell.textContent = auditeur.prenom;
            row.appendChild(champ3Cell);

            var champ4Cell = document.createElement('td');
            champ4Cell.textContent = auditeur.note;
            row.appendChild(champ4Cell);

          // Créer la cellule de tableau pour le bouton de suppression
var champActionCell = document.createElement('td');
var deleteButton = document.createElement('a');
deleteButton.href = '#';
deleteButton.className = 'btn btn-sm btn-primary';
deleteButton.setAttribute('data-id', auditeur.id); // Remplacez `auditeur.id` par la propriété correspondante dans votre objet auditeur
deleteButton.setAttribute('data-toggle', 'modal');
deleteButton.setAttribute('data-target', '#ddeleteModal'); // Remplacez 'deleteModal' par l'ID de votre modale
deleteButton.setAttribute('data-original-title', "Noter");
deleteButton.innerHTML = '<i class="fas fa-edit"></i>';
champActionCell.appendChild(deleteButton);
row.appendChild(champActionCell);

            // Ajouter la ligne au corps du tableau
            auditeursTableBody.appendChild(row);
/* 
        // Écouter le clic sur le bouton de suppression
deleteButton.addEventListener('click', function(event) {
  event.preventDefault();

  // Récupérer la valeur du champ de texte
  var inputValue = textbox.value;

  // Récupérer l'ID de l'auditeur
  var auditeurId = deleteButton.getAttribute('data-id');
  console.log(evaId);
  console.log(inputValue);
  console.log(auditeurId);
  $('input[name="idev"]').val(evaId);
  $('input[name="note"]').val(inputValue);
  $('input[name="idaudi"]').val(auditeurId);

  // Créer un objet contenant les données à envoyer
  var data = {
    valeur: inputValue,
    auditeurId: auditeurId,
    evaId: evaId
  };

  // Effectuer la requête AJAX avec la méthode POST
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'evaluation_note_Insert', true);

  // Avant d'ouvrir la requête AJAX
  var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Traitement à effectuer après la réussite de la requête
      console.log('Requête POST réussie !');
    }
  };
  xhr.send(JSON.stringify(data));
}); */
          });
        }
      };
      xhr.send();
    });
  });
</script>


<!-- script pour récupérer les auditeurs d'un regroupement-->
<script>
  // Sélectionner tous les éléments avec la classe "vpro"
  var vproElements = document.querySelectorAll('.anonymat');

  // Parcourir les éléments et attacher le gestionnaire d'événement à chacun d'eux
  vproElements.forEach(function(element) {
    element.addEventListener('click', function() {
      // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
      var regId = this.getAttribute('data-idre');
      var evaId = this.getAttribute('data-id');
      console.log(evaId);
      console.log(regId);

      // Effectuer une requête AJAX pour récupérer les promotions du parcours
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_regauditeur?regId=' + regId, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Désencoder la réponse JSON
          var auditeurs = JSON.parse(xhr.responseText);

          // Mettre à jour le contenu de la modal avec les auditeurs récupérés
          var auditeursTableBody = document.getElementById('auditeursTableBodya');
          auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

          // Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
          auditeurs.forEach(function(auditeur) {
            var row = document.createElement('tr'); // Créer une nouvelle ligne
            console.log(auditeur.nom);

            var champ2Cell = document.createElement('td');
            champ2Cell.textContent = auditeur.nom;
            row.appendChild(champ2Cell);

            var champ3Cell = document.createElement('td');
            champ3Cell.textContent = auditeur.prenom;
            row.appendChild(champ3Cell);

            var champ6Cell = document.createElement('td');
            var textbox = document.createElement('input');
            textbox.type = 'text';
            champ6Cell.appendChild(textbox);
            row.appendChild(champ6Cell);

          // Créer la cellule de tableau pour le bouton de suppression
var champActionCell = document.createElement('td');
var deleteButton = document.createElement('a');
deleteButton.href = '#';
deleteButton.className = 'btn btn-sm btn-primary';
deleteButton.setAttribute('data-id', auditeur.id); // Remplacez `auditeur.id` par la propriété correspondante dans votre objet auditeur
deleteButton.setAttribute('data-toggle', 'modal');
deleteButton.setAttribute('data-target', '#dddeleteModal'); // Remplacez 'deleteModal' par l'ID de votre modale
deleteButton.setAttribute('data-original-title', "Noter");
deleteButton.innerHTML = '<i class="fas fa-user-secret"></i>';
champActionCell.appendChild(deleteButton);
row.appendChild(champActionCell);

            // Ajouter la ligne au corps du tableau
            auditeursTableBody.appendChild(row);

        // Écouter le clic sur le bouton de suppression
deleteButton.addEventListener('click', function(event) {
  event.preventDefault();

  // Récupérer la valeur du champ de texte
  var inputValue = textbox.value;

  // Récupérer l'ID de l'auditeur
  var auditeurId = deleteButton.getAttribute('data-id');
  console.log(evaId);
  console.log(inputValue);
  console.log(auditeurId);
  $('input[name="idev"]').val(evaId);
  $('input[name="anonymat"]').val(inputValue);
  $('input[name="idaudi"]').val(auditeurId);

  // Créer un objet contenant les données à envoyer
  var data = {
    valeur: inputValue,
    auditeurId: auditeurId,
    evaId: evaId
  };

  // Effectuer la requête AJAX avec la méthode POST
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'evaluation_note_Insert', true);

  // Avant d'ouvrir la requête AJAX
  var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Traitement à effectuer après la réussite de la requête
      console.log('Requête POST réussie !');
    }
  };
  xhr.send(JSON.stringify(data));
});
          });
        }
      };
      xhr.send();
    });
  });
</script>


<script>
    // Récupérez le message d'erreur de Blade dans une variable JavaScript
    var errorMessage = "{{ isset($errorMessage) ? $errorMessage : '' }}";

    // Vérifiez si un message d'erreur est présent
    if (errorMessage !== '') {
        // Affichez le message d'erreur dans la div
        document.getElementById('errorMessage').innerText = errorMessage;
        document.getElementById('errorMessage').style.display = 'block';

        // Masquez la div après 5 secondes
        setTimeout(function() {
            document.getElementById('errorMessage').style.display = 'none';
        }, 5000);
    }
</script>
<script>
    // Récupérez le message de succès de Blade dans une variable JavaScript
    var succesMessage = "{{ isset($succesMessage) ? $succesMessage : '' }}";

    // Vérifiez si un message de succès est présent
    if (succesMessage !== '') {
        // Affichez le message de succès dans la div
        document.getElementById('succesMessage').innerText = succesMessage;
        document.getElementById('succesMessage').style.display = 'block';

        // Masquez la div après 5 secondes
        setTimeout(function() {
            document.getElementById('succesMessage').style.display = 'none';
        }, 5000);
    }
</script>







<!-- script pour récupérer les auditeurs d'un regroupement-->
<script>
  // Sélectionner tous les éléments avec la classe "vpro"
  var vproElements = document.querySelectorAll('.attribnoteexaa');

  // Parcourir les éléments et attacher le gestionnaire d'événement à chacun d'eux
  vproElements.forEach(function(element) {
    element.addEventListener('click', function() {
      // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
      var regId = this.getAttribute('data-idre');
      var evaId = this.getAttribute('data-id');
      console.log(evaId);
      console.log(regId);

      // Effectuer une requête AJAX pour récupérer les promotions du parcours
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_regauditeuranonyme?regId=' + regId, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Désencoder la réponse JSON
          var auditeurs = JSON.parse(xhr.responseText);

          // Mettre à jour le contenu de la modal avec les auditeurs récupérés
          var auditeursTableBody = document.getElementById('auditeursTableBody');
          auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

          // Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
          auditeurs.forEach(function(auditeur) {
            var row = document.createElement('tr'); // Créer une nouvelle ligne
            console.log(auditeur.hasOwnProperty('code') ? auditeur.code : 'Code anonyme non défini');
            // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
          /*   var champ1Cell = document.createElement('td');
            champ1Cell.textContent = auditeur.matricule;
            row.appendChild(champ1Cell); */

            /* var champ2Cell = document.createElement('td');
            champ2Cell.textContent = auditeur.nom;
            row.appendChild(champ2Cell); */

           /*  var champ3Cell = document.createElement('td');
            champ3Cell.textContent = auditeur.prenom;
            row.appendChild(champ3Cell); */

            var champ4Cell = document.createElement('td');
            champ4Cell.textContent = auditeur.code;
            row.appendChild(champ4Cell);


            var champ6Cell = document.createElement('td');
            var textbox = document.createElement('input');
            textbox.type = 'text';
            champ6Cell.appendChild(textbox);
            row.appendChild(champ6Cell);

          // Créer la cellule de tableau pour le bouton de suppression
var champActionCell = document.createElement('td');
var deleteButton = document.createElement('a');
deleteButton.href = '#';
deleteButton.className = 'btn btn-sm btn-primary';
deleteButton.setAttribute('data-id', auditeur.id); // Remplacez `auditeur.id` par la propriété correspondante dans votre objet auditeur
deleteButton.setAttribute('data-toggle', 'modal');
deleteButton.setAttribute('data-target', '#ddeleteModal'); // Remplacez 'deleteModal' par l'ID de votre modale
deleteButton.setAttribute('data-original-title', "Noter");
deleteButton.innerHTML = '<i class="fas fa-trash-alt"></i>';
champActionCell.appendChild(deleteButton);
row.appendChild(champActionCell);

            // Ajouter la ligne au corps du tableau
            auditeursTableBody.appendChild(row);

        // Écouter le clic sur le bouton de suppression
deleteButton.addEventListener('click', function(event) {
  event.preventDefault();

  // Récupérer la valeur du champ de texte
  var inputValue = textbox.value;

  // Récupérer l'ID de l'auditeur
  var auditeurId = deleteButton.getAttribute('data-id');
  console.log(evaId);
  console.log(inputValue);
  console.log(auditeurId);
  $('input[name="idev"]').val(evaId);
  $('input[name="note"]').val(inputValue);
  $('input[name="idaudi"]').val(auditeurId);

  // Créer un objet contenant les données à envoyer
  var data = {
    valeur: inputValue,
    auditeurId: auditeurId,
    evaId: evaId
  };

  // Effectuer la requête AJAX avec la méthode POST
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'evaluation_note_Insert', true);

  // Avant d'ouvrir la requête AJAX
  var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Traitement à effectuer après la réussite de la requête
      console.log('Requête POST réussie !');
    }
  };
  xhr.send(JSON.stringify(data));
});
          });
        }
      };
      xhr.send();
    });
  });
</script>






<!-- script pour récupérer les auditeurs d'un regroupement-->
<script>
  // Sélectionner tous les éléments avec la classe "vpro"
  var vproElements = document.querySelectorAll('.details-btn');

  // Parcourir les éléments et attacher le gestionnaire d'événement à chacun d'eux
  vproElements.forEach(function(element) {
    element.addEventListener('click', function() {
      // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
      var periodeId = this.getAttribute('data-id');
      console.log(periodeId);

      // Effectuer une requête AJAX pour récupérer les promotions du parcours
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_promotiondelaperiode?periode=' + periodeId, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Désencoder la réponse JSON
          var promotions = JSON.parse(xhr.responseText);

          // Mettre à jour le contenu de la modal avec les auditeurs récupérés
          var auditeursTableBody = document.getElementById('promotionTableBody');
          auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

          // Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
          promotions.forEach(function(promotion) {
            var row = document.createElement('tr'); // Créer une nouvelle ligne
            // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
            var element = document.getElementById('nbrepro');
  element.textContent = promotion.promotions_count;
           var champ2Cell = document.createElement('td');
            champ2Cell.textContent = promotion.nompromo;
            row.appendChild(champ2Cell); 

       

            // Ajouter la ligne au corps du tableau
            auditeursTableBody.appendChild(row);

        // Écouter le clic sur le bouton de suppression

          });
        }
      };
      xhr.send();
    });
  });


  vproElements.forEach(function(element) {
    element.addEventListener('click', function() {
      // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
      var periodeId = this.getAttribute('data-id');
      console.log(periodeId);

      // Effectuer une requête AJAX pour récupérer les promotions du parcours
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_parcoursdelaperiode?periode=' + periodeId, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Désencoder la réponse JSON
          var parcours = JSON.parse(xhr.responseText);

          // Mettre à jour le contenu de la modal avec les auditeurs récupérés
          var auditeursTableBody = document.getElementById('parcoursTableBody');
          auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

          // Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
          parcours.forEach(function(parcours) {
            var row = document.createElement('tr'); // Créer une nouvelle ligne
            // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
            var element = document.getElementById('nbrepar');
  element.textContent = parcours.parcours_count;
console.log(parcours.nomparc);
           var champ2Cell = document.createElement('td');
            champ2Cell.textContent = parcours.nomparc;
            row.appendChild(champ2Cell); 

         

            // Ajouter la ligne au corps du tableau
            auditeursTableBody.appendChild(row);

        // Écouter le clic sur le bouton de suppression

          });
        }
      };
      xhr.send();
    });
  });

  
  vproElements.forEach(function(element) {
    element.addEventListener('click', function() {
      // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
      var periodeId = this.getAttribute('data-id');
      console.log(periodeId);

      // Effectuer une requête AJAX pour récupérer les promotions du parcours
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_regroupementdelaperiode?periode=' + periodeId, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Désencoder la réponse JSON
          var regroupements = JSON.parse(xhr.responseText);

          // Mettre à jour le contenu de la modal avec les auditeurs récupérés
          var auditeursTableBody = document.getElementById('regroupementTableBody');
          auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

          // Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
          regroupements.forEach(function(regroupement) {
            var row = document.createElement('tr'); // Créer une nouvelle ligne
            // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
            var element = document.getElementById('nbrere');
  element.textContent = regroupement.parcours_count;
           var champ2Cell = document.createElement('td');
            champ2Cell.textContent = regroupement.nomreg;
            row.appendChild(champ2Cell); 

         

            // Ajouter la ligne au corps du tableau
            auditeursTableBody.appendChild(row);

        // Écouter le clic sur le bouton de suppression

          });
        }
      };
      xhr.send();
    });
  });





  
  vproElements.forEach(function(element) {
    element.addEventListener('click', function() {
      // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
      var periodeId = this.getAttribute('data-id');
      console.log(periodeId);

      // Effectuer une requête AJAX pour récupérer les promotions du parcours
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_auditeurdelaperiode?periode=' + periodeId, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Désencoder la réponse JSON
          var auditeurs = JSON.parse(xhr.responseText);

          // Mettre à jour le contenu de la modal avec les auditeurs récupérés
          var auditeursTableBody = document.getElementById('auditeurTableBody');
          auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

          // Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
          auditeurs.forEach(function(auditeur) {
            var row = document.createElement('tr'); // Créer une nouvelle ligne
            // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
            var element = document.getElementById('nbreau');
  element.textContent = auditeur.parcours_count;
           var champ1Cell = document.createElement('td');
            champ1Cell.textContent = auditeur.nom;
            row.appendChild(champ1Cell); 

            var champ2Cell = document.createElement('td');
            champ2Cell.textContent = auditeur.prenom;
            row.appendChild(champ2Cell); 

            // Ajouter la ligne au corps du tableau
            auditeursTableBody.appendChild(row);

        // Écouter le clic sur le bouton de suppression

          });
        }
      };
      xhr.send();
    });
  });




  
  vproElements.forEach(function(element) {
    element.addEventListener('click', function() {
      // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
      var periodeId = this.getAttribute('data-id');
      console.log(periodeId);

      // Effectuer une requête AJAX pour récupérer les promotions du parcours
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_enseignantdelaperiode?periode=' + periodeId, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Désencoder la réponse JSON
          var auditeurs = JSON.parse(xhr.responseText);

          // Mettre à jour le contenu de la modal avec les auditeurs récupérés
          var auditeursTableBody = document.getElementById('enseignantTableBody');
          auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

          // Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
          auditeurs.forEach(function(auditeur) {
            var row = document.createElement('tr'); // Créer une nouvelle ligne
            // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
            var element = document.getElementById('nbreen');
  element.textContent = auditeur.parcours_count;
           var champ1Cell = document.createElement('td');
            champ1Cell.textContent = auditeur.nomens;
            row.appendChild(champ1Cell); 

            var champ2Cell = document.createElement('td');
            champ2Cell.textContent = auditeur.prenomens;
            row.appendChild(champ2Cell); 

            // Ajouter la ligne au corps du tableau
            auditeursTableBody.appendChild(row);

        // Écouter le clic sur le bouton de suppression

          });
        }
      };
      xhr.send();
    });
  });




  vproElements.forEach(function(element) {
    element.addEventListener('click', function() {
      // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
      var periodeId = this.getAttribute('data-id');
      console.log(periodeId);

      // Effectuer une requête AJAX pour récupérer les promotions du parcours
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_matieredelaperiode?periode=' + periodeId, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Désencoder la réponse JSON
          var auditeurs = JSON.parse(xhr.responseText);

          // Mettre à jour le contenu de la modal avec les auditeurs récupérés
          var auditeursTableBody = document.getElementById('ueTableBody');
          auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

          // Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
          auditeurs.forEach(function(auditeur) {
            var row = document.createElement('tr'); // Créer une nouvelle ligne
            // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
            var element = document.getElementById('nbreue');
  element.textContent = auditeur.parcours_count;
           var champ1Cell = document.createElement('td');
            champ1Cell.textContent = auditeur.codeu;
            row.appendChild(champ1Cell); 

            var champ2Cell = document.createElement('td');
            champ2Cell.textContent = auditeur.nomue;
            row.appendChild(champ2Cell); 

            // Ajouter la ligne au corps du tableau
            auditeursTableBody.appendChild(row);

        // Écouter le clic sur le bouton de suppression

          });
        }
      };
      xhr.send();
    });
  });





  
  vproElements.forEach(function(element) {
    element.addEventListener('click', function() {
      // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
      var periodeId = this.getAttribute('data-id');
      console.log(periodeId);

      // Effectuer une requête AJAX pour récupérer les promotions du parcours
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_divisiondelaperiode?periode=' + periodeId, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Désencoder la réponse JSON
          var auditeurs = JSON.parse(xhr.responseText);

          // Mettre à jour le contenu de la modal avec les auditeurs récupérés
          var auditeursTableBody = document.getElementById('divTableBody');
          auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

          // Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
          auditeurs.forEach(function(auditeur) {
            var row = document.createElement('tr'); // Créer une nouvelle ligne
            // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
            var element = document.getElementById('nbredv');
  element.textContent = auditeur.parcours_count;
           var champ1Cell = document.createElement('td');
            champ1Cell.textContent = auditeur.nom;
            row.appendChild(champ1Cell); 

            var champ2Cell = document.createElement('td');
            champ2Cell.textContent = auditeur.datedebut;
            row.appendChild(champ2Cell); 
            var champ2Cell = document.createElement('td');
            champ2Cell.textContent = auditeur.datefin;
            row.appendChild(champ2Cell); 
            // Ajouter la ligne au corps du tableau
            auditeursTableBody.appendChild(row);

        // Écouter le clic sur le bouton de suppression

          });
        }
      };
      xhr.send();
    });
  });
</script>

<script>
  // Sélectionner tous les éléments avec la classe "vpro"
  var vproElements = document.querySelectorAll('.vreg');
  vproElements.forEach(function(element) {
    element.addEventListener('click', function() {
      // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
      var parcursId = this.getAttribute('data-id');
      console.log(parcursId);

      // Effectuer une requête AJAX pour récupérer les promotions du parcours
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_regroupementduparcours?periode=' + parcursId, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Désencoder la réponse JSON
          var auditeurs = JSON.parse(xhr.responseText);

          // Mettre à jour le contenu de la modal avec les auditeurs récupérés
          var auditeursTableBody = document.getElementById('regTableBody');
          auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

          // Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
          auditeurs.forEach(function(auditeur) {
            var row = document.createElement('tr'); // Créer une nouvelle ligne
            // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
       
           var champ1Cell = document.createElement('td');
            champ1Cell.textContent = auditeur.nomreg;
            row.appendChild(champ1Cell); 

            var champ2Cell = document.createElement('td');
            champ2Cell.textContent = auditeur.heuredebut;
            row.appendChild(champ2Cell); 
            var champ2Cell = document.createElement('td');
            champ2Cell.textContent = auditeur.heurefin;
            row.appendChild(champ2Cell); 
            // Ajouter la ligne au corps du tableau
            auditeursTableBody.appendChild(row);

        // Écouter le clic sur le bouton de suppression

          });
        }
      };
      xhr.send();
    });
  });

  // Sélectionner tous les éléments avec la classe "vpro"
  var vproElements = document.querySelectorAll('.vau');
  vproElements.forEach(function(element) {
    element.addEventListener('click', function() {
      // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
      var parcursId = this.getAttribute('data-id');
      console.log(parcursId);

      // Effectuer une requête AJAX pour récupérer les promotions du parcours
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_auditeurduparcours?parcours=' + parcursId, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Désencoder la réponse JSON
          var auditeurs = JSON.parse(xhr.responseText);

          // Mettre à jour le contenu de la modal avec les auditeurs récupérés
          var auditeursTableBody = document.getElementById('audiTableBody');
          auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

          // Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
          auditeurs.forEach(function(auditeur) {
            var row = document.createElement('tr'); // Créer une nouvelle ligne
            // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
           var champ1Cell = document.createElement('td');
            champ1Cell.textContent = auditeur.matricule;
            row.appendChild(champ1Cell); 

            var champ2Cell = document.createElement('td');
            champ2Cell.textContent = auditeur.nom;
            row.appendChild(champ2Cell); 
            var champ2Cell = document.createElement('td');
            champ2Cell.textContent = auditeur.prenom;
            row.appendChild(champ2Cell); 
            // Ajouter la ligne au corps du tableau
            auditeursTableBody.appendChild(row);

        // Écouter le clic sur le bouton de suppression

          });
        }
      };
      xhr.send();
    });
  });


  
  // Sélectionner tous les éléments avec la classe "vpro"
  var vproElements = document.querySelectorAll('.vgrue');
  vproElements.forEach(function(element) {
    element.addEventListener('click', function() {
      // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
      var ueId = this.getAttribute('data-id');
      console.log(ueId);

      // Effectuer une requête AJAX pour récupérer les promotions du parcours
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_enseigantdelue?ue=' + ueId, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Désencoder la réponse JSON
          var auditeurs = JSON.parse(xhr.responseText);

          // Mettre à jour le contenu de la modal avec les auditeurs récupérés
          var auditeursTableBody = document.getElementById('audiTableBody');
          auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

          // Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
          auditeurs.forEach(function(auditeur) {
            var row = document.createElement('tr'); // Créer une nouvelle ligne
            // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
           var champ1Cell = document.createElement('td');
            champ1Cell.textContent = auditeur.numeroens;
            row.appendChild(champ1Cell); 

            var champ2Cell = document.createElement('td');
            champ2Cell.textContent = auditeur.nomens;
            row.appendChild(champ2Cell); 
            var champ2Cell = document.createElement('td');
            champ2Cell.textContent = auditeur.prenomens;
            row.appendChild(champ2Cell); 
            // Ajouter la ligne au corps du tableau
            auditeursTableBody.appendChild(row);

        // Écouter le clic sur le bouton de suppression

          });
        }
      };
      xhr.send();
    });
  });



  
  
  // Sélectionner tous les éléments avec la classe "vpro"
  var vproElements = document.querySelectorAll('.vparc');
  vproElements.forEach(function(element) {
    element.addEventListener('click', function() {
      // Récupérer l'ID du parcours à partir de l'attribut data-id de l'élément
      var ueId = this.getAttribute('data-id');
      console.log(ueId);

      // Effectuer une requête AJAX pour récupérer les promotions du parcours
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_parcoursdelue?ue=' + ueId, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Désencoder la réponse JSON
          var auditeurs = JSON.parse(xhr.responseText);

          // Mettre à jour le contenu de la modal avec les auditeurs récupérés
          var auditeursTableBody = document.getElementById('pTableBody');
          auditeursTableBody.innerHTML = ''; // Réinitialiser le contenu du corps du tableau

          // Parcourir les auditeurs et créer les lignes du tableau avec les 7 champs
          auditeurs.forEach(function(auditeur) {
            var row = document.createElement('tr'); // Créer une nouvelle ligne
            // Créer les cellules de tableau pour chaque champ et les ajouter à la ligne
           var champ1Cell = document.createElement('td');
            champ1Cell.textContent = auditeur.codeparc;
            row.appendChild(champ1Cell); 

            var champ2Cell = document.createElement('td');
            champ2Cell.textContent = auditeur.nomparc;
            row.appendChild(champ2Cell); 
           
            // Ajouter la ligne au corps du tableau
            auditeursTableBody.appendChild(row);

        // Écouter le clic sur le bouton de suppression

          });
        }
      };
      xhr.send();
    });
  });

  </script>


<script>

  $(document).ready(function() {

  // Écouteur d'événement pour le bouton de téléchargement PDF
  $('.btnaudi-download-pdf').click(function() {
        var idreg = $(this).data('idreg');
        var idperio = $(this).data('idperio');
        var idparc = $(this).data('idparc');
        var idre = $(this).data('idre');
        var idgue = $(this).data('idgue');
        var idue = $(this).data('idue');
            // Construire l'URL avec les paramètres
            var url = 'auditeurregroupdf?idreg=' + idreg + '&idperio=' + idperio + '&idparc=' + idparc + '&idre=' + idre + '&idgue=' + idgue + '&idue=' + idue;
        
        console.log(url);
        
        // Redirection vers l'URL avec les paramètres
        window.location.href = url;
    });


      // Écouteur d'événement pour le bouton d'impression
      $('.btnaudi-print').click(function() {
      var idreg = $(this).data('idreg');
        var idperio = $(this).data('idperio');
        var idparc = $(this).data('idparc');
        var idre = $(this).data('idre');
        var idgue = $(this).data('idgue');
        var idue = $(this).data('idue');
            // Construire l'URL avec les paramètres
            var url = 'imprimerauditeurregroupdf?idreg=' + idreg + '&idperio=' + idperio + '&idparc=' + idparc + '&idre=' + idre + '&idgue=' + idgue + '&idue=' + idue;
        
        console.log(url);
        
        // Redirection vers l'URL avec les paramètres
        window.location.href = url;
    });

    // Écouteur d'événement pour le bouton de téléchargement PDF
    $('.btn-download-pdf').click(function() {
        var codeorg = $(this).data('codeorg');
        var idperio = $(this).data('idperio');
        var idparc = $(this).data('idparc');
        var idre = $(this).data('idre');
        var idgue = $(this).data('idgue');
        var idue = $(this).data('idue');
            // Construire l'URL avec les paramètres
            var url = 'genererpdf?codeorg=' + codeorg + '&idperio=' + idperio + '&idparc=' + idparc + '&idre=' + idre + '&idgue=' + idgue + '&idue=' + idue;
        
        console.log(url);
        
        // Redirection vers l'URL avec les paramètres
        window.location.href = url;
    });

  

    // Écouteur d'événement pour le bouton d'impression
    $('.btn-print').click(function() {
      var codeorg = $(this).data('codeorg');
        var idperio = $(this).data('idperio');
        var idparc = $(this).data('idparc');
        var idre = $(this).data('idre');
        var idgue = $(this).data('idgue');
        var idue = $(this).data('idue');
            // Construire l'URL avec les paramètres
            var url = 'imprimerpdf?codeorg=' + codeorg + '&idperio=' + idperio + '&idparc=' + idparc + '&idre=' + idre + '&idgue=' + idgue + '&idue=' + idue;
        
        console.log(url);
        
        // Redirection vers l'URL avec les paramètres
        window.location.href = url;
    });

  });

</script>


<script>
  $(document).ready(function() {
    $(document).on('click', '.compte-audi', function() {
      var email = $(this).data('email');
      var iduser = $(this).data('iduser');
      var tel = $(this).data('tel');
      var nom = $(this).data('nom');
   
console.log(email);
console.log(iduser);
console.log(tel);

      $('input[name="email"]').val(email);
      $('input[name="iduser"]').val(iduser);
      $('input[name="tel"]').val(tel);
      $('input[name="nom"]').val(nom);

     
    });
  });
</script>

<script>
  $(document).ready(function() {
    $(document).on('click', '.compte-ens', function() {
         var nomens = $(this).data('nomens');
      var email = $(this).data('emailens');
      var telens = $(this).data('telens');
      var iduser = $(this).data('iduser');
   
console.log(email);

      $('input[name="email"]').val(email);
$('input[name="telens"]').val(telens);
$('input[name="iduser"]').val(iduser);
$('input[name="nomens"]').val(nomens);
     
    });
  });
</script>

<script>
  $(document).ready(function() {
    $(document).on('click', '.details-audi', function() {
      var email = $(this).data('email');
      var nom = $(this).data('nom');
      var prenom = $(this).data('prenom');
      var date = $(this).data('date');
      var tel = $(this).data('tel');
      var provenance = $(this).data('provenance');
      var imageurl = $(this).data('imageurl');

      $('#eexampleModalCenter .modal-body').html(`
        <div>
        <div align="center">
        <img src="${imageurl}"  width="100" height="150" >
        </div>
        <div align="center">
        <table>
  <tr>
    <td style="padding-right: 10px;">
      Nom: ${nom}
    </td>
    <td>
      Prénom: ${prenom}
    </td>
  </tr>
  <tr>
    <td style="padding-right: 10px;">
      Date Naissance: ${date}
    </td>
    <td>
      Email: ${email}
    </td>
  </tr>
  <tr>
    <td style="padding-right: 10px;">
      Téléphone: ${tel}
    </td>
  </tr>
</table>
</div>
        </div>
      `);
    });
  });
</script>

</body>

</html>

