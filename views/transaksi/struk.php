<?php
$label_metode = array(
    'tunai'    => 'Tunai',
    'transfer' => 'Transfer Bank',
    'qris'     => 'QRIS',
    'kartu'    => 'Kartu Debit/Kredit',
);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk - <?= htmlspecialchars($transaksi->no_nota) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .struk-box { max-width: 420px; margin: 40px auto; }
        @media print {
            body { background: #fff; }
            .no-print { display: none !important; }
            .struk-box { margin: 0; max-width: 100%; }
        }
    </style>
</head>
<body>

    <div class="struk-box">
        <div class="text-end no-print mb-3">
            <button onclick="window.print()" class="btn btn-success btn-sm">
                <i class="bi bi-printer me-1"></i> Cetak Struk
            </button>
            <a href="<?= site_url('transaksi/history') ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="text-center mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 mb-2"
                         style="background-color:#16a34a; width:48px; height:48px;">
                        <i class="bi bi-plus-lg text-white fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-0">Apotek Sehat</h5>
                    <p class="text-muted small mb-0">Struk Pembelian</p>
                </div>

                <hr>

                <div class="small mb-3">
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">No. Nota</span>
                        <span class="fw-medium"><?= htmlspecialchars($transaksi->no_nota) ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Tanggal</span>
                        <span class="fw-medium"><?= date('d/m/Y H:i', strtotime($transaksi->created_at)) ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Kasir</span>
                        <span class="fw-medium">
                            <?= $transaksi->is_self_checkout ? 'Pembelian Mandiri' : htmlspecialchars($transaksi->nama_kasir ?? '-') ?>
                        </span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Pelanggan</span>
                        <span class="fw-medium"><?= htmlspecialchars($transaksi->nama_pelanggan ?? 'Umum') ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Metode Bayar</span>
                        <span class="fw-medium"><?= $label_metode[$transaksi->metode_pembayaran] ?? '-' ?></span>
                    </div>
                </div>

                <hr>

                <table class="table table-sm mb-0">
                    <thead>
                        <tr class="text-muted small">
                            <th>Obat</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Harga</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($items)): ?>
                        <tr><td colspan="4" class="text-center text-muted py-3">Tidak ada item.</td></tr>
                        <?php endif; ?>
                        <?php foreach ($items as $it): ?>
                        <tr>
                            <td class="small"><?= htmlspecialchars($it->nama_obat ?? '-') ?></td>
                            <td class="text-center small"><?= (int) $it->qty ?></td>
                            <td class="text-end small">Rp <?= number_format($it->harga_satuan, 0, ',', '.') ?></td>
                            <td class="text-end small fw-medium">Rp <?= number_format($it->subtotal, 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="fw-semibold">Total</span>
                    <span class="fw-bold text-success fs-5">Rp <?= number_format($transaksi->total, 0, ',', '.') ?></span>
                </div>

                <?php if ($transaksi->status === 'returned'): ?>
                <div class="text-center mt-3">
                    <span class="badge bg-danger-subtle text-danger">Transaksi ini telah diretur</span>
                </div>
                <?php endif; ?>

                <p class="text-center text-muted small mt-4 mb-0">Terima kasih telah berbelanja di Apotek Sehat 🙏</p>
            </div>
        </div>
    </div>

</body>
</html>