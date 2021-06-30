<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequests extends FormRequest
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
            'title' => 'required|unique:blogs',
            'image' => 'required',
            'body' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề không được bỏ rỗng !',
            'image.required' => 'Bạn chưa chọn ảnh !',
            'body.required' => 'Nội dung đề không được bỏ rỗng !',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
        });
    }
}
