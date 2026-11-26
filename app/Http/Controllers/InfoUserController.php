<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class InfoUserController extends Controller
{
    public function create()
    {
        return view('profil.index', [
            'user' => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->ignore($user->id)],
            'email' => ['nullable', 'email', 'max:150', Rule::unique('users', 'email')->ignore($user->id)],
            'foto_profil' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'current_password' => ['nullable', 'required_with:password', 'string'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()
                    ->withInput()
                    ->with('error', 'Kata sandi saat ini tidak sesuai.');
            }
            $user->password = Hash::make($request->password);
        }

        if ($request->boolean('hapus_foto') && $user->foto_profil) {
            $oldPath = public_path($user->foto_profil);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
            $user->foto_profil = null;
        }

        if ($request->hasFile('foto_profil')) {
            $uploadDir = public_path('uploads/profil');
            if (!File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true);
            }

            if ($user->foto_profil) {
                $oldPath = public_path($user->foto_profil);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $file = $request->file('foto_profil');
            $filename = 'profil_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $user->foto_profil = 'uploads/profil/' . $filename;
        }

        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email ?: null;
        $user->save();

        return redirect()->route('profil.edit')->with('success', 'Pengaturan profil berhasil diperbarui.');
    }
}
