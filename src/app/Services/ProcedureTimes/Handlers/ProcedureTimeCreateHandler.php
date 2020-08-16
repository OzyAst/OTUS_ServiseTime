<?php

namespace App\Services\ProcedureTimes\Handlers;

use App\Services\ProcedureTimes\DTOs\CreateFormProcedureTimeDTO;
use App\Services\ProcedureTimes\DTOs\FormProcedureTimeDTO;
use App\Services\ProcedureTimes\Repositories\ProcedureTimeRepositoryInterface;
use Illuminate\Support\Facades\Auth;

/**
 * Добавление контакта к адресу салона
 * Class BusinessCreateHandler
 * @package App\Services\ProcedureTimes\Handlers
 */
class ProcedureTimeCreateHandler
{

    /**
     * @var ProcedureTimeRepositoryInterface
     */
    private $repository;

    public function __construct(
        ProcedureTimeRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function handle(FormProcedureTimeDTO $formDTO): array
    {
        $procedureTimes = [];

        foreach ($formDTO->day as $key => $day) {
            $createDTO = new CreateFormProcedureTimeDTO(
                Auth::user()->business->id,
                $formDTO->procedure_id,
                $formDTO->start[$key],
                $formDTO->end[$key],
                $day,
                $formDTO->day_off[$key]
            );

            $procedureTimes[] = $this->repository->create($createDTO);
        }

        return $procedureTimes;
    }
}
