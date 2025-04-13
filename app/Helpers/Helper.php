<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public static function generateString($strength = 16): string
    {
        $input = 'abcdefghijklmnopqrstuvwxyz';
        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

    public static function firstLetters($text, $limit = 4): string
    {
        $text = strtolower($text);
        $text = Str::slug($text);
        $text = preg_replace('/[^a-z0-9]/', '', $text);

        return str_split($text, $limit)[0];
    }
}
