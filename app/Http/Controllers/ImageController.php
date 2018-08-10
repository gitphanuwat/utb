<?php

namespace App\Http\Controllers;

use App\Logic\Image\ImageRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use App\Models\Image;

class ImageController extends Controller
{
    protected $image;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->image = $imageRepository;
    }

    public function getUpload()
    {
        return view('pages.upload');
    }

    public function postUpload()
    {
        $form_data = Input::all();
        //$response = $this->image->upload($photo);
        //return $response;

        $file_id = $form_data['file_id'];
        $image = $form_data['file'];
        $originalName = $image->getClientOriginalName();
        $imageName = time().$originalName;
        $uploaded = $image->move(public_path('files'),$imageName);
        if($uploaded){
            $sessionImage = new Image;
            $sessionImage->file_id      = $file_id;
            $sessionImage->filename      = $imageName;
            $sessionImage->original_name = $originalName;
            $sessionImage->save();
        }
        //return response()->json(['success'=>$imageName]);

        return Response()->json([
            'success' => $imageName,
            'error' => false,
            'code'  => 200,
            'filename' => $imageName
        ], 200);

    }

    public function deleteUpload()
    {
        $filename = Input::get('id');

        if(!$filename)
        {
            return 0;
        }

        $response = $this->image->delete( $filename );

        return $response;
    }

    public function getServerImagesPage()
    {
        return view('pages.upload-2');
    }

    public function getServerImages($id)
    {
        //$images = Image::get(['original_name', 'filename']);
        $images = Image::where('file_id', $id)->get();

        $imageAnswer = [];

        foreach ($images as $image) {
            $imageAnswer[] = [
                'original' => $image->original_name,
                'server' => $image->filename,
                'size' => File::size(public_path('files/' . $image->filename))
            ];
        }

        return response()->json([
            'images' => $imageAnswer
        ]);
    }
}
