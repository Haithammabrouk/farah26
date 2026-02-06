<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Helpers\ImageUploaderTrait;

use App\Models\AdditionalTripsPhotos;

/**
 * Class AdditionalTrip
 * @package App\Models
 * @version August 19, 2020, 1:05 pm UTC
 *
 * @property \App\Models\TripCategory $tripCategory
 * @property integer $trip_category_id
 * @property number $price
 * @property number $SinglePrice
 * @property string $img
 * @property string $details
 */
class AdditionalTrip extends Model  implements TranslatableContract
{
    use SoftDeletes, Translatable, ImageUploaderTrait;

    public $table = 'additional_trips';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'price',
        'SinglePrice',
        'img',
    ];

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
        'name',
        'location',
        'details'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'trip_category_id' => 'integer',
        'price' => 'float',
        'SinglePrice' => 'float',
        'img' => 'string',
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
            $rules[$language . '.location'] = 'required|string|min:3|max:191';
            $rules[$language . '.details'] = 'required';
        }
        $rules['price'] = 'required|numeric';
        $rules['SinglePrice'] = 'numeric';
        $rules['img'] = 'required|image';

        return $rules;
    }

    /**
     * Data Setter for value attribute
     */
    public function setImgAttribute($file)
    {
        if ($file) {
            $fileName = $this->createFileName($file);

            $this->originalImage($file, $fileName);

            $this->attributes['img'] = $fileName;
        }
    }

    public function getImgAttribute($val)
    {
        return $val ? asset('uploads/images/original') . '/' . $val : null;
    }

    public function additionalTripsPhotos()
    {
        return $this->hasMany(\App\Models\AdditionalTripsPhotos::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function tripsAdditionals()
    {
        return $this->belongsToMany('App\Models\Trip', 'trips_additionals', 'additional_trip_id', 'trip_id');
    }
}
