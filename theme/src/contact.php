<?php
/**
 * Template Name: Contact pagina
 * Description: Pagina met contact formullier.
 */

use Classes\Template\Contact;
use Classes\General\MetaData;

$context = Timber::get_context();
$context['page'] = new Contact($post);
$context['metaData'] = MetaData::constructFromPost($post);

Timber::render( array("page-contact.twig"), $context );
