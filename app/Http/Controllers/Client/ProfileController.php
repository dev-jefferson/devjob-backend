<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return response()->json($user);
    }


    public function getAvatar()
    {
        $user = Auth::user();
        $avatar = $user->avatar;

        if($user->avatar){
            $storage = Storage::disk($avatar->disk)->url($avatar->path);
        }else{
            $storage = null;
        }

        return $storage;
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        $fileImage = $request->file('avatar');

        $radonstr = (string) Str::random(16);
        $path = '/uploads/files/users/'.$user->id.'/images/';
        $fileName = 'avatar-'.$radonstr.'-'.time().'.'.$fileImage->getClientOriginalExtension();
        $filePath = $path.$fileName;
        $disk = env('FILESYSTEM_DRIVER', 'public');

        if ($fileImage) {

            $avatar = new File();
            if($user->avatar){
                $avatar = $user->avatar;
                Storage::disk($disk)->put($avatar->path, file_get_contents($fileImage), 'public');

            }else{
                Storage::disk($disk)->put($filePath, file_get_contents($fileImage), 'public');
            }

            $avatar->name = $avatar->name ? $avatar->name : $fileName;
            $avatar->original_name = $fileImage->getClientOriginalName();
            $avatar->size = $fileImage->getClientSize();
            $avatar->type = $fileImage->getMimeType();
            $avatar->extension = $fileImage->getClientOriginalExtension();
            $avatar->path = $avatar->path ? $avatar->path : $filePath;
            $avatar->disk = $disk;
            $avatar->fileable_id = $user->id;
            $avatar->fileable_type = "App\models\User";
            $avatar->save();

            // $user->avatar()->associate($avatar);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->contacts = $request->contacts;
        $user->addresses = $request->addresses;
        $user->linkedin = $request->linkedin;
        $user->git = $request->git;
        $user->save();

        $user->load('avatar');
        // dd($user->load('avatar'));
        return response()->json($user);

    }


    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
}
