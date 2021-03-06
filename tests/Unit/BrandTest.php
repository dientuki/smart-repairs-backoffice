<?php

namespace Tests\Unit;

use App\Login;
use App\Brand;
use Tests\TestCase;

class BrandTest extends TestCase
{
    protected $brand;

    public function setUp(): void
    {
        parent::setUp();
        $this->brand = new Brand();
    }

    protected function successfulIndexOrderRoute($order)
    {
        return route('brands.index', ['order='. $order]);
    }

    public function testGetAscOrder()
    {
        $array = ['C','B','A'];

        foreach ($array as $letter) {
            factory(Brand::class)->create([
                'brand' => $letter
            ]);
        }

        $array = array_reverse($array);

        $brands = $this->brand->getAll();

        foreach ($brands as $key => $brand) {
            $this->assertEquals($brand->brand, $array[$key]);
        }
    }
    
    public function testGetDescOrder()
    {
        $array = ['A','B','C'];

        foreach ($array as $letter) {
            factory(Brand::class)->create([
                'brand' => $letter
            ]);
        }

        $array = array_reverse($array);

        $this->followingRedirects()
            ->actingAs(factory(Login::class)->create())
            ->get($this->successfulIndexOrderRoute('desc'));

        $brands = $this->brand->getAll();

        foreach ($brands as $key => $brand) {
            $this->assertEquals($brand->brand, $array[$key]);
        }
    }

    public function testGetAnyOrder()
    {
        $array = ['C','B','A'];

        foreach ($array as $letter) {
            factory(Brand::class)->create([
                'brand' => $letter
            ]);
        }

        $array = array_reverse($array);

        $this->followingRedirects()
            ->actingAs(factory(Login::class)->create())
            ->get($this->successfulIndexOrderRoute('any'));

        $brands = $this->brand->getAll();

        foreach ($brands as $key => $brand) {
            $this->assertEquals($brand->brand, $array[$key]);
        }
    }
}
