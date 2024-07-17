<?php
namespace Classes\Traits;

use Classes\General\Image;
use Classes\General\Link;
use Classes\General\Video;
use Classes\General\Sound;
use Classes\General\File;


trait Paragraphs
{
    private array $paragraphs;

    public function setParagraphs($post) {
        $parArray = get_field("paragraphs", $post->ID);
        if (!empty($parArray)) {
            $this->paragraphs = $this->parseParagraphs($parArray);
        }
        else
            $this->paragraphs = [];
    }
    public function getParagraphs(){
        return $this->paragraphs;
    }

    public function parseParagraphs($paragraphs): array
    {
        $parsedParagraphs = [];
        if (!empty($paragraphs)) {
            foreach ($paragraphs as $index => $paragraph) {
                $parsedParagraphs[] = $this->parseParagraph($paragraph);
            }
        }
        return $parsedParagraphs;
    }
    public function parseParagraph($paragraph): array
    {
        $parsed["format"] = $paragraph["format"];

        switch ($paragraph["format"]) {
            case "text":
                $parsed["text"] = $this->_parseTextParagraph($paragraph);
                break;
            case "text-text":
                $parsed["text"] = $this->_parseTextParagraph($paragraph);
                $parsed["textRight"] = $this->_parseTextRightParagraph($paragraph);
                break;
            case "text-picture":
                $parsed["button"] = $this->_parseLinkParagraph($paragraph);
                $parsed["text"] = $this->_parseTextParagraph($paragraph);
                $parsed["picture"] = $this->_parsePictureParagraph($paragraph);
                $parsed["textPosition"] = $this->_parseTextPosition($paragraph);
                break;
            case "text-video":
                $parsed["button"] = $this->_parseLinkParagraph($paragraph);
                $parsed["text"] = $this->_parseTextParagraph($paragraph);
                $parsed["video"] = $this->_parseVideoParagraph($paragraph);
                $parsed["textPosition"] = $this->_parseTextPosition($paragraph);
                break;
            case "picture":
                $parsed["picture"] = $this->_parsePictureParagraph($paragraph);
                break;
            case "gallery":
                $parsed["gallery"] = $this->_parseGalleryParagraph($paragraph);
                break;
            case "video":
                $parsed["video"] = $this->_parseVideoParagraph($paragraph);
                break;
            case "sound":
                $parsed["sound"] = $this->_parseSoundParagraph($paragraph);
                break;
            case "file":
                $parsed["file"] = $this->_parseFileParagraph($paragraph);
                break;
            case "button":
                $parsed["button"] = $this->_parseLinkParagraph($paragraph);
                break;
            case "quote":
                $parsed["quote"] = $this->_parseQuoteParagraph($paragraph);
                break;
        }
        return $parsed;
    }

    private function _parseTextParagraph($paragraph): string {
        return apply_filters("the_content", $paragraph["text"] );
    }
    private function _parseTextRightParagraph($paragraph): string {
        return apply_filters("the_content", $paragraph["textRight"] );
    }
    private function _parseTextPosition($paragraph): string {
        return $paragraph["textPosition"];
    }
    private function _parsePictureParagraph($paragraph): Image
    {
        $image = new Image($paragraph["picture"], "acf");
        $image->setDisplaySize($paragraph["pictureSize"]);
        return $image;
    }
    private function _parseGalleryParagraph($paragraph): array
    {
        $gallery = array();
        foreach ($paragraph["gallery"] as $item) {
            $gallery[] = New Image($item, "acf");
        }
        return $gallery;
    }
    private function _parseVideoParagraph($paragraph): Video
    {
        if ($paragraph["videoPlatform"] == "cms") {
            $video = new Video($paragraph["videoPlatform"], $paragraph["videoFile"]["url"], $paragraph["videoAutoplay"], $paragraph["videoFile"]["title"], $paragraph["videoFile"]["mime_type"]);
        }
        else {
            $video = new Video($paragraph["videoPlatform"], $paragraph["videoUrl"]["url"], $paragraph["videoAutoplay"], "", "");
        }
        return $video;
    }
    private function _parseSoundParagraph($paragraph): Sound
    {
        if ($paragraph["soundPlatform"] == "cms"  ) {
            $sound = new Sound($paragraph["soundPlatform"], $paragraph["soundFile"]["url"], $paragraph["soundFile"]["title"], $paragraph["soundFile"]["mime_type"]);
        }
        else {
            $sound = new Sound($paragraph["soundPlatform"], $paragraph["soundUrl"]["url"], "", "","");
        }
        return $sound;
    }
    private function _parseFileParagraph($paragraph): File
    {
        return new File($paragraph["file"]["url"], $paragraph["fileLabel"],$paragraph["file"]["mime_type"]);
    }
    private function _parseLinkParagraph($paragraph): ?Link
    {
        if (empty($paragraph['link'])) return null;
        return new Link($paragraph["link"]);
    }
    private function _parseQuoteParagraph($paragraph): array
    {
        return array(
            "text" => $paragraph["quote"],
            "author" => $paragraph["quoteAuthor"],
            "company" => $paragraph["quoteCompany"]
        );
    }
}
