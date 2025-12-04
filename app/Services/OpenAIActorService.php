<?php

namespace App\Services;

use App\Contracts\AIActorInterface;
use App\DTO\ActorProfileData;
use App\Exceptions\IncompleteActorDataException;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class OpenAIActorService implements AIActorInterface
{
    public function __construct(
        protected PromptBuilderService $promptBuilder
    ) {}

    public function extractData(string $description): ActorProfileData
    {
        $prompt = $this->promptBuilder->build($description);

        try {
            $response = Http::withToken(config('services.openai.key'))
                ->asJson()
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => config('services.openai.model', 'gpt-4o-mini'),
                    'messages' => [
                        ['role' => 'system', 'content' => $prompt],
                    ],
                    'response_format' => ['type' => 'json_object'],
                    'temperature' => 0.1,
                ])
                ->throw();
        } catch (RequestException $e) {
            throw $e;
        }

        $content = $response->json('choices.0.message.content');
        $data = json_decode($content, true) ?? [];

        $this->validateRequiredFields($data);

        return ActorProfileData::fromArray($data);
    }

    /**
     * @throws IncompleteActorDataException
     */
    protected function validateRequiredFields(array $data): void
    {
        $required = $this->promptBuilder->getRequiredFields();

        foreach ($required as $field) {
            if (empty($data[$field])) {
                throw IncompleteActorDataException::missingFields();
            }
        }
    }
}
