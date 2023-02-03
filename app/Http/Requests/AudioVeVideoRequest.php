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
            'price'    => ["required","integer"],
            'city'     => ["required","string"],
            'about'    => ["nullable","string"],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'    => ["required","string"],
            'images'   => ["min:1", "max:20"],
            'images.*' => ["mimes:jpg,jpeg,png,bmp,gif,svg"],
        ];
    }
}
