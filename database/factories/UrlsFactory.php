<?php

namespace Database\Factories;

use App\Models\Urls;
use App\Repositories\Eloquent\EloquentRepositoryInterface;
use App\Repositories\Eloquent\Url\UrlRepository;
use App\Repositories\Eloquent\Url\UrlRepositoryInterface;
use App\Services\UrlService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class UrlsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Urls::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        $urlService = app(UrlService::class);

        return [
            'url' => $this->faker->url,
            'redirectId' => $urlService->generateUniqueRedirectId(),
            'expires_at' => Carbon::now()->subDays(random_int(0, 7))->format('Y-m-d')
        ];
    }
}
