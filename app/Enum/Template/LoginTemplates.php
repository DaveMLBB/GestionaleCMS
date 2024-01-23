<?php

namespace App\Enum\Template;

enum LoginTemplates: string {
    case BASIC = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href="{{ asset(\'css/login.css\') }}" rel="stylesheet">
    </head>
    <body>
        <div class="login-container">
            <form action="/login" method="post">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="login-button">Login</button>
            </form>
        </div>
    </body>
    </html>
    ';


    case ADVANCED = "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Login Advanced</title>
            <!-- Stili -->
        </head>
        <body>
            <h1>Login Advanced</h1>
            <!-- Contenuto del login avanzato -->
        </body>
        </html>
    ";

}
