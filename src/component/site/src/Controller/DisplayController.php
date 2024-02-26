<?php
/**
 * @package     com_spm
 *
 * @copyright   (c) 2024 Christoph Schafflinger
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FreezeFramez\Component\Spm\Site\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

class DisplayController extends BaseController
{
	protected $default_view = 'Projects';
	protected $app;
}