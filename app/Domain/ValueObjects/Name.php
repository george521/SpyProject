<?php

namespace App\Domain\ValueObjects;

class Name
{
    private string $name;
    private string $surname;

    public function __construct(string $name, string $surname)
    {
        // Ensure both first and last names are not empty
        if (empty($name) || empty($surname)) {
            throw new \InvalidArgumentException('Both first name and last name are required.');
        }

        $this->name = $name;
        $this->surname = $surname;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getSurname(): string
    {
        return $this->surname;
    }

}
