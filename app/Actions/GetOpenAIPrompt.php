<?php
namespace App\Actions;

use App\Services\PromptBuilderService;

class GetOpenAIPrompt
{
    protected PromptBuilderService $promptBuilder;

    public function __construct(PromptBuilderService $promptBuilder)
    {
        $this->promptBuilder = $promptBuilder;
    }

    public function execute(): string
    {
        return $this->promptBuilder->build('{text_prompt}');
    }
}
