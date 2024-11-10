<?php
namespace App\Events;

use App\Models\Spy;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SpyCreated
{
    use Dispatchable, SerializesModels;

    public Spy $spy;

    public function __construct(Spy $spy)
    {
        $this->spy = $spy;
    }
}
