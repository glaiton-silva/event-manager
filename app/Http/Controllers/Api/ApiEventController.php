<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Info(title="Event Manager API", version="1.0")
 */
class ApiEventController extends Controller
{
    /**
     * Exibir uma lista de eventos.
     *
     * @OA\Get(
     *     path="/api/events",
     *     summary="Listar todos os eventos",
     *     @OA\Response(response="200", description="Lista de eventos")
     * )
     */
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }

    /**
     * Criar um novo evento.
     *
     * @OA\Post(
     *     path="/api/events",
     *     summary="Criar um novo evento",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"event_date", "name", "responsible", "city", "state", "address", "number", "phone"},
     *             @OA\Property(property="image", type="string", format="binary", description="Imagem"),
     *             @OA\Property(property="event_date", type="string", format="date-time", description="Data e hora do evento"),
     *             @OA\Property(property="name", type="string", description="Nome do evento"),
     *             @OA\Property(property="responsible", type="string", description="Responsável"),
     *             @OA\Property(property="city", type="string", description="Cidade"),
     *             @OA\Property(property="state", type="string", description="Estado"),
     *             @OA\Property(property="address", type="string", description="Endereço"),
     *             @OA\Property(property="number", type="string", description="Número"),
     *             @OA\Property(property="complement", type="string", description="Complemento"),
     *             @OA\Property(property="phone", type="string", description="Telefone"),
     *         )
     *     ),
     *     @OA\Response(response="201", description="Evento criado com sucesso")
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateEvent($request);

        $event = new Event($validatedData);

        if ($request->hasFile('image')) {
            $event->image = $request->file('image')->store('events');
        }

        $event->save();

        return response()->json(['message' => 'Evento criado com sucesso', 'event' => $event], 201);
    }

    /**
     * Exibir os detalhes de um evento.
     *
     * @OA\Get(
     *     path="/api/events/{id}",
     *     summary="Mostrar um evento",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Detalhes do evento")
     * )
     */
    public function show(Event $event)
    {
        return response()->json($event);
    }

    /**
     * Atualizar um evento existente.
     *
     * @OA\Put(
     *     path="/api/events/{id}",
     *     summary="Atualizar um evento",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"event_date", "name", "responsible", "city", "state", "address", "number", "phone"},
     *             @OA\Property(property="image", type="string", format="binary", description="Imagem"),
     *             @OA\Property(property="event_date", type="string", format="date-time", description="Data e hora do evento"),
     *             @OA\Property(property="name", type="string", description="Nome do evento"),
     *             @OA\Property(property="responsible", type="string", description="Responsável"),
     *             @OA\Property(property="city", type="string", description="Cidade"),
     *             @OA\Property(property="state", type="string", description="Estado"),
     *             @OA\Property(property="address", type="string", description="Endereço"),
     *             @OA\Property(property="number", type="string", description="Número"),
     *             @OA\Property(property="complement", type="string", description="Complemento"),
     *             @OA\Property(property="phone", type="string", description="Telefone"),
     *         )
     *     ),
     *     @OA\Response(response="200", description="Evento atualizado com sucesso")
     * )
     */
    public function update(Request $request, Event $event)
    {
        $validatedData = $this->validateEvent($request);

        $oldImage = $event->image;

        $event->fill($validatedData);

        if ($request->hasFile('image')) {
            if ($oldImage) {
                Storage::delete($oldImage);
            }
            $event->image = $request->file('image')->store('events');
        }

        $event->save();

        return response()->json(['message' => 'Evento atualizado com sucesso', 'event' => $event]);
    }

    /**
     * Remover um evento.
     *
     * @OA\Delete(
     *     path="/api/events/{id}",
     *     summary="Excluir um evento",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Evento excluído com sucesso")
     * )
     */
    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::delete($event->image);
        }

        $event->delete();
        return response()->json(['message' => 'Evento excluído com sucesso']);
    }

    /**
     * Validar os dados do evento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    private function validateEvent(Request $request)
    {
        return $request->validate([
            'image' => 'nullable|image',
            'event_date' => 'required|date',
            'name' => 'required|string|max:255',
            'responsible' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'complement' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255',
        ]);
    }
}
