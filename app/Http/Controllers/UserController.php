<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ParametersRequest;
use App\Services\User\CreateUserService;
use App\Services\User\DeleteUserService;
use App\Services\User\EditUserService;
use App\Services\User\EmailUserVerifiedAtService;
use App\Services\User\ListUserService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Parameters\BaseDecode;
use App\Support\Utils\Parameters\FilterByActive;
use App\Support\Utils\Parameters\Search;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private CreateUserService   $createUserService;
    private DeleteUserService   $deleteUserService;
    private EditUserService     $editUserService;
    private ListUserService     $listUserService;
    private EmailUserVerifiedAtService $emailUserVerifiedAtService;

    public function __construct
    (
        CreateUserService   $createUserService,
        DeleteUserService   $deleteUserService,
        EditUserService     $editUserService,
        ListUserService     $listUserService,
        EmailUserVerifiedAtService $emailUserVerifiedAtService
    )
    {
        $this->createUserService    =   $createUserService;
        $this->deleteUserService    =   $deleteUserService;
        $this->editUserService      =   $editUserService;
        $this->listUserService      =   $listUserService;
        $this->emailUserVerifiedAtService = $emailUserVerifiedAtService;
    }

    public function index(Pagination $pagination, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->listUserService->listUserAll
            (
                $filterByActive->filterByActive($pagination->active)
            );
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function show(ParametersRequest $request, BaseDecode $baseDecode, Search $search, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->listUserService->listUserFind
            (
                $baseDecode->baseDecode($request->id ?? ''),
                $search->search($request->search ?? ''),
                $filterByActive->filterByActive($request->active)
            );
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

    public function enableDisable(ParametersRequest $request, BaseDecode $baseDecode, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->deleteUserService->deleteUser
            (
                $baseDecode->baseDecode($request->id),
                $filterByActive->filterByActive($request->active)
            );
            if (!$success) return Controller::error();
            return Controller::delete();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function emailVerifiedAt(ParametersRequest $request, BaseDecode $baseDecode, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->emailUserVerifiedAtService->emailVerifiedAt
            (
                $baseDecode->baseDecode($request->id),
                $filterByActive->filterByActive($request->active)
            );
            if (!isset ($success)):
                return response()->json([
                    "message" => "Error ao efetuar verificação!",
                    "data" => false,
                    "status" => Response::HTTP_UNAUTHORIZED,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Verificação efetuada com sucesso!",
                "data" => $success,
                "status" => 200,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
