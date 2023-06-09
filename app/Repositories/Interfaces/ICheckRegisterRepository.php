<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProviderRequest;
use App\Http\Requests\UserRequest;

interface ICheckRegisterRepository {
    public function checkAddressIdExist(int $id): void;
    public function checkCategoryExist(CategoryRequest $request): void;
    public function checkCategoryIdExist(int $id): void;
    public function checkProductExist(ProductRequest $request): void;
    public function checkProductIdExist(int $id): void;
    public function checkProviderExist(ProviderRequest $request): void;
    public function checkProviderIdExist(int $id): void;
    public function checkTelephoneExist(string $numero): void;
    public function checkTelephoneIdExist(int $id): void;
    public function checkUserExist(UserRequest $request): void;
    public function checkUserIdExist(int $id): void;
    public function checkUserCodeRefreshPassword(string $codigo): void;
    public function checkTokenPassword(string $token): void;
    public function checkUserSocial(string $email);
}
