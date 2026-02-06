<?php

namespace App\Models;

use Eloquent as Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

/**
 * Class Tripadvisor
 * @package App\Models
 * @version September 9, 2020, 3:13 pm UTC
 *
 * @property integer $author
 */
class Tripadvisor extends Model implements TranslatableContract
{
    use Translatable;

    public $table = 'tripadvisors';

    public $fillable = [
        'author',
        'url',
    ];

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
        'title',
        'text',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static function rules()
    {
        $languages = array_keys(config('langs'));
        foreach ($languages as $language) {
            $rules[$language . '.title'] = 'required|string|min:3|max:191';
            $rules[$language . '.text'] = 'required|min:3';
        }
        $rules['author'] = 'required';
        $rules['url'] = 'required';

        return $rules;
    }
}
