<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="fw-bold mb-1">Detail Buku</h3>
                <p class="text-muted small mb-0">Informasi lengkap dan riwayat peminjaman buku ini.</p>
            </div>
            <div>
                <a href="<?php echo e(route('buku.edit', $buku->id)); ?>" class="btn btn-primary btn-sm me-1">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
                <a href="<?php echo e(route('buku.index')); ?>" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body p-4">
                <div class="row g-4 align-items-center">
                    
                    <div class="col-md-3 text-center">
                        <?php if($buku->cover): ?>
                            <img src="<?php echo e(asset('storage/' . $buku->cover)); ?>" alt="<?php echo e($buku->judul); ?>" class="img-fluid rounded shadow-sm" style="max-height: 240px; object-fit: cover;">
                        <?php else: ?>
                            <div class="bg-light text-muted rounded d-flex align-items-center justify-content-center" style="height: 200px; border: 2px dashed #cbd5e1;">
                                <div class="text-center">
                                    <i class="bi bi-image fs-1 d-block mb-1 text-secondary"></i>
                                    <span class="small">Belum Ada Sampul</span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    
                    <div class="col-md-6">
                        <h4 class="fw-bold text-dark mb-3"><?php echo e($buku->judul); ?></h4>
                        <div class="row text-secondary g-2">
                            <div class="col-sm-4 fw-semibold text-muted">Penulis</div>
                            <div class="col-sm-8 text-dark"><?php echo e($buku->penulis); ?></div>

                            <div class="col-sm-4 fw-semibold text-muted">Penerbit</div>
                            <div class="col-sm-8 text-dark"><?php echo e($buku->penerbit); ?></div>

                            <div class="col-sm-4 fw-semibold text-muted">Tahun Terbit</div>
                            <div class="col-sm-8 text-dark"><?php echo e($buku->tahun_terbit); ?></div>
                        </div>
                    </div>

                    
                    <div class="col-md-3 text-center border-start">
                        <span class="text-muted small mb-1 d-block">Status Ketersediaan Stok</span>
                        <h2 class="fw-bold mb-1 text-dark">
                            <?php echo e($buku->stok); ?> <span class="fs-6 text-muted">eksemplar</span>
                        </h2>
                        <?php if($buku->stok > 0): ?>
                            <span class="badge bg-success px-3 py-2 mt-2">
                                <i class="bi bi-check-circle me-1"></i> Tersedia untuk dipinjam
                            </span>
                        <?php else: ?>
                            <span class="badge bg-danger px-3 py-2 mt-2">
                                <i class="bi bi-x-circle me-1"></i> Stok Habis
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Peminjaman Buku Ini -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0">Riwayat Peminjaman Buku Ini</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3" style="width: 50px;">No</th>
                                <th>Nama Anggota</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $buku->peminjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pinjam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="ps-3 text-muted"><?php echo e($index + 1); ?></td>
                                    <td class="fw-semibold"><?php echo e($pinjam->anggota->nama ?? '-'); ?></td>
                                    <td><?php echo e($pinjam->tanggal_pinjam); ?></td>
                                    <td><?php echo e($pinjam->tanggal_kembali ?? '-'); ?></td>
                                    <td>
                                        <?php if($pinjam->status === 'Dipinjam'): ?>
                                            <span class="badge bg-warning text-dark">Dipinjam</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Dikembalikan</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        Buku ini belum pernah dipinjam.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PAW_MODUL4_FIKA_102042500145\resources\views/buku/show.blade.php ENDPATH**/ ?>