<?php

namespace App\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Deck;

class UpdateDeckRequest extends FormRequest
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
        $rules = Deck::rules();
        //مش كل لما ارفع صورة لازم اعمل ايديت
        $rules['file'] = 'nullable';
        $rules['other_file'] = 'nullable';

        return $rules;
    }
}
