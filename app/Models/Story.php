<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Image;
use Johntaa\Arabic\I18N_Arabic;

class Story extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id'
    ];

    /**
     * Return Created At as ForHumen
     */
    public function saveTextStory()
    {
        $txt = 'من أفضل ماقرأت في اللغه أنك تستطيع فعل اي شئ تريده مادمت تتمتع بالصحة والعافية';

        $Arabic = new I18N_Arabic('Glyphs');

        $txt = $Arabic->utf8Glyphs($txt);

        Image::canvas(500, 500, '#635D92')
            ->text($txt, 250, 100, function ($font) {
                $font->file('vendors/fonts/arial/ArialUnicodeMS.ttf');
                $font->size(20);
                $font->color('#ffffff');
                $font->align('center');
                $font->valign('middle');
            })
            ->save('uploads/' . 'my.jpg');
    }

    /**
     * User who owner the Post
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * Items that belongs to this story
     */
    public function items()
    {
        return $this->hasMany('App\Models\StoryItem', 'story_id', 'id');
    }

}
