<?php
namespace App\Domain\ValueObjects;

use Carbon\Carbon;

class DateChecker
{
    public ?Carbon $datechecker;

    public function __construct(?string $datechecker)
    {
        if(isset($datechecker)) {
            // Ensure the date is valid
            $date = Carbon::createFromFormat('Y-m-d', $datechecker);
            if ($date->format('Y-m-d') !== $datechecker) {
                throw new \InvalidArgumentException('Invalid date of birth format.');
            }
        }
        $this->datechecker = $date ?? null;
    }

}
