<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class CrudController extends Controller
{
    public function getRecordForm(Request $request)
    {
        $users = User::all();

        return view('page.record', compact('users'));
    }


    public function getCreateForm()
    {
        return view('page.create');
    }
    public function postCreateForm(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed'],
            'photo' => ['sometimes', 'file', 'image', 'mimes:jpeg,png,jpg']
        ]);



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $request->photo,
        ]);


        // Upload image here
        $photo = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('pictures'), $photo);


        Auth::login($user);

        return redirect('/record')->withSuccess('User created.');
    }

    public function getEditForm($id)
    {
        $users = User::where('id', $id)->first();
        return view('page.editrecord', compact('users'));
    }

    public function postEditForm($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'photo' => 'sometimes'
        ]);

        $users = User::find($id);
        $users->update($request->only('name', 'email', 'photo'));

        return redirect('/edit/{id}')->withSuccess('Updated Successfully');
    }

    public function getDelete($id)
    {
        $users = User::where('id', $id)->first();
        $users->delete();
        return back()->withSuccess('Deleted successfully');
    }

    public function getRoleForm()
    {
        $users = User::all();
        return view('page.roles', compact('users'));
    }




    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->role = $request->input('role');
        $user->save();

        return redirect()->route('page.role')->with('success', 'Role updated successfully');
    }
}
