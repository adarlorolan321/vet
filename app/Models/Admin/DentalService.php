<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DentalService extends Model  implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        "name","description","duration","price", "photo"
    ];

    public function getImagesAttribute()
    {

        $medias = $this->getMedia('services');
        $images = [];

        foreach ($medias as $media) {
            $images[] = $media ? array_merge($media->toArray(), [
                'url' => $media->getUrl(),
                'src' => $media->getUrl(),
                'path' => $media->getUrl(),
                'preview_url' => $media->getUrl(),
            ]) : null;
        }
    
        return $images;
    }

   
}
