<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mitras;
use App\Models\Educations;
use App\Models\Subdistricts;
use App\Models\User;
use App\Models\Villages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('mitra.mitra-view');
    }

    public function edit()
    {
        $mitra = Mitras::where('email', Auth::user()->email)->first();
        return view(
            'mitra.mitra-edit',
            compact('mitra'),
            [
                'educations' => Educations::all(),
                'subdistricts' => Subdistricts::all()
            ]
        );
    }
    public function getVillage($id)
    {
        return json_encode(Villages::where('subdistrict', $id)->get());
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'sex' => 'required',
            'education' => 'required',
            'birthdate' => 'required',
            'profession' => 'required',
            'address' => 'required',
            'village' => 'required',
            'subdistrict' => 'required'
        ]);

        $path = '';
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $path = $image->store('images', 'public');
        }

        $mitra = Mitras::where('email', $id)->first();
        $data = ([
            'email' => $request->email,
            'name' => $request->name,
            'nickname' => $request->nickname,
            'sex' => $request->sex,
            'photo' => $path == '' ? $mitra->photo : $path,
            'education' => $request->education,
            'birthdate' => $request->birthdate,
            'profession' => $request->profession,
            'address' => $request->address,
            'village' => $request->village,
            'subdistrict' => $request->subdistrict
        ]);
        $mitra->update($data);

        $user = User::where('email', $id)->first();
        if ($user == null) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => '',
                'avatar' => $mitra->photo
            ]);
        } else {
            $data = ([
                'email' => $request->email,
                'name' => $request->name,
                'avatar' => $mitra->photo,
            ]);
            $user->update($data);
        }
        
        return redirect('/mitra-view')->with('success-create', 'Data Mitra telah direkam!');
    }
    public function show()
    {
        $mitra = Mitras::where('email', Auth::user()->email)->first();
        return view('mitra.mitra-view', compact('mitra'));
    }
}
