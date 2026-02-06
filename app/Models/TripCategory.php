<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Helpers\ImageUploaderTrait;

/**
 * Class TripCategory
 * @package App\Models
 * @version July 28, 2020, 1:21 pm UTC
 *
 * @property string $photo
 */
class TripCategory extends Model  implements TranslatableContract
{
    use SoftDeletes, Translatable, ImageUploaderTrait;

    public $table = 'trip_categories';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'photo',
        'map',
    ];

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
        'name',
        'duration',
        'rate_plan',
        'desc',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'        => 'integer',
        'photo'     => 'string',
        'map'       => 'string',
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
            $rules[$language . '.name'] = 'required|string|min:3|max:191';
            $rules[$language . '.duration'] = 'required|string|min:3|max:191';
            $rules[$language . '.rate_plan'] = 'required|string|min:3';
            $rules[$language . '.desc'] = 'required|string|min:3';
        }
        $rules['photo'] = 'required|image';
        $rules['map'] = 'required|image';

        return $rules;
    }

    /**
     * Data Setter for value attribute
     */
    public function setPhotoAttribute($file)
    {
        if ($file) {
            $fileName = $this->createFileName($file);

            $this->originalImage($file, $fileName);

            $this->attributes['photo'] = $fileName;
        }
    }

    public function getPhotoAttribute($val)
    {
        return $val ? asset('uploads/images/original') . '/' . $val : null;
    }

    public function setMapAttribute($file)
    {
        if ($file) {
            $fileName = $this->createFileName($file);

            $this->saveFile($file, $fileName);

            $this->attributes['map'] = $fileName;
        }
    }

    public function getMapAttribute($val)
    {
        return $val ? asset('uploads/files') . '/' . $val : null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function trips()
    {
        return $this->hasMany(\App\Models\Trip::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function additionalTrips()
    {
        return $this->hasMany(\App\Models\AdditionalTrip::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function itineraries()
    {
        return $this->hasMany(\App\Models\Itinerary::class);
    }
}
