<?php
namespace App\Services;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;

class UserService
{

    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all users
     */
    public function getAllUsers():array
    {
        return [
            'users' => UserResource::collection($this->userRepository->getAllUsers())->response()->getData(true)
        ];
    }
}
