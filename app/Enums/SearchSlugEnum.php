<?php

namespace App\Enums;

enum SearchSlugEnum: string
{
    case Articles = 'artiklid';
    const Courses = 'koolitused';
    const Companies = 'koolitajad';
    const Properties = 'ruumid';


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
