<?php

namespace App\Notifications;

use App\Classes\GoogleChat\GoogleChatBuilder;
use App\Classes\GoogleChat\GoogleChatSettings;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\GoogleChat\Card;
use NotificationChannels\GoogleChat\Components\Button\TextButton;
use NotificationChannels\GoogleChat\GoogleChatChannel;
use NotificationChannels\GoogleChat\GoogleChatMessage;
use NotificationChannels\GoogleChat\Section;
use NotificationChannels\GoogleChat\Widgets\Buttons;
use NotificationChannels\GoogleChat\Widgets\Image;
use NotificationChannels\GoogleChat\Widgets\TextParagraph;

class GoogleChatCardNotification extends Notification
{
    use Queueable;

    private GoogleChatSettings $googleChatProperties;

    public function __construct($googleChatProperties)
    {
        $this->googleChatProperties = $googleChatProperties;
    }

    public function via(): array
    {
        return [
            GoogleChatChannel::class
        ];
    }

    // Create a super simple message
    public function toGoogleChat($notifiable)
    {
        dd('Estoy aqu');
        $buttons = [];

        if ($btns = $this->googleChatProperties->buttons) {
            foreach ($btns as $btn) {
                $buttons[] = TextButton::create(
                    $btn->url,
                    $btn->name
                );
            }
        }

        $images = [];

        if ($btns = $this->googleChatProperties->buttons) {
            foreach ($btns as $btn) {
                $buttons[] = TextButton::create(
                    $btn->url,
                    $btn->name
                );
            }
        }

        return GoogleChatMessage::create()
            ->text('An invoice was just paid... ')
            ->bold('Woo-hoo!')
            ->card(
                Card::create()
                    ->header(
                        $this->googleChatProperties->title,
                        $this->googleChatProperties->color,
                        $this->googleChatProperties->urlImg,
                        $this->googleChatProperties->styleImage
                    )
                    ->section(
                        Section::create(
                            [
                                TextParagraph::create($this->googleChatProperties->message),
                                Buttons::create($buttons),
                                Image::create(
                                    'https://www.panel.prodooh.com/assets/images/default/prodooh.png',
                                    'https://www.panel.prodooh.com'
                                ),
                                Image::create(
                                    'https://www.panel.prodooh.com/assets/images/default/prodooh.png',
                                    'https://www.panel.prodooh.com'
                                )
                            ]
                        )
                    )
            )
            ->to($this->googleChatProperties->channel);
    }
}
