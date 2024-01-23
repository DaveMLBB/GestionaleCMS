<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Project - GestionaleCMS</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 100px;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,.1);
        }
        h1 {
            font-size: 2.2rem;
            color: #333;
            margin-bottom: 20px;
        }
        p {
            color: #666;
        }
        #startProject {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
        }
        #startProject:hover {
            background-color: #0056b3;
        }
        #loadingIndicator {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h1>Benvenuto in GestionaleCMS</h1>
        <p>Inizia a creare il tuo progetto gestionale personalizzato.</p>
        <input type="text" id="projectName" placeholder="Nome del Progetto">
        <!-- Menu a tendina per scegliere il tipo di autenticazione -->
        <select id="authType">
            <option value="basic">Basic Authentication</option>
            <option value="advanced">Advanced Authentication</option>
        </select>

        <button id="startProject">Start Project</button>

        <div id="loadingIndicator">
            <p>Creazione del progetto in corso...</p>
            <div class="spinner-border" role="status">
                <span class="sr-only">Caricamento...</span>
            </div>
        </div>
    </div>

   <script>
        $(document).ready(function() {
            $('#startProject').click(function() {
                $('#loadingIndicator').show();
                var projectName = $('#projectName').val();
                var authType = $('#authType').val(); 

                $.get('/project-creator/create', { name: projectName, authType: authType }, function(data) {
                    $('#loadingIndicator').hide();
                    alert(data.message);
                }).fail(function(response) {
                    $('#loadingIndicator').hide();
                    alert('Errore: ' + response.responseText);
                });
            });
        });
    </script>
</body>
</html>
