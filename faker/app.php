<?php

require './vendor/autoload.php';

$faker = Faker\Factory::create('en_GB');

$faker->seed(1234);

$evenValidator = function ($digit) {
    return $digit % 2 === 0;
};

for ($i = 0; $i < 10; $i++) {
    echo $faker->valid($evenValidator)->randomNumber(5, true) . ',' .
        $faker->isbn13 . ',' .
        $faker->unique()->firstName . ',' .
        $faker->lastName . ',' .
        $faker->email . ',' .
        $faker->dateTimeThisCentury->format('d-M-Y') . ',' .
        $faker->latitude . ',' .
        $faker->longitude . ',' .
        $faker->imageUrl(80, 150, 'people') . PHP_EOL;
}
