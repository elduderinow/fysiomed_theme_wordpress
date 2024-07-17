<?php

namespace Classes\PostType;

use Classes\Traits\Paragraphs;
use Classes\General\Link;
use Classes\General\Category;

class Job extends BasePost
{
    use Paragraphs;

    private $reference;
    private $profile;
    private $offer;
    private $competences;
    private $extra;
    private $languages;
    private $companyDescription;
    private $location;
    private $contact;
    private $applyLink;
    private $applyForm;

    private $contract;
    private $regime;

    public function __construct($post)
    {
        parent::__construct($post);

        $this->setReference($post);
        $this->setProfile($post);
        $this->setOffer($post);
        $this->setCompetences($post);
        $this->setExtra($post);
        $this->setLanguages($post);
        $this->setCompanyDescription($post);
        $this->setLocation($post);
        $this->setContact($post);
        $this->setApplyLink($post);
        $this->setApplyForm($post);
        $this->setContract($post);
        $this->setRegime($post);

        $this->setParagraphs($post);
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }
    /**
     * @return string
     */
    public function getProfile()
    {
        return $this->profile;
    }
    /**
     * @return string
     */
    public function getOffer()
    {
        return $this->offer;
    }
    /**
     * @return string
     */
    public function getCompetences()
    {
        return $this->competences;
    }
    /**
     * @return string
     */
    public function getExtra()
    {
        return $this->extra;
    }
    /**
     * @return array
     */
    public function getLanguages()
    {
        return $this->languages;
    }
    /**
     * @return string
     */
    public function getCompanyDescription()
    {
        return $this->companyDescription;
    }
    /**
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }
    /**
     * @return Person
     */
    public function getContact()
    {
        return $this->contact;
    }
    /**
     * @return Link
     */
    public function getApplyLink()
    {
        return $this->applyLink;
    }
    /**
     * @return int
     */
    public function getApplyForm()
    {
        return $this->applyForm;
    }
    /**
     * @return mixed
     */
    public function getContract()
    {
        return $this->contract;
    }
    /**
     * @return mixed
     */
    public function getRegime()
    {
        return $this->regime;
    }


    /**
     * @param $post
     */
    public function setReference($post): void
    {
        $this->reference = get_field('reference', $post);
    }
    /**
     * @param mixed $post
     */
    public function setProfile($post): void
    {
        $this->profile = get_field('profile', $post);
    }
    /**
     * @param mixed $post
     */
    public function setOffer($post): void
    {
        $this->offer = get_field('offer', $post);
    }
    /**
     * @param mixed $post
     */
    public function setCompetences($post): void
    {
        $this->competences = get_field('competences', $post);
    }
    /**
     * @param mixed $post
     */
    public function setExtra($post): void
    {
        $this->extra = get_field('extra', $post);
    }
    /**
     * @param mixed $post
     */
    public function setLanguages($post): void
    {
        $this->languages = null;
        $langs = get_field('languages', $post);
        if (!empty($langs)) {
            foreach($langs as $item) {
                $this->languages[] = array(
                    'language' => $item['language'],
                    'languageLevel' => $item['language-level']
                );
            }
        }
    }
    /**
     * @param mixed $post
     */
    public function setCompanyDescription($post): void
    {
        $this->companyDescription = get_field('companyDescription', $post);
    }
    /**
     * @param mixed $post
     */
    public function setLocation($post): void
    {
        if (get_field('location', $post) !== null) {
            $this->location = new Location(get_field('location', $post));
        }
    }
    /**
     * @param mixed $post
     */
    public function setContact($post): void
    {
        if (get_field('contact', $post) !== null) {
            $this->contact = new Person (get_field('contact', $post));
        }
    }
    /**
     * @param mixed $post
     */
    public function setApplyLink($post): void
    {
        if (get_field('applyLink', $post) !== null) {
            $this->applyLink = new Link(get_field('applyLink', $post));
        }
    }
    /**
     * @param mixed $post
     */
    public function setApplyForm($post): void
    {
        $this->applyForm = get_field('applyForm', $post);
    }

    /**
     * @param mixed $post
     */
    public function setContract($post): void
    {
        $terms = get_the_terms($post->ID, 'contract');
        if (!empty($terms)) {
            foreach ($terms as $term) {
                $this->contract[] = new Category($term);
            }
        }
    }
    /**
     * @param mixed $post
     */
    public function setRegime($post): void
    {
        $terms = get_the_terms($post->ID, 'regime');
        if (!empty($terms)) {
            foreach ($terms as $term) {
                $this->regime[] = new Category($term);
            }
        }
    }

}