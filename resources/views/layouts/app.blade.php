<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Inventory System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Inventory System</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto">

                    @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('procurements.index') }}">Procurement</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('dryings.index') }}">Drying</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('dryings.pending') }}">Pending Receipts</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('drying-facilities.index') }}">Facilities</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('farmers.index') }}">Farmers</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('warehouses.index') }}">Warehouses</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('inventories.index') }}">Inventory</a>
                    </li>
                    @endauth

                </ul>

                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item">
                        <span class="navbar-text text-white me-3">
                            {{ Auth::user()->name }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-light" type="submit">Logout</button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>