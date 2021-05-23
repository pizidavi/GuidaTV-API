# GuidaTV-API

API non ufficiali per i palinsesti TV delle maggiori emittenti italiane.

### Emittenti supportate

- Rai
- Mediaset
- Sky

## Get started

### Requests

Le richieste sono da effettuare con il metodo **GET**, in ogni richiesta è obbligatorio il parametro **api_key**  

### Responses

Le risposte sono nel formato JSON con i campi:  

-   data `[array/json/null]`  
-   status `[boolean]`  
-   message `[string]`  
	Presente solo in caso di errore *(status=false)*  

## Method
### getChannelsList | Lista dei canali supportati

Esempio URL [/getChannelsList?api_key=API_KEY](https://guidatv-api.herokuapp.com/getChannelsList?api_key=API_KEY)  

| Campo | Obbligatorio |
| --- | --- |
| api_key | **yes** |

Esempio risposta  
``` json
{
  "data": [
    {
      "id": "rai-1",
      "name": "Rai 1",
      "channel": 1,
      "station": {
        "id": 1,
        "name": "Rai"
      }
    },
  ],
  "status": true
}
```

### getSchedule| Palinsesto di un canale

Esempio URL [/getSchedule?api_key=API_KEY&channelId=CANALE&date=DATE](https://guidatv-api.herokuapp.com/getSchedule?api_key=API_KEY&channelId=CANALE&date=DATE)  

| Campo | Obbligatorio | Formato |
| --- | --- | --- | 
| api_key | **yes** |  |
| channelId | **yes** |  |
| date | no | *dd-mm-YYY* |

Esempio risposta  
``` json
{
  "data": {
    "name": "Rai 1",
    "date": "23-05-2021",
    "events": [
      {
        "name": "Titolo",
        "description": "Descrizione",
        "genres": [
          "...",
        ],
        "hour": "hh:mm",
        "duration": "hh:mm:ss",
        "duration_in_minutes": 0,
        "image": "https://..."
      },
    ]
  },
  "status": true
}
```
