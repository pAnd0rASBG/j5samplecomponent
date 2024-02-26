<?php
/**
 * @package     com_spm
 *
 * @copyright   (c) 2024 Christoph Schafflinger
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FreezeFramez\Component\Spm\Administrator\Table;

// No direct access
\defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class ProjectTable extends Table
{
	public function __construct(DatabaseDriver $db)
	{
		parent::__construct('#__spm_projects', 'id', $db);
	}
}