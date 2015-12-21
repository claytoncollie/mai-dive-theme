<?php

// Remove the schema markup from an element
function maidive_schema_empty( $attr ) {
    $attr['itemtype'] = '';
	$attr['itemprop'] = '';
	$attr['itemscope'] = '';
	return $attr;
}

// Change the schema type of an element to Hotel
function maidive_schema_hotel( $attr ) {
	$attr['itemtype'] = 'http://schema.org/Hotel';
	$attr['itemprop'] = '';
	$attr['itemscope'] = 'itemscope';
	return $attr;
}

// Set the itemprop of an element to description
function maidive_itemprop_description( $attr ) {
	$attr['itemprop'] = 'description';
	return $attr;
}

// Set the itemprop of an element to name
function maidive_itemprop_name( $attr ) {
	$attr['itemprop'] = 'name';
	return $attr;
}

// Remove the rel="author" and change it to itemprop="author" as the Structured Data Testing Tool doesn't understand 
// rel="author" in relation to Schema, even though it should according to the spec.
function maidive_author_schema( $output ) {
	return str_replace( 'rel="author"', 'itemprop="author"', $output );
}

// Add the url itemprop to the URL of the entry
function maidive_title_link_schema( $output ) {
	return str_replace( 'rel="bookmark"', 'rel="bookmark" itemprop="url"', $output );
}