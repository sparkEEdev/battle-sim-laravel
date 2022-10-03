<?php

namespace App\Http\Requests\v1;

use App\Enums\GameStatusEnum;
use App\Rules\GameStatusInactionableRule;
use Illuminate\Foundation\Http\FormRequest;

class RunAttackGameRequest extends FormRequest
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
            'game' => ['bail', 'required', 'integer', 'exists:games,id', new GameStatusInactionableRule(GameStatusEnum::PROCESSING, GameStatusEnum::FINISHED)],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'game' => $this->route('game'),
        ]);
    }
}
