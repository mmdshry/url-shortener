<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\Url\UrlRepository;
use App\Repositories\Eloquent\Url\UrlRepositoryInterface;
use App\Services\UrlService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Http\Redirector;
use Symfony\Component\HttpFoundation\Response;

class UrlController extends Controller
{
    /**
     * @var UrlService
     */
    private UrlService $urlService;

    /**
     * @var UrlRepository
     */
    private UrlRepository $urlRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UrlRepositoryInterface $urlRepository, UrlService $urlService)
    {
        $this->urlService = $urlService;
        $this->urlRepository = $urlRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse('Operation was Successful', $this->urlRepository->all(), Response::HTTP_OK);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function create(Request $request): ?JsonResponse
    {
        $response = $this->urlService->store($request->all());

        if ($response['success']) {
            return $this->sendResponse('Url Created Successfully', $response['data'], $response['code']);
        }

        return $this->sendError($response['data'], $response['code']);
    }

    /**
     * @param  string  $redirectId
     * @return JsonResponse
     */
    public function show(string $redirectId): JsonResponse
    {
        if ($this->urlRepository->isRedirectIdExists($redirectId)) {
            $model = $this->urlRepository->findByRedirectId($redirectId);

            return $this->sendResponse('Url Fetched Successfully', $model, Response::HTTP_OK);
        }

        return $this->sendError('The Link Does Not Exists!', Response::HTTP_NOT_FOUND);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $response = $this->urlService->update($request->all());

        if ($response['success']) {
            $model = $this->urlRepository->findByRedirectId($request->redirectId);

            return $this->sendResponse('Url Updated Successfully', $model, $response['code']);
        }

        return $this->sendError($response['data'], $response['code']);
    }

    /**
     * @param  string  $redirectId
     * @return JsonResponse
     */
    public function destroy(string $redirectId): JsonResponse
    {
        if ($this->urlRepository->isRedirectIdExists($redirectId)) {
            $model = $this->urlRepository->findByRedirectId($redirectId);

            return $this->sendResponse('Url Destroyed Successfully', $model, Response::HTTP_OK);
        }

        return $this->sendError('The Link Does Not Exists!', Response::HTTP_NOT_FOUND);
    }

    /**
     * @param  string  $redirectId
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function redirectUrl(string $redirectId)
    {
        if ($this->urlRepository->isRedirectIdExists($redirectId)) {
            $model = $this->urlRepository->findByRedirectId($redirectId);
            if ($this->urlRepository->isRedirectIdValid($model)) {
                return redirect($model->url);
            }

            return $this->sendError('The Link Has Been Expired!', Response::HTTP_GONE);
        }

        return $this->sendError('The Link Does Not Exists!', Response::HTTP_NOT_FOUND);
    }
}
