<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>GuidaTV API²</title>
</head>
<body>
  <div class="container mt-4 mb-5">
    <h1>GuidaTV API<sup>2</sup></h1>
    <h6>API non ufficiali per i palinsesti TV delle maggiori emittenti italiane</h6>

    <section class="mt-4">
      <h4>Canali supportati</h4>
      <table class="table">
        <tr>
          <th>Emittente</th>
          <th>Canale</th>
        </tr>
        <tr>
          <td rowspan="5">Rai</td>
          <td>Rai 1</td>
        </tr>
        <tr><td>Rai 2</td></tr>
        <tr><td>Rai 3</td></tr>
        <tr><td>Rai 5</td></tr>
        <tr><td></td></tr>
        <tr>
          <td rowspan="4">Mediaset</td>
          <td>Rete 4</td>
        </tr>
        <tr><td>Canale 5</td></tr>
        <tr><td>Italia 1</td></tr>
        <tr><td></td></tr>
        <tr>
          <td rowspan="2">Sky</td>
          <td>Cielo</td>
        </tr>
        <tr><td></td></tr>
      </table>
      <p>E tanti altri 😃</p>
    </section>

    <section class="mt-5">
      <h4>Come Iniziare</h4>

      <article class="mt-3">
        <h5>Richieste</h5>
        <p>Le richieste sono da effettuare con il metodo <b>GET</b>, in ogni richiesta è obbligatorio il parametro <b>api_key</b></p>

        <h5>Risposte</h5>
        <p>Le risposte saranno nel formato JSON e avranno tutte i campi:</p>
        <ul class="browser-default">
          <li>data [array / json / null]</li>
          <li>status [boolean]</li>
          <li>message [string]</li>
          <small>Presente solo in caso di errore (status=false)</small>
        </ul>
      </article>

      <article class="mt-3">
        <h5>Ottenere un API Key</h5>
        <ol>
          <li>Premi <a href="#get">qui</a></li>
          <li>Completare il <i>form</i> presente</li>
        </ol>
      </article>

      <hr>

      <article class="mt-4">
        <h5><b>getChannelsList</b> Lista dei canali supportati</h5>
        <p class="mb-1">URL d'esempio <a href="/getChannelsList?api_key=API_KEY" target="_blank">/getChannelsList?api_key=API_KEY</a></p>
        <table class="table">
          <tr>
            <th colspan="2">Campi</th>
          </tr>
          <tr>
            <td>api_key</td>
            <td>Obbligatorio</td>
          </tr>
        </table>

        <h6 id="sample-getChannelsList"><b>Esempio di risposta</b></h6>
        <textarea class="form-control" rows="15" readonly>
        {
          "data": [
            {
              "id": "rai-1",
              "name": "Rai 1"
              "channel": 1,
              "station": {
                "id": 1,
                "name": "Rai"
              }
            },
            {
              "id": "italia-1",
              "name": "Italia 1"
              "channel": 6,
              "station": {
                "id": 2,
                "name": "Mediaset"
              }
            },
            ...
          ],
          "status": true
        }
        </textarea>
      </article>

      <article class="mt-4">
        <h5><b>getSchedule</b> Palinsesto di un canale</h5>
        <p class="mb-1">URL d'esempio <a href="/getSchedule?api_key=API_KEY&channelId=CANALE&date=DATE" target="_blank">/getSchedule?api_key=API_KEY&channelId=CANALE&date=DATE</a></p>
        <table class="table">
          <tr>
            <th colspan="2">Campi</th>
          </tr>
          <tr>
            <td>api_key</td>
            <td>Obbligatorio</td>
          </tr>
          <tr>
            <td>channelId</td>
            <td>Obbligatorio</td>
          </tr>
          <tr>
            <td>date</td>
            <td>Opzionale <span class="ms-3">(formato <i>dd-mm-YYYY</i>)</span></td>
          </tr>
        </table>

        <h6 id="sample-getSchedule"><b>Esempio di risposta</b></h6>
        <textarea class="form-control" rows="20" readonly>
        {
          "data": {
            "name": "Rai 1",
            "date": "<?php echo date('d-m-Y'); ?>",
            "events": [
              {
                "name": "Titolo",
                "description": "Descrizione",
                "genres": [
                  "...",
                  "...",
                ],
                "hour": "hh:mm",
                "duration": "hh:mm:ss",
                "duration_in_minutes": 0,
                "image": "https://..."
              },
          },
          "status": true
        }
        </textarea>
      </article>
    </section>

    <section id="get" class="mt-5">
      <h4>Ottieni un API KEY</h4>

      <form id="form" class="px-4">
        <div class="row">
          <div class="col-sm-4">
            <label for="name">Nome*</label>
            <input id="name" type="text" class="form-control" required>
          </div>
          <div class="col-sm-4">
            <label for="email">Email*</label>
            <input id="email" type="email" class="form-control" required>
          </div>
          <div class="col-sm-4">
            <label for="project_name">Nome Progetto*</label>
            <input id="project_name" type="text" class="form-control" required>
          </div>
        </div>
        <div class="row mt-1">
          <div class="col-sm-12">
            <label for="project_description">Cosa vuoi realizzare?</label>
            <textarea id="project_description" class="form-control"></textarea>
          </div>
        </div>
        <div class="text-center mt-3">
          <button class="btn btn-primary" type="submit">Ottieni</button>
        </div>
      </form>

      <h3 id="key" class="my-5 text-center" style="display: none;"></h3>
    </section>

    <hr class="my-5">

    <section id="update">
      <h3>Aggiornamento da GuidaTV-API v1</h3>
      <!-- <p>È stato tenuto un format delle risposte molto simile alla versione precedente per permettere una veloce modifica.</p> -->

      <article class="mt-4">
        <h5>Risposte</h5>
        <ul class="mb-1">
          <li>Il campo "<i>msg</i>" è stato rinominato "<i>message</i>"</li>
        </ul>
        <span class="d-block"><b>Esempio</b></span>
        <textarea class="form-control" rows="5" readonly>
        {
          "data": null,
          "status": false,
          "message": "api_key is missing."
        }
        </textarea>
      </article>

      <article class="mt-4">
        <h5><b>getChannelsList</b> Lista dei canali supportati</h5>
        <ul class="mb-1">
          <li>Il campo "<i>station</i>" di ogni canale è ora un JSON con "<i>id</i>" e "<i>name</i>" dell'emittente TV</li>
        </ul>
        <a href="#sample-getChannelsList" class="d-block"><b>Esempio</b></a>
      </article>

      <article class="mt-4">
        <h5><b>getSchedule</b> Palinsesto di un canale</h5>
        <ul class="mb-1">
          <li>È stato aggiunto il campo "<i>genre<b>s</b></i>" (array) con i generi del programma TV</li>
          <li>Il campo "<i>channel</i>" con il nome del canale è stato rinominato in "<i>name</i>"</li>
          <li>Il campo "<i>genre</i>" è stato <b>rimosso</b></li>
          <li>I campi "<i>is_show</i>", "<i>episode</i>", "<i>episode_title</i>" e "<i>season</i>" sono stati <b>rimossi</b></li>
        </ul>
        <a href="#sample-getSchedule" class="d-block"><b>Esempio</b></a>
      </article>
    </section>

  </div>

  <script type="text/javascript">
    if (localStorage && localStorage.getItem('api_key')) {
      document.querySelector('#form').style.display = 'none';
      document.querySelector('#key').style.display = 'block';
      document.querySelector('#key').innerHTML = localStorage.getItem('api_key');
    }

    const form = document.querySelector('#form');
    form.addEventListener('submit', e => {
      e.preventDefault(); e.stopPropagation();

      const data = {
        name: document.querySelector('#name').value,
        email: document.querySelector('#email').value,
        project_name: document.querySelector('#project_name').value,
        project_description: document.querySelector('#project_description').value,
      };

      request({
        url: '/getApiKey.php',
        data: data,
        success: function(data) {
          if (data.status === true) {
            document.querySelector('#form').style.display = 'none';
            document.querySelector('#key').style.display = 'block';
            document.querySelector('#key').innerHTML = data.api_key;
            localStorage.setItem('api_key', data.api_key);
          } else {
            alert(data.message);
          }
        },
        error: function(response, status) {
          alert('Errore '+status+' nella richiesta');
        }
      });
    });

    function request(options) {
      const xhttp = new XMLHttpRequest();
      xhttp.open('POST', options.url, true);
      xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
          options.success(JSON.parse(this.responseText));
        } else if (this.readyState === 4) {
          options.error(this.responseText, this.status);
        }
      };
      xhttp.send(new URLSearchParams(options.data).toString());
    }
  </script>
</body>
</html>
