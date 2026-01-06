<?php

namespace App\Http\Requests\MasterData;

use App\Http\Requests\BaseFormRequest;

/**
 * Form Request untuk Sumber Pendanaan Eksternal
 * 
 * Dapat digunakan oleh Controller maupun sebagai referensi rules untuk Livewire
 */
class SumberPendanaanEksternalRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'nama_instansi' => ['required', 'string', 'max:255'],
            'presentase_bagi_hasil' => ['required', 'numeric', 'min:0', 'max:100'],
        ];

        // Tambahkan unique rule saat create, ignore saat update
        if ($this->isMethod('POST')) {
            $rules['nama_instansi'][] = 'unique:sumber_pembiayaan_eksternal,nama_instansi';
        } elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('id') ?? $this->input('id');
            $rules['nama_instansi'][] = "unique:sumber_pembiayaan_eksternal,nama_instansi,{$id},id_sumber_pembiayaan";
        }

        return $rules;
    }

    /**
     * Custom attribute names
     */
    protected function customAttributes(): array
    {
        return [
            'nama_instansi' => 'Nama Instansi',
            'presentase_bagi_hasil' => 'Presentase Bagi Hasil',
        ];
    }

    /**
     * Custom validation messages
     */
    protected function customMessages(): array
    {
        return [
            'nama_instansi.unique' => 'Nama instansi sudah terdaftar.',
            'presentase_bagi_hasil.max' => 'Presentase tidak boleh lebih dari 100%.',
        ];
    }

    /**
     * Static method untuk mendapatkan rules (untuk Livewire)
     */
    public static function livewireRules(?string $editId = null): array
    {
        $rules = [
            'nama_instansi' => 'required|string|max:255',
            'presentase_bagi_hasil' => 'required|numeric|min:0|max:100',
        ];

        if ($editId) {
            $rules['nama_instansi'] .= "|unique:sumber_pembiayaan_eksternal,nama_instansi,{$editId},id_sumber_pembiayaan";
        } else {
            $rules['nama_instansi'] .= '|unique:sumber_pembiayaan_eksternal,nama_instansi';
        }

        return $rules;
    }

    /**
     * Static method untuk mendapatkan attributes (untuk Livewire)
     */
    public static function livewireAttributes(): array
    {
        return [
            'nama_instansi' => 'Nama Instansi',
            'presentase_bagi_hasil' => 'Presentase Bagi Hasil',
        ];
    }
}
