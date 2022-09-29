<?php

namespace App\Http\Requests\v1;

use App\Enums\AttackStrategyEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreateArmyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'game_id' => ['required', 'integer', 'exists:games,id'],
            'name' => ['required', 'string'],
            'initial_units' => ['required', 'integer', 'min:80', 'max:100'],
            'attack_strategy' => ['required', 'string', 'in:' . implode(',', AttackStrategyEnum::getValues())],
        ];
    }
}
