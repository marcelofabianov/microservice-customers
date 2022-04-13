<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Tests\Feature\MockOAuth;
use Tests\Feature\OAuth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use OAuth;

    protected $headersAuthorization;

    public $mockConsoleOutput = false;

    public function setUp(): void
    {
        parent::setUp();

        //$this->setHeadersAutorization(); Return Invalid token =\
    }
}
