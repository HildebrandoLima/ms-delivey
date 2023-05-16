<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\UserRequest;
use App\Services\User\CreateUserService;
use App\Services\User\DeleteUserService;
use App\Services\User\EditUserService;
use App\Services\User\ListUserService;
use App\Support\Utils\BaseDecode;
use App\Support\Utils\Pagination;
use App\Support\Utils\Search;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private CreateUserService   $createUserService;
    private DeleteUserService   $deleteUserService;
    private EditUserService     $editUserService;
    private ListUserService     $listUserService;

    public function __construct
    (
        CreateUserService   $createUserService,
        DeleteUserService   $deleteUserService,
        EditUserService     $editUserService,
        ListUserService     $listUserService
    )
    {
        $this->createUserService    =   $createUserService;
        $this->deleteUserService    =   $deleteUserService;
        $this->editUserService      =   $editUserService;
        $this->listUserService      =   $listUserService;
    }

    public function index(Pagination $pagination, Search $search): Response
    {
        try {
            $success = $this->listUserService->listUserAll
            ($pagination, $search->search($pagination->search ?? ''));
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function show(string $id, BaseDecode $baseDecode): Response
    {
        try {
            $success = $this->listUserService->listUserFind($baseDecode->baseDecode($id));
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function store(UserRequest $request): Response
    {
        try {
            $success = $this->createUserService->createUser($request);
            if (!$success) return Controller::error();
            return Controller::post($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function update(string $id, UserRequest $request, BaseDecode $baseDecode): Response
    {
        try {
            $success = $this->editUserService->editUser
            ($baseDecode->baseDecode($id), $request);
            if (!$success) return Controller::error();
            return Controller::put();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function destroy(string $id, BaseDecode $baseDecode): Response
    {
        try {
            $success = $this->deleteUserService->deleteUser($baseDecode->baseDecode($id));
            if (!$success) return Controller::error();
            return Controller::delete();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
