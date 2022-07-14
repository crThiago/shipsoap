<?php

namespace App\Soap;

class SoapDemoServer
{
    /**
     * Adds two numbers
     *
     * @param float $a
     * @param float $b
     *
     * @return float
     */
    public function sum(float $a = 0, float $b = 0): float
    {
        return $a + $b;
    }

    /**
     * Returns your data
     *
     * @return Person
     */
    public function me(): Person
    {
        return new Person('John', 'Doe');
    }

    /**
     * Says hello to person provided
     *
     * @param Person $person
     *
     * @return string
     */
    public function hello(Person $person): string
    {
        return sprintf("Hello %s!", $person->first_name);
    }
}
