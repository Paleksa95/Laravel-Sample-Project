<?php

namespace App\Policies;

use App\User;
use App\Message;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class MessagePolicy {
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
     * Only users with moderator role can approve messages.
     */
    public function approve(User $user) {
        return $user->checkRole('role_moderator');
    }

    /**
     * @param User $user
     * @param Message $message
     * @return bool
     *
     * update message only user is moderator or if user created message.
     *
     */
    public function update(User $user ,Message $message) {
      //  dd($user->id , $message->user_id);
        return $user->id === $message->user_id || $user->checkRole('role_moderator');
    }


}
