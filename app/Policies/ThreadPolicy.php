<?php

namespace App\Policies;


use App\User;
use App\Thread;

use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy {
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }


    /**
     * @param User $user
     * @return bool
     *
     * If current user have more than 5 approved messages on site we return true else it is false.
     */
    public function post(User $user) {

       return $user->message()->where('approved', '=', 1)->count() >= 5;

    }

    /**
     * @param User $user
     * @param Thread $thread
     * @return bool
     *
     * Update only if user have moderator role or if user own thread.
     *
     */
    public function update(User $user , Thread $thread) {

        return $user->id === $thread->user_id || $user->checkRole('role_moderator');

    }



}
