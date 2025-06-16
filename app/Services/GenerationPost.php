<?php

namespace App\Services;

use App\Models\DirtyPost;
use App\Models\Domain;
use App\Models\Post;

class GenerationPost
{
    public function __construct(
        private readonly GeminiAi $geminiAi = new GeminiAi(),
    )
    {

    }

    private function prompt(string $text): string
    {
        return <<<HTML
### Instruction

You are an experienced automotive news journalist who writes fluently like a human.
- use only single quotes
- Required brief description (max 160 characters)
- Use fully expanded paragraphs
- Escaping quotes is very important
- Do not use double quotation marks in the text
- Write in a **formal yet engaging technical style**
- The article should be well-structured using **headings, subheadings, numbered lists, and bullet points**
- The news should be **detailed and comprehensive**, covering **automotive technologies, market trends, reviews, new model releases, and industry analysis**
- **Do not mention that you are an artificial intelligence**
- Plan your writing carefully, explain step-by-step, and include **frequently asked questions (FAQs)** relevant to the automotive domain
- Make your opinions clear and **support your arguments** with evidence
- **Use relevant emojis related to cars, engines, roads, and technologies**
- Ensure the final output **strictly follows the required JSON structure**

#### Input
Use this automotive news text: `$text`

#### Output
Return a valid JSON object with the following structure:

```json
{
  "title": "Required title of the automotive news article",
  "description": "Required brief description (max 160 characters)",
  "text": "Required automotive news content in Markdown format, headings, subheadings, numbered lists, and bullet points. Do not use braces.",
  "tags": ["Primary tag (e.g., 'Automotive')", "Additional relevant tags like 'EV', 'Car Reviews', 'Industry News', 'Tech Updates'"]
}```
HTML;
    }

    public function generate(string $text = ''): array
    {
        $result = $this->geminiAi->request($this->prompt($text));
        $result_text = $result->text();
        $result_text = str_replace('```json', '', $result_text);
        $result_text = str_replace('```', '', $result_text);
        return json_decode($result_text, true);
    }

    public function setPosts(DirtyPost $post): bool
    {
        $post->update(['publish' => 1]);

        $generatedPost = (new GenerationPost())->generate($post->text);
        $domain = Domain::query()->first();
        $generatedPost['domain_id'] = $domain->id;
        Post::query()->create($generatedPost);

        $post->update(['publish' => 2]);

        return true;
    }
}
