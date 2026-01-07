<div>
    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <h1 class="mb-1 fw-bold">Pengajuan Peminjaman Dana</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <!-- Nama Perusahaan -->
            <div class="mb-4">
                <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                <input type="text" class="form-control" id="nama_perusahaan" placeholder="Masukkan nama perusahaan" />
            </div>

            <!-- Jenis Pembiayaan Section -->
            <div class="border border-1 rounded-2 mb-4 p-4">
                <label class="form-label fw-medium d-block mb-3">Sumber Pembiayaan</label>
                <div class="d-flex gap-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sumber_pembiayaan" id="external"
                            value="external" />
                        <label class="form-check-label" for="external">External</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sumber_pembiayaan" id="internal"
                            value="internal" />
                        <label class="form-check-label" for="internal">Internal</label>
                    </div>
                </div>

                <!-- Select Sumber Pembiayaan (muncul jika External dipilih) -->
                <div class="mt-4">
                    <label for="sumber_pembiayaan" class="form-label">Sumber Pembiayaan</label>
                    <select id="sumber_pembiayaan" class="select2 form-select" data-allow-clear="true">
                        <option value="">Pilih sumber pembiayaan...</option>
                        <option value="1">Bank Mandiri</option>
                        <option value="2">Bank BRI</option>
                        <option value="3">Bank BNI</option>
                        <option value="4">Bank BTN</option>
                    </select>
                </div>
            </div>

            <div class="border border-1 rounded-2 mb-4 p-4">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                    <div class="mb-3">
                        <label for="nama_bank" class="form-label">Nama Bank</label>
                        <input type="text" class="form-control" id="nama_bank" placeholder="Masukkan nama bank"
                            disabled />
                    </div>

                    <div class="mb-3">
                        <label for="nomor_rekening" class="form-label">Nomor Rekening</label>
                        <input type="text" class="form-control" id="nomor_rekening"
                            placeholder="Masukkan nomor rekening" disabled />
                    </div>

                    <div class="mb-3">
                        <label for="nama_rekening" class="form-label">Nama Rekening</label>
                        <input type="text" class="form-control" id="nama_rekening"
                            placeholder="Masukkan nama rekening" disabled />
                    </div>
                </div>

                <div class="mb-4">
                    <label for="lampiran_sid" class="form-label">Lampiran SID</label>
                    <input type="file" class="form-control" id="lampiran_sid" />
                </div>

                <div class="mb-4">
                    <label for="tujuan_peminjaman" class="form-label">Tujuan Peminjaman</label>
                    <input type="text" class="form-control" id="tujuan_peminjaman"
                        placeholder="Masukkan tujuan peminjaman" />
                </div>
            </div>

            <div class="border border-1 rounded-2 mb-4 p-4">
                <label class="form-label fw-medium d-block mb-3 mt-3">Jenis Pembiayaan</label>
                <div class="d-flex gap-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_pembiayaan" id="invoice_financing"
                            value="invoice_financing" />
                        <label class="form-check-label" for="invoice_financing">Invoice Financing</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_pembiayaan" id="po_financing"
                            value="po_financing" />
                        <label class="form-check-label" for="po_financing">PO Financing</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_pembiayaan" id="installment"
                            value="installment" />
                        <label class="form-check-label" for="installment">Installment</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_pembiayaan" id="factoring"
                            value="factoring" />
                        <label class="form-check-label" for="factoring">Factoring</label>
                    </div>
                </div>

                <div class="card border-0 shadow-none mt-4 mb-4">
                    <div class="card-header d-flex justify-content-between items-center">
                        <h5>Bukti Penjamin</h5>
                        <button type="button" class="btn btn-primary">
                            Tambah Bukti Penjamin
                        </button>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>No</th>
                                    <th>NO. INVOICE</th>
                                    <th>NAMA CLIENT</th>
                                    <th>NILAI INVOICE</th>
                                    <th>NILAI PINJAMAN</th>
                                    <th>NILAI BAGI HASIL</th>
                                    <th>INVOICE DATE</th>
                                    <th>DUE DATE</th>
                                    <th>DOKUMEN INVOICE </th>
                                    <th>DOKUMEN KONTRAK</th>
                                    <th>DOKUMEN SO</th>
                                    <th>DOKUMEN BAST</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                    <td>Table cell</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="border border-1 rounded-2 mb-4 p-4">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                    <div class="mb-3">
                        <label for="total_nilai_pinjaman" class="form-label">Total Nilai Pinjaman</label>
                        <input type="text" class="form-control" id="total_nilai_pinjaman"
                            placeholder="Masukkan total nilai pinjaman" disabled />
                    </div>

                    <div class="mb-3">
                        <label for="total_nilai_bagi_hasil" class="form-label">Total Nilai Bagi Hasil</label>
                        <input type="text" class="form-control" id="total_nilai_bagi_hasil"
                            placeholder="Masukkan total nilai bagi hasil" disabled />
                    </div>

                    <div class="mb-3">
                        <label for="total_jumlah_pinjaman" class="form-label">Total Jumlah Pinjaman</label>
                        <input type="text" class="form-control" id="total_jumlah_pinjaman"
                            placeholder="Masukkan total jumlah pinjaman" disabled />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-6">
                        <label for="flatpickr-date" class="form-label">Harapan Tanggal Pencairan</label>
                        <input type="text" class="form-control" placeholder="YYYY-MM-DD" id="flatpickr-date" />
                    </div>

                    <div class="mb-6">
                        <label for="flatpickr-date" class="form-label">Rencana Tanggal Pembayaran</label>
                        <input type="text" class="form-control" placeholder="YYYY-MM-DD" id="flatpickr-date" />
                    </div>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('peminjaman-dana') }}" class="btn btn-outline-primary" wire:navigate.hover>
                    <i class="ti ti-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-check me-1"></i> Submit Pengajuan
                </button>
            </div>
        </div>
    </div>
</div>

@push('page-js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initSelect2();
        });

        // Re-initialize after Livewire updates
        document.addEventListener('livewire:navigated', function() {
            initSelect2();
        });

        function initSelect2() {
            const select2Elements = document.querySelectorAll('.select2');
            select2Elements.forEach(function(el) {
                // Destroy existing Select2 instance if exists
                if ($(el).data('select2')) {
                    $(el).select2('destroy');
                }

                // Initialize Select2
                $(el).select2({
                    placeholder: el.getAttribute('data-placeholder') || 'Pilih...',
                    allowClear: el.hasAttribute('data-allow-clear'),
                    dropdownParent: $(el).parent()
                });
            });
        }
    </script>
@endpush
