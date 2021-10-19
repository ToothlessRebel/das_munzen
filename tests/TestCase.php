<?php

namespace Tests;

use App\Models\Currency;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;
    use WithFaker;

    /** @noinspection PhpMissingReturnTypeInspection */
    protected function setUpTraits()
    {
        $uses = parent::setUpTraits();

        if (isset($uses[WithUSD::class]) && Currency::query()->where(['abbreviation' => 'USD'])->doesntExist()) {
            Artisan::call('db:seed', ['--class' => 'UsdSeeder']);
        }

        return $uses;
    }
}
