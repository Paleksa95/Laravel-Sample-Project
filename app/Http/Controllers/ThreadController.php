<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

//use Illuminate\Support\Facades\Gate;

class ThreadController extends Controller {


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Displaying form to subbmit thread.
     */
    public function displayForm() {

        return view('pages.thread.createThread');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Method used to submit thread.
     *
     */
    public function submitThread(Request $request) {
        //Getting current user.
        $user = $request->user();

        //Checking if user have more than 5 messages on our site.
        $this->authorize('post', Thread::class);


        $this->validate($request, [
            'title' => 'required|max:255|min:5',
            'body' => 'required|max:255|min:5',
        ]);

        $thread = new Thread();
        $thread->title = $request->title;
        $thread->body = $request->body;


        $thread->user()->associate($user);
        $thread->save();

        return redirect()->back()->with('verify', 'Message created!');

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     *
     * Display all threads.
     */
    public function displayAllThreads() {

        $threads = Thread::orderBy('created_at', 'DESC')->paginate(10);

        return view('pages.thread.displayAllThreads', ['threads' => $threads]);

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Display one thread by id
     *
     */
    public function displayOneThread($id) {

        //Finding thread by id.
        $thread = Thread::find($id);

        //Paginate all messages for specific thread.
        $messages = $thread->message()->paginate(10);

        return view('pages.thread.displayThread', [
            'thread' => $thread,
            'messages' => $messages
        ]);
    }


}
