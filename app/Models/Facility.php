<?php

namespace App\Models;

use Eloquent as Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Helpers\ImageUploaderTrait;
use App\Models\FacilityPhoto;

/**
 * Class Facility
 * @package App\Models
 * @version August 24, 2020, 5:45 pm UTC
 *
 * @property string $img
 */
class Facility extends Model  implements TranslatableContract
{
    use Translatable, ImageUploaderTrait;

    public $table = 'facilities';

    public $fillable = [
        'img'
    ];

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
        'name',
        'details'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'img' => 'string'
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
            $rules[$language . '.details'] = 'required';
        }
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

    public function facilityPhotos()
    {
        return $this->hasMany(FacilityPhoto::class);
    }
}
