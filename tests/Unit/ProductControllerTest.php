<?php

namespace Tests\Unit;

use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase; 
use Mockery;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase; //limpa o banco a cada teste

    private $productServiceMock;
    private $productController;

    //metodo responsavel por configurar os mocks e instanciar o controller
    protected function setUp(): void {

        parent::setUp();

        $this->productServiceMock = Mockery::mock(ProductService::class);

        $this->productController = new ProductController($this->productServiceMock);
    }

    public function test_index_return_all_products() {

        //retorna um object product
        Product::factory(2)->create();
      
        $response = (new ProductService()->getAll());

        $this->assertEquals($response['status'], 'success');
        $this->assertEquals($response['message'], 'Todos os produtos cadastrados');
        $this->assertCount(2, $response['data']);

    }

    public function test_index_return_all_products_empty() {

        $response = (new ProductService()->getAll());

        $this->assertEquals($response['status'], 'error');
        $this->assertEquals($response['message'], 'Sem produtos cadastrados');

    }

    public function test_index_return_all_products_exception() {

        $this->productServiceMock
            ->shouldReceive('getAll')
            ->once()
            ->andReturn([
                'status' => 'error',
                'message' => 'Falha ao listar produtos',
                'error' => 'Database connection failed'
        ]);


        $response = $this->productController->index();
        $responseData = $response->getData(true);
        
        $this->assertEquals('error', $responseData['status']);
        $this->assertEquals('Falha ao listar produtos', $responseData['message']);
        $this->assertStringContainsString('Database connection failed', $responseData['error']);

    }

    public function test_create_product_success() {

        $productData = Product::factory()->make()->toArray();

        $request = new \Illuminate\Http\Request($productData);

        $response = (new ProductService()->create($request));

        $this->assertEquals('success', $response['status']);
        $this->assertEquals('Produto cadastrado com sucesso', $response['message']);

    }

    public function test_create_product_failure() {

        $productData = Product::factory()->make()->toArray();

        $this->productServiceMock
            ->shouldReceive('create')
            ->once()
            ->andReturn([
                'status' => 'error',
                'message' => 'Falha ao cadastrar produto',
                'error' => 'Database connection failed'
        ]);

        $response = $this->productController->store(new \Illuminate\Http\Request($productData));
        $responseData = $response->getData(true);

        $this->assertEquals('error', $responseData['status']);
        $this->assertEquals('Falha ao cadastrar produto', $responseData['message']);
        //verifica que existe essa string inicial na string de error
        $this->assertStringContainsString('Database connection failed', $responseData['error']);

    }

    public function test_find_product_success() {

        $response = Product::factory(1)->create();
        
        $productData = $response->first();

        $response = (new ProductService()->find($productData->id));
        
        $this->assertEquals('success', $response['status']);
        $this->assertEquals('Produto encontrado com sucesso', $response['message']);
    }

    public function test_find_product_failure() {

        $productData = Product::factory()->make()->toArray();
        $id = $productData['id'];

        $this->productServiceMock
            ->shouldReceive('find')
            ->once()
            ->andReturn([
                'status' => 'error',
                'message' => "Falha ao procurar produto de id: $id",
                'error' => 'Database connection failed'
        ]);

        $response = $this->productController->show(new \Illuminate\Http\Request($productData));
        $responseData = $response->getData(true);

        $this->assertEquals('error', $responseData['status']);
        $this->assertEquals("Falha ao procurar produto de id: $id", $responseData['message']);
       
        $this->assertStringContainsString('Database connection failed', $responseData['error']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

}