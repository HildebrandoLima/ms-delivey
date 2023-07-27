<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\ParametersRequest;
use App\Http\Requests\User\ParamsUserRequest;
use App\Http\Requests\User\UserEditRequest;
use App\Services\User\Interfaces\CreateUserServiceInterface;
use App\Services\User\Interfaces\DeleteUserServiceInterface;
use App\Services\User\Interfaces\EditUserServiceInterface;
use App\Services\User\Interfaces\EmailUserVerifiedAtServiceInterface;
use App\Services\User\Interfaces\ListUserServiceInterface;
use App\Support\Utils\Params\BaseDecode;
use App\Support\Utils\Params\FilterByActive;
use App\Support\Utils\Params\Search;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private CreateUserServiceInterface   $createUserService;
    private DeleteUserServiceInterface   $deleteUserService;
    private EditUserServiceInterface     $editUserService;
    private ListUserServiceInterface     $listUserService;
    private EmailUserVerifiedAtServiceInterface $emailUserVerifiedAtService;

    public function __construct
    (
        CreateUserServiceInterface   $createUserService,
        DeleteUserServiceInterface   $deleteUserService,
        EditUserServiceInterface     $editUserService,
        ListUserServiceInterface     $listUserService,
        EmailUserVerifiedAtServiceInterface $emailUserVerifiedAtService
    )
    {
        $this->createUserService    =   $createUserService;
        $this->deleteUserService    =   $deleteUserService;
        $this->editUserService      =   $editUserService;
        $this->listUserService      =   $listUserService;
        $this->emailUserVerifiedAtService = $emailUserVerifiedAtService;
    }

    public function index(Search $search, FilterByActive $filter): Response
    {
        try {
            $success = $this->listUserService->listUserAll
            (
                $search->search(request()),
                $filter->active
            );
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function show(ParamsUserRequest $request, FilterByActive $filter): Response
    {
        try {
            $success = $this->listUserService->listUserFind
            (
                $request->id,
                $filter->active
            );
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function store(CreateUserRequest $request): Response
    {
        try {
            $success = $this->createUserService->createUser($request);
            if (!$success) return Controller::error();
            return Controller::post($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function update(UserEditRequest $request): Response
    {
        try {
            $success = $this->editUserService->editUser($request);
            if (!$success) return Controller::error();
            return Controller::put();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function enableDisable(ParametersRequest $request, BaseDecode $baseDecode, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->deleteUserService->deleteUser
            (
                $baseDecode::baseDecode($request->id),
                $filterByActive::filterByActive($request->active)
            );
            if (!$success) return Controller::error();
            return Controller::delete();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function emailVerifiedAt(ParamsUserRequest $request, FilterByActive $filter): Response
    {
        try {
            $success = $this->emailUserVerifiedAtService->emailVerifiedAt
            (
                $request->id,
                $filter->active
            );
            if (!$success) return Controller::error();
            return response()->json([
                "message" => "Verificação efetuada com sucesso!",
                "data" => true,
                "status" => 200,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
