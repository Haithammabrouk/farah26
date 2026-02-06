<?php

namespace App\Models;

use Eloquent as Model;
use App\Helpers\ImageUploaderTrait;

/**
 * Class SliderPhoto
 * @package App\Models
 * @version September 10, 2020, 4:08 pm UTC
 *
 * @property string $photo
 */
class SliderPhoto extends Model
{
    use ImageUploaderTrait;

    public $table = 'slider_photos';

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
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        "photo" => "required|image",
    ];

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
