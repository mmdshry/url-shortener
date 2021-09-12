<?php

namespace Tests\Http\Controllers;

use App\Http\Controllers\UrlController;
use App\Models\Urls;
use App\Repositories\Eloquent\Url\UrlRepositoryInterface;
use App\Services\UrlService;
use DB;
use Illuminate\Database\SQLiteConnection;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutMiddleware;
use Mockery;
use Mockery\Mock;
use TestCase;

/**
 * Class UrlControllerTest.
 *
 * @covers \App\Http\Controllers\UrlController
 */
class UrlControllerTest extends TestCase
{

    use DatabaseMigrations;
    use WithoutMiddleware;
    /**
     * @var UrlController
     */
    protected UrlController $urlController;

    /**
     * @var UrlRepositoryInterface|Mock
     */
    protected $urlRepository;

    /**
     * @var UrlService|Mock
     */
    protected $urlService;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();
        if (DB::connection() instanceof SQLiteConnection) {
            DB::statement(DB::raw('PRAGMA foreign_keys=on'));
        }
        $this->urlService = app(UrlService::class);
        $this->urlRepository = app(UrlRepositoryInterface::class);
        $this->urlController = new UrlController($this->urlRepository,$this->urlService);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->urlController, $this->urlRepository, $this->urlService);
    }

    public function test_user_can_see_all_urls_list(): void
    {
        $this->json('GET', '/api/url')
            ->seeJson(['success' => true]);
    }

    public function test_user_can_create_url(): void
    {
        $url = Urls::factory()->make();
        $urls = $this->urlService->createUrl($url->toArray());
        dd($urls);

        $this->get('/')
            ->assertResponseOk();
    }

    public function testShow(): void
    {
        /** @todo This test is incomplete. */
        $this->get('/')
            ->assertResponseOk();
    }

    public function testUpdate(): void
    {
        /** @todo This test is incomplete. */
        $this->get('/', [ /* data */ ])
            ->assertResponseOk();
    }

    public function testDestroy(): void
    {
        /** @todo This test is incomplete. */
        $this->get('/')
            ->assert();
    }

    public function testRedirectUrl(): void
    {
        /** @todo This test is incomplete. */
        $this->get('/')
            ->assertResponseOk();
    }
}
