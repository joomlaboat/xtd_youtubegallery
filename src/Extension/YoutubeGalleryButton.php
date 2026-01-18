<?php
/**
 * @package     YoutubeGallery
 * @subpackage  Editors-xtd.youtubegallerybutton
 * @author      Ivan Komlev <support@joomlaboat.com>
 * @copyright   (C) 2025-2026 Ivan Komlev. <https://www.joomlaboat.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 **/

namespace YoutubeGallery\Plugin\EditorsXtd\YoutubeGalleryButton\Extension;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Object\CMSObject;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Uri\Uri;

// phpcs:disable PSR1.Files.SideEffects
defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Editor YoutubeGallery button
 *
 * @since  1.5
 */
final class YoutubeGalleryButton extends CMSPlugin //implements SubscriberInterface
{
    /**
     * Load the language file on instantiation.
     *
     * @var    boolean
     * @since  3.1
     */
    protected $autoloadLanguage = true;

    /**
     * Display the button
     *
     * @param string $name The name of the button to add
     *
     * @return  CMSObject  The button options as CMSObject
     *
     * @throws Exception
     * @since   1.5
     */
    public function onDisplay($name)
    {
		$document = Factory::getApplication()->getDocument();
		$wa = $document->getWebAssetManager();

		// Register the script if not already registered
		if (!$wa->assetExists('script', 'editor-button.youtubegallery')) {
			$wa->registerScript(
				'editor-button.youtubegallery',
				Uri::root() . 'plugins/editors-xtd/youtubegallerybutton/js/modal.js',
				[],
				['type' => 'module']
			);
		}

		// Use the script (enqueue it for loading)
		$wa->useScript('editor-button.youtubegallery');

        $link = 'index.php?option=com_youtubegallery&amp;view=listandthemeselection&amp;tmpl=component&amp;e_name=' . $name;

        $button          = new CMSObject();
        $button->modal   = true;
        $button->action  = 'modal';
        $button->link    = $link;
        $button->text    = 'Youtube Gallery';
        $button->name    = $this->_type . '_' . $this->_name;
        $button->icon    = 'youtube-gallery';
        $button->iconSVG = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
  <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" fill="red" />
</svg>';

        return $button;
    }
}
