<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRestaurantRequest extends FormRequest
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
            'restaurant_id' => 'required',
            'cate_id' => 'required',
            'event_id' => 'required',
            'event_info' => 'required',
            'start_time' => ['required','regex:/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}\s(0[0-9]|1[0-9]|2[1-3]):(0[0-9]|[1-5][0-9])$/'],
            'end_time' => ['required','regex:/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}\s(0[0-9]|1[0-9]|2[1-3]):(0[0-9]|[1-5][0-9])$/'],
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
            'start_time.regex' => 'Chưa đúng định dạng thời gian cho phép',
            'end_time.required' => 'Chưa có thời gian kết thức sự kiện',
            'end_time.regex' => 'Chưa đúng định dạng thời gian cho phép',
        ];
    }
}
