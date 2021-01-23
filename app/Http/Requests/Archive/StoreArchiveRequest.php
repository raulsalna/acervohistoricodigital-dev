<?php

namespace App\Http\Requests\Archive;

use Illuminate\Foundation\Http\FormRequest;

class StoreArchiveRequest extends FormRequest
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
            'title' => 'required|string|max:250',
            'box_id' => 'required|integer|max:250',
            'proceedings_id' => 'required|integer|max:250',
            'placement' => 'required|string|max:250',
            'code' => 'required|string|max:250',
            'group_id' => 'required|integer|max:250',
            'year' => 'required|string|max:4',
            'openingDate' => 'required|date',
            'closingDate' => 'required|date',
            'startVolume' => 'required|string|max:250',
            'endVolume' => 'required|string|max:250',
            'characters_id' => 'required|integer|max:250',
            'documentaryTradition_id' => 'required|integer|max:250',
            'description' => 'required|string|max:3000',
            'appendNotes' => 'nullable|string|max:3000',
            'notesArchivist' => 'nullable|string|max:3000',
            'support'                 => 'required',
            'languages'               => 'required',
            'producer'                => 'required',
          ];
    }
}
