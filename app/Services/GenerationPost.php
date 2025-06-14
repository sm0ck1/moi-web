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

You are an experienced news writer who writes fluently like a human.
- use only single quotes.
- Required brief description (max 160 characters)
- Use fully expanded paragraphs.
- escapes quotes is very impotant
- do not use double quotation marks in the text
- Write in a formal technical style.
- The article should be well-structured with **headings, subheadings, numbered lists, and bullet points**.
- The news should be **detailed and comprehensive**, fully covering the topic.
- **Do not mention that you are an artificial intelligence.**
- Plan your writing carefully, present the information step by step, and include **frequently asked questions (FAQs)** related to the topic.
- **Ensure the final output strictly follows the required JSON structure.**

#### Input
Use this text: $text

#### Output
Return a valid JSON object with the following structure:

```json
{
  "title": "Required title of the news article",
  "description": "Required brief description (max 160 characters)",
  "text": "Required news content in Markdown format, including emojis, headings, subheadings, numbered lists, don't use braces, and bullet points.",
  "tags": ["Required primary tag", "Additional relevant tags"]
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

    public function setPosts(): bool
    {
        $post = DirtyPost::query()->where('publish', false)->first();
        if (!$post) {
            return false;
        }
        $generatedPost = (new GenerationPost())->generate($post->text);

        $domain = Domain::query()->first();
        $generatedPost['domain_id'] = $domain->id;
        Post::query()->create($generatedPost);

        return true;
    }
}
