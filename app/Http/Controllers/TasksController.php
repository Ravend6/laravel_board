<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Task;
use App\DealMessage;
use App\Proposition;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('lang');
        $this->middleware('auth', ['only' => ['indexAccepted']]);
    }

    public function create()
    {
        $category_list = Category::lists('title', 'id');
        $categories = Category::where('is_visible', true)->get();

        return view('tasks.create', compact('category_list', 'categories'));
    }

    public function store(Requests\TaskRequest $request)
    {
        $task = new Task;

        $task->category_id = $request->category_id;
        $task->title = $request->title;
        $task->slug = str_slug($request->title, '-');
        $task->description = $request->description;
        $task->price = $request->price ?: '0.00';
        if (\Auth::guest()) {
            $task->is_visible = false;
            $task->email = $request->email;
        } else {
            $task->is_visible = true;
            $task->user_customer_id = \Auth::user()->id;
        }
        $task->status = 0;
        $task->date_begin = $request->date_begin;
        $task->date_end = $request->date_end;
        $task->save();

        $task->slug = $task->id . '-' . $task->slug;
        $task->save();

        // upload image
        if ($request->image) {
            $destinationPath = base_path().config('app.uploads_tasks_path');

            $imageExt = $request->image->getClientOriginalExtension();
            $imageName = $task->id.'.'.$imageExt;
            $task->image = $imageName;
            $task->save();

            $request->image->move(
                $destinationPath.'/'.$task->id,
                $imageName
            );
        }

        if (\Auth::guest()) {
            return redirect('/' . App::getLocale() . '/auth/register' )
                ->withInput($request->only('name', 'email', 'phone', '_disabled'));
        } else {
            return redirect('/' . App::getLocale())
                ->with('flash_info', 'Task success created.');
        }
    }

    public function show($lang, Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function storeDeal(Request $request, $lang, Task $task, $userId, $propositionId)
    {
        $proposition = Proposition::findOrFail($propositionId);
        $this->authorize('createDeal', $task);

        if ($request->ajax()) {
            $task->user_executant_id = $userId;
            // $task->is_confirmed = 1;
            $task->status = 1; // closed
            $task->save();

            $proposition->is_confirmed = 1;
            $proposition->save();

            foreach ($task->propositions as $prop) {
                if ($prop->id != $propositionId) {
                    $prop->is_confirmed = 2;
                    $prop->save();
                }
            }

            // $dealMessage = DealMessage::where('proposition_id', $propositionId)
            //     ->firstOrFail();
            // // $dealMessage = new DealMessage();
            // // $dealMessage->task_id = $task->id;
            // // $dealMessage->user_id = $userId;
            // // $dealMessage->proposition_id = $propositionId;
            // $dealMessage->is_confirmed = 2;
            // $dealMessage->save();

            return response()->json('success', 200);
        }

    }

    // public function updateDeal(Request $request, $lang, Task $task, $userId, $propositionId, $answer)
    // {
    //     $this->authorize('updateDeal', $task);
    //
    //     if ($request->ajax()) {
    //         $dealMessage = DealMessage::where('task_id', $task->id)
    //             ->where('user_id', $userId)
    //             ->where('proposition_id', $propositionId)
    //             ->where('is_confirmed', 2)
    //             ->firstOrFail();
    //         $proposition = $dealMessage->proposition;
    //
    //         if ($answer == 'ok') {
    //             $task->user_executant_id = $userId;
    //             $task->is_confirmed = 1;
    //             $task->save();
    //
    //             $proposition->is_confirmed = 1;
    //             $proposition->save();
    //
    //             $dealMessage->is_confirmed = 1;
    //             $dealMessage->save();
    //
    //             return response()->json('success', 200);
    //         }
    //         if ($answer == 'no') {
    //             // $task->user_executant_id = $userId;
    //             // $task->is_confirmed = 3;
    //             // $task->save();
    //
    //             $task->user_executant_id = null;
    //             $task->is_confirmed = 0;
    //             $task->save();
    //
    //             $proposition->is_confirmed = 3;
    //             $proposition->save();
    //
    //             $dealMessage->is_confirmed = 3;
    //             $dealMessage->save();
    //
    //             return response()->json('success', 200);
    //         }
    //
    //         return response()->json('error', 400);
    //     }
    //
    // }

    public function indexAccepted()
    {
        $tasks = Task::where('user_customer_id', \Auth::user());
        return view('tasks.accepted', compact('tasks'));
    }

    // public function test()
    // {
    //     $task = Task::findOrFail(1);
    //     $client = new \DateTime($task->date_begin);
    //     dd($client);
    //     return 'test';
    // }
}
