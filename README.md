# PHP_Laravel12_Flash

##  Project Introduction

PHP_Laravel12_Flash is a Laravel 12 demonstration project that showcases how to implement elegant flash notifications using the Spatie Laravel Flash package. Flash messages are temporary notifications stored in the session that automatically disappear after being displayed once.

This project demonstrates:

- Flashing success, error, warning, and informational messages.

- Using session-based flash messages without a database.

- Implementing flash messages in controllers.

- Displaying flash messages dynamically in Blade templates.

- Styling flash messages with modern 2026 design UI using Bootstrap 5 and custom CSS.

- Organizing a Laravel 12 project with a clean folder structure.

---

## Project Overview

PHP_Laravel12_Flash is a Laravel 12 project demonstrating elegant flash notifications using the Spatie Laravel Flash package. It showcases how to display success, error, warning, and info messages via session-based flash messages that disappear after being viewed.

The project includes:

- Controller-based flash message handling (FlashController).

- Clean routing for each flash type (/success, /error, /warning, /info).

- Dynamic display of flash messages in a modern, responsive Blade view with Bootstrap 5 and custom 2026-style UI.

- Lightweight setup with no database required.

- Well-structured Laravel 12 project for easy integration and maintenance.

---

##  Step 1: Create Laravel 12 Project

Run the following command:

```bash
composer create-project laravel/laravel PHP_Laravel12_Flash "12.*"
```

Now go inside the project:

```bash
cd PHP_Laravel12_Flash
```

Check Laravel version:

```bash
php artisan --version
```

---

##  Step 2: Install Spatie Laravel Flash

Install the package:

```bash
composer require spatie/laravel-flash
```

Laravel 12 supports auto-discovery, so no need to manually register provider.

---

## Step 3: Create Controller

Create controller:

```bash
php artisan make:controller FlashController
```

Now update:

app/Http/Controllers/FlashController.php

```php
<?php

namespace App\Http\Controllers;

class FlashController extends Controller
{
    public function index()
    {
        return view('flash-demo');
    }

    public function success()
    {
        flash('Success message! Data saved successfully.', 'alert alert-success');
        return redirect()->back();
    }

    public function error()
    {
        flash('Error message! Something went wrong.', 'alert alert-danger');
        return redirect()->back();
    }

    public function warning()
    {
        flash('Warning message! Please check your input.', 'alert alert-warning');
        return redirect()->back();
    }

    public function info()
    {
        flash('Info message! This is an informational alert.', 'alert alert-info');
        return redirect()->back();
    }
}
```

---

## Step 4: Define Routes

routes/web.php

Add:

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlashController;

Route::get('/', [FlashController::class, 'index']);

Route::get('/success', [FlashController::class, 'success']);
Route::get('/error', [FlashController::class, 'error']);
Route::get('/warning', [FlashController::class, 'warning']);
Route::get('/info', [FlashController::class, 'info']);
```
---

## Step 5: Create Blade View

resources/views/flash-demo.blade.php

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 12 Flash Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            font-family: 'Inter', sans-serif;
        }

        .container {
            max-width: 700px;
            margin-top: 100px;
        }

        .card {
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            padding: 40px;
            background: #fff;
        }

        h2 {
            font-weight: 700;
            color: #333;
            text-align: center;
        }

        .flash-message {
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 25px;
            font-weight: 500;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .flash-message button.btn-close {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }

        .btn-group-custom {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }

        .btn-group-custom a {
            flex: 1 1 calc(50% - 10px);
            text-align: center;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-group-custom a:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2 class="mb-4">Flash Messages Demo</h2>

        {{-- Flash Messages --}}
        @if(flash()->message)
            <div class="flash-message {{ flash()->class }} alert-dismissible fade show position-relative">
                {{ flash()->message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="btn-group-custom">
            <a href="{{ url('/success') }}" class="btn btn-success">Success</a>
            <a href="{{ url('/error') }}" class="btn btn-danger">Error</a>
            <a href="{{ url('/warning') }}" class="btn btn-warning">Warning</a>
            <a href="{{ url('/info') }}" class="btn btn-info">Info</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
```

---

## Step 6: Run Project

Start server:

```bash
php artisan serve
```

Visit:

```
http://127.0.0.1:8000
```

Click buttons to see flash messages.

---

## Output    

### Success Message

<img width="1919" height="1031" alt="Screenshot 2026-02-27 174638" src="https://github.com/user-attachments/assets/8c30a1d1-fdb5-411e-a3ab-bedee45453c7" />

### Error Message

<img width="1919" height="1028" alt="Screenshot 2026-02-27 174648" src="https://github.com/user-attachments/assets/a5eb14dd-981d-4477-b481-9561c6d50e10" />

### Warning Message

<img width="1917" height="1027" alt="Screenshot 2026-02-27 174658" src="https://github.com/user-attachments/assets/8f147453-fcf3-40fa-a060-f244d417ab53" />

### Info Message

<img width="1919" height="1027" alt="Screenshot 2026-02-27 174707" src="https://github.com/user-attachments/assets/e381ec74-88b0-453d-b7ff-2b1314308acb" />

---

##  Project Structure

After setup, your important folders:

```
PHP_Laravel12_Flash
│
├── app/
│   └── Http/
│       └── Controllers/
│           └── FlashController.php
│
├── resources/
│   └── views/
│       ├── flash-demo.blade.php
│       
│
├── routes/
    └── web.php
```

---

Your PHP_Laravel12_Flash Project is now ready!

