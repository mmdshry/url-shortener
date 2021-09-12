<?php

namespace App\Services;

use App\Models\Urls;
use App\Repositories\Eloquent\Url\UrlRepositoryInterface;
use Exception;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class UrlService
{
    /**
     * @var UrlRepositoryInterface
     */
    private UrlRepositoryInterface $urlRepository;

    /**
     * @param UrlRepositoryInterface $urlRepository
     */
    public function __construct(UrlRepositoryInterface $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    /**
     * Create new record with given data
     * @param array $data
     * @return array
     */
    public function store(array $data): array
    {
        $validator = Validator::make($data, [
            'url' => 'required|url',
            'expires_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return ['success' => false, 'data' => $validator->errors()->first(), 'code' => Response::HTTP_UNPROCESSABLE_ENTITY];
        }

        $validated = $validator->validated();

        try {
            $model = $this->urlRepository->create([
                'url' => $validated['url'],
                'redirectId' => $this->generateUniqueRedirectId(),
                'expires_at' => $validated['expires_at'] ?? null
            ]);
            return ['success' => true, 'data' => $model, 'code' => Response::HTTP_CREATED];
        } catch (Exception $exception) {
            return ['success' => false, 'data' => $exception->getMessage(), 'code' => Response::HTTP_INTERNAL_SERVER_ERROR];
        }
    }

    /**
     * Update record of given redirect id
     * @param array $data
     * @return array
     */
    public function update(array $data): array
    {
        $validator = Validator::make($data, [
            'redirectId' => 'required|string|min:4|max:4',
            'url' => 'required_without:expires_at|url',
            'expires_at' => 'required_without:url|date'
        ]);

        if ($validator->fails()) {
            return ['success' => false, 'data' => $validator->errors()->first(), 'code' => Response::HTTP_UNPROCESSABLE_ENTITY];
        }

        $validated = $validator->validated();

        try {
            $model = $this->urlRepository->update($validated['redirectId'],$validated);
            return ['success' => true, 'data' => $model, 'code' => Response::HTTP_OK];
        } catch (Exception $exception) {
            return ['success' => false, 'data' => $exception->getMessage(), 'code' => Response::HTTP_INTERNAL_SERVER_ERROR];
        }
    }

    /**
     * @return string
     */
    public function generateUniqueRedirectId(): string
    {
        $uniqueId = Str::random(4);

        if (Urls::where('redirectId', $uniqueId)->exists()) {
            return $this->generateUniqueRedirectId();
        }

        return $uniqueId;
    }

}
