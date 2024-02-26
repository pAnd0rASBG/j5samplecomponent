<?php
/**
 * @package     com_spm
 *
 * @copyright   (c) 2024 Christoph Schafflinger
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FreezeFramez\Component\Spm\Administrator\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;

class ProjectsModel extends ListModel
{
	public function __construct($config = [])
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = [
				'id', 'a.id',
				'name', 'a.name',
			];
		}

		parent::__construct($config);
	}

	/**
	 * @throws \Exception
	 * @since 0.1.0
	 */
	protected function populateState($ordering = 'name', $direction = 'ASC'): void
	{
		$app = Factory::getApplication();
		$value = $app->input->get('limit', $app->get('list_limit', 0),'uint');
		$this->setState('list.limit', $value);

		$value = $app->input->get('limitstart', 0, 'uint');
		$this->setState('list.start', $value);

		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		parent::populateState($ordering, $direction);
	}

	protected function getListQuery()
	{
		$db     = $this->getDatabase();
		$query  = $db->getQuery(true);
		$query->select(
			$this->getState('list.select',
				[
					$db->quoteName('a.id'),
					$db->quoteName('a.name'),
					$db->quoteName('a.deadline'),
				]
			)
		)->from($db->quoteName('#__spm_projects', 'a'));

		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$search = $db->quote('%' . str_replace(' ', '%', $db->escape(trim($search), true) . '%'));
			$query->where($db->quoteName('a.name') . ' LIKE ' . $search);
		}

		$orderCol = $this->state->get('list.ordering', 'a.name');
		$orderDirn = $this->state->get('list.direction', 'ASC');

		$query->order($db->escape($orderCol . ' ' . $orderDirn));

		return $query;
	}
}