@include('header')

<div class="d-sm-flex align-items-center justify-content-between mb-4 bg-white">
        
          </div>



          
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
                        <th>Année</th>
                        <th>Parcours</th>
                        <th>Regroupement</th>
                        <th>Divisions</th>
                        <th>Enseignants</th>
                        <th>U.E</th>
                        <th>Debut</th>
                        <th>Fin</th>
                        <th>Horaires</th>
                        <th>Classes</th>
                  
                       
                        
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Année</th>
                        <th>Parcours</th>
                        <th>Regroupement</th>
                        <th>Divisions</th>
                        <th>Enseignants</th>
                        <th>U.E</th>
                        <th>Debut</th>
                        <th>Fin</th>
                        <th>Horaires</th>
                        <th>Classes</th>
                
                        
                        <th>Action </th>
                      </tr>
                    </tfoot>
                    <tbody>
                    @foreach($cours as $cour)
                @php
                    $cour = (object) $cour;
                @endphp
                      <tr>
                        <td>{{$cour->nomperio}}</td>
                        <td>{{$cour->nomparc}}</td>
                        <td>{{$cour->nomreg}}</td>
                        <td>{{$cour->nomdiv}}</td>
                        <td>{{$cour->nomens}}</td>
                        <td>{{$cour->nomue}}</td>
                        <td>{{$cour->date_debut}}</td>
                        <td>{{$cour->date_fin}}</td>
                        <td>{{$cour->Heure_Debut}}-{{$cour->Heure_Fin}}</td>
                        <td>{{$cour->nomsal}}</td>
                      
                        <td>
                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                        id="#modalCenter" dataa-toggle="tooltip" data-original-title="Modifier une période académique" ><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-outline-danger delete-btn" data-toggle="modal" data-target="#deleteModal"  dataa-toggle="tooltip" data-original-title=" Supprimer un programme" ><i class="fas fa-trash-alt"></i></a>
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

         


          <!-- Modal Center -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Edition Cours</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                            <!--corps  -->

                            <form method="POST" action="{{route('programmation_Insert')}}">
@csrf
                            <div class="form-group">
                            <select  class="select-single-placeholder form-control" name="organisation" id="selectOrg">
        <option value="" disabled selected>Choisir une organisation</option>
        @foreach($organisations as $organisation)
        <option value="{{ $organisation->codeorg }}">{{ $organisation->nomorg }}</option>
        @endforeach
    </select>
    </div>
                            <div class="form-group">
                    <label for="select2SinglePlaceholder">Année Académque</label>
                    <select  class="select-single-placeholder form-control ml-1" name="perio" id="selectPe">
        <option value="" disabled selected>Choisir une période</option>
    </select>
                  </div>
                  <div class="form-group">
                    <label for="select2SinglePlaceholder">Parcours Académique</label>
                    <select  class="select-single-placeholder form-control ml-1" name="parc" id="selectPa">
        <option value="" disabled selected>Choisir un Parcours</option>
    </select>
                  </div>

                  
    
                  <div class="form-group">
                    <label for="select2SinglePlaceholder">Regroupement</label>
                    <select class="select-single-placeholder form-control ml-1" name="re" id="selectre">
        <option value="" disabled selected>Choisir un regroupement</option>
    </select>
                  </div>

            

                  
                  <div class="form-group">
                    <label for="select2SinglePlaceholder">Division Calendaire</label>
                    <select class="select-single-placeholder form-control" name="div" id="selectSinglePlaceholder">
                      <option disabled selected>choisir l'unité calendaire</option>
                      @foreach($divisioncas as $divisionca)
                      <option value="{{ $divisionca->id }}">	{{ $divisionca->nom }}</option>
                      @endforeach
                    </select>
                  </div>

                  
                  <div class="form-group">
                    <label for="select2SinglePlaceholder">Enseignant</label>
                    <select class="select-single-placeholder form-control" name="ens" id="selectEns">
                      <option disabled selected>choisir l'enseignant</option>
                      @foreach($enseignants as $enseignant)
                      <option value="{{ $enseignant->id }}">{{ $enseignant->nomens }}</option>
                      @endforeach
             
                    </select>
                  </div>
                  
                  
                  <div class="form-group">
                    <label for="select2SinglePlaceholder">Unité d'enseignement</label>
                    <select class="select-single-placeholder form-control" name="ue" id="selectUe">
                      <option disabled selected>choisir l'unité d'enseignement</option>
                     

             
                    </select>
                  </div>

                   
                  <div class="form-group">
                    <label for="select2SinglePlaceholder">Classe</label>
                    <select class="select-single-placeholder form-control" name="salle" id="selectSinglePlaceholder">
                      <option disabled selected>choisir la classe</option>
                      @foreach($salles as $salle)
                      <option value="{{ $salle->id }}">{{ $salle->codeSalle }}</option>
                     
                      @endforeach
                    </select>
                  </div>
       


  
                  <div class="form-group" id="simple-date2">
                    <label for="oneYearView">Date de Debut </label>
                      <div class="input-group date">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control" value="01/06/2020" id="oneYearView" name="datedebut">
                      </div>
                  </div>

                  <div class="form-group" id="simple-date2">
                    <label for="oneYearView">Date de Fin </label>
                      <div class="input-group date">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control" value="01/06/2020" id="oneYearView" name="datefin">
                      </div>
                  </div>
<input type="number" name="idpro" >
                  <div class="form-group">
                    <label for="select2SinglePlaceholder">Horaire Debut</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="10:20 - 12:20" name="heuredebut">
                  </div>
                  <div class="form-group">
                    <label for="select2SinglePlaceholder">Horaire Fin</label>
                    <input type="text" class="form-control" id="inputEmail3" placeholder="10:20 - 12:20" name="heurefin">
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
<style>
  /**
 * ALL the UI design credit goes to:
 * https://www.sketchappsources.com/free-source/2676-calendar-template-sketch-freebie-resource.html
 */


/* WRAPPER */

.wrapper {
  display: grid;
  grid-template-rows: 70px 1fr 70px;
  grid-template-columns: 1fr;
  grid-template-areas: "sidebar"
                       "content";
  width: 100vw; /* unnecessary, but let's keep things consistent */
  height: 100vh;
}

@media screen and (min-width: 850px) {
  .wrapper {
    grid-template-columns: 200px 5fr;
    grid-template-rows: 1fr;
    grid-template-areas: "sidebar content";
  }
}



/* SIDEBAR */

main {
  grid-area: content;
  padding: 48px;
}

sidebar {
  grid-area: sidebar;
  display: grid;
  grid-template-columns: 1fr 3fr 1fr;
  grid-template-rows: 3fr 1fr;
  grid-template-areas: "logo menu avatar"
                       "copyright menu avatar";
}
.logo {
  display: flex;
  align-items: center;
  justify-content: center;
}
.copyright {
  text-align: center;
}
.avatar {
  grid-area: avatar;
  display: flex;
  align-items: center;
  flex-direction: row-reverse;
}
.avatar__name {
  flex: 1;
  text-align: right;
  margin-right: 1em;
}
.avatar__img > img {
  display: block;
}

.copyright {
  grid-area: copyright;
}
.menu {
  grid-area: menu;
  display: flex;
  align-items: center;
  justify-content: space-evenly;
}
.logo {
  grid-area: logo;
}
.menu__text {
  display: none;
}

@media screen and (min-width: 850px) {
  sidebar {
    grid-template-areas: "logo"
                         "avatar"
                         "menu"
                         "copyright";
    grid-template-columns: 1fr;
    grid-template-rows: 50px auto 1fr 50px;
  }
  
  .menu {
    flex-direction: column;
    align-items: normal;
    justify-content: flex-start;
  }
  .menu__text {
    display: inline-block;
  }
  .avatar {
    flex-direction: column;
  }
  .avatar__name {
    margin: 1em 0;
  }
  .avatar__img > img {
    border-radius: 50%;
  }
}




/* MAIN */

.toolbar{
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}
.calendar{}

.calendar__week,
.calendar__header {
  display: grid;
  grid-template-columns: repeat(7, 1fr);  
}
.calendar__week {
  grid-auto-rows: 100px;
  text-align: right;
}

.calendar__header {
  grid-auto-rows: 50px;
  align-items: center;
  text-align: center;
}

.calendar__day {
  padding: 16px;
}




/* COSMETIC STYLING */

:root {
  --red: #ED5454;
}

body {
  font-family: Montserrat;
  font-weight: 100;
  color: #A8B2B9;
}

sidebar {
  background-color: white;
  box-shadow: 5px 0px 20px rgba(0, 0, 0, 0.2);
}

main {
  background-color: #FCFBFC;
}

.avatar__name {
  font-size: 0.8rem;
}

.menu__item {
  text-transform: uppercase;
  font-size: 0.7rem;
  font-weight: 500;
  padding: 16px 16px 16px 14px;
  border-left: 4px solid transparent;
  color: inherit;
  text-decoration: none;
  transition: color ease 0.3s;
}

.menu__item--active .menu__icon {
  color: var(--red);
}
.menu__item--active .menu__text {
  color: black;
}

.menu__item:hover {
  color: black;
}


.menu__icon {
  font-size: 1.3rem;
}

@media screen and (min-width: 850px) {
  .menu__icon {
    font-size: 0.9rem;
    padding-right: 16px;
  }
  .menu__item--active {
    border-left: 4px solid var(--red);
    box-shadow: inset 10px 0px 17px -13px var(--red);
  }
}

.copyright {
  font-size: 0.7rem;
  font-weight: 400;
}

.calendar {
  background-color: white;
  border: 1px solid #e1e1e1;
}

.calendar__header > div {
  text-transform: uppercase;
  font-size: 0.8em;
  font-weight: bold;
}

.calendar__day {
  border-right: 1px solid #e1e1e1;
  border-top: 1px solid #e1e1e1;
}

.calendar__day:last-child {
  border-right: 0;
}

.toggle{
  display: grid;
  grid-template-columns: 1fr 1fr;

  text-align: center;
  font-size: 0.9em;
}
.toggle__option{
  padding: 16px;
  border: 1px solid #e1e1e1;
  border-radius: 8px;
  text-transform: capitalize;
  cursor: pointer;
}
.toggle__option:first-child {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.toggle__option:last-child {
    border-left: 0;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}
.toggle__option--selected{
  border-color: white;
  background-color: white;
  color: var(--red);
  font-weight: 500;
  box-shadow: 1px 2px 30px -5px var(--red);
}
</style>

<div id="calendar-container">
  <?php
  $year = 2024; // Année
  $weekDays = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');

  // Boucle pour les mois
  for ($month = 1; $month <= 12; $month++) {
    // Nombre de jours dans le mois
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    // Jour de la semaine du premier jour du mois (0 pour dimanche, 1 pour lundi, etc.)
    $firstDayOfWeek = date('w', strtotime("$year-$month-1"));

    echo '<div class="calendar__month">';
    echo '<div class="current-month">' . date('F Y', strtotime("$year-$month-1")) . '</div>';
    echo '<div class="calendar__week">';
    
    // Boucle pour les en-têtes des jours de la semaine
    for ($i = 0; $i < 7; $i++) {
      echo '<div class="calendar__day day">' . $weekDays[($i + $firstDayOfWeek) % 7] . '</div>';
    }

    // Boucle pour les jours du mois
    for ($day = 1; $day <= $daysInMonth; $day++) {
      echo '<div class="calendar__day day" onclick="addEvent(' . $day . ',' . $month . ',' . $year . ')">' . $day . '</div>';
    }

    echo '</div>';
    echo '</div>';
  }
  ?>
</div>

<script>
  function addEvent(day, month, year) {
    var eventName = prompt('Ajouter un événement pour le ' + day + '/' + month + '/' + year);

    if (eventName) {
      // Utilisez JavaScript pour gérer les données de l'événement (envoi à un serveur, stockage local, etc.)
      console.log('Événement ajouté pour le ' + day + '/' + month + '/' + year + ' : ' + eventName);
    }
  }
</script>
<div class="wrapper">
  <main>
    <div class="toolbar">
      <div class="toggle">
        <div class="toggle__option">week</div>
        <div class="toggle__option toggle__option--selected">month</div>
      </div>
      <div class="current-month">June 2016</div>
      <div class="search-input">
        <input type="text" value="What are you looking for?">
        <i class="fa fa-search"></i>
      </div>
    </div>
    <div class="calendar">
      <div class="calendar__header">
        <div>mon</div>
        <div>tue</div>
        <div>wed</div>
        <div>thu</div>
        <div>fri</div>
        <div>sat</div>
        <div>sun</div>
      </div>
      <div class="calendar__week">
  <?php
  // Boucle pour générer les divs pour chaque jour
  for ($day = 1; $day <= $daysInMonth; $day++) {
    echo '<div class="calendar__day day">' . $day . '</div>';
  }
  ?>
</div>
    </div>
  </main>
  
</div>




<div id="calendar-container">
  <?php
  $year = 2024; // Année
  $weekDays = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');

  // Boucle pour les mois
  for ($month = 1; $month <= 12; $month++) {
    // Nombre de jours dans le mois
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    // Jour de la semaine du premier jour du mois (0 pour dimanche, 1 pour lundi, etc.)
    $firstDayOfWeek = date('w', strtotime("$year-$month-1"));

    echo '<div class="calendar__month">';
    echo '<div class="current-month">' . date('F Y', strtotime("$year-$month-1")) . '</div>';
    echo '<div class="calendar__week">';
    
    // Boucle pour les en-têtes des jours de la semaine
    for ($i = 0; $i < 7; $i++) {
      echo '<div class="calendar__day day">' . $weekDays[($i + $firstDayOfWeek) % 7] . '</div>';
    }

    // Tableau multidimensionnel pour stocker les événements
    $events = array();

    // Boucle pour les jours du mois
    for ($day = 1; $day <= $daysInMonth; $day++) {
      // Initialiser le tableau d'événements pour le jour actuel
      $events[$day] = array();

      echo '<div class="calendar__day day" onclick="addEvent(' . $day . ',' . $month . ',' . $year . ')" data-day="' . $day . '" data-month="' . $month . '" data-year="' . $year . '">' . $day;

      // Vérifier s'il y a des événements pour le jour actuel
      if (isset($events[$day]) && !empty($events[$day])) {
        echo '<ul class="events-list">';
        // Afficher les événements
        foreach ($events[$day] as $event) {
          echo '<li>' . $event . '</li>';
        }
        echo '</ul>';
      }

      echo '</div>';
    }

    echo '</div>';
    echo '</div>';
  }
  ?>
</div>

<script>
  // Tableau multidimensionnel pour stocker les événements en JavaScript
  var events = {};

  function addEvent(day, month, year) {
    var eventName = prompt('Ajouter un événement pour le ' + day + '/' + month + '/' + year);

    if (eventName) {
      // Ajouter l'événement au tableau des événements
      if (!events.hasOwnProperty(year)) {
        events[year] = {};
      }
      if (!events[year].hasOwnProperty(month)) {
        events[year][month] = {};
      }
      if (!events[year][month].hasOwnProperty(day)) {
        events[year][month][day] = [];
      }
      events[year][month][day].push(eventName);

      // Actualiser l'affichage de la liste d'événements pour le jour correspondant
      var dayElements = document.querySelectorAll('.calendar__day');

      for (var i = 0; i < dayElements.length; i++) {
        var element = dayElements[i];
        var elementDay = parseInt(element.getAttribute('data-day'));
        var elementMonth = parseInt(element.getAttribute('data-month'));
        var elementYear = parseInt(element.getAttribute('data-year'));

        if (elementDay === day && elementMonth === month && elementYear === year) {
          var eventsList = element.querySelector('.events-list');

          if (!eventsList) {
            eventsList = document.createElement('ul');
            eventsList.classList.add('events-list');
            element.appendChild(eventsList);
          }

          var eventItem = document.createElement('li');
          eventItem.textContent = eventName;
          eventsList.appendChild(eventItem);

          break;
        }
      }

      console.log('Événement ajouté pour le ' + day + '/' + month + '/' + year + ' : ' + eventName);
    }
  }
</script>



<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div id="calendar-container">
    <select id="year-select" onchange="changeYear()">
        <?php
        $selectedYear = 2024; // Année sélectionnée par défaut

        for ($year = 2022; $year <= 2030; $year++) {
            $selected = ($year == $selectedYear) ? 'selected' : '';
            echo '<option value="' . $year . '" ' . $selected . '>' . $year . '</option>';
        }
        ?>
    </select>
    <div id="calendar"></div>
</div>

<script>
    var events = {}; // Variable pour stocker les événements

    function changeYear() {
        var yearSelect = document.getElementById('year-select');
        var selectedYear = parseInt(yearSelect.value);
        var calendarContainer = document.getElementById('calendar');

        // Effacer le contenu précédent du conteneur du calendrier
        calendarContainer.innerHTML = '';

        // Générer le calendrier pour l'année sélectionnée
        generateCalendar(calendarContainer, selectedYear, events);
    }

    function handleDayClick(event) {
        var clickedDay = event.target.getAttribute('data-day');
        var clickedMonth = event.target.getAttribute('data-month');
        var clickedYear = event.target.getAttribute('data-year');

        var eventName = prompt('Veuillez saisir le nom de l\'événement :');
        var organizerName = prompt('Veuillez saisir le nom de l\'organisateur :');
        var startTime = prompt('Veuillez saisir l\'heure de début (format HH:MM) :');
        var endTime = prompt('Veuillez saisir l\'heure de fin (format HH:MM) :');

        if (eventName && organizerName && startTime && endTime) {
            var eventDate = clickedYear + '-' + clickedMonth + '-' + clickedDay;

            if (!events[eventDate]) {
                events[eventDate] = [];
            }

            var eventDescription = '<li><strong>' + eventName + '</strong></li><li>Organisateur: ' + organizerName + '</li><li>Heure: ' + startTime + ' - ' + endTime + '</li>';
            events[eventDate].push(eventDescription);

            // Mettre à jour le calendrier pour afficher l'événement ajouté
            var calendarContainer = document.getElementById('calendar');
            generateCalendar(calendarContainer, parseInt(clickedYear), events);
        }
    }

    function generateCalendar(container, year, events) {
        var weekDays = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];

        // Boucle pour les mois
        for (var month = 1; month <= 12; month++) {
            // Nombre de jours dans le mois
            var daysInMonth = new Date(year, month, 0).getDate();

            // Jour de la semaine du premier jour du mois (0 pour dimanche, 1 pour lundi, etc.)
            var firstDayOfWeek = new Date(year, month - 1, 1).getDay();

            var monthElement = document.createElement('div');
            monthElement.classList.add('calendar__month');
            monthElement.innerHTML = '<div class="current-month">' + new Date(year, month - 1, 1).toLocaleString('default', { month: 'long' }) + ' ' + year + '</div><div class="calendar__week"></div>';

            var weekElement = monthElement.querySelector('.calendar__week');

            // Boucle pour les en-têtes des jours de la semaine
            for (var i = 0; i < 7; i++) {
                var dayElement = document.createElement('div');
                dayElement.classList.add('calendar__day', 'day');
                dayElement.textContent = weekDays[(i + firstDayOfWeek) % 7];
                weekElement.appendChild(dayElement);
            }

            // Boucle pour les jours du mois
            for (var day = 1; day <= daysInMonth; day++) {
                var dayElement = document.createElement('div');
                dayElement.classList.add('calendar__day', 'day');
                dayElement.setAttribute('data-day', day);
                dayElement.setAttribute('data-month', month);
                dayElement.setAttribute('data-year', year);
                dayElement.textContent = day;

                var eventDate = year + '-' + month + '-' + day;
                var eventsForDay = events[eventDate]; // Récupérer les événements pour la date

                if (eventsForDay) {
                    dayElement.classList.add('event-day'); // Ajouter la classe CSS "Je m'excuse pour la coupure dans la réponse précédente. Voici la suite du code corrigé :


                    event-day

                    var eventList = document.createElement('ul');
                    eventList.classList.add('event-list');

                    for (var i = 0; i < eventsForDay.length; i++) {
                        var eventItem = document.createElement('li');
                        eventItem.innerHTML = eventsForDay[i];
                        eventList.appendChild(eventItem);
                    }

                    dayElement.appendChild(eventList);
                }

                dayElement.addEventListener('click', handleDayClick); // Ajouter un gestionnaire d'événement pour l'ajout d'événement

                weekElement.appendChild(dayElement);
            }

            container.appendChild(monthElement);
        }
    }

    // Initialisation du calendrier pour l'année sélectionnée
    changeYear();
</script>
@include('footer')