<main class="container-fluid p-4 p-md-5">
    <h4 class="fw-bold text-dark mb-4">Profil Saya</h4>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>
    <?php if (validation_errors()): ?>
        <div class="alert alert-danger"><?= validation_errors() ?></div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm" style="max-width: 560px;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center fw-semibold"
                     style="width:56px; height:56px; font-size: 1.4rem;">
                    <?= strtoupper(substr($akun->nama_lengkap, 0, 1)) ?>
                </div>
                <div>
                    <p class="fw-semibold mb-0"><?= htmlspecialchars($akun->nama_lengkap) ?></p>
                    <span class="badge bg-light text-secondary border text-uppercase"><?= htmlspecialchars($akun->role) ?></span>
                </div>
            </div>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label small text-muted">Username</label>
                    <input type="text" value="<?= htmlspecialchars($akun->username) ?>" class="form-control bg-light" readonly>
                    <div class="form-text">Username tidak dapat diubah.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($akun->nama_lengkap) ?>" required class="form-control">
                </div>

                <hr>

                <p class="small text-muted mb-2">Ubah Password (opsional)</p>

                <div class="mb-3">
                    <label class="form-label small text-muted">Password Baru</label>
                    <input type="password" name="password" minlength="6" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                </div>
                <div class="mb-4">
                    <label class="form-label small text-muted">Konfirmasi Password Baru</label>
                    <input type="password" name="konfirmasi_password" minlength="6" class="form-control" placeholder="Ulangi password baru">
                </div>

                <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</main>