<?php


namespace App\Nova\Actions;


class DuplicateCourse extends DuplicateResource
{
    protected $keepRelations = [
        'courseCategories',
    ];
}
