<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Task;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('lang', ['except' => ['getIndex', 'getAdmin']]);
    }

    private function getLatestOpenTasks()
    {
        return Task::where('is_visible', true)
            ->where('status', 0)
            ->latest()
            ->take(5)
            ->get();
    }

    public function getIndex()
    {
        $tasks = $this->getLatestOpenTasks();
        return view('pages.index', compact('tasks'));
    }

    public function getIndexLang()
    {
        $tasks = $this->getLatestOpenTasks();
        return view('pages.index', compact('tasks'));
    }

    public function getBoard()
    {
        $tasks = Task::where('is_visible', true)
            ->latest()
            ->paginate(10);
        return view('pages.board', compact('tasks'));
    }

    public function getAdmin()
    {
        return view('pages.admin');
    }

    public function getRules()
    {
        return view('pages.rules');
    }

    public function getInstructions()
    {
        return view('pages.instructions');
    }

    public function getFaq()
    {
        return view('pages.faq');
    }

    public function getAbout()
    {
        return view('pages.about');
    }

    public function getContactUs()
    {
        return view('pages.contact-us');
    }

    public function getPartnership()
    {
        return view('pages.partnership');
    }

}
