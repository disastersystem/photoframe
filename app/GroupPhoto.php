<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Group;

use Image;

class GroupPhoto extends Model
{
    protected $fillable = [
        'group_id',
        'filename',
        'filepath',
        'thumbnail_filepath',
        'width',
        'height'
    ];

    protected $table = 'group_images';

    # Base directory for uploaded group photos.
    protected $baseUploadDir = 'uploads/groups';

    protected $file;

    /**
     * A group photo belongs to a group.
     *
     * @return Response
     */
    public function group() {
        return $this->belongsTo('App\Group');
    }

    protected static function boot() {
        static::creating(function($photo) {
            return $photo->upload();
        });
    }

    public static function fromFile(UploadedFile $file) {
        $photo = new static;

        $photo->file = $file;
        
        $filename = $photo->filename();
        list($width, $height) = getimagesize($photo->file);

        # set properties and return instance
        return $photo->fill([
            'filename' => $filename,
            'filepath' => $photo->filepath($filename),
            'thumbnail_filepath' => $photo->thumbnail_filepath($filename),
            'width' => $width,
            'height' => $height
        ]);
    }

    protected function filename() {
        // use uniq_id instead?
        return time() . $this->file->getClientOriginalName();
    }

    protected function filepath($filename) {
        return sprintf(
            "%s/%s",
            $this->baseUploadDir . '/' . $filename, $filename
        );
    }

    protected function thumbnail_filepath($filename) {
        return sprintf(
            "%s/tn-%s",
            $this->baseUploadDir . '/' . $filename, $filename
        );
    }

    /**
     * Move the photo to the proper folder.
     *
     * @param  Request  $request
     * @return Response
     */
    public function upload()
    {
        $this->file->move(
            $this->baseUploadDir . '/' . $this->filename,
            $this->filename
        );

        Image::make($this->filepath)
            ->fit(500, 300)
            ->save($this->thumbnail_filepath);

        // exec(
        //     'magick ' .
        //     $this->filepath .
        //     ' -auto-orient' . # reads and resets the EXIF image profile setting 'Orientation'
        //     #' -resize 500x350^' . # minimum values of width and height given, aspect ratio preserved
        //     ' -gravity center' . # move to the center of image
        //     ' -crop 500x350+0+0 ' . # crop (from center) remains if image is larger than 500x350
        //     // ' -crop 500x350 ' .
        //     $this->thumbnail_filepath
        // );

        return $this;
    }

    /**
     * Delete a photo.
     *
     * @param  Request  $request
     * @return Response
     */
    public function delete() {
        /* delete the files on the filesystem */
        \File::delete([
            $this->filepath,
            $this->thumbnail_filepath
        ]);

        /* delete from database */
        parent::delete();
    }

}
