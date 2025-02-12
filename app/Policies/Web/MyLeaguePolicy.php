<?php

namespace App\Policies\Web;

use App\Models\League;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MyLeaguePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): Response
    {
        return $user->leagues()->exists() ? Response::allow() : Response::deny('Do dané ligy nemáte přístup!');

    }

    public function view(User $user, League $league): Response
    {
        return $user->leagues()->where('leagues.id', $league->id)->exists() ? Response::allow() : Response::deny('Nejste členem dané ligy!');
    }

    public function viewOnlyWithRounds(User $user, League $league): Response
    {
        return $user->leaguesWithRounds()->where('leagues.id', $league->id)->exists() ? Response::allow() : Response::denyAsNotFound();

    }
}
