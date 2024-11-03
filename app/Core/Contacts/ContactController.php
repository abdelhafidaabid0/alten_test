<?php

namespace App\Core\Contacts;

use App\Base\BaseController;
use App\Tier\Inertia\InertiaService;

class ContactController extends BaseController {

    public function index() {
        return InertiaService::render_page("Contact", "ContactForm");
    }



    public function send_message(SendMessageContactRequest $request) {
        $validated = $request->validate([
                                            'email'   => 'required|email',
                                            'message' => 'required|max:300',
                                        ]);

        // Logique d'envoi d'email ou de sauvegarde du message

        return response()->json(['message' => 'Message envoyé avec succès']);
    }
}
