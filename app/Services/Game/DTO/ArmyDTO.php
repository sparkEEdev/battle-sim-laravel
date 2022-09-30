<?php

namespace App\Services\Game\DTO;

class ArmyDTO
{
    private int $id;

    private int $game_id;

    private string $name;

    private int $initial_units;

    private int $units;

    private string $attack_strategy;

    private int $ordinal;

    public function __construct(int $id, int $game_id, string $name, int $initial_units, int $units, string $attack_strategy, int $ordinal)
    {
        $this->id = $id;
        $this->game_id = $game_id;
        $this->name = $name;
        $this->initial_units = $initial_units;
        $this->units = $units;
        $this->attack_strategy = $attack_strategy;
        $this->ordinal = $ordinal;
    }

    public function getUnits(): int
    {
        return $this->units;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getGameId(): int
    {
        return $this->game_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getInitialUnits(): int
    {
        return $this->initial_units;
    }

    public function getAttackStrategy(): string
    {
        return $this->attack_strategy;
    }

    public function getOrdinal(): int
    {
        return $this->ordinal;
    }

    public function getDamage(): int
    {
        return $this->units > 1
            ? round($this->units * 0.5, 0, PHP_ROUND_HALF_DOWN)
            : $this->units;
    }

    public function canAttack(): bool
    {
        return mt_rand(1, 100) < $this->units ? true : false;
    }

    public function isDead(): bool
    {
        return $this->units <= 0 ? true : false;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['game_id'],
            $data['name'],
            $data['initial_units'],
            $data['units'],
            $data['attack_strategy'],
            $data['ordinal']
        );
    }

    public function fromUnits(int $units): self
    {
        return new self(
            $this->id,
            $this->game_id,
            $this->name,
            $this->initial_units,
            $units,
            $this->attack_strategy,
            $this->ordinal
        );
    }
}
