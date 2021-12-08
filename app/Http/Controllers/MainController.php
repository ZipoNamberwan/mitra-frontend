<?php

namespace App\Http\Controllers;

use App\Models\Mitras;
use App\Models\Statuses;
use App\Models\Surveys;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function register(Request $request)
    {
        //register logic here

    }

    public function profile()
    {
        $mitra = Mitras::where('email', Auth::user()->email)->first();
        return view('profile', compact('mitra'));
    }

    public function showAssessment()
    {
        return view('survey.assessment');
    }

    public function home()
    {
        $mitra = Mitras::where('email')->first();
        $surveys = Surveys::all();
        $now = new DateTime(date("Y-m-d"));
        $currentsurveys = [];
        foreach ($surveys as $survey) {
            $start = $survey->start_date;
            $end = $survey->end_date;

            $s =  new DateTime($start);
            $e =  new DateTime($end);
            if ($now >= $s && $now <= $e)
                $currentsurveys[] = $survey;
        }

        $mitras = Mitras::all();
        $data = [];

        $label = [];
        $total = [];

        foreach ($data as $key => $value) {
            $label[] = $key;
            $total[] = $value;
        }

        $label = json_encode($label);
        $total = json_encode($total);

        return view('survey.home', compact('mitra', 'currentsurveys'));
    }

    public function data(Request $request)
    {
        $survey = Mitras::find(Auth::user()->email);
        $mitras = $survey->surveys;
        $recordsTotal = count($mitras);
        $recordsFiltered = $mitras->where('name', 'like', '%' . $request->search["value"] . '%')->count();

        $orderColumn = 'name';
        $orderDir = 'desc';
        if ($request->order != null) {
            if ($request->order[0]['dir'] == 'asc') {
                $orderDir = 'asc';
            } else {
                $orderDir = 'desc';
            }
            if ($request->order[0]['column'] == '2') {
                $orderColumn = 'name';
            } else if ($request->order[0]['column'] == '3') {
                $orderColumn = 'email';
            }
        }
        $searchkeyword = $request->search['value'];
        if ($searchkeyword != null) {
            $mitras = $mitras->filter(function ($q) use (
                $searchkeyword
            ) {
                return Str::contains(strtolower($q['name']), strtolower($searchkeyword));
            });
        }
        if ($orderDir == 'asc') {
            $mitras = $mitras->sortBy($orderColumn)->skip($request->start)
                ->take($request->length);
        } else {
            $mitras = $mitras->sortByDesc($orderColumn)->skip($request->start)
                ->take($request->length);
        }

        $mitrasArray = array();
        $i = $request->start + 1;
        foreach ($mitras as $mitra) {
            $mitraData = array();
            $mitraData["index"] = $i;
            $mitraData["name"] = $mitra->name;
            $mitraData["email"] = $mitra->email;
            $mitraData["rating"] = $survey->avgrating();
            $surveys = Surveys::find($mitra->pivot->survey_id);
            $mitraData["survey_id"] = $surveys->name;
            $mitraData["start_date"] = $surveys->start_date;
            $mitraData["end_date"] = $surveys->end_date;
            $status = Statuses::find($mitra->pivot->status_id);
            $mitraData["status_id"] = $status->name;
            $mitraData["status_color"] = 'secondary';
            if ($status->id == 2) {
                $mitraData["status_color"] = 'success';
            } else if ($status->id == 3) {
                $mitraData["status_color"] = 'danger';
            }
            $mitraData["id"] = 'adams.leo@example.org';
            $mitrasArray[] = $mitraData;
            $i++;
        }
        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $mitrasArray
        ]);
    }
}
