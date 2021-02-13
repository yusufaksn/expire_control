<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurcHaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productList = [
          'type' => 'mobile_phone',
          'trademark' => 'iphone',
          'price' => '8.200'
        ];
        return response()->json($productList);
    }


}
