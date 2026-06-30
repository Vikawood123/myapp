<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Главная страница
     */
    public function index()
    {
        return view('home.index');
    }

    /**
     * Страница контактов
     */
    public function contacts()
    {
        return view('home.contacts');
    }
}
