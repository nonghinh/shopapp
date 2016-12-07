<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
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
            
            'name' => 'required',
            'address' => 'required',
            'cover_image' => 'image',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Tên địa điểm là bắt buộc.',
            'address.required' => 'Địa chỉ của cửa hàng là bắt buộc',
            'cover_image.image' => 'File upload sai định dạng ảnh',
        ];
    }
}
