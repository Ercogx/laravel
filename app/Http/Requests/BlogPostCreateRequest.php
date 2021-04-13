<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostCreateRequest extends FormRequest
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
            'title'       => 'required|min:3|max:200|unique:blog_posts',
            'slug'        => 'max:200',
            'content_raw' => 'required|string|max:10000|min:5',
            'category_id' => 'required|integer|exists:blog_categories,id'
        ];
    }

    /**
     * Fet the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required'    => 'Enter title article',
            'content_raw.min'   => 'The minimum symbols article [:min]'
        ];
    }

    /**
     * Get custom attributes for validator errors
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => 'Title'
        ];
    }
}
