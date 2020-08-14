<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessAddress\StoreBusinessAddressRequest;
use App\Http\Requests\BusinessAddress\UpdateBusinessAddressRequest;
use App\Models\BusinessAddress;
use App\Services\BusinessAddresses\BusinessAddressService;
use Illuminate\Support\Facades\Redirect;

class BusinessAddressController extends Controller
{
    /**
     * @var BusinessAddressService
     */
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param BusinessAddressService $service
     */
    public function __construct(
        BusinessAddressService $service
    )
    {
        $this->service = $service;
    }

    /**
     * Главная страница
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('business-address.index', [
            'addresses' => $this->service->getMyAddress()
        ]);
    }

    /**
     * Страница добавления записи
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View+
     */
    public function create()
    {
        return view('business-address.create', [
            'address' => new BusinessAddress(),
        ]);
    }

    /**
     * Добавление записи
     * @param StoreBusinessAddressRequest $request
     * @return mixed
     */
    public function store(StoreBusinessAddressRequest $request)
    {
        $this->service->create($request->getFormData());
        return Redirect::to(action([self::class, 'index']));
    }

    /**
     * Форма редактирование записи
     * @param BusinessAddress $address
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(BusinessAddress $address)
    {
        return view('business-address.edit', [
            'address' => $address,
        ]);
    }

    /**
     * Редактирование записи
     * @param UpdateBusinessAddressRequest $request
     * @param BusinessAddress $address
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBusinessAddressRequest $request, BusinessAddress $address)
    {
        $this->service->update($request->getFormData(), $address);
        return Redirect::to(action([self::class, 'index']));
    }

    /**
     * Удалить запись
     * @param BusinessAddress $address
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(BusinessAddress $address)
    {
        $this->service->delete($address);
        return Redirect::to(action([self::class, 'index']));
    }
}
