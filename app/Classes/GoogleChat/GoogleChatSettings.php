<?php

namespace App\Classes\GoogleChat;

use NotificationChannels\GoogleChat\Enums\ImageStyle;

class GoogleChatSettings {
    public string $channel = 'develop';
    public string $title;
    public string $subtitle = '';
    public string $urlImg = 'https://media.licdn.com/dms/image/C560BAQEtm-E5HAZT_A/company-logo_200_200/0/1612852878071?e=2147483647&v=beta&t=hG6-dmYHJYdmbgQKgh-hQB6GfUtcFt3QF-_q0rXPUHw';
    public string $styleImage = ImageStyle::CIRCULAR;
    public string $message;
    public array $buttons;
    public array $image;
}
