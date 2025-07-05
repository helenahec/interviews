<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f4f6f8;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    tbody tr:hover {
    background-color: #f8f9fa;
    }
    
    .main-card {
        background-color: #ffffff;
        border-radius: 8px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }

    .navbar-brand {
        font-weight: 500;
        font-size: 1.2rem;
        color: #ffffff;
    }

    .btn-primary {
        background-color: #0069d9;
        border: none;
    }

    .btn-outline-secondary {
        border-color: #ced4da;
        color: #495057;
    }

    .btn-outline-secondary:hover {
        background-color: #e9ecef;
        border-color: #ced4da;
    }

    .table th {
        background-color: #f1f3f5;
        font-weight: 500;
        color: #343a40;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .btn-edit {
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        color: #212529;
    }

    .btn-delete {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        color: #dc3545; 
    }

    .btn-edit:hover, .btn-delete:hover {
        background-color: #dee2e6;
    }
</style>

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('job-applications.index') }}">Job Tracker</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="main-card mx-auto" style="max-width: 1000px;">
            
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Page Content --}}
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
