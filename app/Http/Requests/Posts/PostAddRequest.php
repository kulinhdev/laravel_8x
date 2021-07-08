<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class PostAddRequest extends FormRequest
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
            'image' => 'required|mimes:jpg,jpeg,png',
            'body' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề không được bỏ rỗng !',
            'title.unique' => 'Tiêu đề này đã tồn tại !',
            'image.required' => 'Bạn chưa chọn ảnh !',
            'image.mimes' => 'Định dang ảnh phải là jpg, png or jpeg !',
            'body.required' => 'Nội dung đề không được bỏ rỗng !',
        ];
    }
}
