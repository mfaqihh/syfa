{{-- Layout untuk Invoice Financing & PO Financing --}}
<div x-show="jenisPembiayaan === 'invoice_financing' || jenisPembiayaan === 'po_financing'" x-transition
    class="border border-1 rounded-2 mb-4 p-4">
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="total_nilai_pinjaman" class="form-label">Total Nilai Pinjaman</label>
            <input type="text" class="form-control" id="total_nilai_pinjaman" placeholder="Rp 0" disabled />
        </div>

        <div class="col-md-4">
            <label for="total_nilai_bagi_hasil" class="form-label">Total Nilai Bagi Hasil</label>
            <input type="text" class="form-control" id="total_nilai_bagi_hasil" placeholder="Rp 0" disabled />
        </div>

        <div class="col-md-4">
            <label for="total_jumlah_pinjaman" class="form-label">Total Jumlah Pinjaman</label>
            <input type="text" class="form-control" id="total_jumlah_pinjaman" placeholder="Rp 0" disabled />
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <label for="harapan_tanggal_pencairan" class="form-label">Harapan Tanggal Pencairan</label>
            <input type="text" class="form-control flatpickr-date" placeholder="DD/MM/YYYY"
                id="harapan_tanggal_pencairan" />
        </div>

        <div class="col-md-6">
            <label for="rencana_tanggal_pembayaran" class="form-label">Rencana Tanggal Pembayaran</label>
            <input type="text" class="form-control flatpickr-date" placeholder="DD/MM/YYYY"
                id="rencana_tanggal_pembayaran" />
        </div>
    </div>
</div>

{{-- Layout untuk Installment --}}
<div x-show="jenisPembiayaan === 'installment'" x-transition class="border border-1 rounded-2 mb-4 p-4">
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <label for="total_pinjaman_installment" class="form-label">Total Pinjaman</label>
            <input type="text" class="form-control" id="total_pinjaman_installment" placeholder="Rp 0" disabled />
        </div>

        <div class="col-md-6">
            <label for="tenor_pembayaran" class="form-label">Tenor Pembayaran</label>
            <select id="tenor_pembayaran" class="select2 form-select" data-allow-clear="true">
                <option value="">Pilih Tenor...</option>
                <option value="3">3 Bulan</option>
                <option value="6">6 Bulan</option>
                <option value="9">9 Bulan</option>
                <option value="12">12 Bulan</option>
            </select>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="persentase_bagi_hasil" class="form-label">Persentase Bagi Hasil (Debit Cost)</label>
            <input type="text" class="form-control" id="persentase_bagi_hasil" placeholder="10% (Rp. 0)" disabled />
        </div>

        <div class="col-md-4">
            <label for="pps" class="form-label">PPS</label>
            <input type="text" class="form-control" id="pps" placeholder="40% (Rp. 0)" disabled />
        </div>

        <div class="col-md-4">
            <label for="s_finance" class="form-label">S Finance</label>
            <input type="text" class="form-control" id="s_finance" placeholder="60% (Rp. 0)" disabled />
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <label for="total_pembayaran" class="form-label">
                Total Pembayaran
                <i class="ti ti-info-circle text-muted" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Total yang harus dibayarkan oleh peminjam"></i>
            </label>
            <input type="text" class="form-control" id="total_pembayaran" placeholder="Rp. 0" disabled />
        </div>

        <div class="col-md-6">
            <label for="yang_harus_dibayarkan" class="form-label">Yang harus dibayarkan</label>
            <div class="input-group">
                <input type="text" class="form-control" id="yang_harus_dibayarkan" placeholder="Rp. 0" disabled />
                <span class="input-group-text">/Bulan</span>
            </div>
        </div>
    </div>
</div>

{{-- Layout untuk Factoring --}}
<div x-show="jenisPembiayaan === 'factoring'" x-transition class="border border-1 rounded-2 mb-4 p-4">
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="total_nominal_dialihkan" class="form-label">Total Nominal Dialihkan</label>
            <input type="text" class="form-control" id="total_nominal_dialihkan" placeholder="Rp 0" disabled />
        </div>

        <div class="col-md-4">
            <label for="total_nilai_bagi_hasil_factoring" class="form-label">Total Nilai Bagi Hasil</label>
            <input type="text" class="form-control" id="total_nilai_bagi_hasil_factoring" placeholder="Rp 0"
                disabled />
        </div>

        <div class="col-md-4">
            <label for="total_jumlah_pinjaman_factoring" class="form-label">Total Jumlah Pinjaman</label>
            <input type="text" class="form-control" id="total_jumlah_pinjaman_factoring" placeholder="Rp 0"
                disabled />
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <label for="harapan_tanggal_pencairan_factoring" class="form-label">Harapan Tanggal Pencairan</label>
            <input type="text" class="form-control flatpickr-date" placeholder="DD/MM/YYYY"
                id="harapan_tanggal_pencairan_factoring" />
        </div>

        <div class="col-md-6">
            <label for="rencana_tanggal_pembayaran_factoring" class="form-label">Rencana Tanggal Pembayaran</label>
            <input type="text" class="form-control flatpickr-date" placeholder="DD/MM/YYYY"
                id="rencana_tanggal_pembayaran_factoring" />
        </div>
    </div>
</div>
