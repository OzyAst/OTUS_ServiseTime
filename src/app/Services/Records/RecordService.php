<?php

namespace App\Services\Records;

use App\Models\Record;
use App\Models\User;
use App\Services\Records\DTO\RecordCreateDTO;
use App\Services\Records\DTO\RecordUpdateBusinessDTO;
use App\Services\Records\DTO\RecordUpdateDTO;
use App\Services\Records\Handlers\RecordBusinessDeleteHandler;
use App\Services\Records\Handlers\RecordBusinessUpdateHandler;
use App\Services\Records\Handlers\RecordCreateHandler;
use App\Services\Records\Handlers\RecordClientDeleteHandler;
use App\Services\Records\Handlers\RecordUpdateHandler;
use App\Services\Records\Repositories\RecordRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class RecordService
{

    private RecordRepositoryInterface $repository;
    private RecordCreateHandler $createHandler;
    private RecordUpdateHandler $updateHandler;
    private RecordClientDeleteHandler $deleteClientHandler;
    private RecordBusinessDeleteHandler $deleteBusinessHandler;
    private RecordBusinessUpdateHandler $businessUpdateHandler;

    public function __construct(
        RecordRepositoryInterface $repository,
        RecordCreateHandler $createHandler,
        RecordUpdateHandler $updateHandler,
        RecordBusinessUpdateHandler $businessUpdateHandler,
        RecordClientDeleteHandler $deleteClientHandler,
        RecordBusinessDeleteHandler $deleteBusinessHandler
    ) {
        $this->repository = $repository;
        $this->createHandler = $createHandler;
        $this->updateHandler = $updateHandler;
        $this->deleteClientHandler = $deleteClientHandler;
        $this->deleteBusinessHandler = $deleteBusinessHandler;
        $this->businessUpdateHandler = $businessUpdateHandler;
    }

    /**
     * Списк всех записей для салона
     * @param User $user
     * @return Collection|null
     */
    public function getUserRecords(User $user): ?Collection
    {
        if (Auth::guest() || !$user->business) {
            return new Collection();
        }

        return $this->repository->findByBusinessId($user->business->id);
    }

    /**
     * Список записей для процедуры
     * @param int $procedure_id
     * @param Carbon|null $date_start
     * @param Carbon|null $date_end
     * @return Collection|null
     */
    public function getProcedureRecords(int $procedure_id, ?Carbon $date_start, ?Carbon $date_end): ?Collection
    {
        $date_start = $date_start ?? now();
        $date_end = $date_end ?? now()->addDays(Record::GET_RECORDS_FOR_DAYS);

        return $this->repository->findByProcedureId($procedure_id, $date_start, $date_end);
    }

    /**
     * Данные по записи
     * @param $record_id
     * @param User $user
     * @return Record|null
     */
    public function findRecordUser($record_id, User $user)
    {
        return $this->repository->findByClientIdOrFail($record_id, $user->id);
    }

    /**
     * Добавить запись
     * @param array $data
     * @param User $user
     * @return Record
     */
    public function createForUser(array $data, User $user): Record
    {
        $record = RecordCreateDTO::fromArray($data);
        return $this->createHandler->handle($record, $user);
    }

    /**
     * Обновить запись для пользователя
     * @param array $data
     * @param int $record_id
     * @param User $user
     */
    public function updateForUser(array $data, int $record_id, User $user): void
    {
        $DTO = RecordUpdateDTO::fromArray($data);
        $this->updateHandler->handle($DTO, $record_id, $user);
    }

    /**
     * Обновить запись для бизнеса
     * @param array $data
     * @param int $record_id
     * @param User $user
     */
    public function updateForBusiness(array $data, int $record_id, User $user): void
    {
        $DTO = RecordUpdateBusinessDTO::fromArray($data);
        $this->businessUpdateHandler->handle($DTO, $record_id, $user);
    }

    /**
     * Удалить запись клиента
     * @param int $record_id
     * @param User $user
     */
    public function deleteUserRecord(int $record_id, User $user): void
    {
        $this->deleteClientHandler->handle($record_id, $user);
    }

    /**
     * Удалить запись бизнеса
     * @param int $record_id
     * @param User $user
     */
    public function deleteBusinessRecord(int $record_id, User $user): void
    {
        $this->deleteBusinessHandler->handle($record_id, $user->business->id);
    }
}
