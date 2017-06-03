<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\TripImage;

class PhotoGalleryController extends Controller
{
    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {
        return view('admin.photo-gallery.index', [
            'trip_images' => TripImage::all()
        ]);
    }

}
