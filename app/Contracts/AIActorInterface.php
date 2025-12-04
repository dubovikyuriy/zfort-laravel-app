<?php

namespace App\Contracts;

use App\DTO\ActorProfileData;

interface AIActorInterface
{
    /**
     * @throws \App\Exceptions\IncompleteActorDataException
     */
    public function extractData(string $description): ActorProfileData;
}
