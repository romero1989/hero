<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.site.home');
    }

    public function negado()
    {
        return view('layouts.site.negado');
    }

    public function download()
    {
        return view('layouts.page');
    }

    public function donate()
    {
        return view('layouts.page');
    }

    public function screenshots()
    {
        return view('layouts.page');
    }

    public function forum()
    {
        return view('layouts.page');
    }

    public function regras()
    {
        return view('layouts.page');
    }

    public function conta()
    {
        return view('layouts.site.conta');
    }

    public function guild()
    {
        return view('layouts.site.guild');
    }

    public function suporte()
    {
        return view('layouts.site.suporte.home');

    }
    public function suporte_novo()
    {
        return view('layouts.site.suporte.novo');

    }
}
