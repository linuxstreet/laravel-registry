<?php

namespace Linuxstreet\Registry;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ValidateRegistry
 *
 * @package Linuxstreet\Registry
 * @property int id
 * @property string comment
 * @property mixed value
 * @property string type
 * @property string key
 */
class ValidateRegistry extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $table = app(Registry::class)->getTable();

        return [
            'key' => [
                'required',
                'max:64',
                ($this->method() === 'POST') ? "unique:$table,key" : "unique:$table,key,{$this->id},id"
            ],
            'value' => 'required',
            'type' => 'required|max:16'
        ];
    }
}
