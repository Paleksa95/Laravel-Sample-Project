<?php

namespace App\Policies;

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
     * @return bool
     *
     *  If current user have more than 5 approved messages on site we return true else it is false.
     */
    public function post() {

       return \Auth::user()->message()->where('approved', '=', 1)->count() >= 5;

    }

}
