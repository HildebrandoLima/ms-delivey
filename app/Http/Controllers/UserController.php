<?php

namespace App\Http\Controllers;

use App\Domains\Services\User\Concretes\ListFindByIdUserService;
use App\Domains\Services\User\Interfaces\ICreateUserService;
use App\Domains\Services\User\Interfaces\IEmailUserVerifiedAtService;
use App\Domains\Services\User\Interfaces\IListAllUserService;
use App\Domains\Services\User\Interfaces\IUpdateUserService;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\ListAllUserRequest;
use App\Http\Requests\User\ListFindByIdUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class UserController extends Controller
{
    private ICreateUserService          $createUserService;
    private IEmailUserVerifiedAtService $emailUserVerifiedAtService;
    private IListAllUserService         $listAllUserService;
    private ListFindByIdUserService     $listFindByIdUserService;
    private IUpdateUserService          $updateUserService;

    public function __construct
    (
        ICreateUserService          $createUserService,
        IEmailUserVerifiedAtService $emailUserVerifiedAtService,
        IListAllUserService         $listAllUserService,
        ListFindByIdUserService     $listFindByIdUserService,
        IUpdateUserService          $updateUserService
    )
    {
        $this->createUserService          = $createUserService;
        $this->emailUserVerifiedAtService = $emailUserVerifiedAtService;
        $this->listAllUserService         = $listAllUserService;
        $this->listFindByIdUserService    = $listFindByIdUserService;
        $this->updateUserService          = $updateUserService;
    }

    public function index(ListAllUserRequest $request): Response
    {
        try {
            $success = $this->listAllUserService->listAll($request);
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function show(ListFindByIdUserRequest $request): Response
    {
        try {
            $success = $this->listFindByIdUserService->listFindById($request);
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function store(CreateUserRequest $request): Response
    {
        try {
            $success = $this->createUserService->create($request);
            return Controller::post($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function update(UpdateUserRequest $request): Response
    {
        try {
            $success = $this->updateUserService->update($request);
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
