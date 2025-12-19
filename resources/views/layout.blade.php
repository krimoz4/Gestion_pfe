<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PFE Manager - EMSI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; letter-spacing: 0.5px; }
        .nav-link { font-weight: 500; }
        .nav-link.active { color: #fff !important; font-weight: 700; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-graduation-cap me-2"></i>PFE Manager
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @auth
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('etudiants*') ? 'active' : '' }}" href="{{ route('etudiants.index') }}">
                                    <i class="fas fa-user-graduate me-1"></i> Étudiants
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('professeurs*') ? 'active' : '' }}" href="{{ route('professeurs.index') }}">
                                    <i class="fas fa-chalkboard-teacher me-1"></i> Profs
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('stages*') ? 'active' : '' }}" href="{{ route('stages.index') }}">
                                    <i class="fas fa-folder-open me-1"></i> Stages
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('soutenances*') ? 'active' : '' }}" href="{{ route('soutenances.index') }}">
                                    <i class="fas fa-calendar-alt me-1"></i> Soutenances
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>

                @auth
                <div class="d-flex align-items-center text-white">
                    <div class="dropdown">
                        <a class="text-white text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle fa-lg me-1"></i> 
                            {{ Auth::user()->name }} 
                            <span class="badge bg-light text-primary ms-1" style="font-size: 0.7rem;">
                                {{ ucfirst(Auth::user()->role) }}
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog me-2"></i> Mon Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger fw-bold">
                                        <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>