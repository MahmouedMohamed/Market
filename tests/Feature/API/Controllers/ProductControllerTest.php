<?php

namespace Tests\Feature\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Closure;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ExpectedResponse\ExpectedResponse;
use Tests\ExpectedResponse\PaginatedResponse;
use Tests\ExpectedResponse\StoreResponse;
use Tests\ExpectedResponse\ValidationResponse;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @dataProvider indexDataProvider */
    public function testIndex(Closure $responseFactory, Closure $modelsFactory, $payload = '')
    {
        $url = route('products.index');
        $modelsFactory();

        // Call Endpoints
        $response = $this->getJson(
            $url.'?'.$payload,
        );

        /** @var ExpectedResponse $expected */
        $expected = $responseFactory($this);
        $expected->assert($response);
    }

    public function indexDataProvider()
    {
        $apiCanListProductsWithNoParameters = function (): PaginatedResponse {
            return new PaginatedResponse(
                [
                    [
                        'id' => '5217517a-bca4-11eb-8a9f-0a9c0da6eea7',
                    ],
                ],
                [
                    'id',
                    'title',
                    'description',
                    'number_of_views',
                    'images',
                    'category',
                    'brand',
                    'tag',
                    'wish_list_customers',
                    'price',
                    'created_at',
                ]
            );
        };
        $apiCanListProductsWithSearchParameters = function (): PaginatedResponse {
            return new PaginatedResponse(
                [
                    [
                        'id' => '5217517a-bca4-11eb-8a9f-0a9c0da6eea6',
                    ],
                ],
                [
                    'id',
                    'title',
                    'description',
                    'number_of_views',
                    'images',
                    'category',
                    'brand',
                    'tag',
                    'wish_list_customers',
                    'price',
                    'created_at',
                ]
            );
        };

        return [
            'API Can List Products With no Parameters' => [
                $apiCanListProductsWithNoParameters,
                function () {
                    Category::factory(5)->createQuietly();
                    Brand::factory(5)->createQuietly();
                    Product::factory()->createQuietly([
                        'id' => '5217517a-bca4-11eb-8a9f-0a9c0da6eea7',
                    ]);
                },
            ],
            'API Can List Searched by a Key' => [
                $apiCanListProductsWithSearchParameters,
                function () {
                    Category::factory(5)->createQuietly();
                    Brand::factory(5)->createQuietly();
                    Product::factory()->createQuietly([
                        'id' => '5217517a-bca4-11eb-8a9f-0a9c0da6eea6',
                        'title' => 'xD',
                    ]);
                    Product::factory()->createQuietly([
                        'id' => '5217517a-bca4-11eb-8a9f-0a9c0da6eea5',
                    ]);
                },
                'searchKey=xD',
            ],
            'API Can List Filtered by Category' => [
                $apiCanListProductsWithSearchParameters,
                function () {
                    $category_one = Category::factory()->createQuietly([
                        'id' => '5217517a-bca4-11eb-8a9f-0a9c0da6eea4',
                    ]);
                    $category_two = Category::factory()->createQuietly([
                        'id' => '5217517a-bca4-11eb-8a9f-0a9c0da6eea3',
                    ]);
                    Brand::factory(5)->createQuietly();
                    Product::factory()->createQuietly([
                        'id' => '5217517a-bca4-11eb-8a9f-0a9c0da6eea6',
                        'title' => 'xD',
                        'category_id' => $category_one->getKey(),
                    ]);
                    Product::factory()->createQuietly([
                        'id' => '5217517a-bca4-11eb-8a9f-0a9c0da6eea5',
                        'category_id' => $category_two->getKey(),
                    ]);
                },
                'filters={"category_id": "5217517a-bca4-11eb-8a9f-0a9c0da6eea4"}',
            ],
        ];
    }

    /** @dataProvider storeDataProvider */
    public function testStore(Closure $responseFactory, $payload = [])
    {
        $url = route('products.store');

        // Call Endpoints
        $response = $this->postJson(
            $url,
            $payload
        );

        /** @var ExpectedResponse $expected */
        $expected = $responseFactory($this);
        $expected->assert($response);
    }

    public function storeDataProvider()
    {
        $apiCanStoreProduct = function (): StoreResponse {
            return new StoreResponse(
                [
                    'title' => 'xYz',
                ],
                [
                    'id',
                    'title',
                    'description',
                    'number_of_views',
                    'images',
                    'category',
                    'brand',
                    'tag',
                    'wish_list_customers',
                    'price',
                    'created_at',
                ]
            );
        };
        $apiCantStoreGiveValidationError = function (): ValidationResponse {
            return new ValidationResponse(400);
        };

        return [
            'API Can Store Product' => [
                $apiCanStoreProduct,
                [
                    'title' => 'xYz',
                ],
            ],
            'API Can\'t Store Given Validation Error' => [
                $apiCantStoreGiveValidationError,
                [],
            ],
        ];
    }
}
