<?php

namespace App\Models;

use Eloquent as Model;
use App\Helpers\ImageUploaderTrait;
use App\Models\AdditionalTrip;

/**
 * Class AdditionalTripsPhotos
 * @package App\Models
 * @version September 1, 2020, 10:52 am UTC
 *
 * @property string $photo
 */
class AdditionalTripsPhotos extends Model
{
    use ImageUploaderTrait;

    public $table = 'additional_trips_photos';

    public $fillable = [
        'additional_trip_id',
        'photo',

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
        "additional_trip_id" => "required",
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
    public function additionalTrip()
    {
        return $this->belongsTo(\App\Models\AdditionalTrip::class);
    }
}
