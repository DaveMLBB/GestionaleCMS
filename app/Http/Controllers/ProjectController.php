<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller {
    /**
     * Si occupa della creazione di un nuovo progetto laravel
     */
    public function createNewProject(Request $request) { 
//rimmuovere la cartella aggiuntiva
        $projectName = $request->get('name', 'NuovoProgetto');
        $projectPath = storage_path('app/' . $projectName);

        try {
            if (!file_exists($projectPath)) {
                mkdir($projectPath, 0777, true); 
            }

            $command = "cd " . $projectPath . " && laravel new " . $projectName;
            $output = shell_exec($command);

            return response()->json(['message' => 'Progetto creato con successo', 'output' => $output]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Errore nella creazione del progetto', 'error' => $e->getMessage()], 500);
        }
    }
}
