<?php
/**
 * @package     com_spm
 *
 * @copyright   (c) 2024 Christoph Schafflinger
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
\defined('_JEXEC') or die;

use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;

$wam = Factory::getApplication()->getDocument()->getWebAssetManager();

$wam->useStyle('com_spm.projects');
?>
<form>
	<div class="items-limit-box">
		<?php echo $this->pagination->getLimitBox(); ?>
	</div>
	<div class="cards row row-col-3">
		<?php foreach ($this->items as $item) : ?>
		<div class="card col m-1">
			<h2><?php echo $item->name; ?></h2>
			<div id="project-id">
				<?php echo $item->id; ?>
			</div>
			<div id="project-deadline">
				<?php echo $item->deadline; ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<div><?php echo $this->pagination->getResultsCounter(); ?></div>
	<?php echo $this->pagination->getListFooter(); ?>
	<input type="hidden" name="task" value="projects">
	<?php echo HTMLHelper::_('form.token'); ?>
</form>
