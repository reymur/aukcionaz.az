<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AudioVeVideoRequest extends FormRequest
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
            'sub_category_id'  => ["required","integer"],
            'type'      => ["required","string"],
            'title'     => ["required","string"],
            'check_box' => [
                [
                    'new' => 'nullable|string'
                ],
                [
                    'delivery' => 'nullable|string'
                ]
            ],
            'price' => ["required","integer"],
            'city'  => ["required","string"],
            'about' => ["string"],
            'name'  => ["required","string"],
            'email' => ["required","email:rfc"],
            'phone' => ["required","string"],
        ];
    }
}
