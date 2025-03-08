<?php

namespace App\Traits;

trait StringHelper
{
    /**
     * Generate a URL-friendly slug from a string
     *
     * @param string $string The string to convert
     * @param string $separator The separator to use between words (default: '-')
     * @param bool $lowercase Convert to lowercase (default: true)
     * @param bool $transliterate Transliterate non-ASCII characters (default: true)
     * @return string
     */
    public static function slug(string $string, string $separator = '-', bool $lowercase = true, bool $transliterate = true)
    {
    
        if ($transliterate) {
            
            $string = transliterator_transliterate('Any-Latin; Latin-ASCII; [\u0080-\u7fff] remove', $string);
        }
        
        
        $string = preg_replace('/[^a-zA-Z0-9\s]/', '', $string);
        
        
        $string = preg_replace('/\s+/', $separator, $string);
        
        
        $string = preg_replace('/' . preg_quote($separator) . '+/', $separator, $string);
        
        
        $string = trim($string, $separator);
        
        
        if ($lowercase) {
            $string = strtolower($string);
        }
        
        return $string;
    }
    
    /**
     * Generate a unique slug by appending a number if needed
     *
     * @param string $string The string to convert to slug
     * @param callable $checkExists Function that checks if a slug exists
     * @param string $separator The separator to use between words
     * @return string
     */
    public static function uniqueSlug(string $string, callable $checkExists, string $separator = '-')
    {
        $originalSlug = self::slug($string, $separator);
        $slug = $originalSlug;
        $counter = 1;
        
        while ($checkExists($slug)) {
            $slug = $originalSlug . $separator . $counter;
            $counter++;
        }
        
        return $slug;
    }
}
