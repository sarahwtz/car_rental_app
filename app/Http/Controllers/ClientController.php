<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;


class ClientController extends Controller
{
     protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
{
    $clientRepository = new ClientRepository($this->client);

    if ($request->has('filter')) {
        $clientRepository->filter($request->filter);
    }

    if ($request->has('fields')) {
        $clientRepository->selectFields($request->fields);
    }

    return response()->json($clientRepository->getResult(), 200);
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
         $client = $this->client->create($request->validated());

          return response()->json($client, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $client = $this->client->find($id);

        if (!$client) {
            return response()->json(['error' => 'The searched item does not exist'], 404);
        }

        return response()->json($client, 200);
    }

  
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, $id)
    {
            $client = $this->client->find($id);

             if (!$client) {
            return response()->json(['error' => 'The requested item does not exist'], 404);
        }

             $client->update($request->validated());

             return response()->json($client, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $client = $this->client->find($id);

        if (!$client) {
            return response()->json(['error' => 'The requested item does not exist'], 404);
        }

        $client->delete();

        return response()->json(['message' => 'The client was deleted successfully!'], 200);
        }
}
