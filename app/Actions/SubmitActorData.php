<?php

namespace App\Actions;

use App\Contracts\AIActorInterface;
use App\Exceptions\IncompleteActorDataException;
use App\Models\Actor;
use Illuminate\Validation\ValidationException;

class SubmitActorData
{
    public function __construct(
        protected AIActorInterface $aiService
    ) {}

    public function execute(array $validatedInput): Actor
    {
        try {
            $actorProfile = $this->aiService->extractData($validatedInput['description']);
            $creationData = array_merge(
                $validatedInput,
                $actorProfile->toArray()
            );

            return Actor::create($creationData);

        } catch (IncompleteActorDataException $e) {
            throw ValidationException::withMessages([
                'description' => $e->getMessage(),
            ]);
        }
    }
}
