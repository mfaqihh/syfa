{{-- Modal untuk Invoice Financing --}}
<div class="modal fade" id="modalInvoiceFinancing" tabindex="-1" aria-labelledby="modalInvoiceFinancingLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="modalInvoiceFinancingLabel">Tambah Invoice Financing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label for="if_no_invoice" class="form-label">No. Invoice</label>
                        <input type="text" class="form-control" id="if_no_invoice"
                            placeholder="Masukkan No. Invoice" />
                    </div>
                    <div class="col-md-4">
                        <label for="if_nama_client" class="form-label">Nama Client</label>
                        <input type="text" class="form-control" id="if_nama_client"
                            placeholder="Masukkan Nama Client" />
                    </div>
                    <div class="col-md-4">
                        <label for="if_nilai_invoice" class="form-label">Nilai Invoice</label>
                        <input type="text" class="form-control" id="if_nilai_invoice" placeholder="Rp 0" />
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="if_nilai_pinjaman" class="form-label">Nilai Pinjaman</label>
                        <input type="text" class="form-control" id="if_nilai_pinjaman" placeholder="Rp 0" />
                    </div>
                    <div class="col-md-6">
                        <label for="if_nilai_bagi_hasil" class="form-label">Nilai Bagi Hasil</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="if_nilai_bagi_hasil" placeholder="Rp 0" />
                            <span class="input-group-text">/Bulan</span>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="if_invoice_date" class="form-label">Invoice Date</label>
                        <input type="text" class="form-control flatpickr-date" id="if_invoice_date"
                            placeholder="DD/MM/YYYY" />
                    </div>
                    <div class="col-md-6">
                        <label for="if_due_date" class="form-label">Due Date</label>
                        <input type="text" class="form-control flatpickr-date" id="if_due_date"
                            placeholder="DD/MM/YYYY" />
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="if_dokumen_invoice" class="form-label">Upload Dokumen Invoice <span
                                class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="if_dokumen_invoice" />
                        <small class="text-muted">Maximum upload file size: 2 MB. (Type File: pdf, docx, xls, png, rar,
                            zip)</small>
                    </div>
                    <div class="col-md-6">
                        <label for="if_dokumen_kontrak" class="form-label">Upload Dokumen Kontrak</label>
                        <input type="file" class="form-control" id="if_dokumen_kontrak" />
                        <small class="text-muted">Maximum upload file size: 2 MB. (Type File: pdf, docx, xls, png, rar,
                            zip)</small>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="if_dokumen_so" class="form-label">Upload Dokumen SO</label>
                        <input type="file" class="form-control" id="if_dokumen_so" />
                        <small class="text-muted">Maximum upload file size: 2 MB. (Type File: pdf, docx, xls, png, rar,
                            zip)</small>
                    </div>
                    <div class="col-md-6">
                        <label for="if_dokumen_bast" class="form-label">Upload Dokumen BAST</label>
                        <input type="file" class="form-control" id="if_dokumen_bast" />
                        <small class="text-muted">Maximum upload file size: 2 MB. (Type File: pdf, docx, xls, png, rar,
                            zip)</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-end gap-2">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                    Hapus Data
                </button>
                <button type="button" class="btn btn-primary">
                    Simpan Data <i class="ti ti-arrow-right ms-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk PO Financing --}}
<div class="modal fade" id="modalPoFinancing" tabindex="-1" aria-labelledby="modalPoFinancingLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="modalPoFinancingLabel">Tambah PO Financing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label for="pf_no_kontrak" class="form-label">No. Kontrak</label>
                        <input type="text" class="form-control" id="pf_no_kontrak"
                            placeholder="Masukkan No. Kontrak" />
                    </div>
                    <div class="col-md-4">
                        <label for="pf_nama_client" class="form-label">Nama Client</label>
                        <input type="text" class="form-control" id="pf_nama_client"
                            placeholder="Masukkan Nama Client" />
                    </div>
                    <div class="col-md-4">
                        <label for="pf_nilai_invoice" class="form-label">Nilai Invoice</label>
                        <input type="text" class="form-control" id="pf_nilai_invoice" placeholder="Rp 0" />
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="pf_nilai_pinjaman" class="form-label">Nilai Pinjaman</label>
                        <input type="text" class="form-control" id="pf_nilai_pinjaman" placeholder="Rp 0" />
                    </div>
                    <div class="col-md-6">
                        <label for="pf_nilai_bagi_hasil" class="form-label">Nilai Bagi Hasil</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="pf_nilai_bagi_hasil"
                                placeholder="Rp 0" />
                            <span class="input-group-text">/Bulan</span>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="pf_kontrak_date" class="form-label">Kontrak Date</label>
                        <input type="text" class="form-control flatpickr-date" id="pf_kontrak_date"
                            placeholder="DD/MM/YYYY" />
                    </div>
                    <div class="col-md-6">
                        <label for="pf_due_date" class="form-label">Due Date</label>
                        <input type="text" class="form-control flatpickr-date" id="pf_due_date"
                            placeholder="DD/MM/YYYY" />
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="pf_dokumen_kontrak" class="form-label">Upload Dokumen Kontrak <span
                                class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="pf_dokumen_kontrak" />
                        <small class="text-muted">Maximum upload file size: 2 MB. (Type File: pdf, docx, xls, png, rar,
                            zip)</small>
                    </div>
                    <div class="col-md-6">
                        <label for="pf_dokumen_so" class="form-label">Upload Dokumen SO</label>
                        <input type="file" class="form-control" id="pf_dokumen_so" />
                        <small class="text-muted">Maximum upload file size: 2 MB. (Type File: pdf, docx, xls, png, rar,
                            zip)</small>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="pf_dokumen_bast" class="form-label">Upload Dokumen BAST</label>
                        <input type="file" class="form-control" id="pf_dokumen_bast" />
                        <small class="text-muted">Maximum upload file size: 2 MB. (Type File: pdf, docx, xls, png, rar,
                            zip)</small>
                    </div>
                    <div class="col-md-6">
                        <label for="pf_dokumen_lainnya" class="form-label">Upload Dokumen Lainnya</label>
                        <input type="file" class="form-control" id="pf_dokumen_lainnya" />
                        <small class="text-muted">Maximum upload file size: 2 MB. (Type File: pdf, docx, xls, png, rar,
                            zip)</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-end gap-2">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                    Hapus Data
                </button>
                <button type="button" class="btn btn-primary">
                    Simpan Data <i class="ti ti-arrow-right ms-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk Installment --}}
<div class="modal fade" id="modalInstallment" tabindex="-1" aria-labelledby="modalInstallmentLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="modalInstallmentLabel">Tambah Installment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label for="in_no_invoice" class="form-label">No. Invoice</label>
                        <input type="text" class="form-control" id="in_no_invoice"
                            placeholder="Masukkan No. Invoice" />
                    </div>
                    <div class="col-md-4">
                        <label for="in_nama_client" class="form-label">Nama Client</label>
                        <input type="text" class="form-control" id="in_nama_client"
                            placeholder="Masukkan Nama Client" />
                    </div>
                    <div class="col-md-4">
                        <label for="in_nilai_invoice" class="form-label">Nilai Invoice</label>
                        <input type="text" class="form-control" id="in_nilai_invoice" placeholder="Rp 0" />
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="in_invoice_date" class="form-label">Invoice Date</label>
                        <input type="text" class="form-control flatpickr-date" id="in_invoice_date"
                            placeholder="DD/MM/YYYY" />
                    </div>
                    <div class="col-md-6">
                        <label for="in_nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="in_nama_barang"
                            placeholder="Masukkan Nama Barang" />
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="in_dokumen_invoice" class="form-label">Upload Dokumen Invoice <span
                                class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="in_dokumen_invoice" />
                        <small class="text-muted">Maximum upload file size: 2 MB. (Type File: pdf, docx, xls, png, rar,
                            zip)</small>
                    </div>
                    <div class="col-md-6">
                        <label for="in_dokumen_lainnya" class="form-label">Upload Dokumen Lainnya</label>
                        <input type="file" class="form-control" id="in_dokumen_lainnya" />
                        <small class="text-muted">Maximum upload file size: 2 MB. (Type File: pdf, docx, xls, png, rar,
                            zip)</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-end gap-2">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                    Hapus Data
                </button>
                <button type="button" class="btn btn-primary">
                    Simpan Data <i class="ti ti-arrow-right ms-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk Factoring --}}
<div class="modal fade" id="modalFactoring" tabindex="-1" aria-labelledby="modalFactoringLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="modalFactoringLabel">Tambah Factoring</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label for="fc_no_kontrak" class="form-label">No. Kontrak</label>
                        <input type="text" class="form-control" id="fc_no_kontrak"
                            placeholder="Masukkan No. Kontrak" />
                    </div>
                    <div class="col-md-4">
                        <label for="fc_nama_client" class="form-label">Nama Client</label>
                        <input type="text" class="form-control" id="fc_nama_client"
                            placeholder="Masukkan Nama Client" />
                    </div>
                    <div class="col-md-4">
                        <label for="fc_nilai_invoice" class="form-label">Nilai Invoice</label>
                        <input type="text" class="form-control" id="fc_nilai_invoice" placeholder="Rp 0" />
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="fc_nilai_pinjaman" class="form-label">Nilai Pinjaman</label>
                        <input type="text" class="form-control" id="fc_nilai_pinjaman" placeholder="Rp 0" />
                    </div>
                    <div class="col-md-6">
                        <label for="fc_nilai_bagi_hasil" class="form-label">Nilai Bagi Hasil</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="fc_nilai_bagi_hasil"
                                placeholder="Rp 0" />
                            <span class="input-group-text">/Bulan</span>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="fc_kontrak_date" class="form-label">Kontrak Date</label>
                        <input type="text" class="form-control flatpickr-date" id="fc_kontrak_date"
                            placeholder="DD/MM/YYYY" />
                    </div>
                    <div class="col-md-6">
                        <label for="fc_due_date" class="form-label">Due Date</label>
                        <input type="text" class="form-control flatpickr-date" id="fc_due_date"
                            placeholder="DD/MM/YYYY" />
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="fc_dokumen_invoice" class="form-label">Upload Dokumen Invoice <span
                                class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="fc_dokumen_invoice" />
                        <small class="text-muted">Maximum upload file size: 2 MB. (Type File: pdf, docx, xls, png, rar,
                            zip)</small>
                    </div>
                    <div class="col-md-6">
                        <label for="fc_dokumen_kontrak" class="form-label">Upload Dokumen Kontrak <span
                                class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="fc_dokumen_kontrak" />
                        <small class="text-muted">Maximum upload file size: 2 MB. (Type File: pdf, docx, xls, png, rar,
                            zip)</small>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="fc_dokumen_so" class="form-label">Upload Dokumen SO</label>
                        <input type="file" class="form-control" id="fc_dokumen_so" />
                        <small class="text-muted">Maximum upload file size: 2 MB. (Type File: pdf, docx, xls, png, rar,
                            zip)</small>
                    </div>
                    <div class="col-md-6">
                        <label for="fc_dokumen_bast" class="form-label">Upload Dokumen BAST</label>
                        <input type="file" class="form-control" id="fc_dokumen_bast" />
                        <small class="text-muted">Maximum upload file size: 2 MB. (Type File: pdf, docx, xls, png, rar,
                            zip)</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-end gap-2">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                    Hapus Data
                </button>
                <button type="button" class="btn btn-primary">
                    Simpan Data <i class="ti ti-arrow-right ms-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>
