<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

/**
 * Class Country
 * @package App\Models
 * @version July 24, 2020, 12:19 pm UTC
 *
 */
class Country extends Model implements TranslatableContract
{
    use SoftDeletes, Translatable;

    public $table = 'countries';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name'
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
        'id' => 'integer'
    ];

    /**
     * Rules validation
     *
     * @return array vaildations rules
     */
    public static function rules()
    {
        $languages = array_keys(config('langs'));
        foreach ($languages as $language) {
            $rules[$language . '.name'] = 'required|min:3';
        }

        return $rules;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function cities()
    {
        return $this->hasMany(\App\Models\City::class);
    }
}
