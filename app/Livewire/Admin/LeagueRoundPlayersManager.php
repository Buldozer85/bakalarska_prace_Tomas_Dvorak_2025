<?php

namespace App\Livewire\Admin;

use App\Models\LeagueRound;
use App\Models\RoundPlayer;
use Livewire\Component;

class LeagueRoundPlayersManager extends Component
{
    public LeagueRound $leagueRound;

    public function render()
    {
        return view('livewire.admin.league-round-players-manager');
    }

    public function confirmScore(RoundPlayer $roundPlayer): void
    {
        $score = $roundPlayer->player->score;

        if (! is_null($roundPlayer->confirmed)) {
            $roundPlayer->confirmed = null;
            $roundPlayer->player->score = max([$score - $roundPlayer->score, 0]);
            flash('Bylo zrušeno potvrzení skóre', 'error');
        } else {
            $roundPlayer->confirmed = now();
            $roundPlayer->player->score = $score + $roundPlayer->score;
            flash('Skóre bylo úspěšně potvrzeno');
        }

        $roundPlayer->save();
        $roundPlayer->player->save();

    }

    public function editScore(RoundPlayer $roundPlayer, float $score): void
    {
        $roundPlayer->score = $score;
        $roundPlayer->save();

        flash('Skóre hráče '.$roundPlayer->player->user->full_name.' bylo upraveno');
    }
}
