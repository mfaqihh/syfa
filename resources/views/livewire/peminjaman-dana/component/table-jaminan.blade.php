{{-- Table untuk Invoice Financing --}}
<div x-show="jenisPembiayaan === 'invoice_financing'" x-transition class="mt-4">
    <div class="card border-0 shadow-none mb-4">
        <div class="card-header d-flex justify-content-between align-items-center px-0">
            <h5 class="mb-0">Invoice Penjamin</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalInvoiceFinancing">
                <i class="ti ti-plus me-1"></i> Tambah Invoice
            </button>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>No. Invoice</th>
                        <th>Nama Client</th>
                        <th>Nilai Invoice</th>
                        <th>Nilai Pinjaman</th>
                        <th>Nilai Bagi Hasil</th>
                        <th>Invoice Date</th>
                        <th>Due Date</th>
                        <th>Dokumen Invoice <span class="text-danger">*</span></th>
                        <th>Dokumen Kontrak</th>
                        <th>Dokumen SO</th>
                        <th>Dokumen BAST</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="13" class="text-center text-muted py-4">
                            <i class="ti ti-file-invoice ti-lg mb-2 d-block"></i>
                            Belum ada data invoice. Klik "Tambah Invoice" untuk menambahkan.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Table untuk PO Financing --}}
<div x-show="jenisPembiayaan === 'po_financing'" x-transition class="mt-4">
    <div class="card border-0 shadow-none mb-4">
        <div class="card-header d-flex justify-content-between align-items-center px-0">
            <h5 class="mb-0">Kontrak Penjamin</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPoFinancing">
                <i class="ti ti-plus me-1"></i> Tambah Kontrak
            </button>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>No. Kontrak</th>
                        <th>Nama Client</th>
                        <th>Nilai Invoice</th>
                        <th>Nilai Pinjaman</th>
                        <th>Nilai Bagi Hasil</th>
                        <th>Kontrak Date</th>
                        <th>Due Date</th>
                        <th>Dokumen Kontrak <span class="text-danger">*</span></th>
                        <th>Dokumen SO</th>
                        <th>Dokumen BAST</th>
                        <th>Dokumen Lainnya</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="13" class="text-center text-muted py-4">
                            <i class="ti ti-file-text ti-lg mb-2 d-block"></i>
                            Belum ada data kontrak. Klik "Tambah Kontrak" untuk menambahkan.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Table untuk Installment --}}
<div x-show="jenisPembiayaan === 'installment'" x-transition class="mt-4">
    <div class="card border-0 shadow-none mb-4">
        <div class="card-header d-flex justify-content-between align-items-center px-0">
            <h5 class="mb-0">Invoice Installment</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalInstallment">
                <i class="ti ti-plus me-1"></i> Tambah Invoice
            </button>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>No. Invoice</th>
                        <th>Nama Client</th>
                        <th>Nilai Invoice</th>
                        <th>Invoice Date</th>
                        <th>Nama Barang</th>
                        <th>Dokumen Invoice <span class="text-danger">*</span></th>
                        <th>Dokumen Lainnya</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            <i class="ti ti-receipt ti-lg mb-2 d-block"></i>
                            Belum ada data installment. Klik "Tambah Invoice" untuk menambahkan.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Table untuk Factoring --}}
<div x-show="jenisPembiayaan === 'factoring'" x-transition class="mt-4">
    <div class="card border-0 shadow-none mb-4">
        <div class="card-header d-flex justify-content-between align-items-center px-0">
            <h5 class="mb-0">Dokumen Factoring</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFactoring">
                <i class="ti ti-plus me-1"></i> Tambah Dokumen
            </button>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>No. Kontrak</th>
                        <th>Nama Client</th>
                        <th>Nilai Invoice</th>
                        <th>Nilai Pinjaman</th>
                        <th>Nilai Bagi Hasil</th>
                        <th>Kontrak Date</th>
                        <th>Due Date</th>
                        <th>Dokumen Invoice <span class="text-danger">*</span></th>
                        <th>Dokumen Kontrak <span class="text-danger">*</span></th>
                        <th>Dokumen SO</th>
                        <th>Dokumen BAST</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="13" class="text-center text-muted py-4">
                            <i class="ti ti-files ti-lg mb-2 d-block"></i>
                            Belum ada data factoring. Klik "Tambah Dokumen" untuk menambahkan.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Include Modals --}}
@include('livewire.peminjaman-dana.component.modal-pembiayaan')
