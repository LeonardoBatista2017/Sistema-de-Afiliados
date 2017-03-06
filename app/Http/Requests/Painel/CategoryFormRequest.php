<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|min:3|max:100',
            'url'           => "required|min:3|max:100|unique:categories,url,{$this->segment(3)},id",
            'description'   => 'required|min:3|max:200',
            'image'         => 'image'
        ];
    }
}
