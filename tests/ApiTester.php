<?php

namespace Tests;

//use Tests\TestCase;
use Faker\Factory as Faker;


class ApiTester extends TestCase
{
    protected $fake;

    protected $times = 1;

    /**
     * ApiTester constructor.
     * @param $faker
     */
    public function __construct()
    {
        $this->fake = Faker::create();
    }

    protected function times($count)
    {
        $this->times = $count;
        return $this;
    }


}
