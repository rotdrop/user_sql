<?php
/**
 * Nextcloud - user_sql
 *
 * @copyright 2012-2015 Andreas Böhler <dev (at) aboehler (dot) at>
 * @copyright 2018 Marcin Łojewski <dev@mlojewski.me>
 * @author    Marcin Łojewski <dev@mlojewski.me>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

use OCA\UserSQL\AppInfo\Application;
use OCP\AppFramework\QueryException;

try {
    $app = new Application();
    $app->registerBackends();
} catch (QueryException $queryException) {
	\OC::$server->query(Psr\Log\LoggerInterface::class)->error(
		$queryException->getMessage(),
		['exception' => $queryException]
	);
}
