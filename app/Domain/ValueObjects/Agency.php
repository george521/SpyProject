<?php
namespace App\Domain\ValueObjects;

class Agency
{
    private string $agency;
    private array $knownAgencies = ['CIA', 'MI6', 'KGB'];

    public function __construct(string $agency)
    {
        if (!in_array(strtoupper($agency), $this->knownAgencies)) {
            throw new \InvalidArgumentException('Invalid agency name.');
        }

        $this->agency = strtoupper($agency);
    }

    public function getAgency(): string
    {
        return $this->agency;
    }
}
