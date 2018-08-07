<?php
/**
 * Created by PhpStorm.
 * User: nathanael79
 * Date: 24/07/18
 * Time: 21:33
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view("/home");
    }
}