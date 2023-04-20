<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $this->page_vars['user'] = Auth::user();
        return $this->renderView('profile.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect('admin/profile/edit')->with('errors', $validator->errors());
            }
            $input = $request->all();
            $user = Auth::user()->id;
            $data = [
                'name' => $input['name'],
                'email' => $input['email'],
            ];

            if ($request->file('profile_image')) {
                $data['profile_photo'] = $request->file('profile_image')->storePublicly('profileImages', 'public');
            }
            if($request->password && $request->confirm_password)
            {
                if($request->password===$request->confirm_password){
                $data['password'] =Hash::make($request->password);
                }else{
                    // dd('manish');
                    return redirect('admin/profile/edit')
                    ->with('errors', 'Password and confirm password not matched');
                }
            }
           //dd($data);
            $model = User::where('id', $user)->update($data);
            if ($model) {
                return redirect('admin/profile/edit')
                    ->with('success', 'Profile Update successfully.');
            } else {
                return redirect('admin/profile/edit')
                    ->with('errors', 'Something went wrong.');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('profile.edit')->with('errors', $e->getMessage());
        }
    }

    protected function welcome()
    {
        return $this->renderView('welcome');
    }

    protected function renderView($view_name = 'page_not_found', $end = 'admin')
    {
        $this->page_vars['page_title'] = $this->getPageTitle();
        return parent::renderView($view_name, $end);
    }
}
