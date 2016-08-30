<?php 

namespace App\Http\Controllers\Api\Admin;

use App\User;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function __construct()
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function all()
    {
        return User::all();
    }

    public function uploadAvatar()
    {
        $avatarPath = $this->saveImageToLocal('avatar', 350);

        $user = \Auth::user();
        $user->avatar = $avatarPath;
        $user->save();

        return $avatarPath;
    }

    public function uploadImage()
    {
        $imagePath = $this->saveImageToLocal('topic', 1440);
        
        return $imagePath;
    }

    private function saveImageToLocal($type, $resize)
    {
        if ($file = \Request::file('file')) {
            
            $allowed_extensions = ["png", "jpg", "gif"];
            if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
                return ['error' => 'You may only upload png, jpg or gif.'];
            }

            $folderName = ($type == 'avatar') ? 'uploads/avatars' : 'uploads/images/' . date("Ym", time()) .'/'.date("d", time()) .'/'. \Auth::user()->id;

            $destinationPath = public_path() . '/' . $folderName;

            $extension = $file->getClientOriginalExtension() ?: 'png';
            $safeName  = uniqid().'.'.$extension;
            $file->move($destinationPath, $safeName);
            $filePath = $folderName.'/'.$safeName;

            return $filePath;
        } else {
            return ['error' => 'Error while uploading file'];
        }
    }
}
