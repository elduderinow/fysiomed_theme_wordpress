<?php
namespace Classes\General;

class File
{
    private string $label;
    private string $url;
    private string $mimeType;

    /**
     * Video constructor.
     * @param $file
     */
    public function __construct(string $url, string $label = "", string $mimeType = "") {
        $this->setUrl($url);
        $this->setLabel($label);
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
    public function getLabel(): string
    {
        return $this->label;
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
     * @param mixed $label
     */
    public function setLabel($label): void
    {
        $this->label = $label;
    }

    /**
     * @param mixed $mimeType
     */
    public function setMimeType($mimeType): void
    {
        $this->mimeType = $mimeType;
    }
}
