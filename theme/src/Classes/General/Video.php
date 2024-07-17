<?php
namespace Classes\General;

class Video
{
    private string $title;
    private string $url;
    private string $mimeType;
    private string $platform;
    private bool $autoplay;

    /**
     * Video constructor.
     * @param string $platform
     * @param string $url
     * @param bool $autoplay
     * @param string $title
     * @param string $mimeType
     */
    public function __construct(string $platform, string $url, bool $autoplay = false, string $title = "", string $mimeType = "") {
        $this->setPlatform($platform);
        $this->setUrl($url);
        $this->setAutoplay($autoplay);
        $this->setTitle($title);
        $this->setMimeType($mimeType);
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
    /**
     * @return bool
     */
    public function getAutoplay(): bool
    {
        return $this->autoplay;
    }
    /**
     * @return string
     */
    public function getPlatform(): string
    {
        return $this->platform;
    }
    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }


    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }
    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }
    /**
     * @param mixed $autoplay
     */
    public function setAutoplay($autoplay): void
    {
        $this->autoplay = $autoplay;
    }
    /**
     * @param mixed $platform
     */
    public function setPlatform($platform): void
    {
        $this->platform = $platform;
    }
    /**
     * @param mixed $mimeType
     */
    public function setMimeType($mimeType): void
    {
        $this->mimeType = $mimeType;
    }
}
