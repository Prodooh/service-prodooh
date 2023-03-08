<?php

namespace App\Classes\GoogleChat;

class GoogleChatBuilder {

    public GoogleChatSettings $googleChatSettings;

    public function __construct()
    {
        $this->googleChatSettings = new GoogleChatSettings;
    }

    public function setChannel($channel)
    {
        $this->googleChatSettings->channel = $channel;
        return $this;
    }

    public function setTitle($title)
    {
        $this->googleChatSettings->title = $title;
        return $this;
    }

    public function setColor($color)
    {
        $this->googleChatSettings->color = $color;
        return $this;
    }

    public function setImage($image)
    {
        $this->googleChatSettings->image = $image;
        return $this;
    }

    public function setStyleImage($styleImage)
    {
        $this->googleChatSettings->styleImage = $styleImage;
        return $this;
    }

    public function setMessage($message)
    {
        $this->googleChatSettings->message = $message;
        return $this;
    }

    public function setButtons($buttons)
    {
        $this->googleChatSettings->buttons = $buttons;
        return $this;
    }

    public function setImages($images)
    {
        $this->googleChatSettings->images = $images;
        return $this;
    }
}
