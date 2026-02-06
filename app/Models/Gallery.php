<?php

namespace App\Models;

use Eloquent as Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

/**
 * Class Gallery
 * @package App\Models
 * @version August 23, 2020, 1:17 pm UTC
 *
 * @property integer $status
 */
class Gallery extends Model implements TranslatableContract
{

    use Translatable;

    public $table = 'galleries';




    public $fillable = [
        'status'
    ];

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'status' => 'integer'
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
            $rules[$language . '.name'] = 'required|string|min:3|max:191';
        }
        $rules['status'] = 'required|in:0,1';

        return $rules;
    }

    public function gallery_photos()
    {
        return $this->hasMany(\App\Models\GalleryPhoto::class);
    }
}
