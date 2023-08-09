<?php

namespace App\Http\Controllers;

use App\Models\User;
Use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
     
    }
    
    public function loginPost2(Request $request)
    {
        // code untuk menerima request dari halaman login 
        $val = $request->username;
        $password = $request->password;

        // code untuk pengecekan ke db user apakah ada akun dengan username yang di inputkan tersebut

        $cekMail = User::where('username',$val)->first();
   
            // if disini artinya jika pengecekan tidak kosong maka akan jalankan code di dalam if tersebut 
            if($cekMail != null){
                
                // disini juga melakukan pengecekan apakah akun tersebut sudah di approve atau belum dari sisi admin 
                if ($cekMail->approval == 'Pending') {
                    // jika status approval nya masih pending maka user tersebut tidak akan bisa masuk ke dashboard..akan langsung diarahkan ke halaman login sebelumnya
                    // return redirect()->back() ini artinya kembalikan ke halaman sebelumnya dengan msg akunmu belum disetujui
                    return redirect()->back()->with(['success' => 'Akunmu belum disetujui']);
                }elseif ($cekMail->approval == 'Not Approve') {
                    // jika status approval nya Not Approve maka user tersebut tidak akan bisa masuk ke dashboard..akan langsung diarahkan ke halaman login sebelumnya
                    // return redirect()->back() ini artinya kembalikan ke halaman sebelumnya dengan msg akunmu tidak disetujui
                    return redirect()->back()->with(['success' => 'Akunmu tidak disetujui']);
                }elseif ($cekMail->approval == 'Approve' ) {
                     // jika status approval nya Approve maka user tersebut dapat masuk ke dashboard
                    // return redirect()->back() ini artinya kembalikan ke halaman sebelumnya dengan msg akunmu belum disetujui

                    // $credentials ini untuk menampung username dan password user tersebut 
                    $credentials = ([
                        'username' => $val,
                        'password' => $password,
                    ]);

                    // kemudian disini kita jalankan perintah if Auth::attempt($credentials) yang artinya jika username dan password tersebut valid akan langsung di login kan oleh sistem 
                    
                    if (Auth::attempt($credentials)) {
                        // disini user akan di masukan ke halaman dashboard melalui code redirect()->route('dashboard.index') 
                        // route route('dashboard.index') ini code nya ada di file web.php 
                            return redirect()->route('dashboard.index');
                    }
                }
        
                // disini jika pengecekan diatas bernilai kosong maka akan langsung diarahkan ke halaman sebelumnya atau halaman login dengan msg no credentials 
            }elseif ($cekMail == null ){
                return redirect()->back()->with(['success' => 'No Credentials']);
            }
     
    }


    // disini fungsi untuk mengatur data dan view list management user 
    public function index()
    {
        $data['page_title'] = 'Users List';
        $data['breadcumb'] = 'Users List';
        // disini code untuk get all data user dari table users 
        $data['users'] = User::orderby('id', 'asc')->get();

        // disini kita return view data yang sudah kita get 
        return view('users.index', $data);
    }

    // disini adalah fungsi untuk mengatur halaman create data management user 
    public function create()
    {
        $data['page_title'] = 'Add Users';
        $data['breadcumb'] = 'Add Users';
        // disni kita lakukan get dara role dengan mengambil column name nya saja untuk input select role
        $data['roles'] = Role::pluck('name')->all();

        // disini kita return view data yang sudah kita get diatas 
        return view('users.create', $data);
    }

    // disini function untuk get data simpan data management user
    public function store(Request $request)
    {
        // disini kita lakukan validasi request dari form tambah user 
        // required|string|min:3 artinya wajib disini,harus string dan min 3 karakter 
        // required|unique:users,username|alpha_dash artinya harus di isi,username tidak boleh sama dengan yg lain,harus huruf kecil semua 
        // required|min:8 artinya harus di isi dan minimal 8 karakter 
        // nullable|image|mimes:jpeg,png,jpg,gif,svg artinya tidak wajib disini,harus gambar,format gambar harus jpeg,png,jpg,gif,svg 
        // required artinya harus di isi 
        $validateData = $request->validate([
            'name'   => 'required|string|min:3',
            'username'   => 'required|unique:users,username|alpha_dash',
            'email'   => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'role' => 'required',
         
        ]);

        // disini code untuk save data user 
        $user = new User();
        $user->name = $validateData['name'];
        $user->username = $validateData['username'];
        $user->email = $validateData['email'];
        $user->status = 'Approve';
       
        // disini untuk password kita hash terlebih dahulu
        // contohnya...kita inputkan password nya 12345678 maka ketika setelah di hash hasilnya akan  "hjEFWkberfhb2ui3rbui39010394801"
        $user->password = Hash::make($validateData['password']);

        // disini code untuk simpan gambar 
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            // disini kita bikin nama file gambar nya dengan format waktu dan extension dari gambar tersebut 
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/users/');
            $image->move($destinationPath, $name);
            $user->avatar = $name;
        }

        $user->save();
        $user->assignRole($validateData['role']);

        return redirect()->route('users.index')->with(['success' => 'User added successfully!']);
        
    }

    // disini fungsi untuk mengatur view edit data management user 
    public function edit($id)
    {
        $data['page_title'] = 'Edit User';
        $data['breadcumb'] = 'Edit User';
        // disini code  untuk get data user by id 
        $data['user'] = User::findOrFail($id);
        // disni kita lakukan get dara role dengan mengambil column name nya saja untuk input select role
        $data['roles'] = Role::pluck('name')->all();


        return view('users.edit', $data);
    }

    // DISINI FUNCTION UNTUK UPDATE DATA 
    public function update(Request $request, $id)
    {
        // disini kita lakukan validasi request dari form tambah user 
        // required|string|min:3 artinya wajib disini,harus string dan min 3 karakter 
        // required|unique:users,username|alpha_dash artinya harus di isi,username tidak boleh sama dengan yg lain,harus huruf kecil semua 
        // required|min:8 artinya harus di isi dan minimal 8 karakter 
        // nullable|image|mimes:jpeg,png,jpg,gif,svg artinya tidak wajib disini,harus gambar,format gambar harus jpeg,png,jpg,gif,svg 
        // required artinya harus di isi 
        $validateData = $request->validate([
            'name'   => 'required|string|min:3',
            'username'   => 'required|alpha_dash|unique:users,username,'.$id,
            'email'   => 'required|unique:users,email,'.$id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'role' => 'required',
        ]);

        // disni adalah code untuk update data user
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

        $user->save();
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($validateData['role']);

        return redirect()->route('users.index')->with(['success' => 'User edited successfully!']);
    }

    // disini adalah fungsi delete user 
    public function destroy($id)
    {
        // DB::transaction ini untuk handle terjadinya error 
        // jika image berhasil di hapus tetapi data tidak berhasil dihapus maka akan dilakukan rollback 
        DB::transaction(function () use ($id) {
            $user = User::findOrFail($id);
            if ($user->avatar) {
                $image_path = public_path('img/users/'.$user->avatar); // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }


            // code untuk delete data 
            $user->delete();
        });
        
        // jika berhasil delete akan di arahkan ke halaman list user dengan msg successfully 
        return redirect()->route('users.index')->with(['success' => ' successfully!']);
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
    
            // jika berhasil lakukan save data maka akan diarahkan ke halaman user edit dengan msg Password changed successfully
            return redirect()->route('users.edit', Auth::user()->id)->with('success', 'Password changed successfully!');
        } else {
            // jika gagal lakukan save data maka akan diarahkan ke halaman user edit dengan msg Password change failed
            return redirect()->route('users.edit', Auth::user()->id)->with('failed', 'Password change failed');
        }
    }
}
