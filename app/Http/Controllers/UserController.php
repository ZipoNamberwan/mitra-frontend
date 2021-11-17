<?php

namespace App\Http\Controllers;

use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Style\Alignment;
use \PhpOffice\PhpSpreadsheet\Style\Border;
use App\Http\Controllers\Controller;
use App\Models\Mitras;
use App\Models\Educations;
use App\Models\PhoneNumbers;
use App\Models\Subdistricts;
use App\Models\Villages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mitra.mitra-index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mitra.mitra-create', [
            'educations' => Educations::all(),
            'subdistricts' => Subdistricts::all(),
            'code' => sprintf("%05s", count(Mitras::withTrashed()->get()) + 1),
        ]);
    }
    public function getVillage($id)
    {
        return json_encode(Villages::where('subdistrict', $id)->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'phone' => 'required',
            'code' => 'required',
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

        $mitra = Mitras::create([
            'email' => $request->email,
            'code' => $request->code,
            'name' => $request->name,
            'nickname' => $request->nickname,
            'sex' => $request->sex,
            'photo' => $path,
            'education' => $request->education,
            'birthdate' => $request->birthdate,
            'profession' => $request->profession,
            'address' => $request->address,
            'village' => $request->village,
            'subdistrict' => $request->subdistrict

        ]);

        PhoneNumbers::create([
            'phone' => $request->phone,
            'is_main' => true,
            'mitra_id' => $mitra->email
        ]);

        return redirect('/mitras')->with('success-create', 'Data Mitra telah direkam!');
    }
}
