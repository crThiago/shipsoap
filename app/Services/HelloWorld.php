<?php

namespace App\Services;

class HelloWorld
{
    public function helloWorld() {

        return 'Hallo Welt '. print_r(func_get_args(), true);
    }
}
