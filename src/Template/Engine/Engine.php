<?php

namespace Benlumia007\Alembic\Template\Engine;

class Engine {

	public function view( $name, array $slugs = [], $data = [] ) {

		return new View( $name, $slugs, $data );
	}
}
