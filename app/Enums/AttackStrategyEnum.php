<?php

namespace App\Enums;

class AttackStrategyEnum {
    public CONST RANDOM = 'random';
    public CONST STRONGEST = 'strongest';
    public CONST WEAKEST = 'weakest';

    public static function getValues(): array
    {
        return [
            self::RANDOM,
            self::STRONGEST,
            self::WEAKEST,
        ];
    }
}
