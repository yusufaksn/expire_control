<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{

    public $nowDate;
    public function __construct()
    {
        $this->nowDate = date('Y-m-d H:i:s');
    }

    public function store(Request $request)
    {
        if($request){
         $userId = DB::table('users')->insertGetId([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'created_at' => $this->nowDate,
                'expire_date' => $this->expireGetDay(),
                'status' => 1,
            ]);
        }
        if($userId){
            $this->insertUserAgent($userId);
        }

    }

    public function expireGetDay(){
       $day = DB::table('system_setting')->where([
          'key' => 'expire_limit_day'
        ])->first()->value;
        $addDayToDate = date('Y-m-d H:i:s', strtotime( $this->nowDate. ' + '.$day.' days'));
        return $addDayToDate;
    }

    private function insertUserAgent($userId){
        if($userId){
            DB::table('user_agent')->insert([
                'user_id' => $userId,
                'REMOTE_ADDR' => $this->GetIP(),
                'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'],
                'created_at' => $this->nowDate,
            ]);
            return true;
        }
    }


    private function GetIP($ip = null, $deep_detect = TRUE){
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }
        return $ip;
    }

    public function expireReport(){
      $data = DB::table('users')->get([
            'users.name',
            'users.expire_date',
            'users.created_at'
        ]);
      $array = [];
      foreach ($data as $value){
          if($this->nowDate > $value->expire_date){
                $result = "Access period expired";
          }else{
                $result = "Can Access";
          }
          $array[] = [
              'name' => $value->name,
              'result' => $result,
              'expire_date' => $value->expire_date,
              'created_at' => $value->created_at,
          ];
      }
      return response()->json($array);
    }

}
