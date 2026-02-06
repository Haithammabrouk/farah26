<?php

namespace App\Models;

use Eloquent as Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

/**
 * Class ItineraryDetail
 * @package App\Models
 * @version August 24, 2020, 7:33 pm UTC
 *
 * @property \App\Models\Itinerary $itinerary
 * @property integer $itinerary_id
 */
class ItineraryDetail extends Model  implements TranslatableContract
{
    use Translatable;

    public $table = 'itinerary_details';
    



    public $fillable = [
        'itinerary_id'
    ];

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
        'text',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'itinerary_id' => 'integer'
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
            $rules[$language . '.text'] = 'required|string|min:3|max:191';
        }
        $rules['itinerary_id'] = 'required';

        return $rules;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function itinerary()
    {
        return $this->belongsTo(\App\Models\Itinerary::class);
    }
}
