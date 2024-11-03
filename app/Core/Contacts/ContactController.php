<?php

namespace App\Core\Contacts;

use App\Base\BaseController;
use App\Core\Notification\NotificationService;
use App\Tier\Inertia\InertiaService;

class ContactController extends BaseController {

    public function index() {
        return InertiaService::render_page("Contact", "ContactForm", [
            'title' => "Contactez-nous",

        ]);
    }



    public function send_message(SendMessageContactRequest $request) {
        $data = $request->validated();

        NotificationService::show_notification("Message envoyé avec succès !");

        // Logique d'envoi d'email ou de sauvegarde du message
        return redirect(route('contact'));
    }
}
