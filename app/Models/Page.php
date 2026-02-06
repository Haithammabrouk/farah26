<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Helpers\ImageUploaderTrait;

class Page extends Model  implements TranslatableContract
{
    use SoftDeletes, ImageUploaderTrait, Translatable;

    public $table = 'pages';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'active',
        'photo',
        'linke',
        'in_navbar',
        'in_footer'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'active' => 'string',
        'photo' => 'string',
        'in_navbar' => 'string',
        'in_footer' => 'string'
    ];

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
        'name',
        'content',
        'slug'
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
            $rules[$language . '.content'] = 'required|min:3';
            $rules[$language . '.linke'] = 'min:3';
        }
        // $rules['photo'] = 'image|mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv';

        return $rules;
    }

    /**
     * Data Setter for value attribute
     */
    public function setPhotoAttribute($file)
    {
        if ($file) {
            $fileName = $this->createFileName($file);

            $mime = $file->getMimeType();

            if (strstr($mime, "image/")) {
                $this->originalImage($file, $fileName);
                $this->thumbImage($file, $fileName);
            } else {
                $this->saveFile($file, $fileName);
            }
            $this->attributes['photo'] = $fileName;
        }
    }

    public function getPhotoAttribute($val)
    {
        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png'];

        $explodeImage = explode('.', $val);
        $extension = end($explodeImage);

        if (in_array($extension, $imageExtensions)) {
            return $val ? asset('uploads/images/original') . '/' . $val : null;
        } else {
            return $val ? asset('uploads/files') . '/' . $val : null;
        }
    }

    /**
     * Gets metas for page
     *
     * @return Collection
     */
    public function metas()
    {
        return $this->hasMany('App\Models\Meta', 'page_id', 'id');
    }
}
