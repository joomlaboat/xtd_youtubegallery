<?php
/**
 * @package     YoutubeGallery
 * @subpackage  Editors-xtd.youtubegallerybutton
 * @author      Ivan Komlev <support@joomlaboat.com>
 * @copyright   (C) 2025 Ivan Komlev. <https://www.joomlaboat.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 **/

\defined('_JEXEC') or die;

use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use YoutubeGallery\Plugin\EditorsXtd\YoutubeGalleryButton\Extension\YoutubeGalleryButton;

return new class () implements ServiceProviderInterface {
    /**
     * Registers the service provider with a DI container.
     *
     * @param Container $container The DI container.
     *
     * @return  void
     *
     * @since   4.4.0
     */
    public function register(Container $container): void
    {
        $container->set(
            PluginInterface::class,
            function (Container $container) {

                $containerTemp = $container->get(DispatcherInterface::class);

                $plugin = new YoutubeGalleryButton(
                    $containerTemp,
                    (array)PluginHelper::getPlugin('editors-xtd', 'youtubegallerybutton')
                );
                $plugin->setApplication(Factory::getApplication());

                return $plugin;
            }
        );
    }
};
