<?php
namespace App\Http\Controllers;

use App\Http\Factories\OrderFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends Controller
{
    private const USER_ORDER_REMEMBER = 1;

    /**
     * @param string $user
     * @return JsonResponse
     * @internal param string $order
     * @internal param Request $request
     */
    public function orders(string $user): JsonResponse
    {
        try {
            $data = Cache::remember('user.' . $user . '.orders', self::USER_ORDER_REMEMBER, function () use ($user) {
                return (new OrderFactory())->retrieveUserOrders($user);
            });
        }catch (HttpException $exception) {
            return new JsonResponse(
                $exception->getMessage(),
                $exception->getStatusCode()
            );
        }

        return new JsonResponse($data, 200);
    }

}
