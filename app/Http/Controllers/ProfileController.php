<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile.index');
    }

    public function store(Request $request){
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $imageName = null;
        
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,'.$userId, 'min:3', 'max:20', 'not_in:twitter,edit'],
            'email' => ['nullable','email', 'unique:users,email,'.$userEmail],
            'password' => ['required_unless:email,null']
        ]);

        
        if($request->email && $request->email !== $userEmail){
            if (!auth()->attempt(["email" => $userEmail, "password" => $request->password])) {
                return back()->with('message', 'Contraseña inválida');
            }
        }
        
        if($request->image){
            $image = $request->file('image');

            $imageName = Str::uuid() .".".$image->extension();

            $serverImage = Image::make($image);
            $serverImage->fit(1000, 1000);

            $path = public_path('profiles').'/'.$imageName;
            $serverImage->save($path);
        }

        $user = User::find($userId);
        $user->username = $request->username;
        $user->image = $imageName ?: auth()->user()->image;
        $user->email = $request->email ?: auth()->user()->email;
        $user->save();

        return redirect()->route('posts.index', $user->username);
    }
}
