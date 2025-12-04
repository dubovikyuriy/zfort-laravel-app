<?php
namespace App\Actions;

use Illuminate\View\View;

class ShowActorForm
{
    public function execute(): View
    {
        return view('actors.create');
    }
}
