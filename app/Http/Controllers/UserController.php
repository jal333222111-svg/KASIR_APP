<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        confirmDelete('Hapus User','Apakah anda yakin menghapus user ini?');
        return view('users.index', compact('users'));
    }

    public function store(Request $request){
        $id = $request->id;
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' .$id,
        ],[
            'name.required' => 'Nama Harus Diisi',
            'email.required' => 'Email Harud Diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah tersedia',
            ]);

            $newRequest = $request->all();

            if(!$id) {
                $newRequest['password'] = Hash::make('12345678');
            }

            User::updateOrCreate(['id'=>$id], $newRequest);
            toast()->success('User berhasil di simpan');
            return redirect()->route('users.index');
    }

    public function gantiPassword(Request $request){
        $request->validate([
            'old_password'=> 'required',
            'password' => 'required|min:8|confirmed',
        ],[
            'old_password.required' => 'Password lama harus di isi',
            'password.required' => 'Password baru harus di isi',
            'password.min' => 'Password baru minimal 8 karakter',
            'password.confirmed' => 'Password baru tidak sama dengan konfirmasi password',
        ]);

        $user = User::find(Auth::id());

        //check old password
        if(!Hash::check($request->old_password, $user->password)){
            toast()->error('Password lama tidak sesuai');
            return redirect()->route('users.index');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        toast()->success('Password berhasil diubah');
        return redirect()->route('dashboard');
    }

    public function destroy(String $id){
        $user = User::find($id);
        
        if (Auth::id()==$id){
            toast()->error('Tidak dapat menghapus akun yang sedang login');
            return redirect()->route('users.index');
        }

        $user->delete();
        toast()->success('User berhasil di hapus');
        return redirect()->route('users.index');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id', // pastikan id valid
        ]);

        $user = User::findOrFail($request->id);

        $user->update([
            'password' => Hash::make('12345678'), // password default baru
        ]);

        // Jika pakai package realrashid/sweet-alert
        toast('Password berhasil direset', 'success');

        return redirect()->route('users.index');
    }

}


