<?php

namespace App\Enums;

enum SkillLevel: int
{
    case BEGINNER = 1;
    case INTERMEDIATE = 2;
    case ADVANCED = 3;
    case EXPERT = 4;

    public function label(): string
    {
        return match ($this) {
            self::BEGINNER => 'Beginner',
            self::INTERMEDIATE => 'Intermediate',
            self::ADVANCED => 'Advanced',
            self::EXPERT => 'Expert',
        };
    }
}   