<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CurrencyFieldRule implements Rule
{
    private array $enabledCurrencies;

    public function __construct()
    {
        $this->enabledCurrencies = config('converter.enabled_currencies');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, $this->enabledCurrencies);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $enabledCurrenciesAsString = implode(',', $this->enabledCurrencies);
        return "Lütfen geçerli bir para birimi seçiniz [Enabled Currencies: $enabledCurrenciesAsString].";
    }
}
