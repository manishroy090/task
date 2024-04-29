<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function  setUp() : void {
        parent::setUp();
        $this->withoutExceptionHandling();
        $filePath = storage_path('app/public/' . "clients.csv");
        file_put_contents($filePath, '');
    }
}
