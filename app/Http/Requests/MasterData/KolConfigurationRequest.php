<?php

namespace App\Http\Requests\MasterData;

use App\Http\Requests\BaseFormRequest;

/**
 * Form Request untuk KOL Configuration
 * 
 * Dapat digunakan oleh Controller maupun sebagai referensi rules untuk Livewire
 */
class KolConfigurationRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'kol' => ['required', 'string', 'max:50'],
            'presentase_pencairan' => ['required', 'numeric', 'min:0', 'max:100'],
            'jumlah_hari_keterlambatan' => ['required', 'integer', 'min:0'],
        ];

        // Tambahkan unique rule saat create, ignore saat update
        if ($this->isMethod('POST')) {
            $rules['kol'][] = 'unique:kol_configuration,kol';
        } elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('id') ?? $this->input('id');
            $rules['kol'][] = "unique:kol_configuration,kol,{$id},id_kol";
        }

        return $rules;
    }

    /**
     * Custom attribute names
     */
    protected function customAttributes(): array
    {
        return [
            'kol' => 'KOL',
            'presentase_pencairan' => 'Presentase Pencairan',
            'jumlah_hari_keterlambatan' => 'Jumlah Hari Keterlambatan',
        ];
    }

    /**
     * Custom validation messages
     */
    protected function customMessages(): array
    {
        return [
            'kol.unique' => 'KOL sudah terdaftar.',
            'presentase_pencairan.max' => 'Presentase tidak boleh lebih dari 100%.',
            'jumlah_hari_keterlambatan.integer' => 'Jumlah hari harus berupa bilangan bulat.',
        ];
    }

    /**
     * Static method untuk mendapatkan rules (untuk Livewire)
     */
    public static function livewireRules(?string $editId = null): array
    {
        $rules = [
            'kol' => 'required|string|max:50',
            'presentase_pencairan' => 'required|numeric|min:0|max:100',
            'jumlah_hari_keterlambatan' => 'required|integer|min:0',
        ];

        if ($editId) {
            $rules['kol'] .= "|unique:kol_configuration,kol,{$editId},id_kol";
        } else {
            $rules['kol'] .= '|unique:kol_configuration,kol';
        }

        return $rules;
    }

    /**
     * Static method untuk mendapatkan attributes (untuk Livewire)
     */
    public static function livewireAttributes(): array
    {
        return [
            'kol' => 'KOL',
            'presentase_pencairan' => 'Presentase Pencairan',
            'jumlah_hari_keterlambatan' => 'Jumlah Hari Keterlambatan',
        ];
    }
}
