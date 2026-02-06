<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Helpers\ImageUploaderTrait;


/**
 * Class Unique
 * @package App\Models
 * @version September 8, 2020, 8:11 am UTC
 *
 * @property string $photo
 */
class Unique extends Model implements TranslatableContract
{
    use SoftDeletes, ImageUploaderTrait, Translatable;

    public $table = 'uniques';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'photo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'photo' => 'string'
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
        $rules['photo'] = 'image|required';

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
}
