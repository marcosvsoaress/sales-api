<?php

namespace App\Http\Controllers;

use App\Contracts\Clients\ClientRepositoryInterface;
use App\Dominios\Clients\Client;
use App\Dominios\Clients\ClientRepository;
use App\Dominios\Clients\ClientResponseApi;
use App\Http\Requests\Clients\StoreClientRequest;
use App\Http\Requests\Clients\UpdateClientRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * Create a new controller instance.
     *
     * @param ClientRepositoryInterface $clientRepository
     */
    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * Get all clients
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $clients = $this->clientRepository->getAll();
        return response()->json(ClientResponseApi::create($clients)->toResponse(), 200);
    }

    /**
     * Get one client
     *
     * @param $idClient
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($idClient)
    {
        $client = $this->clientRepository->get($idClient);
        return response()->json(ClientResponseApi::create($client)->toResponse(), 200);
    }

    /**
     * Create a new client
     *
     * @param StoreClientRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreClientRequest $request)
    {
        $client = new Client(
            $request->name,
            $request->cpf,
            $request->phone,
            $request->email
        );

        if (!empty($request->birth_date)) {
            $client->setBirthDate(Carbon::createFromFormat('Y-m-d', $request->birth_date));
        }

        try {
            $client = $this->clientRepository->create($client);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            $message = 'It was not possible create client data';
            return response()->json(ClientResponseApi::errorResponseJson($message), 500);
        }

        return response()->json(ClientResponseApi::create($client)->toResponse(), 201);
    }

    /**
     * Update a client existing
     *
     * @param UpdateClientRequest $request
     * @param $idClient
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateClientRequest $request, $idClient)
    {
        /**
         * @var Client
         */
        $client = $this->clientRepository->get($idClient);

        if(is_null($client)){
            return response()->json(ClientResponseApi::create($client)->toResponse(), 204);
        }

        if ($request->name) {
            $client->setName($request->name);
        }

        if ($request->cpf) {
            $client->setCpf($request->cpf);
        }

        if ($request->phone) {
            $client->setPhone($request->phone);
        }

        if ($request->email) {
            $client->setEmail($request->email);
        }

        if ($request->birth_date) {
            $client->setBirthDate(Carbon::createFromFormat('Y-m-d', $request->birth_date));
        }

        try {
            $client = $this->clientRepository->update($client);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            $message = 'It was not possible update client data';
            return response()->json(ClientResponseApi::errorResponseJson($message), 500);
        }

        return response()->json(ClientResponseApi::create($client)->toResponse(), 200);
    }

    public function destroy($clientId){
        try {
            if($this->clientRepository->delete($clientId)){
                return response()->json(ClientResponseApi::responseJson('The client has been removed'));
            }else{
                return response()->json(ClientResponseApi::responseJson('It was not possible remove client data'));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            $message = 'It was not possible remove client data';
            return response()->json(ClientResponseApi::errorResponseJson($message), 500);
        }
    }
}
