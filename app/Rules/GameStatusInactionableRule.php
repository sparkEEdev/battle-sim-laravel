<?php

namespace App\Rules;

use App\Models\Game;
use App\Enums\GameStatusEnum;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Validation\Rule;

class GameStatusInactionableRule implements Rule
{

    private $statuses = [];

    private Game $game;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string ...$statuses)
    {
        $this->statuses = $statuses;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->game = Game::find($value)
            ->first();

        return !in_array($this->game->status, $this->statuses);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The game cannot be managed when it is {$this->game->status}";
    }
}
