<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\User;
use App\Models\Question;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\QuestionResource;
class QuestionController extends Controller
{
    public function index(){
        $questions = Question::orderBy("id","desc")->get();
        return response()->json([
            'status' => true,
            'message' => 'الاسئله',
            'data' => QuestionResource::collection($questions)
            ]);
    }
}