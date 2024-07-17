<?php
namespace Classes\General;

class Sound
{
    private string $title;
    private string $url;
    private string $mimeType;
    private string $platform;
    private bool $autoplay;

    /**
     * Sound constructor.
     * @param $platform
     * @param $url
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
     * @return mixed
     */
    public function getUrl():string
    {
        return $this->url;
    }
    /**
     * @return mixed
     */
    public function getTitle():string
    {
        return $this->title;
    }
    /**
     * @return mixed
     */
    public function getAutoplay():bool
    {
        return $this->autoplay;
    }
    /**
     * @return mixed
     */
    public function getPlatform():string
    {
        return $this->platform;
    }
    /**
     * @return mixed
     */
    public function getMimeType():string
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
    /**
     * @param mixed $autoplay
     */
    public function setAutoplay($autoplay): void
    {
        $this->autoplay = $autoplay;
    }
}
