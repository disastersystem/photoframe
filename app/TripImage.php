<?php

namespace App;

// use Image;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Trip;

class TripImage extends Model
{
    protected $fillable = [
        'trip_id',
        'filename',
        'filepath',
        'thumbnail_filepath',
        'caption'
    ];

    protected $table = 'trip_images';

    # Base directory for uploaded trip photos.
    protected $baseUploadDir = 'uploads/trips';

    protected $file;

    /**
     * A trip image belongs to a trip.
     *
     * @return Response
     */
    public function trip() {
        return $this->belongsTo('App\Trip');
    }

    protected static function boot() {
        static::creating(function($photo) {
            return $photo->upload();
        });
    }

    public static function fromFile(UploadedFile $file) {
        $photo = new static;

        $photo->file = $file;
        $dimensions = $photo->file_dimensions($photo->file);
        $photo->width = $dimensions[0];
        $photo->height = $dimensions[1];
        $photo->ratio = $photo->file_ratio($dimensions);

        $filename = $photo->filename();

        # set properties and return instance
        return $photo->fill([
            'filename' => $filename,
            'filepath' => $photo->filepath($filename),
            'thumbnail_filepath' => $photo->thumbnail_filepath($filename)
        ]);
    }

    protected function filename() {
        return time() . $this->file->getClientOriginalName();
    }

    protected function filepath($filename) {
        return sprintf("%s/%s", $this->baseUploadDir . '/' . $filename, $filename);
    }

    protected function thumbnail_filepath($filename) {
        return sprintf("%s/tn-%s", $this->baseUploadDir . '/' . $filename, $filename);
    }

    protected function file_dimensions($file) {
        return getimagesize($file);
    }

    protected function file_ratio($dimensions) {
        return round( (($dimensions[1] / $dimensions[0]) * 100), 4 );
    }

    /**
     * Move the image to the proper folder.
     *
     * @param  Request  $request
     * @return Response
     */
    public function upload()
    {
        $this->file->move($this->baseUploadDir . '/' . $this->filename, $this->filename);

        // Image::make($this->filepath)->fit(200)->save($this->thumbnail_filepath);

        exec('convert ' . $this->filepath . ' -resize 500x350^ -gravity center -crop 500x350+0+0 ' . $this->thumbnail_filepath);
        // exec('convert ' . $this->filepath . ' -resize 1500x1500^ ' . $this->thumbnail_filepath);

        return $this;
    }

    /**
     * Delete a image.
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
