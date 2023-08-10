<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Http\Requests\User\ParamsUserRequest;
use App\Http\Requests\User\PermissonUserRequest;
use App\Services\User\Interfaces\CreateUserServiceInterface;
use App\Services\User\Interfaces\EditUserServiceInterface;
use App\Services\User\Interfaces\EmailUserVerifiedAtServiceInterface;
use App\Services\User\Interfaces\ListUserServiceInterface;
use App\Support\Utils\Params\FilterByActive;
use App\Support\Utils\Params\Search;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private CreateUserServiceInterface          $createUserService;
    private EditUserServiceInterface            $editUserService;
    private ListUserServiceInterface            $listUserService;
    private EmailUserVerifiedAtServiceInterface $emailUserVerifiedAtService;

    public function __construct
    (
        CreateUserServiceInterface          $createUserService,
        EditUserServiceInterface            $editUserService,
        ListUserServiceInterface            $listUserService,
        EmailUserVerifiedAtServiceInterface $emailUserVerifiedAtService
    )
    {
        $this->createUserService          =   $createUserService;
        $this->editUserService            =   $editUserService;
        $this->listUserService            =   $listUserService;
        $this->emailUserVerifiedAtService = $emailUserVerifiedAtService;
    }

    public function index(PermissonUserRequest $request, Search $search, FilterByActive $filter): Response
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
            $success = $this->listUserService->listUserOne
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

    public function update(EditUserRequest $request): Response
    {
        try {
            $success = $this->editUserService->editUser($request);
            if (!$success) return Controller::error();
            return Controller::put();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function emailVerifiedAt(int $id): Response
    {
        try {
            $success = $this->emailUserVerifiedAtService->emailVerifiedAt($id);
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
