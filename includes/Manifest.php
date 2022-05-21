<?php
declare(strict_types=1);

namespace CleanWeb;

use LogicException;

final class Manifest {

	public function __construct(
		private array $manifest
	) {
	}

	public function get( string $file ): string {
		if ( $this->has( $file ) ) {
			return $this->manifest[ $file ];
		}

		throw new LogicException();
	}

	public function has( string $file ): bool {
		return isset( $this->manifest[ $file ] );
	}

}
