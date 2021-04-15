<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Facebook()
 * @method static static Instagram()
 * @method static static Twitter()
 * @method static static Youtube()
 */
final class AdTypeEnum extends Enum
{
    const Courses = 0;
    const Rooms = 1;
}
