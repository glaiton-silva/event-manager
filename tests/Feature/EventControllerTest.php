<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    /**
     * Configuração inicial dos testes.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Cria um usuário para autenticação
        $this->user = User::factory()->create();
    }

    /**
     * Testa se um usuário autenticado pode visualizar todos os eventos.
     *
     * @return void
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function a_user_can_view_all_events()
    {
        $this->actingAs($this->user);

        $events = Event::factory()->count(3)->create();

        $response = $this->get(route('events.index'));

        $response->assertStatus(200)
                 ->assertViewIs('events.index')
                 ->assertViewHas('events', function ($viewEvents) use ($events) {
                     return $viewEvents->count() === $events->count();
                 });
    }

    /**
     * Testa se um usuário autenticado pode criar um novo evento.
     *
     * @return void
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function a_user_can_create_an_event()
    {
        $this->actingAs($this->user);

        Storage::fake('public');

        $eventData = Event::factory()->make()->toArray();
        $eventData['image'] = UploadedFile::fake()->image('event.jpg');
        $eventData['event_date'] = now()->addDays(1)->format('Y-m-d H:i:s');

        $response = $this->post(route('events.store'), $eventData);

        $response->assertStatus(302)
                 ->assertRedirect(route('events.index'));

        $this->assertDatabaseHas('events', [
            'name' => $eventData['name'],
            'responsible' => $eventData['responsible'],
            'city' => $eventData['city'],
            'state' => $eventData['state'],
            'address' => $eventData['address'],
            'number' => $eventData['number'],
            'complement' => $eventData['complement'],
            'phone' => $eventData['phone'],
        ]);
    }

    /**
     * Testa se um usuário autenticado pode visualizar um único evento.
     *
     * @return void
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function a_user_can_view_a_single_event()
    {
        $this->actingAs($this->user);

        $event = Event::factory()->create();

        $response = $this->get(route('events.show', $event->id));

        $response->assertStatus(200)
                 ->assertViewIs('events.show')
                 ->assertViewHas('event', function ($viewEvent) use ($event) {
                     return $viewEvent->id === $event->id;
                 });
    }

    /**
     * Testa se um usuário autenticado pode atualizar um evento existente.
     *
     * @return void
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function a_user_can_update_an_event()
    {
        $this->actingAs($this->user);

        $event = Event::factory()->create();

        Storage::fake('public');
        
        $updatedData = Event::factory()->make()->toArray();
        $updatedData['image'] = UploadedFile::fake()->image('event.jpg');
        $updatedData['event_date'] = now()->addDays(2)->format('Y-m-d H:i:s');

        $response = $this->put(route('events.update', $event->id), $updatedData);

        $response->assertStatus(302)
                 ->assertRedirect(route('events.index'));

        $this->assertDatabaseHas('events', [
            'id' => $event->id,
            'name' => $updatedData['name'],
            'responsible' => $updatedData['responsible'],
            'city' => $updatedData['city'],
            'state' => $updatedData['state'],
            'address' => $updatedData['address'],
            'number' => $updatedData['number'],
            'complement' => $updatedData['complement'],
            'phone' => $updatedData['phone'],
        ]);
    }

    /**
     * Testa se um usuário autenticado pode excluir um evento.
     *
     * @return void
     */
    #[\PHPUnit\Framework\Attributes\Test]
    public function a_user_can_delete_an_event()
    {
        $this->actingAs($this->user);

        $event = Event::factory()->create();

        $response = $this->delete(route('events.destroy', $event->id));

        $response->assertStatus(302)
                 ->assertRedirect(route('events.index'));

        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }
}
