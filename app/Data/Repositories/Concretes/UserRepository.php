<?php

namespace App\Data\Repositories\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Domains\Dtos\UserDto;
use App\Data\Repositories\Abstracts\IUserRepository;
use App\Domains\Traits\Dtos\AutoMapper;
use App\Exceptions\HttpInternalServerError;
use App\Models\PasswordReset;
use App\Models\User;
use App\Support\Queries\QueryFilter;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Exception;

class UserRepository extends DBConnection implements IUserRepository
{
    use AutoMapper;

    public function hasPagination(string $search, bool $filter): Collection
    {
        $collection = $this->query($search, 0, $filter)->paginate(10);
        foreach ($collection->items() as $key => $instance):
          $collection[$key] = $this->map($instance->toArray());
        endforeach;
        return PaginationList::createFromPagination($collection);
    }

    public function noPagination(string $search, bool $filter): Collection
    {
        $collection = $this->query($search, 0, $filter)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = $this->map($instance);
        endforeach;
        return $collection;
    }

    public function readOne(int $id, bool $filter): Collection
    {
        $collection = $this->query('', $id, $filter)->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = $this->map($instance);
        endforeach;
        return $collection;
    }

    private function query(string $search, int $id, bool $filter): Builder
    {
        return User::with('endereco')->with('telefone')
        ->where(function($query) use ($search, $id, $filter) {
            if (!empty($search)):
                $query->where('users.nome', 'like', $search);
            elseif (!empty($id)):
                $query->where('users.id', '=', $id);
            else:
                QueryFilter::getQueryFilter($query, $filter);
            endif;
        })->orderByDesc('users.id');
    }

    public function readCode(string $codigo): int
    {
        return User::query()
        ->join('password_resets as pr', 'pr.email', '=', 'users.email')
        ->select('users.id')->where('pr.codigo', '=', $codigo)->get()->first()->id;
    }

    public function delete(string $codigo): bool
    {
        try {
            $this->db->beginTransaction();
            $id = PasswordReset::query()->where('codigo', '=', $codigo)->delete();
            $this->db->commit();
            return $id;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }

    private function map(array $data): UserDto
    {
        return $this->mapper($data, UserDto::class);  
    }
}
