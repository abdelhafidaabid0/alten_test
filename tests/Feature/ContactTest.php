<?php


it('displays the contact form', function () {
    $response = $this->get(route('contact'));

    $response->assertStatus(200)
             ->assertSee('Contactez-nous');
});

it('sends a contact message successfully', function () {
    $data = [
        'nom'     => 'John Doe',
        'email'   => 'john@example.com',
        'sujet'   => 'Support',
        'message' => 'Besoin d\'aide pour un problème.',
    ];

    $response = $this->post(route('contact.send_message'), $data);

    $response->assertRedirect(route('contact'))
             ->assertSessionHas('notification_messages', [
                 ['message' => 'Message envoyé avec succès !', 'type' => 'success'],
             ]);
});

it('validates contact form input', function () {
    $data = [
        'nom'     => 'John Doe',
        'email'   => 'invalid-email',
        'message' => '',
    ];

    $response = $this->post(route('contact.send_message'), $data);

    $response->assertSessionHasErrors(['email', 'message']);
});
