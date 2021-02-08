<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessContact\StoreBusinessContactRequest;
use App\Http\Requests\BusinessContact\UpdateBusinessContactRequest;
use App\Models\BusinessAddress;
use App\Models\BusinessContact;
use App\Services\BusinessContacts\BusinessContactService;
use App\Services\BusinessContactTypes\BusinessContactTypeService;
use Illuminate\Support\Facades\Redirect;

class BusinessContactController extends Controller
{
    /**
     * @var BusinessContactService
     */
    private $service;
    /**
     * @var BusinessContactTypeService
     */
    private $typeService;

    /**
     * Create a new controller instance.
     *
     * @param BusinessContactService $service
     * @param BusinessContactTypeService $typeService
     */
    public function __construct(
        BusinessContactService $service,
        BusinessContactTypeService $typeService
    )
    {
        $this->service = $service;
        $this->typeService = $typeService;
    }

    /**
     * Страница добавления записи
     * @param BusinessAddress $address
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View+
     */
    public function create(BusinessAddress $address)
    {
        $types = $this->typeService->list();
        return view('business-contact.create', [
            'contact' => new BusinessContact(),
            'types' => $types,
            'address' => $address,
        ]);
    }

    /**
     * Добавление записи
     * @param StoreBusinessContactRequest $request
     * @return mixed
     */
    public function store(StoreBusinessContactRequest $request)
    {
        $this->service->create($request->getFormData());
        return Redirect::to(action([BusinessAddressController::class, 'index']));
    }

    /**
     * Форма редактирование записи
     * @param BusinessContact $contact
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(BusinessContact $contact)
    {
        $types = $this->typeService->list();
        return view('business-contact.edit', [
            'contact' => $contact,
            'types' => $types,
        ]);
    }

    /**
     * Редактирование записи
     * @param UpdateBusinessContactRequest $request
     * @param BusinessContact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBusinessContactRequest $request, BusinessContact $contact)
    {
        $this->service->update($request->getFormData(), $contact);
        return Redirect::to(action([BusinessAddressController::class, 'index']));
    }

    /**
     * Удалить запись
     * @param BusinessContact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(BusinessContact $contact)
    {
        $this->service->delete($contact);
        return Redirect::to(action([BusinessAddressController::class, 'index']));
    }
}
