<?php

use App\Models\Producer;
use Livewire\Livewire;
use App\Models\Product;
use App\Livewire\Product\Index;

test('the product index page is rendered', function () {
    // Arrange
    $producer = Producer::factory()->create();

    $product = Product::factory()->create([
        'producer_id' => $producer->id,
    ]);

    // Act
    $response = $this->get('/products');

    // Assert
    $response->assertOk();
    $response->assertSeeLivewire(Index::class);
    $response->assertSee($product->name);
    $response->assertSee($product->producer->name);
});

test('the filter by producer works and clearSearch method works', function () {
    // Arrange
    $producer1 = Producer::factory()->create();

    Product::factory(6)->create([
        'producer_id' => $producer1->id,
    ]);

    $producer2 = Producer::factory()->create();

    Product::factory(12)->create([
        'producer_id' => $producer2->id,
    ]);

    // Act
    $response = Livewire::test(Index::class)
        ->set('filters.producer', $producer1->name)
        ->set('showPerPage', '99')
        ->call('makeSearch');

    // Assert
    $response->assertSee($producer1->name)
        ->assertDontSee($producer2->name);

    $response->assertViewHas('products', function ($products) {
        return count($products) == 6;
    });

    // Act
    $response->call('clearSearch');

    // Assert
    $response->assertViewHas('products', function ($products) {
        return count($products) == 18;
    });
});

test('the filter by in stock works', function () {
    // Arrange
    $producer = Producer::factory()->create();

    Product::factory(8)->create([
        'stock' => 0,
        'producer_id' => $producer->id,
    ]);

    Product::factory(6)->create([
        'stock' => random_int(1, 100),
        'producer_id' => $producer->id,
    ]);

    // Act
    $response = Livewire::test(Index::class)
        ->set('showPerPage', '99')
        ->set('filters.inStock', '1')
        ->call('makeSearch');

    // Assert
    $response->assertViewHas('products', function ($products) {
        return count($products) == 6;
    });

    // Act
    $response = Livewire::test(Index::class)
        ->set('showPerPage', '99')
        ->set('filters.inStock', '0')
        ->call('makeSearch');

    // Assert
    $response->assertViewHas('products', function ($products) {
        return count($products) == 8;
    });

    // Act
    $response = Livewire::test(Index::class)
        ->set('showPerPage', '99')
        ->set('filters.inStock', '-1')
        ->call('makeSearch');

    // Assert
    $response->assertViewHas('products', function ($products) {
        return count($products) == 14;
    });
});

test('show per page works', function () {
    // Arrange
    $producer = Producer::factory()->create();

    Product::factory(150)->create([
        'producer_id' => $producer->id,
    ]);

    // Act
    $response = Livewire::test(Index::class)
        ->set('showPerPage', '3')
        ->call('makeSearch');

    // Assert
    $response->assertViewHas('products', function ($products) {
        return count($products) == 3;
    });

    // Act
    $response = Livewire::test(Index::class)
        ->set('showPerPage', '101')
        ->call('makeSearch');

    // Assert
    $response->assertViewHas('products', function ($products) {
        return count($products) == 100;
    });

    $response->assertSee('You can not show more than 100 products per page.');
});
