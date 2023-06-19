<?php

namespace App\DataTransferObjects\Create;

use App\Http\Requests\UserRequest;
use App\Support\Utils\Cases\UserCase;
use App\Support\Utils\Enums\PerfilEnum;
use App\Support\Utils\Enums\UserEnum;
use Illuminate\Support\Facades\Hash;

class UserDto
{
    public string $name;
    public string $cpf;
    public string $email;
    public string $password;
    public string $data_nascimento;
    public string $genero;
    public bool $ativo;
    public int $perfil_id;

    public function __construct(string $name, string $cpf, string $email, string $password, string $data_nascimento, string $genero, bool $ativo, int $perfil_id)
    {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->password = $password;
        $this->data_nascimento = $data_nascimento;
        $this->genero = $this->genero($genero);
        $this->ativo = $ativo;
        $this->perfil_id = $perfil_id;
    }

    public static function fromRquest(UserRequest $request): self
    {
        return new self(
            $request->nome,
            str_replace(array('.','-','/'), "", $request->cpf),
            $request->email,
            Hash::make($request->senha),
            $request->dataNascimento,
            $request->genero,
            $request->ativo == UserEnum::ATIVADO,
            $request->perfilId == 1 ? PerfilEnum::ADMIN : PerfilEnum::CLIENTE
        );
    }

    private function genero(string $genero): string
    {
        $gender = new UserCase();
        return $gender->genderCase($genero);
    }
}
