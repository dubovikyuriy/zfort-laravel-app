<?php

namespace App\Actions;

use App\Models\Actor;
use Illuminate\Database\Eloquent\Collection;

class ListActors
{
    public function execute(): Collection
    {
        return Actor::orderBy('created_at', 'desc')->get();
    }
}
