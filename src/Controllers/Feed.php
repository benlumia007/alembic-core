<?php

namespace Benlumia007\Alembic\Controllers;

use Suin\RSSWriter\Feed as RSSFeed;
use Suin\RSSWriter\Channel;
use Suin\RSSWriter\Item;

use Benlumia007\Alembic\App;
use Benlumia007\Alembic\ContentTypes;
use Benlumia007\Alembic\Entry\Entries;
use Benlumia007\Alembic\Entry\Locator;

class Feed {

	protected $params;

	public function __invoke( array $params = [] ) {

		$this->params = $params;

		header('Content-Type: application/rss+xml; charset=utf-8');

		echo $this->feed();
	}

	protected function entries() {

		$path    = ContentTypes::get( 'post' )->path();
		$locator = new Locator( $path );

		$args = [
			'number' => 10,
			'order'  => 'desc'
		];

		return new Entries( $locator, $args );
	}

	protected function feed() {

		$feed    = new RSSFeed();
		$channel = new Channel();

		$channel
			->title( 'Benjamin Lu' )
			->description( 'Life &amp; Stuff' )
			->url( e( uri() ) )
			->feedUrl( e( uri( 'feed' ) ) )
			->language( 'en-US' )
			->copyright( 'Copyright ' . date( 'Y' ) . ', Benjamin Lu' )
			->ttl( 60 )
			->appendTo( $feed );

		foreach ( $this->entries()->all() as $entry ) {

			$item = new Item();

			$item
				->title( e( $entry->title() ) )
				->description( $entry->excerpt() )
				->contentEncoded( $entry->content() )
				->url( e( $entry->uri() ) )
				->author( $entry ? e( $entry->author()->title() ) : 'Benjamin Lu' )
				->pubDate( strtotime( $entry->meta( 'date' ) ) )
				->preferCdata( true )
				->appendTo( $channel );
		}

		if ( ! empty( $entry ) ) {
			$channel->pubDate( strtotime( $entry->meta( 'date' ) ) )->lastBuildDate( strtotime( $entry->meta( 'date' ) ) );
		}

		return $feed;
	}
}