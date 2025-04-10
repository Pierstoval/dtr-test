<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Orbitale\Component\ArrayFixture\ArrayFixture;

final class ProductFixture extends ArrayFixture
{
    protected function getEntityClass(): string
    {
        return Product::class;
    }

    protected function getObjects(): iterable
    {
        yield [
            'title' => 'Test product',
            'description' => 'Lorem ipsum dolor sit amet',
        ];
    }
}
