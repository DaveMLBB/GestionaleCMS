<?php

namespace App\Http\Controllers;

use App\Enum\Css\LoginCss;
use App\Enum\Route\LoginRoutes;
use App\Enum\Template\LoginTemplates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ProjectController extends Controller {
    public function createNewProject(Request $request) {
        ini_set('max_execution_time', 300);
        $projectName = $request->get('name', 'NuovoProgetto');
        $projectPath = storage_path('app/' . $projectName);
        $authType = $request->get('authType', 'basic'); 

        try {
            if (!file_exists($projectPath)) {
                mkdir($projectPath, 0777, true); 
            }

            $command = "cd " . $projectPath . " && laravel new " . $projectName;
            $output = shell_exec($command);
            Log::info('PRIMA ERRORE');

            // Assicurati che la cartella del progetto sia stata effettivamente creata
            if (file_exists($projectPath . '/' . $projectName)) {
                $this->createLoginPage($projectPath, $projectName, $authType);
             } else {
                throw new \Exception("La cartella del progetto non è stata creata.");
            }

            Log::info('DOPO ERRORE');

            return response()->json(['message' => 'Progetto creato con successo', 'output' => $output]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Errore nella creazione del progetto', 'error' => $e->getMessage()], 500);
        }
    }

    private function createLoginPage($projectPath, $projectName, $authType) {
        try {
            // Comandi per configurare Laravel Breeze
            $command = "cd " . $projectPath . '/' . $projectName .
                       " && composer require laravel/breeze --dev" .
                       " && php artisan breeze:install" .
                       " && npm install" .
                       " && php artisan migrate";
    
            // Esegui i comandi per configurare Laravel Breeze
            $output = shell_exec($command . " 2>&1");
    
            // Verifica se la cartella 'auth' esiste
            $authFolderPath = $projectPath . '/' . $projectName . '/resources/views/auth';
            if (!file_exists($authFolderPath)) {
                mkdir($authFolderPath, 0777, true);
            }
    
            // Percorso al file di login nel progetto Laravel
            $loginPagePath = $authFolderPath . '/login.blade.php';
            
            // Scegli il template in base al tipo di autenticazione
            $loginPageContent = '';
            if ($authType === 'basic') {
                $loginPageContent = LoginTemplates::BASIC->value;
            } elseif ($authType === 'advanced') {
                $loginPageContent = LoginTemplates::ADVANCED->value;
            } else {
                throw new \Exception("Tipo di autenticazione non valido.");
            }
    
            // Scrivi il contenuto nella pagina di login
            file_put_contents($loginPagePath, $loginPageContent);

            // Aggiorna il file delle rotte per reindirizzare alla login
            $routesPath = $projectPath . '/' . $projectName . '/routes/web.php';
            $routeContent = LoginRoutes::LOGIN_ROUTE->value;
            file_put_contents($routesPath, $routeContent);

            // Aggiunge uno stile css alla pagina di login
            $cssPath = $projectPath . '/' . $projectName . '/resources/css/login.css';
            $cssContent = LoginCss::LOGIN_CSS->value;
            file_put_contents($cssPath, $cssContent);

            return 'Pagina di login e rotte aggiornate con successo.';
        } catch (\Exception $e) {
            return 'Errore nella configurazione di Laravel Breeze o nella creazione della pagina di login: ' . $e->getMessage();
        }
    }
}
