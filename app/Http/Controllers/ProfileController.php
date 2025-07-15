<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfilePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show profile
     */
    public function index(Request $request)
    {
        $pageTitle = 'Pengaturan Akun';
        $user = auth()->user();
        return view('pages.profile.index', compact('user', 'pageTitle'));
    }

    /**
     * Update profile
     */
    public function update(UpdateProfileRequest $request)
    {
        try {
            DB::beginTransaction();

            $request->user()->update([
                ...$request->only(['name', 'email', 'phone_number'])    
            ]);

            // Upload profile picture
            if ($file = $request->file('profile_picture')) {
                $url = $file->storePubliclyAs('media', $file->hashName(), 'public');

                // Delete old file if exist
                if ($oldImage = $request->user()->profile_picture) {
                    Storage::disk('public')->exists($oldImage) && Storage::disk('public')->delete($oldImage);
                }

                $request->user()->update([
                    'profile_picture' => $url
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil memperbarui data');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadik kesalhan pada server');
        }
    }

    /**
     * Update password
     */
    public function updatePassword(UpdateProfilePasswordRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();
            $user = $request->user();

            if (!Hash::check($data['current_password'], $user->password)) {
                return redirect()->back()->with('error', 'Kata sandi lama Anda tidak sesuai');
            }

            $user->update([
                'password' => Hash::make($data['new_password'])
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil merubah kata sandi');
        } catch (Exception $error) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi kesalahan pada server');
        }
    }
}
