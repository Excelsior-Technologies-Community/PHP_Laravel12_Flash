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