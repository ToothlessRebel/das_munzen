<?php

namespace App\Console\Commands;

use App\Facades\Money;
use App\Models\Currency;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class Convert extends Command
{
    protected $name = 'convert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert an amount of a given currency to individual denominations.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $this->table(
                ['Denomination', 'Amount'],
                collect(Money::convertToArray($this->argument('amount'), $this->getCurrency()))
                    ->map(function ($amount, $name) {
                        return [
                            Str::title(Str::replace('-', ' ', $name)),
                            number_format($amount, 0),
                        ];
                    })
            );
        } catch (InvalidArgumentException $argumentException) {
            $this->error($argumentException->getMessage());

            $exitCode = Command::FAILURE;
        }

        return $exitCode ?? Command::SUCCESS;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['amount', InputArgument::REQUIRED, 'The value to be converted.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['currency', 'c', InputOption::VALUE_OPTIONAL, 'Use this currency abbreviation. Default: USD'],
        ];
    }

    protected function getCurrency(): Currency
    {
        /** @var Currency $currency */
        $currency = Currency::query()->where(['abbreviation' => 'USD'])->first();
        if ($this->option('currency')) {
            $currency = Currency::query()->where(['abbreviation' => $this->option('currency')])->first();
        }

        if ($currency === null) {
            throw new InvalidArgumentException("{$this->option('currency')} did not match any known currencies.");
        }

        return $currency;
    }
}
