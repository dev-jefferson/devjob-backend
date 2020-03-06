<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'name',
        'original_name',
        'size',
        'type',
        'extension',
        'path',
        'disk',
    ];

    protected $hidden = [
        'fileable_type', 'fileable_id', 'created_at', 'updated_at'
    ];

    public function fileable()
    {
      return $this->morphTo();
    }
}
