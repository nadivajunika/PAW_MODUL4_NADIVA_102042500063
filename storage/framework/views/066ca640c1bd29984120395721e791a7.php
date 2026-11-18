<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($buku->judul); ?> - TelkomLibrary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar-brand { font-weight: 700; }
        .main-content { flex: 1; }
        .cover-img {
            max-height: 380px;
            width: 100%;
            object-fit: cover;
            border-radius: 0.5rem;
        }
        .cover-placeholder {
            height: 320px;
            background-color: #e9ecef;
            color: #adb5bd;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>

    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?php echo e(route('home')); ?>">
                <i class="bi bi-book me-1"></i> TelkomLibrary
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="<?php echo e(route('home')); ?>">Katalog Buku</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto align-items-center">
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item me-3 text-white small">
                            <i class="bi bi-person-circle me-1"></i> <?php echo e(Auth::user()->name); ?>

                            <span class="badge bg-warning text-dark ms-1"><?php echo e(ucfirst(Auth::user()->role)); ?></span>
                        </li>
                        <?php if(Auth::user()->role === 'admin'): ?>
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-light btn-sm" href="<?php echo e(route('dashboard')); ?>">
                                    <i class="bi bi-speedometer2 me-1"></i> Dashboard Admin
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-outline-light btn-sm" onclick="return confirm('Apakah Anda yakin ingin logout?')">
                                    Logout
                                </button>
                            </form>
                        </li>
                    <?php else: ?>
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-light btn-sm" href="<?php echo e(route('login')); ?>">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light btn-sm fw-semibold text-primary" href="<?php echo e(route('register')); ?>">
                                <i class="bi bi-person-plus me-1"></i> Daftar
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    
    <main class="main-content container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <a href="<?php echo e(route('home')); ?>" class="btn btn-outline-secondary btn-sm mb-4">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Katalog
                </a>

                <div class="card shadow-sm border-0 overflow-hidden">
                    <div class="row g-0">
                        
                        <div class="col-md-4 p-4 text-center bg-light d-flex align-items-center justify-content-center">
                            <?php if($buku->cover): ?>
                                <img src="<?php echo e(asset('storage/' . $buku->cover)); ?>" alt="<?php echo e($buku->judul); ?>" class="cover-img shadow-sm">
                            <?php else: ?>
                                <div class="cover-placeholder w-100 shadow-sm">
                                    <div class="text-center">
                                        <i class="bi bi-book fs-1 d-block mb-2"></i>
                                        <span>Tidak Ada Sampul</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        
                        <div class="col-md-8 p-4">
                            <h2 class="fw-bold text-dark mb-2"><?php echo e($buku->judul); ?></h2>
                            <p class="text-muted mb-4 fs-5"><?php echo e($buku->penulis); ?></p>

                            <hr>

                            <div class="row g-3 my-2">
                                <div class="col-sm-4 text-muted fw-semibold">Penerbit</div>
                                <div class="col-sm-8 text-dark"><?php echo e($buku->penerbit); ?></div>

                                <div class="col-sm-4 text-muted fw-semibold">Tahun Terbit</div>
                                <div class="col-sm-8 text-dark"><?php echo e($buku->tahun_terbit); ?></div>

                                <div class="col-sm-4 text-muted fw-semibold">Status Ketersediaan</div>
                                <div class="col-sm-8">
                                    <?php if($buku->stok > 0): ?>
                                        <span class="badge bg-success px-3 py-2 fs-6">
                                            <i class="bi bi-check-circle me-1"></i> Tersedia (<?php echo e($buku->stok); ?> eksemplar)
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger px-3 py-2 fs-6">
                                            <i class="bi bi-x-circle me-1"></i> Stok Sedang Kosong
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <hr>

                            <div class="mt-4">
                                <?php if(auth()->guard()->guest()): ?>
                                    <div class="alert alert-info d-flex align-items-center mb-0" role="alert">
                                        <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                                        <div>
                                            Ingin meminjam buku ini? Silakan <a href="<?php echo e(route('login')); ?>" class="alert-link fw-bold">Login</a> terlebih dahulu atau temui petugas perpustakaan.
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-geo-alt me-1"></i> Silakan hubungi petugas perpustakaan di meja sirkulasi untuk meminjam buku fisik ini.
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white py-3 border-top text-center text-muted small mt-auto">
        <div class="container">
            <span>&copy; <?php echo e(date('Y')); ?> TelkomLibrary - Sistem Informasi Perpustakaan Kampus</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php /**PATH C:\laragon\www\PAW_MODUL4_NADIVA_102042500063\resources\views/home_show.blade.php ENDPATH**/ ?>