<?php
/**
 * @package     com_spm
 *
 * @copyright   (c) 2024 Christoph Schafflinger
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FreezeFramez\Component\Spm\Site\Service;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\RouterViewConfiguration;
use Joomla\CMS\Component\Router\Rules\MenuRules;
use Joomla\CMS\Component\Router\Rules\NomenuRules;
use Joomla\CMS\Component\Router\Rules\StandardRules;
use Joomla\CMS\Menu\AbstractMenu;
use Joomla\Database\DatabaseInterface;

defined('_JEXEC') or die;

class Router extends RouterView
{
	private $db;

	public function __construct(SiteApplication $app, AbstractMenu $menu, $category, DatabaseInterface $db)
	{
		$this->db = $db;
		$projects = new RouterViewConfiguration('projects');
		$this->RegisterView($projects);

		$project = new RouterViewConfiguration('project');
		$project->setKey('id')->setParent($projects);
		$this->registerView($project);

		parent::__construct($app, $menu);

		$this->attachRule(new MenuRules($this));
		$this->attachRule(new StandardRules($this));
		$this->attachRule(new NomenuRules($this));
	}


	public function getProjectSegment($key, $urlQuery)
	{
		//$id = (int) $id;
		$query = $this->db->getQuery(true);

		$query->select($this->db->quoteName('alias'))
			->from('#__spm_projects')
			->where($this->db->quoteName('id') . ' = ' . (int) $key);

		$this->db->setQuery($query);
		$id = $this->db->loadResult();

		return [$id];
	}

	public function getProjectId($segment, $urlQuery)
	{
		$query = $this->db->getQuery(true);

		$query->select($this->db->quoteName('id'))
			->from('#__spm_projects')
			->where($this->db->quoteName('alias') . ' = :alias')
			->bind(':alias', $segment);;

		$this->db->setQuery($query);

		return (int) $this->db->loadResult();
	}
}