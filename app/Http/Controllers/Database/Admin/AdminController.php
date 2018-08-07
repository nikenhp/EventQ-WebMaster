<?php
/**
 * Created by PhpStorm.
 * User: nathanael79
 * Date: 25/07/18
 * Time: 1:59
 */

namespace App\Http\Controllers\Database\Admin;


use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('Database.Admin.admin');
    }

}