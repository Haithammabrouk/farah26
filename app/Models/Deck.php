<?php

namespace App\Models;

use Eloquent as Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Helpers\ImageUploaderTrait;

/**
 * Class Deck
 * @package App\Models
 * @version August 31, 2020, 3:34 pm UTC
 *
 * @property string $file
 */
class Deck extends Model implements TranslatableContract
{
    use Translatable, ImageUploaderTrait;

    public $table = 'decks';

    public $fillable = [
        'file',
        'other_file'
    ];

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
        'title',
        'content'
    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'file' => 'string'
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
            $rules[$language . '.content'] = 'required';
        }
        $rules['file'] = 'required';
        $rules['other_file'] = 'required';

        return $rules;
    }

    /**
     * Data Setter for value attribute
     */
    public function setFileAttribute($file)
    {
        if ($file) {
            $fileName = $this->createFileName($file);

            $this->originalImage($file, $fileName);

            $this->attributes['file'] = $fileName;
        }
    }

    public function getFileAttribute($val)
    {
        return $val ? asset('uploads/images/original') . '/' . $val : null;
    }

    public function setOtherFileAttribute($file)
    {
        if ($file) {
            $fileName = $this->createFileName($file);

            $this->originalImage($file, $fileName);

            $this->attributes['other_file'] = $fileName;
        }
    }

    public function getOtherFileAttribute($val)
    {
        return $val ? asset('uploads/images/original') . '/' . $val : null;
    }
}
