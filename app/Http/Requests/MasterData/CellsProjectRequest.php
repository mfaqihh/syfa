<?php

namespace App\Http\Requests\MasterData;

class CellsProjectRequest
{
    public function rules(): array
    {
        return [
            'nama_cells_project' => 'required|string|max:255|unique:cells_project,nama_cells_project',
            'nama_pic' => 'required|string|max:255',
            'tanda_tangan_pic' => 'nullable|image|max:2048',
            'alamat' => 'required|string|max:500',
            'deskripsi_bidang' => 'nullable|string|max:1000',
        ];
    }

    public function customAttributes(): array
    {
        return [
            'nama_cells_project' => 'Nama Cells Project',
            'nama_pic' => 'Nama PIC',
            'tanda_tangan_pic' => 'Tanda Tangan PIC',
            'alamat' => 'Alamat',
            'deskripsi_bidang' => 'Deskripsi Bidang',
        ];
    }

    public function customMessages(): array
    {
        return [
            'nama_cells_project.unique' => 'Nama Cells Project sudah terdaftar.',
            'tanda_tangan_pic.image' => 'Tanda Tangan PIC harus berupa file gambar.',
            'tanda_tangan_pic.max' => 'Ukuran Tanda Tangan PIC tidak boleh lebih dari 2MB.',
        ];
    }

    public static function livewireRules($editId = null): array
    {
        return [
            'nama_cells_project' => 'required|string|max:255|unique:cells_project,nama_cells_project' . ($editId ? ",$editId,id_cells_project" : ''),
            'nama_pic' => 'required|string|max:255',
            'tanda_tangan_pic' => 'nullable|image|max:2048',
            'alamat' => 'required|string|max:500',
            'deskripsi_bidang' => 'nullable|string|max:1000',
        ];
    }

    public static function livewireAttributes(): array
    {
        return [
            'nama_cells_project' => 'Nama Cells Project',
            'nama_pic' => 'Nama PIC',
            'tanda_tangan_pic' => 'Tanda Tangan PIC',
            'alamat' => 'Alamat',
            'deskripsi_bidang' => 'Deskripsi Bidang',
        ];
    }
}