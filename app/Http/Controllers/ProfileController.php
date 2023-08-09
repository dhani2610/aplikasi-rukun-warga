<?php

namespace App\Http\Controllers;

use App\Models\User;

Use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:profile', ['only' => 'index']);
        $this->middleware('permission:profile-edit', ['only' => ['edit','update']]);
    }

    // disni untuk mengatur data yang ada di view 
    public function index()
    {
        $data['page_title'] = 'Profile';
        $data['breadcumb'] = 'Profile ';
        // disini kita get data user data profile tersebut 
        $data['users'] = User::where('id', auth()->user()->id)->get();

        $data['roles'] = Role::pluck('name')->all();
        
     
        return view('profile.index', $data);
    }


    public function edit($id)
    {
        $data['page_title'] = 'Edit Profile';
        $data['breadcumb'] = 'Edit Profile';
        $data['user'] = User::findOrFail($id);
        $data['roles'] = Role::pluck('name')->all();
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name'   => 'required|string|min:3',
            'username'   => 'required|alpha_dash|unique:users,username,'.$id,
            'email'   => 'required|unique:users,email,'.$id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'role' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $validateData['name'];
        $user->username = $validateData['username'];
        $user->email = $validateData['email'];
   
        // disini adalah code untuk iamge
        
         if ($request->hasFile('avatar')) {
            // Delete Img
            // karna disini adalah update data...data image yg lama harus di hapus dahulu jika user nya melakukan update data avatar

            if ($user->avatar) {
                $image_path = public_path('img/users/'.$user->avatar); // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    // jika gambar tersedia maka lakukan delete data 
                    File::delete($image_path);
                }
            }
            
            // disini kita lakukan simpan gambar ke storage img/users/
            $image = $request->file('avatar');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/users/');
            $image->move($destinationPath, $name);
            $user->avatar = $name;
        }

        // disini code untuk simpan data 

        $user->save();
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($validateData['role']);


        // jika data berhasil di save maka  akan reedirect ke halaman profile dengan msg Profile edited successfully 
        return redirect()->route('profile.index')->with(['success' => 'Profile edited successfully!']);
    }

    // disini fungsi untuk change password 
    public function changePassword(Request $request)
    {
        // disini kita lakukan validasi request dari view 
        $validateData = $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        $user = User::findOrFail(Auth::user()->id);
        // disini kita lakukan pengecekan apakah password valid
        if (Hash::check($validateData['password'], $user->password)) {
            // jika valid maka akan lakukan hash password baru 
            $user->password = Hash::make($request->get('new_password'));
            // kemudian lakukan save data 
            $user->save();
           
            // jika berhasil lakukan save data maka akan diarahkan ke halaman login dengan msg Password changed successfully
            return redirect()->route('user.login', Auth::user()->id)->with('success', 'Password changed successfully!');
        } else {
            // jika gagal lakukan save data maka akan diarahkan ke halaman profile edit dengan msg Password change failed
            return redirect()->route('profile.index', Auth::user()->id)->with('failed', 'Password change failed');
        }
    }

}
