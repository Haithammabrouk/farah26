<?php

namespace App\Models;

use Eloquent as Model;
use App\Helpers\ImageUploaderTrait;

/**
 * Class GalleryPhoto
 * @package App\Models
 * @version August 23, 2020, 7:32 pm UTC
 *
 * @property \App\Models\Gallery $gallery
 * @property integer $gallery_id
 * @property string $photo
 */
class GalleryPhoto extends Model
{
    use ImageUploaderTrait;

    public $table = 'gallery_photos';

    public $fillable = [
        'gallery_id',
        'photo',
        'url',
        'is_home',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'gallery_id' => 'integer',
        'photo' => 'string',
        'url' => 'string',
        'is_home' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        "gallery_id" => "required",
        "photo" => "required_without:url|image",
        "url" => "required_without:photo",
        'is_home' => 'required|in:0,1'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function gallery()
    {
        return $this->belongsTo(\App\Models\Gallery::class);
    }
}
