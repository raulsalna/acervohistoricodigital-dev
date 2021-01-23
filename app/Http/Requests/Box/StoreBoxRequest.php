<?php

namespace App\Http\Requests\Box;

use Illuminate\Foundation\Http\FormRequest;

class StoreBoxRequest extends FormRequest
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
      'fileName' => 'required|string|max:250',
      'place' => 'required|string|max:250',
      'depositRoom' => 'required|string|max:250',
      'corridor' => 'required|string|max:250',
      'shelf' => 'required|string|max:250',
      'strep' => 'required|string|max:250',
      'box' => 'required|string|max:250',
    ];
  }
}
