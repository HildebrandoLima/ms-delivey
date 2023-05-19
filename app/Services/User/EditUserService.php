<?php

namespace App\Services\User;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\Services\User\Interfaces\IEditUserService;
use App\Support\Utils\CheckRegister\CheckUser;
use App\Support\Utils\MapToModel\UserModel;

class EditUserService implements IEditUserService
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

    public function editUser(int $id, UserRequest $request): bool
    {
        $this->request = $request;
        $this->checkUser->checkUserIdExist($id);
        $user = $this->userModel->userModel($request, 'edit');
        return $this->userRepository->update($id, $user);
    }
}
