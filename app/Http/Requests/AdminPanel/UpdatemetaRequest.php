<?php

namespace App\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\meta;

class UpdatemetaRequest extends FormRequest
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
        $metaId = $this->route('meta');

        $rules = [
            'name' => 'required|string|max:191|unique:metas,name,' . $metaId,
        ];

        // Add validation for each language
        foreach (config('langs') as $locale => $name) {
            $rules["{$locale}.title"] = 'required|string|max:191';
            $rules["{$locale}.description"] = 'required|string|max:500';
            $rules["{$locale}.keywords"] = 'required|string|max:500';
        }

        return $rules;
    }
}
