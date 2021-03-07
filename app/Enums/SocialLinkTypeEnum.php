<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Facebook()
 * @method static static Instagram()
 * @method static static Twitter()
 * @method static static Youtube()
 */
final class SocialLinkTypeEnum extends Enum
{
    const Facebook = 0;
    const Instagram = 1;
    const Twitter = 2;
    const Youtube = 3;
}
