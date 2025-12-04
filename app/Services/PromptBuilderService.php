<?php

namespace App\Services;

use Illuminate\Support\Carbon;

class PromptBuilderService
{
    protected const REQUIRED_FIELDS = ['first_name', 'last_name', 'address'];
    protected const OPTIONAL_FIELDS = ['height', 'weight', 'gender', 'age'];

    public function build(string $descriptionText): string
    {
        $fields = array_merge(self::REQUIRED_FIELDS, self::OPTIONAL_FIELDS);
        $fieldList = implode(', ', $fields);

        $currentDate = Carbon::now()->toDateString();

        return <<<EOT
You are an intelligent data extraction assistant. Analyze the text description below and extract the actor's profile data.

Target JSON Structure Keys: {$fieldList}

Today's date is: {$currentDate}.

**Extraction Rules:**
1. **Inference is allowed:**
   - **Gender:** Deduce from context keywords (e.g., "guy", "man", "father" -> "Male"; "girl", "actress" -> "Female") or pronouns used in the first person context if evident.
   - **Age:** If a birth year or date is provided, CALCULATE the age based on today's date.
   - **Address:** If a landmark or city is mentioned (e.g., "living near Eiffel Tower"), infer the City/Country (e.g., "Paris, France").

2. **Normalization:**
   - **Height:** Convert to centimeters (cm) if provided in feet/inches. Return formatted like "180 cm".
   - **Weight:** Convert to kilograms (kg) if provided in lbs. Return formatted like "80 kg".

3. **Strict Constraints:**
   - Return ONLY a valid JSON object.
   - If a field cannot be found or inferred with confidence, set it to `null`.
   - Do not hallucinate data that is not implied in the text.

**User Description:**
"{$descriptionText}"
EOT;
    }

    public function getRequiredFields(): array
    {
        return self::REQUIRED_FIELDS;
    }
}
