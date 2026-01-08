<div>
    <h1 class="text-2xl font-bold mb-2">Pengajuan Peminjaman Dana</h1>

    <div class="card">
        <div class="card-body" x-data="{ jenisPembiayaan: '' }">
            <!-- Nama Perusahaan -->
            <div class="mb-4">
                <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                <input type="text" class="form-control" id="nama_perusahaan" placeholder="Masukkan nama perusahaan" />
            </div>

            <!-- Tidak atau masih belum dipakai hingga keputusan kedepannya -->
            {{-- <div class="border border-1 rounded-2 mb-4 p-4">
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
            </div> --}}

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
                <div class="d-flex gap-4 flex-wrap">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_pembiayaan" id="invoice_financing"
                            value="invoice_financing" x-model="jenisPembiayaan" />
                        <label class="form-check-label" for="invoice_financing">Invoice Financing</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_pembiayaan" id="po_financing"
                            value="po_financing" x-model="jenisPembiayaan" />
                        <label class="form-check-label" for="po_financing">PO Financing</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_pembiayaan" id="installment"
                            value="installment" x-model="jenisPembiayaan" />
                        <label class="form-check-label" for="installment">Installment</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_pembiayaan" id="factoring"
                            value="factoring" x-model="jenisPembiayaan" />
                        <label class="form-check-label" for="factoring">Factoring</label>
                    </div>
                </div>

                {{-- Info text ketika belum ada pilihan --}}
                <div x-show="!jenisPembiayaan" class="alert alert-info mt-4 mb-0">
                    <i class="ti ti-info-circle me-2"></i>
                    Silakan pilih jenis pembiayaan untuk menampilkan tabel dokumen yang sesuai.
                </div>

                @include('livewire.peminjaman-dana.component.table-jaminan')
            </div>

            @include('livewire.peminjaman-dana.component.perhitungan-pinjaman')

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
            initFlatpickr();
        });

        // Re-initialize after Livewire updates
        document.addEventListener('livewire:navigated', function() {
            initSelect2();
            initFlatpickr();
        });

        // Re-initialize when modal is shown
        document.addEventListener('shown.bs.modal', function() {
            initFlatpickr();
        });

        function initSelect2() {
            const select2Elements = document.querySelectorAll('.select2');
            select2Elements.forEach(function(el) {
                if ($(el).data('select2')) {
                    $(el).select2('destroy');
                }

                // Initialize Select2
                $(el).select2({
                    placeholder: el.getAttribute('data-placeholder') || 'Pilih...',
                    allowClear: el.hasAttribute('data-allow-clear'),
                    dropdownParent: $(el).closest('.modal').length ? $(el).closest('.modal') : $(el)
                    .parent()
                });
            });
        }

        function initFlatpickr() {
            // Date Picker (DD/MM/YYYY format)
            document.querySelectorAll('.flatpickr-date').forEach(function(el) {
                if (el._flatpickr) {
                    el._flatpickr.destroy();
                }
                flatpickr(el, {
                    dateFormat: 'd/m/Y',
                    allowInput: true
                });
            });

            // DateTime Picker
            document.querySelectorAll('.flatpickr-datetime').forEach(function(el) {
                if (el._flatpickr) {
                    el._flatpickr.destroy();
                }
                flatpickr(el, {
                    dateFormat: 'd/m/Y H:i',
                    enableTime: true,
                    allowInput: true
                });
            });
        }
    </script>
@endpush
