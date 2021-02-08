<?php

namespace App\Services\ProcedureTimes;

use App\Models\Procedure;
use App\Services\ProcedureTimes\DTOs\FormProcedureTimeDTO;
use App\Services\ProcedureTimes\Handlers\ProcedureTimeCreateHandler;
use App\Services\ProcedureTimes\Handlers\ProcedureTimeDeleteHandler;
use App\Services\ProcedureTimes\Handlers\ProcedureTimeUpdateHandler;
use App\Services\ProcedureTimes\Repositories\ProcedureTimeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ProcedureTimeService
{

    /**
     * @var ProcedureTimeCreateHandler
     */
    private $createHandler;
    /**
     * @var ProcedureTimeRepositoryInterface
     */
    private $repository;
    /**
     * @var ProcedureTimeUpdateHandler
     */
    private $updateHandler;

    public function __construct(
        ProcedureTimeCreateHandler $createHandler,
        ProcedureTimeUpdateHandler $updateHandler,
        ProcedureTimeRepositoryInterface $repository
    )
    {
        $this->createHandler = $createHandler;
        $this->repository = $repository;
        $this->updateHandler = $updateHandler;
    }

    /**
     * Добавление записи
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $times = FormProcedureTimeDTO::fromArray($data);
        return $this->createHandler->handle($times);
    }

    /**
     * Обновить данные салона
     * @param array $data
     * @param Procedure $model
     */
    public function update(array $data, Procedure $model)
    {
        $formDTO =  FormProcedureTimeDTO::fromArray($data);
        $this->updateHandler->handle($formDTO, $model);
    }

    /**
     * Получить расписание для всего салона
     * @return Collection|null
     */
    public function getTimeBusiness(): ?Collection
    {
        return $this->repository->getTimeDefault(Auth::user()->business->id);
    }
}
