<?php

namespace App\Core\Notification;

class NotificationService {

    const TOAST_SUCCESS = 'success';
    const TOAST_ERROR   = 'error';
    const TOAST_WARNING = 'warning';
    const TOAST_INFO    = 'info';



    public static function get_notifications() {
        $notifications = session()->pull("notification_messages");

        return $notifications;
    }



    public static function show_notification($message, $type = self::TOAST_SUCCESS) : void {
        session()->push('notification_messages', ["message" => $message, "type" => $type]);
    }
}