<?php

namespace App\Http\Controllers;

use App\Models\Event;

class HomeController extends Controller
{
    /**
     * Exibe a página inicial com uma lista paginada de eventos.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $events = Event::orderBy('event_date', 'desc')->paginate(10);
        return view('home', compact('events'));
    }
}
