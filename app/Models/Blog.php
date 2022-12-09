<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class Blog
 * @package App\Models
 * @mixin Builder
 */
class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $appends = ['image_full_path','short_content'];

    public function getImageFullPathAttribute(){
        return $this->image != null ? asset('storage/'.$this->image) : null;
    }

    public function getShortContentAttribute(){
        return $this->content != null ? $this->shortenText($this->content,30) : null;
    }

    function shortenText($text,$chars_limit){

        if (Str::length($text) > $chars_limit)
        {
            $new_text = Str::substr($text, 0, $chars_limit);
            $new_text = trim($new_text);
            return $new_text . "...";
        }
        return $text;
    }
}
