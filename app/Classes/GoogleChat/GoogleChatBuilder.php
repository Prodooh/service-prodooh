<?php

namespace App\Classes\GoogleChat;

class GoogleChatBuilder {

    private GoogleChatSettings $googleChatSettings;

    public function __construct()
    {
        $this->googleChatSettings = new GoogleChatSettings;
    }

    public function setChannel($channel): static
    {
        $this->googleChatSettings->channel = $channel;
        return $this;
    }

    public function setTitle($title): static
    {
        $this->googleChatSettings->title = $title;
        return $this;
    }

    public function setColor($color): static
    {
        $this->googleChatSettings->color = $color;
        return $this;
    }

    public function setImage($image): static
    {
        $this->googleChatSettings->image = $image;
        return $this;
    }

    public function setStyleImage($styleImage): static
    {
        $this->googleChatSettings->styleImage = $styleImage;
        return $this;
    }

    public function setMessage($message): static
    {
        $this->googleChatSettings->message = $message;
        return $this;
    }

    public function setButtons($buttons): static
    {
        $this->googleChatSettings->buttons = $buttons;
        return $this;
    }

    public function setImages($images): static
    {
        $this->googleChatSettings->images = $images;
        return $this;
    }
}
