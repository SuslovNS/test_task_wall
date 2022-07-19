<?php

namespace App\Http\Controllers\Api;

use App\Models\Desk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class DeskController extends Controller
{

    public function index()
    {
        return response()->json(Desk::orderBy('created_at', 'desc')->paginate(20),200);

    }


    public function store(Request $request)
    {
        try{
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e){
            return response()->json(['error'=>true, 'message'=> $e->getMessage()], 401);
        }
        $rules = [
            'user_id' => 'required',
            'message'=>'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $desk = Desk::firstOrCreate($request->all());
        return response()->json($desk, 201);

    }


    public function destroy(Desk $desk)
    {

        //$user = auth()->user();
        $cur = now();
        try{
            $user = auth()->userOrFail();
        } catch (UserNotDefinedException $e){
            return response()->json(['error'=>true, 'message'=> $e->getMessage()], 401);
        }
        if ($desk->user_id == $user->id and (($desk->created_at->diffInDays($cur)) >= 0)) {
            $desk->delete();
            return response()->json('', 204);
        } else {
            return response()->json(['error'=>true, 'message'=> 'Вы не можете удалить этот пост'], 412);
        }
    }
}
