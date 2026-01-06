<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Base Form Request class
 * Menyediakan fitur umum untuk semua form request
 */
abstract class BaseFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Override di child jika perlu authorization
    }

    /**
     * Get the validation rules that apply to the request.
     */
    abstract public function rules(): array;

    /**
     * Get custom validation messages
     */
    public function messages(): array
    {
        return array_merge($this->defaultMessages(), $this->customMessages());
    }

    /**
     * Default validation messages dalam Bahasa Indonesia
     */
    protected function defaultMessages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'numeric' => ':attribute harus berupa angka.',
            'integer' => ':attribute harus berupa bilangan bulat.',
            'email' => ':attribute harus berupa alamat email yang valid.',
            'max' => [
                'string' => ':attribute tidak boleh lebih dari :max karakter.',
                'numeric' => ':attribute tidak boleh lebih dari :max.',
                'file' => ':attribute tidak boleh lebih dari :max KB.',
            ],
            'min' => [
                'string' => ':attribute harus minimal :min karakter.',
                'numeric' => ':attribute harus minimal :min.',
                'file' => ':attribute harus minimal :min KB.',
            ],
            'unique' => ':attribute sudah digunakan.',
            'exists' => ':attribute yang dipilih tidak valid.',
            'confirmed' => 'Konfirmasi :attribute tidak cocok.',
            'date' => ':attribute harus berupa tanggal yang valid.',
            'date_format' => ':attribute tidak sesuai format :format.',
            'before' => ':attribute harus sebelum :date.',
            'after' => ':attribute harus setelah :date.',
            'image' => ':attribute harus berupa gambar.',
            'mimes' => ':attribute harus berupa file dengan tipe: :values.',
            'mimetypes' => ':attribute harus berupa file dengan tipe: :values.',
            'file' => ':attribute harus berupa file.',
            'size' => ':attribute harus berukuran :size KB.',
            'between' => [
                'numeric' => ':attribute harus antara :min dan :max.',
                'file' => ':attribute harus antara :min dan :max KB.',
                'string' => ':attribute harus antara :min dan :max karakter.',
            ],
            'in' => ':attribute yang dipilih tidak valid.',
            'not_in' => ':attribute yang dipilih tidak valid.',
            'array' => ':attribute harus berupa array.',
            'boolean' => ':attribute harus berupa true atau false.',
            'regex' => 'Format :attribute tidak valid.',
        ];
    }

    /**
     * Custom messages - override di child class
     */
    protected function customMessages(): array
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors
     */
    public function attributes(): array
    {
        return $this->customAttributes();
    }

    /**
     * Custom attributes - override di child class
     */
    protected function customAttributes(): array
    {
        return [];
    }

    /**
     * Handle a failed validation attempt for API responses
     */
    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal.',
                    'errors' => $validator->errors(),
                ], 422)
            );
        }

        parent::failedValidation($validator);
    }

    /**
     * Get validated data with optional merge
     */
    public function validatedWithDefaults(array $defaults = []): array
    {
        return array_merge($defaults, $this->validated());
    }

    /**
     * Get only specific fields from validated data
     */
    public function validatedOnly(array $keys): array
    {
        return collect($this->validated())->only($keys)->toArray();
    }

    /**
     * Get validated data except specific fields
     */
    public function validatedExcept(array $keys): array
    {
        return collect($this->validated())->except($keys)->toArray();
    }
}
