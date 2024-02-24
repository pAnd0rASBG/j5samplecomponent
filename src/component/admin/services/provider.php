<?php
/**
 * @package     com_spm
 *
 * @copyright   (c) 2024 Christoph Schafflinger
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\ServiceProviderInterface;
use Joomla\DI\Container;

use FreezeFramez\Component\Spm\Administrator\Extension\SpmComponent;

return new class implements ServiceProviderInterface
{
	public function register(Container $container)
	{
		$container->registerServiceProvider(new MVCFactory('\\FreezeFramez\\Component\\Spm'));
		$container->registerServiceProvider(new ComponentDispatcherFactory('\\FreezeFramez\\Component\\Spm'));

		$container->set(
			ComponentInterface::class,
			function (Container $container) {
				$component = new SpmComponent($container->get(ComponentDispatcherFactoryInterface::class));
				$component->setMVCFactory($container->get(MVCFactoryInterface::class));

				return $component;
			}
		);
	}
};