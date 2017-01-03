<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            'address' => 'required|unique:restaurants,address',
            'cover_image' => 'required|image',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Tên địa điểm là bắt buộc.',
            'address.required' => 'Địa chỉ của cửa hàng là bắt buộc',
            'address.unique' => 'Địa chỉ này đã tồn tại',
            'cover_image.required' => 'Bạn nên thêm ảnh mô tả cho cửa hàng',
            'cover_image.image' => 'File upload sai định dạng ảnh',
        ];
    }
}
