<?php

namespace App\DataTransferObjects\Dtos;

use App\DataTransferObjects\MappersDtos\AddressMapperDto;
use App\DataTransferObjects\MappersDtos\TelephoneMapperDto;
use App\Support\Utils\Cases\UserCase;
use Illuminate\Support\Facades\Hash;

class UserDto extends DefaultFields
{
    public int $usuarioId;
    public int $loginSocialId;
    public string $loginSocial;
    public string $name;
    public string $cpf;
    public string $email;
    public string $password;
    public string $data_nascimento;
    public string $genero;
    public string $emailVerificado;
    public int $perfil_id;
    public array $perfil;
    public array $enderecos;
    public array $telefones;

    public static function construction(): static
    {
        return new UserDto();
    }

    public function getUsuarioId(): int
    {
        return $this->usuarioId;
    }

    public function setUsuarioId(int $usuarioId): UserDto
    {
        $this->usuarioId = $usuarioId;
        return $this;
    }

    public function getLoginSocialId(): int
    {
        return $this->loginSocialId;
    }

    public function setLoginSocialId(int $loginSocialId): UserDto
    {
        $this->loginSocialId = $loginSocialId;
        return $this;
    }

    public function getLoginSocial(): string
    {
        return $this->loginSocial;
    }

    public function setLoginSocial(string $loginSocial): UserDto
    {
        $this->loginSocial = $loginSocial;
        return $this;
    }

    public function getNome(): string
    {
        return $this->name;
    }

    public function setNome(string $name): UserDto
    {
        $this->name = $name;
        return $this;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): UserDto
    {
        $this->cpf = str_replace(array('.','-','/'), "", $cpf);
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): UserDto
    {
        $this->email = $email;
        return $this;
    }

    public function setSenha(string $password): UserDto
    {
        $this->password = Hash::make($password);
        return $this;
    }

    public function getSenha(): string
    {
        return $this->password;
    }

    public function getDataNascimento(): string
    {
        return $this->data_nascimento;
    }

    public function setDataNascimento(string $data_nascimento): UserDto
    {
        $this->data_nascimento = $data_nascimento;
        return $this;
    }

    public function getGenero(): string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): UserDto
    {
        $this->genero = $this->genero($genero);
        return $this;
    }

    public function getEmailVerificado(): string
    {
        return $this->emailVerificado;
    }

    public function setEmailVerificado(string $emailVerificado): UserDto
    {
        $this->emailVerificado = $emailVerificado;
        return $this;
    }

    public function getPerfilId(): int
    {
        return $this->perfil_id;
    }

    public function setPerfilId(int $perfil_id): UserDto
    {
        $this->perfil_id = $perfil_id;
        return $this;
    }

    public function getPerfil(): array
    {
        return $this->perfil;
    }

    public function setPerfil(array $perfil): UserDto
    {
        $this->perfil = $perfil;
        return $this;
    }

    public function getEnderecos(): array
    {
        return $this->enderecos;
    }

    public function setEnderecos(array $enderecos): UserDto
    {
        $this->enderecos = $this->addrres($enderecos);
        return $this;
    }

    public function getTelefones(): array
    {
        return $this->telefones;
    }

    public function setTelefones(array $telefones): UserDto
    {
        $this->telefones = $this->telephone($telefones);
        return $this;
    }

    private function addrres(array $addrres): array
    {
        foreach ($addrres as $key => $instance):
            $addrres[$key] = AddressMapperDto::mapper($instance);
        endforeach;
        return $addrres;
    }

    private function telephone(array $telefones): array
    {
        foreach ($telefones as $key => $instance):
            $telefones[$key] = TelephoneMapperDto::mapper($instance);
        endforeach;
        return $telefones;
    }

    private function genero(string $genero): string
    {
        $gender = new UserCase();
        return $gender->genderCase($genero);
    }
}
