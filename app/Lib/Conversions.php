<?php

declare(strict_types=1);

namespace App\Lib;

use App\Models\Currency;
use App\Models\Denomination;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class Conversions
{
    protected float $toConvert;

    protected Collection $counts;

    public function __construct()
    {
        $this->counts = collect();
    }

    public function toArray(): array
    {
        return $this->counts->toArray();
    }

    protected function parseValue($initial): float
    {
        if (is_string($initial)) {
            $initial = trim(trim($initial), '$');
        }

        if (!is_numeric($initial)) {
            throw new InvalidArgumentException("Initial value must be numeric.");
        }

        return (float) $initial;
    }

    public function convert($value, Currency $currency): self
    {
        $this->toConvert = $this->parseValue($value);
        $currency->denominations->each(function (Denomination $denomination) {
            if ($this->convertTo($denomination, $this->toConvert)) {
                $this->toConvert = round(fmod($this->toConvert, $denomination->value), 2);
            }
        });

        return $this;
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    public function __toString(): string
    {
        return $this->toJson();
    }

    protected function convertTo(Denomination $denomination, float $value): int
    {
        $this->counts->put($denomination->name, (int) ($value / $denomination->value));

        return $this->counts->get($denomination->name);
    }
}
