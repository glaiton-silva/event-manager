<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Exibe uma lista de eventos.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $events = Event::paginate(10);
        return view('events.index', compact('events'));
    }

    /**
     * Mostra o formulário para criar um novo evento.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Armazena um novo evento no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateEvent($request);

        $event = new Event($validatedData);

        if ($request->hasFile('image')) {
            $event->image = $request->file('image')->store('events', 'public');
        }

        $event->save();

        return redirect()->route('events.index')->with('success', 'Evento criado com sucesso.');
    }

    /**
     * Exibe um evento específico. Sem precisar de login.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\View\View
     */
    public function public_show(Event $event)
    {
        return view('events.public_show', compact('event'));
    }

    /**
     * Exibe um evento específico.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\View\View
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Mostra o formulário para editar um evento existente.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\View\View
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Atualiza um evento no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Event $event)
    {
        $validatedData = $this->validateEvent($request);

        $oldImage = $event->image;

        $event->fill($validatedData);

        if ($request->hasFile('image')) {
            $event->image = $request->file('image')->store('events', 'public');
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
        }

        $event->save();

        return redirect()->route('events.index')->with('success', 'Evento atualizado com sucesso.');
    }

    /**
     * Remove um evento do banco de dados.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento excluído com sucesso.');
    }

    /**
     * Valida os dados do evento.
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
