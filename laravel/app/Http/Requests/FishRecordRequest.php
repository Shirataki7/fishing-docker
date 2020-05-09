<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FishRecordRequest extends FormRequest
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
            'fishing_date' => 'required',
            'harbor' => 'required',
            'fish_name' => 'required',
            'fish_image'=> 'file|image|mimes:jpeg,png',
        ];
    }

    public function messages(){
        return [
            'fishing_date.required' => '釣行日は必ず入力してください。',
            'harbor.required' => '釣行先は必ず入力してください。',
            'fish_name.required' => '釣った魚の名前を入力してください。',
            'fish_image.file'=>'画像を選択してください',
            'fish_image.image'=>'画像を選択してください',
            'fish_image.mimes:jpeg,png'=>'画像を選択してください',
        ];
    }
}
