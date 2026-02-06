<?php

namespace App\Models;

use Eloquent as Model;
use App\Models\Facility;
use App\Helpers\ImageUploaderTrait;


/**
 * Class FacilityPhoto
 * @package App\Models
 * @version September 1, 2020, 1:14 pm UTC
 *
 * @property string $photo
 */
class FacilityPhoto extends Model
{
    use ImageUploaderTrait;

    public $table = 'facility_photos';

    public $fillable = [
        'facility_id',
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
        "facility_id" => "required",
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
