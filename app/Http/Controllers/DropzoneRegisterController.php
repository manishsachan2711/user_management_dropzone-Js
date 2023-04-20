<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;



class DropzoneRegisterController extends Controller
{

    use RegistersUsers;
    protected $redirectTo = RouteServiceProvider::HOME;





	public function dropzoneform()
	{
		return view('dropzoneRegister');
	}


	public function storeInput(Request $request)
	{
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|max:255',
        ]);
		try {
			$user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $user_id = $user->id; // this give us the last inserted record id
		}
		catch (\Exception $e) {
			return response()->json(['status'=>'exception', 'message'=>$e->getMessage()]);
		}
		return response()->json(['status'=>"success", 'user_id'=>$user_id]);
	}



	// We are submitting are image along with userid and with the help of user id we are updateing our record
	public function storeImage(Request $request)
	{
        $this->validate($request, [
            'file' => 'required|mimes:jpg,jpeg,png,bmp,tiff',
        ]);
		if($request->file('file')){

            $img = $request->file('file');

            //here we are geeting userid alogn with an image
            $userid = $request->userid;

            $imageName = strtotime(now()).rand(11111,99999).'.'.$img->getClientOriginalExtension();
            $user_image = new User();
            $original_name = $img->getClientOriginalName();
            $user_image->profile_photo = $imageName;

            if(!is_dir(public_path() . '/uploads/images/')){
                mkdir(public_path() . '/uploads/images/', 0777, true);
            }

        $request->file('file')->move(public_path() . '/uploads/images/', $imageName);

        // we are updating our image column with the help of user id
        $user_image->where('id', $userid)->update(['profile_photo'=>$imageName]);
        if($user_image){
        Auth::loginUsingId($userid);
        }
        // return redirect()->route('login');

        return response()->json(['status'=>"success",'imgdata'=>$original_name,'userid'=>$userid]);
        }
	}

}
