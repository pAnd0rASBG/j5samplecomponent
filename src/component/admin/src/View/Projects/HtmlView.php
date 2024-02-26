<?php
/**
 * @package     com_spm
 *
 * @copyright   (c) 2024 Christoph Schafflinger
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FreezeFramez\Component\Spm\Administrator\View\Projects;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use mysql_xdevapi\Exception;

class HtmlView extends BaseHtmlView
{
	public $filterForm;
	public $state;
	public $items = [];
	public $pagination;
	public $activeFilters = [];

	/**
	 * Invokes parent display method or throws Exception if there are errors
	 *
	 * @param $tpl string The name of the template to display
	 * @throws GenericDataException throws Exception / HTTP 500 if there are errors
	 * @return void
	 * @since 0.1.0
	 */
	public function display($tpl = null): void
	{
		$this->state            = $this->get('State');
		$this->items            = $this->get('Items');
		$this->pagination       = $this->get('Pagination');
		$this->filterForm       = $this->get('FilterForm');
		$this->activeFilters    = $this->get('ActiveFilters');

		if(count($errors = $this->get('Errors')))
		{
			throw new GenericDataException(implode('\n', $errors, 500));
		}

		parent::display($tpl);
	}
}