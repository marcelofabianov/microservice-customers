<?php

namespace Modules\Accounts\Data\Queue;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AccountQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $data;

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        echo 'Disparado...';
    }
}
