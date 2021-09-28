<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
      'name',
      'description',
      'body',
      'main_image',
      'published_date',
      'is_published',
    ];

    const DISK_NAME = 'posts';

    public function saveImage($request) : void
    {
        if (!$request->has('main_image')) return;
        $this->removeImage();
        $name = uniqid().'.'.$request->file('main_image')->extension();
        Storage::disk(self::DISK_NAME)
            ->put($name, $request->file('main_image')->getContent());
        $this->update(['main_image' => $name]);
    }

    public function removeImage() : void
    {
        if (Storage::disk(self::DISK_NAME)->exists($this->main_image))
        {
            Storage::disk(self::DISK_NAME)->delete($this->main_image);
        }
    }

    public function getImageUrl()
    {
        return
            Storage::disk(self::DISK_NAME)->exists($this->main_image)
            ? Storage::disk(self::DISK_NAME)->url($this->main_image)
            : null;
    }

}
