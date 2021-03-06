<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Image;

class UploadFileController extends Controller
{

    /**
     * Show the form to upload image.
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
    {
        return view('image-upload');
    }

    /**
     * Store a newly upload image in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// Validate given image
        $request->validate([
			'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

		// Set current time as filename
		$imageName = time().'.'.$request->image->extension();

		// Create Image Folder if not exists
		$path = public_path('/images');
		File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

		// Save image in storage folder
		$imagePathWithFileName =  $request->image->storeAs('public/images', $imageName); 
 
		// Store image's record in table
        $image = new Image;
        $image->name = $imageName;
        $image->path = $imagePathWithFileName;
        $image->save();
		
		// Redirect to same view with required data
		return redirect()
			->route('image.index')
			->with('status', 'Image uploaded successfully.')
			->with('id', $image->id);
    }
}
