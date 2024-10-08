<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostToggleReactionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'post_id' => 'required|exists:posts,id',
        ];
    }
}
