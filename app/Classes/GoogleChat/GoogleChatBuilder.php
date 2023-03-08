<?php

namespace App\Classes\GoogleChat;

class GoogleChatBuilder {

    public GoogleChatSettings $googleChatSettings;

    public function __construct()
    {
        $this->googleChatSettings = new GoogleChatSettings;
    }

    /**
     * @param $channel
     * @return $this
     */
    public function channel($channel): static
    {
        $this->googleChatSettings->channel = $channel;
        return $this;
    }

    /**
     * @param $title
     * @return $this
     */
    public function title($title): static
    {
        $this->googleChatSettings->title = $title;
        return $this;
    }

    public function subtitle($subtitle): static
    {
        $this->googleChatSettings->subtitle = $subtitle;
        return $this;
    }

    /**
     * @param $image
     * @return $this
     */
    public function image($image): static
    {
        $this->googleChatSettings->image = $image;
        return $this;
    }

    /**
     * @param $styleImage
     * @return $this
     */
    public function styleImage($styleImage): static
    {
        $this->googleChatSettings->styleImage = $styleImage;
        return $this;
    }

    /**
     * @param $message
     * @return $this
     */
    public function message($message): static
    {
        $this->googleChatSettings->message = $message;
        return $this;
    }

    /**
     * @param $buttons
     * @return $this
     */
    public function buttons($buttons): static
    {
        $this->googleChatSettings->buttons = $buttons;
        return $this;
    }

    /**
     * @param $images
     * @return $this
     */
    public function images($images): static
    {
        $this->googleChatSettings->images = $images;
        return $this;
    }
}
