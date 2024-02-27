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
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

class ProjectModel extends BaseDatabaseModel
{
	protected $_item = null;

	protected function populateState()
	{
		$app = Factory::getApplication();
		$params = $app->getParams();
		$id = $app->input->getInt('id');
		$this->setState('project.id', $id);
		$this->setState('project.params', $params);
	}

	function getItem($pk = null)
	{
		$id = (int) $pk ?: (int) $this->getState('project.id');
		if (!$id) {
			throw new \Exception('Missing project id', 404);
		}
		if ($this->_item !== null && $this->_item->id != $id) {
			return $this->_item;
		}
		$db = $this->getDatabase();
		$query = $db->getQuery(true);
		$query->select('*')
			->from($db->quoteName('#__spm_projects', 'a'))
			->where($db->quoteName('a.id') . ' = ' . (int) $id);
		$db->setQuery($query);

		$item = $db->loadObject();

		if (!empty($item)) {
			$this->_item = $item;
		}
		return $this->_item;
	}
}
