<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function getQuestionDoughnutByAnswered()
    {
        $answeredQuestions = Question::where('is_answered', 1)->count();
        $unansweredQuestions = Question::where('is_answered', 0)->count();
        return [
            'answered' => $answeredQuestions,
            'unanswered' => $unansweredQuestions
        ];
    }

    public function getQuestionDoughnutByStatus()
    {
        $questions = Question::get();
        return [
            'active' => $questions->where('status', 'active')->count(),
            'pending' => $questions->where('status', 'pending')->count(),
            'inactive' => $questions->where('status', 'inactive')->count(),
            'denied' => $questions->where('status', 'denied')->count(),
            'in_revision' => $questions->where('status', 'in-revision')->count(),
        ];
    }

    public function getSearch(Request $request)
    {
        $questions = [];
        if($request->key != ""){
            if($request->type == "id"){
                $questions = Question::where('id', $request->key)->get();
            }elseif($request->type == "title"){
                $questions = Question::where('title','like', "%".$request->key."%")->get();
            }elseif($request->type == 'status'){
                $questions = Question::where('status', $request->key)->get();
            }
        }
        return $questions;
    }

    public function getAnswerStat(Request $request)
    {
        $dates = $this->formatDate($request->fromDate, $request->toDate);
        $data = [];
        $answers = DB::table('answers')
            ->whereDate('created_at', '>=', $dates['fromDate']->format('Y-m-d'))
            ->whereDate('created_at', '<=', $dates['toDate']->format('Y-m-d'))
            ->get();
        foreach ($answers->groupBy('status') as $status => $ansStatus) {
            $data[] = ['status' => $status, 'count' => $ansStatus->count()];
        }
        return $data;
    }

    private function formatDate(string $fromDate, string $toDate)
    {
        $formatedDates['fromDate'] = Carbon::parse($fromDate);
        $formatedDates['toDate'] = Carbon::parse($toDate);
        if ($formatedDates['toDate']->greaterThan(Carbon::today())) {
            $formatedDates['toDate'] = Carbon::today();
        }
        return $formatedDates;
    }
}
