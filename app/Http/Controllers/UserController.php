<?php

namespace App\Http\Controllers;

use App\Domains\Services\User\Abstracts\ICreateUserService;
use App\Domains\Services\User\Abstracts\IEditUserService;
use App\Domains\Services\User\Abstracts\IEmailUserVerifiedAtService;
use App\Domains\Services\User\Abstracts\IListUserService;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Http\Requests\User\ParamsUserRequest;
use App\Http\Requests\User\PermissonUserRequest;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class UserController extends Controller
{
    private ICreateUserService          $createUserService;
    private IEditUserService            $editUserService;
    private IListUserService            $listUserService;
    private IEmailUserVerifiedAtService $emailUserVerifiedAtService;

    public function __construct
    (
        ICreateUserService          $createUserService,
        IEditUserService            $editUserService,
        IListUserService            $listUserService,
        IEmailUserVerifiedAtService $emailUserVerifiedAtService
    )
    {
        $this->createUserService          =   $createUserService;
        $this->editUserService            =   $editUserService;
        $this->listUserService            =   $listUserService;
        $this->emailUserVerifiedAtService =   $emailUserVerifiedAtService;
    }

    public function index(PermissonUserRequest $request): Response
    {
        try {
            $success = $this->listUserService->listUserAll($request);
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function show(ParamsUserRequest $request): Response
    {
        try {
            $success = $this->listUserService->listUserFind($request);
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function store(CreateUserRequest $request): Response
    {
        try {
            $success = $this->createUserService->createUser($request);
            return Controller::post($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function update(EditUserRequest $request): Response
    {
        try {
            $success = $this->editUserService->editUser($request);
            return Controller::put($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function emailVerifiedAt(int $id): Response
    {
        try {
            $this->emailUserVerifiedAtService->emailVerifiedAt($id);
            return response()->json([
                "message" => "Verificação efetuada com sucesso!",
                "data" => true,
                "status" => 200,
                "details" => ""
            ]);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }
}
