<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Feature\OAuth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use OAuth;

    /**
     * @var array
     */
    protected array $headersAuthorization;

    public $mockConsoleOutput = false;

    public function setUp(): void
    {
        parent::setUp();

        $this->setHeadersAutorization();
    }
}
