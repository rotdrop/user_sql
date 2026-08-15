<?php
/**
 * Nextcloud - user_sql
 *
 * @copyright 2025 Claus-Justus Heine <himself@claus-justus-heine.de>
 * @author    Claus-Justus Heine <himself@claus-justus-heine.de>
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

namespace OCA\UserSQL\AppInfo;

use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCP\IGroupManager;
use OCP\IUserManager;

use OCA\UserSQL\Backend;

/**
 * The application bootstrap class.
 *
 * @author Marcin Łojewski <dev@mlojewski.me>
 */
class Application extends App implements IBootstrap
{
    /**
     * The class constructor.
     *
     * @param array $urlParams An array with variables extracted
     *                         from the routes.
     */
    public function __construct(array $urlParams = array())
    {
        parent::__construct("user_sql", $urlParams);
    }

	/** {@inheritdoc} */
	public function register(IRegistrationContext $context): void
	{}

	/** {@inheritdoc} */
	public function boot(IBootContext $context): void
	{
		$context->injectFn(function(
			IUserManager $userManager,
			Backend\UserBackend $userBackend,
			IGroupManager $groupManager,
			Backend\GroupBackend $groupBackend,
		) {
			if ($userBackend->isConfigured()) {
				$userManager->registerBackend($userBackend);
			}
			if ($groupBackend->isConfigured()) {
				$groupManager->addBackend($groupBackend);
			}
		});
	}
}
