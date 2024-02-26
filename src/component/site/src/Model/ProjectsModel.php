<?php
/**
 * @package     com_spm
 *
 * @copyright   (c) 2024 Christoph Schafflinger
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FreezeFramez\Component\Spm\Site\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;

class ProjectsModel extends ListModel
{
	protected function populateState($ordering = 'name', $direction = 'asc')
	{
		$app = Factory::getApplication();
		$value = $app->input->get('limit', $app->get('list_limit', 0), 'uint');
		$this->setState('list.start', $value);
		parent::populateState($ordering, $direction);
	}

	protected function getListQuery()
	{
		$db = $this->getDatabase();
		$query = $db->getQuery(true);
		$query->select(
			$this->getState(
				'list.select',
				[
					$db->quoteName('a.id'),
					$db->quoteName('a.name'),
					$db->quoteName('a.deadline'),
				]
			)
		)->from($db->quoteName('#__spm_projects', 'a'));

		$orderCol = $this->state->get('list.ordering', 'a.name');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($db->escape($orderCol . ' ' . $orderDirn));
		return $query;
	}
}
