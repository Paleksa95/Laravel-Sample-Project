<?php

namespace App\Http\Controllers;


use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MessageController extends Controller {


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Submit message to thread.
     *
     *
     */
    public function submitMessage(Request $request) {
        //Get current user
        $user = Auth::user();

        //If user have less than 5 approved messages in total his messages need to be approved by Moderator.
        if (Auth::user()->message()->where('approved', '=', 1)->count() < 5) {
            $this->validate($request, [
                'body' => 'required|max:255|min:5',
            ]);

            $message = new Message();
            $message->body = $request->body;
            $message->approved = 0;

            $message->user()->associate($user);
            $message->thread()->associate($request->thread_id);
            $message->save();

            return redirect()->back()->with('invalidate', 'Thanks for posting , you have less than 5 messages in total so Moderator need to approve your posts!');
        } else {

            $this->validate($request, [
                'body' => 'required|max:255|min:5',
            ]);

            $message = new Message();
            $message->body = $request->body;

            $message->user()->associate($user);
            $message->thread()->associate($request->thread_id);
            $message->save();

            return redirect()->back()->with('verify', 'Message submited');
        }

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Display all messages for approval.
     *
     */
    public function DisplayAllNotApprovedMessages() {

        $messages = Message::all()->where('approved', '=', 0);

        return view('pages.messages.messagesThatNeedApprove', ['messages' => $messages]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Approve message
     *
     */
    public function approveMessage(Request $request) {

        $this->authorize('approve', Message::class);

        Message::find($request->message_id)->update(['approved' => 1]);

        return redirect()->back()->with('verify', 'Message approved!');
    }


    public function getMessage($id) {

        $message = Message::find($id);

        return view('pages.messages.editMessage', ['message' => $message]);

    }
}
