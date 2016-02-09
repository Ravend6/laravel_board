<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DealMessage;
use App\Task;
use App\Proposition;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('lang');
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function indexDeal()
    {
        $userId = \Auth::user()->id;
        $dealMessages = Proposition::where('user_executant_id', $userId)
            ->latest()
            ->get();
        $acceptDealMessages = Proposition::where('user_executant_id', $userId)
            ->where('is_confirmed', 1)
            ->latest()
            ->get();
        $processDealMessages = Proposition::where('user_executant_id', $userId)
            ->where('is_confirmed', 0)
            ->latest()
            ->get();
        $dissmisDealMessages = Proposition::where('user_executant_id', $userId)
            ->where('is_confirmed', 2)
            ->latest()
            ->get();

        return view('message.deal', compact(
            'dealMessages',
            'acceptDealMessages',
            'processDealMessages',
            'dissmisDealMessages'
        ));
    }

    public function indexTask()
    {
        $userId = \Auth::user()->id;
        $tasks = Task::where('user_customer_id', $userId)
            ->latest()
            ->get();

        return view('message.task', compact('tasks'));
    }

    public function showDeal($lang, $dealId)
    {
        $deal = Task::findOrFail($dealId);

        return view('message.deal_show', compact('deal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
