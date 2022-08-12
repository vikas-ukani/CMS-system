<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                'min:3',
                'max:200',
                "unique:pages,title," . $this->id
            ],
            'slug' => 'required',
            'parent_id' => 'numeric|nullable',
            'content' => [
                'required',
                'min:10',
            ],
        ];
    }
}
