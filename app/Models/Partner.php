<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Helpers\ImageUploaderTrait;


/**
 * Class Partner
 * @package App\Models
 * @version September 7, 2020, 3:18 pm UTC
 *
 * @property string $photo
 */
class Partner extends Model
{
    use ImageUploaderTrait;


    public $table = 'partners';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'photo',
        'url',
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
        'url' => "required",
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
