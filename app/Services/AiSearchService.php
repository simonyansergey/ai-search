<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AiSearchService
{
    public function parseSearchQuery($query): array
    {
        try {
            $systemPrompt = <<<PROMPT
                You are a product search parser. Extract attributes from user queries.
                Return ONLY valid JSON with this exact structure:
                {
                    "category": "shirts|pants|shoes|null",
                    "color": "red|blue|black|white|green|null",
                    "pattern": "striped|plain|dotted|checkered|null",
                    "season": "summer|winter|spring|fall|all-season|null",
                    "material": "cotton|polyester|canvas|leather|null",
                    "keywords": ["array", "of", "other", "terms"]
                }

                Examples:
                "red shirt with stripes for summer" → {"category":"shirts","color":"red","pattern":"striped","season":"summer","material":null,"keywords":[]}
                "blue formal pants" → {"category":"pants","color":"blue","pattern":null,"season":null,"material":null,"keywords":["formal"]}
                "comfortable shoes" → {"category":"shoes","color":null,"pattern":null,"season":null,"material":null,"keywords":["comfortable"]}
            PROMPT;

            $response = Http::timeout(10)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . config('services.groq.api_key'),
                    'Content-Type' => 'application/json',
                ])
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'llama-3.1-70b-versatile',
                    'messages' => [
                        ['role' => 'system', 'content' => $systemPrompt],
                        ['role' => 'user', 'content' => $query]
                    ],
                    'temperature' => 0.1,
                    'max_tokens' => 200,
                ]);

            if ($response->successful()) {
                $content = $response->json()['choices'][0]['message']['content'] ?? '{}';
                $content = preg_replace('/```json\s*|\s*```/', '', $content);

                return json_decode($content, true) ?? $this->fallback($query);
            }

            return $this->fallback($query);

        } catch (\Exception) {

        }
    }

    private function fallback(string $query): array
    {
        return [
            'category' => null,
            'color' => null,
            'pattern' => null,
            'season' => null,
            'material' => null,
            'keywords' => explode(' ', strtolower($query))
        ];
    }
}
