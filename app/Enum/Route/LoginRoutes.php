<?php

namespace App\Enum\Route;

enum LoginRoutes: string {
     case LOGIN_ROUTE = "
            <?php

            use Illuminate\Support\Facades\Route;

            Route::get('/', function () {
                return view('auth.login');
            });

            // Altre rotte...
            ";

}
