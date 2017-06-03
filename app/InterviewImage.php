<?php

namespace App;

use Image;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Interview;

class InterviewImage extends Model
{
    protected $fillable = [
        'interview_id',
        'filename',
        'filepath',
        'thumbnail_filepath',
        'caption'
    ];

    protected $table = 'interview_images';

    # Base directory for uploaded trip photos.
    protected $baseUploadDir = 'uploads/interviews';

    protected $file;

    /**
     * A interview image belongs to a interview.
     *
     * @return Response
     */
    public function interview() {
        return $this->belongsTo('App\Interview');
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
        return sprintf("%s/%s", $this->baseUploadDir, $filename);
    }

    protected function thumbnail_filepath($filename) {
        return sprintf("%s/tn-%s", $this->baseUploadDir, $filename);
    }

    /**
     * Move the image to the proper folder.
     *
     * @param  Request  $request
     * @return Response
     */
    public function upload()
    {
        $this->file->move($this->baseUploadDir, $this->filename);

        Image::make($this->filepath)->fit(200)->save($this->thumbnail_filepath);

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
