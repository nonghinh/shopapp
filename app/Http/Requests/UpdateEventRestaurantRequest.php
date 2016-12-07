<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRestaurantRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required',
            'restaurant_id' => 'required',
            'cate_id' => 'required',
            'event_id' => 'required',
            'event_info' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ];
    }

    public function messages(){

        return [
            'name.required' => 'Tên sự kiện không được bỏ trống',
            'restaurant_id.required' => 'Chưa chọn địa điểm',
            'cate_id.required' => 'Chưa chọn danh mục',
            'event_id.required' => 'Chưa chọn lạo sự kiện',
            'event_info.required' => 'Chưa có mô tả cho sự kiện',
            'start_time.required' => 'Chưa có thời gian bắt đầu sự kiện',
            'end_time.required' => 'Chưa có thời gian kết thức sự kiện',
        ];
    }
}
