<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookReturnRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'copy_id' => 'required|exists:book_copies,id',
            'member_id' => 'required|exists:users,id',
            'updated_at' => 'required|date'
        ];
    }
}
