<?php
/**
* @package     com_spm
*
* @copyright   (c) 2024 Christoph Schafflinger
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

namespace FreezeFramez\Component\Spm\Administrator\Model;

// No direct access
\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;



class ProjectModel extends AdminModel
{
	public function getForm($data = [], $loadData = true)
	{
		$form = $this->loadForm('com_spm.project', 'project', ['control' => 'jform', 'load_data' => $loadData]);

		if (empty($form))
		{
			return false;
		}
		return $form;
	}

	protected function loadFormData()
	{
		$app = Factory::getApplication();
		$data = $app->getUserState('com_spm.edit.project.data', []);

		if (empty($data))
		{
			$data = $this->getItem();
		}
		return $data;
	}
}