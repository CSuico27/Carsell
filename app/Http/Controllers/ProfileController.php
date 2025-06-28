<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userInfo = User::with('cars')
            ->where('id', auth()->id())->first();
        return view('profile.index', compact('userInfo'));
    }

    public function edit(string $id)
    {
        $userInfo = User::with('cars')
            ->where('id', auth()->id())->first();
        return view('profile.edit', compact('userInfo'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'phone' => ['required', 'regex:/^09\d{9}$/'],
            'password' => ['required', 'min:6'],
            'image' => ['image', 'nullable', 'mimes:jpeg,png,jpg,PNG', 'max:2048']

        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => $request->input('password'),
        ]);

        if ($request->hasFile('image')) {
            if($user->profile_pic){
                Storage::disk('public')->delete('profile_images/' .$user->profile_pic);
            }

            $path = $request->file('image')->store('profile_images', 'public');
            $filename = basename($path);

            $user->update([
                'profile_pic' => $filename,
            ]);
        }

        return to_route('profile.index')->with('success', 'Successfully Edit the Profile Details');
    }
}
