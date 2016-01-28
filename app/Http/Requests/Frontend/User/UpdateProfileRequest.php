<?php namespace App\Http\Requests\Frontend\User;

use App\Http\Requests\Request;

/**
 * Class UpdateProfileRequest
 * @package App\Http\Requests\Frontend\User
 */
class UpdateProfileRequest extends Request {

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
			'first_name'	=> 'required',
			'last_name'	=> 'required',
			'email'	=> 'sometimes|required|email',
			'bio'	=> 'max:800',
			'avatar' => 'max:2000|mimes:jpeg,JPG,jpg,JPEG,png,PNG',
			'phone_number' => 'regex:/^(\+\d{1,2}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/'
		];
	}
}
