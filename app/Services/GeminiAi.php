<?php

namespace App\Services;

use Gemini;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GeminiAi
{
    private Collection $keys;

    private $response = null;

    private string $model = 'gemini-2.0-flash-lite';

    public function __construct()
    {
        try {
            $this->keys = collect(explode("\n", Storage::disk('local')->get('gemini_keys.txt')))->map(function ($item) {
                return trim($item);
            })->filter();
        } catch (\Exception $e) {
            if (config('app.debug')) {
                dd(
                    'Error: Check file gemini_keys.txt in storage/app/private',
                    $e->getMessage()
                );
            }
            Log::error($e->getMessage());
        }
    }

    public function request($query = '', $model = 'gemini-2.0-flash-lite')
    {
        if ($model) {
            $this->model = $model;
        }
        try {
            $client = Gemini::client($this->keys->random());

            $this->response = $client->generativeModel($this->model)->generateContent($query);

            // Check if this is being called directly as a final method
            // Use debug_backtrace to determine if this method is in a call chain
            $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);

            // If there's only one item in the trace or this is the final method call
            if (count($trace) === 1 || ! isset($trace[1]['function'])) {
                return $this->text();
            }

            return $this;
        } catch (Gemini\Exceptions\ErrorException $e) {
            Log::error('Gemini AI error: '.$e->getMessage());
            if (Str::contains($e->getMessage(), 'The model is overloaded')) {
                return $this->request($query);
            } else {
                return $this;
            }

        }
    }

    public function json(): array
    {
        if (! $this->response) {
            return [];
        }

        $text = trim(str_ireplace(['```json', '```'], '', $this->response->text()));

        try {
            return json_decode($text, true) ?? [];
        } catch (\Exception $e) {
            Log::error('Failed to parse JSON response: '.$e->getMessage());

            return [];
        }
    }

    public function text(): string
    {
        return $this->response ? $this->response->text() : '';
    }

    public function raw()
    {
        return $this->response;
    }

    public function __toString(): string
    {
        return $this->text();
    }
}
