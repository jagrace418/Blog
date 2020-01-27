<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest {

	/**
	 * Determine if the user is authorized to make this request.
	 * @return bool
	 */
	public function authorize () {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 * @return array
	 */
	public function rules () {
		return [
			'title'   => 'sometimes|required|max:255',
			'content' => 'required',
		];
	}

	/**
	 * Custom validation messages
	 * @return array
	 */
	public function messages () {
		return [
			'title.required' => 'A post needs a title!',
			'content.required' => 'What\' the point of a blog if it doesn\'t say anything?'
		];
	}
}
