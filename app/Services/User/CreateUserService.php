<?php

namespace App\Services\User;

use App\Http\Requests\UserRequest;
use App\Jobs\EmailForRegisterJob;
use App\Repositories\UserRepository;
use App\Services\User\Interfaces\ICreateUserService;
use App\Support\Utils\CheckRegister\CheckUser;
use App\Support\Utils\MapToModel\UserModel;

class CreateUserService implements ICreateUserService
{
    private CheckUser $checkUser;
    private UserModel $userModel;
    private UserRepository $userRepository;

    public function __construct
    (
        CheckUser      $checkUser,
        UserModel      $userModel,
        UserRepository $userRepository
    )
    {
        $this->checkUser      = $checkUser;
        $this->userModel      = $userModel;
        $this->userRepository = $userRepository;
    }

    public function createUser(UserRequest $request): int
    {
        $this->checkUser->checkUserExist($request);
        $user = $this->userModel->userModel($request, 'create');
        $userId = $this->userRepository->insert($user);
        EmailForRegisterJob::dispatch($request->email);
        return $userId;
    }
}
