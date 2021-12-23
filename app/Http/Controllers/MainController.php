<?php

namespace App\Http\Controllers;

use App\Models\Assessments;
use App\Models\Mitras;
use App\Models\Statuses;
use App\Models\Surveys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function showAssessment()
    {
        return view('survey.assessment');
    }

    public function home()
    {
        $mitra = Mitras::where('email', Auth::user()->email)->first();
        return view('survey.home', ['mitra' => $mitra]);
    }

    public function getSurveyList(Request $request)
    {
        $mitra = Mitras::find(Auth::user()->email);
        $surveys = $mitra->surveys;
        $recordsTotal = count($surveys);
        $recordsFiltered = $surveys->where('name', 'like', '%' . $request->search["value"] . '%')->count();

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
            $surveys = $surveys->filter(function ($q) use (
                $searchkeyword
            ) {
                return Str::contains(strtolower($q['name']), strtolower($searchkeyword));
            });
        }
        if ($orderDir == 'asc') {
            $surveys = $surveys->sortBy($orderColumn)->skip($request->start)
                ->take($request->length);
        } else {
            $surveys = $surveys->sortByDesc($orderColumn)->skip($request->start)
                ->take($request->length);
        }

        $surveysArray = array();
        $i = $request->start + 1;
        foreach ($surveys as $survey) {
            $surveyData = array();
            $surveyData["index"] = $i;
            $surveyData["name"] = $survey->name;
            $surveyData["phoneregistered"] = $survey->pivot->phone_survey;
            $status = Statuses::find($survey->pivot->status_id);
            $surveyData["status_id"] = $status->name;
            $surveyData["status_color"] = 'secondary';
            if ($status->id == 2) {
                $surveyData["status_color"] = 'success';
            } else if ($status->id == 3) {
                $surveyData["status_color"] = 'danger';
            }
            $surveysArray[] = $surveyData;
            $i++;
        }
        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $surveysArray
        ]);
    }

    public function getAssessmentData(Request $request)
    {
        $mitra = Mitras::find(Auth::user()->email);
        $surveys = $mitra->surveys;
        $recordsTotal = count($surveys);
        $recordsFiltered = $surveys->where('name', 'like', '%' . $request->search["value"] . '%')->count();

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
            $surveys = $surveys->filter(function ($q) use (
                $searchkeyword
            ) {
                return Str::contains(strtolower($q['name']), strtolower($searchkeyword));
            });
        }
        if ($orderDir == 'asc') {
            $surveys = $surveys->sortBy($orderColumn)->skip($request->start)
                ->take($request->length);
        } else {
            $surveys = $surveys->sortByDesc($orderColumn)->skip($request->start)
                ->take($request->length);
        }

        $surveysArray = array();
        $i = $request->start + 1;
        foreach ($surveys as $survey) {
            if ($survey->pivot->status_id == 2) {
                $surveyData = array();
                $surveyData["index"] = $i;
                $surveyData["name"] = $survey->name;
                $assessment = null;
                if ($survey->pivot->assessment_id != null) {
                    $assessmentRow = Assessments::find($survey->pivot->assessment_id);
                    $assessment = ($assessmentRow->cooperation + $assessmentRow->communication + $assessmentRow->dicipline + $assessmentRow->itskill + $assessmentRow->integrity) / 5;
                }
                $surveyData["rating"] = $assessment != null ? number_format((float)$assessment, 2, '.', '') : 'Belum Dinilai';
                $surveysArray[] = $surveyData;
                $i++;
            }
        }
        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $surveysArray
        ]);
    }

    public function getSurveyExperienceList(Request $request)
    {
        $mitra = Mitras::find(Auth::user()->email);
        $surveys = $mitra->surveys;
        $recordsTotal = count($surveys);
        $recordsFiltered = $surveys->where('name', 'like', '%' . $request->search["value"] . '%')->count();

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
            $surveys = $surveys->filter(function ($q) use (
                $searchkeyword
            ) {
                return Str::contains(strtolower($q['name']), strtolower($searchkeyword));
            });
        }
        if ($orderDir == 'asc') {
            $surveys = $surveys->sortBy($orderColumn)->skip($request->start)
                ->take($request->length);
        } else {
            $surveys = $surveys->sortByDesc($orderColumn)->skip($request->start)
                ->take($request->length);
        }

        $surveysArray = array();
        $i = $request->start + 1;
        foreach ($surveys as $survey) {
            if ($survey->pivot->status_id == 2) {
                $surveyData = array();
                $surveyData["index"] = $i;
                $surveyData["name"] = $survey->name;
                $surveys = Surveys::find($survey->pivot->survey_id);
                $surveyData["survey_id"] = $surveys->name;
                $surveyData["start_date"] = $surveys->start_date;
                $surveyData["end_date"] = $surveys->end_date;
                $surveysArray[] = $surveyData;
                $i++;
            }
        }
        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $surveysArray
        ]);
    }
}
