<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\ContactActivity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class ContactsCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_contacts_index_page_loads()
    {
        $response = $this->get(route('contacts.index'));
        $response->assertStatus(200);
        $response->assertSee('Contacts');
    }

    public function test_contacts_create_page_loads()
    {
        $response = $this->get(route('contacts.create'));
        $response->assertStatus(200);
        $response->assertSee('Create Contact');
    }

    public function test_contact_can_be_created()
    {
        Volt::test('pages.contacts.create')
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('phone', '1234567890')
            ->set('company', 'Acme Corp')
            ->set('status', 'lead')
            ->set('notes', 'Test notes')
            ->call('store')
            ->assertRedirect(route('contacts.index'));

        $this->assertDatabaseHas('contacts', [
            'email' => 'john@example.com',
            'name' => 'John Doe',
        ]);

        $contact = Contact::where('email', 'john@example.com')->first();
        $this->assertDatabaseHas('contact_activities', [
            'contact_id' => $contact->id,
            'type' => 'created',
        ]);
    }

    public function test_contact_can_be_updated()
    {
        $contact = Contact::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'status' => 'lead',
        ]);

        Volt::test('pages.contacts.edit', ['contact' => $contact])
            ->set('name', 'Jane Updated')
            ->set('status', 'active')
            ->call('update')
            ->assertRedirect(route('contacts.index'));

        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'name' => 'Jane Updated',
            'status' => 'active',
        ]);

        $this->assertDatabaseHas('contact_activities', [
            'contact_id' => $contact->id,
            'type' => 'updated',
        ]);
    }

    public function test_contact_can_be_deleted()
    {
        $contact = Contact::create([
            'name' => 'Delete Me',
            'email' => 'delete@example.com',
            'status' => 'active'
        ]);

        Volt::test('pages.contacts.index')
            ->call('deleteContact', $contact->id);

        $this->assertDatabaseMissing('contacts', [
            'id' => $contact->id,
        ]);
    }

    public function test_contact_show_page_loads()
    {
        $contact = Contact::create([
            'name' => 'Show Me',
            'email' => 'show@example.com',
            'status' => 'lead',
        ]);

        $response = $this->get(route('contacts.show', $contact));
        $response->assertStatus(200);
        $response->assertSee('Show Me');
    }
}
