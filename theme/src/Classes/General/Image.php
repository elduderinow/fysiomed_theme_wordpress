<?php
namespace Classes\General;

class Image
{
    private array $imgArray;

    private string $title = "";
    private string $alt = "";
    private string $caption = "";
    private array $sizes = [];
    private string $orientation = "";
    private string $displaySize = 'medium';

    public function __construct($object, $objectType) {
		if (isset($object)) {
			switch($objectType) {
				case "post":
				case "woo-term":
					$attachment_id = $this->_getAttachmentId($object, $objectType);
					if($attachment_id) {
						$this->imgArray = $this->_getAttachmentData($attachment_id);
					}
					break;
				case "image":
					$this->imgArray = $this->_getAttachmentData($object->ID);
					break;
				default:
					$this->imgArray = $object;
					break;
			}

            if (isset($this->imgArray)) {
                $this->setTitle($this->imgArray['title']);
                $this->setSizes($this->imgArray['sizes']);
                $this->setAlt($this->imgArray['alt']);
                $this->setCaption($this->imgArray['caption']);
                $this->_setOrientation();
            }
        }
    }

    public function getTitle(): string {
        return $this->title;
    }
    public function getAlt(): string{
        return $this->alt;
    }
    public function getCaption(): string{
        return $this->caption;
    }
    public function getSizes():array {
        return $this->sizes;
    }
    public function getOrientation(): string {
        return $this->orientation;
    }
    public function getDisplaySize(): string{
        return $this->displaySize;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }
    /**
     * @param mixed $alt
     */
    public function setAlt($alt): void
    {
        $this->alt = $alt;
    }
    /**
     * @param mixed $caption
     */
    public function setCaption($caption): void
    {
        $this->caption = $caption;
    }
    /**
     * @param mixed $sizes
     */
    public function setSizes($sizes): void
    {
        $this->sizes = $sizes;
    }
    /**
     * @param mixed $displaySize
     */
    public function setDisplaySize($displaySize){
        if (!empty($displaySize)) {
            $this->displaySize = $displaySize;
        }
    }


    /** PRIVATE FUNCTIONS **/
	private function _getAttachmentId($object, $objectType) {
		$attachmentId = false;
		if ($objectType == "post") {
			$attachment_id = get_post_thumbnail_id($object);
		}
		if ($objectType == "woo-term") {
			$attachment_id = get_term_meta( $object->term_id, 'thumbnail_id', true );
		}
		return $attachment_id;
	}
    private function _getAttachmentData($attachment_id) {
        $sizes_id = 0;
        if (!empty($attachment_id)) {
            $attachment = get_post($attachment_id);
            $meta = wp_get_attachment_metadata( $attachment->ID );
            $attached_file = get_attached_file( $attachment->ID );
            $attachment_url = wp_get_attachment_url( $attachment->ID );

            // get mime types
            if( strpos( $attachment->post_mime_type, '/' ) !== false ) {
                list( $type, $subtype ) = explode( '/', $attachment->post_mime_type );
            } else {
                list( $type, $subtype ) = array( $attachment->post_mime_type, '' );
            }

            // check vars
            $alt_text = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );

            // vars
            $data = array(
                'ID'			=> $attachment->ID,
                'id'			=> $attachment->ID,
                'title'       	=> ($attachment->post_title != "" ? $attachment->post_title : "Fysiomed"),
                'filename'		=> wp_basename( $attached_file ),
                'filesize'		=> 0,
                'url'			=> $attachment_url,
                'link'			=> get_attachment_link( $attachment->ID ),
                'alt'			=> ($alt_text != "" ? $alt_text : $attachment->post_title),
                'author'		=> $attachment->post_author,
                'description'	=> ($attachment->post_content != "" ? $attachment->post_content : "Fysiomed"),
                'caption'		=> ($attachment->post_excerpt != "" ? $attachment->post_excerpt : "Fysiomed"),
                'name'			=> $attachment->post_name,
                'status'		=> $attachment->post_status,
                'uploaded_to'	=> $attachment->post_parent,
                'date'			=> $attachment->post_date_gmt,
                'modified'		=> $attachment->post_modified_gmt,
                'menu_order'	=> $attachment->menu_order,
                'mime_type'		=> $attachment->post_mime_type,
                'type'			=> $type,
                'subtype'		=> $subtype,
                'icon'			=> wp_mime_type_icon( $attachment->ID )
            );

            // filesize
            if( isset($meta['filesize']) ) {
                $data['filesize'] = $meta['filesize'];
            } elseif( file_exists($attached_file) ) {
                $data['filesize'] = filesize( $attached_file );
            }

            // image
            if( $type === 'image' ) {
                $sizes_id = $attachment->ID;
                $src = wp_get_attachment_image_src( $attachment->ID, 'full' );

                $data['url'] = $src[0];
                $data['width'] = $src[1];
                $data['height'] = $src[2];
                $data['orientation'] = ($src[1] > $src[2] ? 'landscape' : 'portrait');

                // video
            } elseif( $type === 'video' ) {

                // dimensions
                $data['width'] = acf_maybe_get($meta, 'width', 0);
                $data['height'] = acf_maybe_get($meta, 'height', 0);

                // featured image
                if( $featured_id = get_post_thumbnail_id($attachment->ID) ) {
                    $sizes_id = $featured_id;
                }

                // audio
            } elseif( $type === 'audio' ) {

                // featured image
                if( $featured_id = get_post_thumbnail_id($attachment->ID) ) {
                    $sizes_id = $featured_id;
                }
            }

            // sizes
            if( $sizes_id ) {
                // vars
                $sizes = get_intermediate_image_sizes();
                $sizes_data = array();

                // loop
                foreach( $sizes as $size ) {
                    $src = wp_get_attachment_image_src( $sizes_id, $size );
                    $sizes_data[ $size ] = $src[0];
                    $sizes_data[ $size . '-width' ] = $src[1];
                    $sizes_data[ $size . '-height' ] = $src[2];
                }

                // append
                $data['sizes'] = $sizes_data;
            }

            // return
            return $data;
        }

        return false;
    }
    private function _setOrientation() {
        if ($this->imgArray['width'] > $this->imgArray['height']) {
            $this->orientation = "landscape";
        }
        else {
            $this->orientation = "portrait";
        }
    }
}
