<?php

namespace App\Enums;

enum SearchSlugEnum: string
{
    case Articles = 'artiklid';
    case Courses = 'koolitused';
    case Companies = 'koolitajad';
    case Properties = 'ruumid';


    public function getNotLocalizedValue(): string
    {
        $translations = array_flip(self::getTranslations());

        return $translations[$this->value];
    }

    public static function getTranslations()
    {
        return [
            'articles' => 'artiklid',
            'courses' => 'koolitused',
            'companies' => 'koolitajad',
            'properties' => 'ruumid',
        ];
    }
}
