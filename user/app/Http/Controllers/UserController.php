<?php
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * @var $users Collection
     */
    private $users;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->users = new Collection([
            "1" => "User 1",
            "2" => "User 2",
            "3" => "User 3",
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse($this->users->toArray(), 200);
    }

    /**
     * @param string $user
     * @return JsonResponse
     * @internal param Request $request
     */
    public function show(string $user): JsonResponse
    {
        $result = $this->users->get($user);

        if (! $result){
            //TODO: REFACTOR TO REPOSITORY IN DOMAIN?
            Log::warning(sprintf('User not found with ID: %s', $user));
            return new JsonResponse(
                'User not found',
                404
            );
        }

        return new JsonResponse($result, 200);
    }

}
