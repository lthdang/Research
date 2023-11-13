<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|max:255',
            'content' => 'required',
            'describe_short' => 'required',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
        ];

        if (!empty($this->file('image'))) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'title.max' => 'The title may not be greater than :max characters.',
            'content.required' => 'The content field is required.',
            'image.required' => 'The image field is required.',
            'image.image' => 'The image must be an image file.',
            'image.mimes' => 'The image must be a file of type: :values.',
            'image.max' => 'The image may not be greater than :max kilobytes.',
            'describe_short.required' => 'The short description field is required.',
        ];
    }


}
