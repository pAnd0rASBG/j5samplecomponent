<?php
/**
 * @package     com_spm
 *
 * @copyright   (c) 2024 Christoph Schafflinger
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
\defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('behavior.keepalive');
?>
<form action="<?php echo Route::_('index.php?option=com_spm&view=project&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="project-form" class="form-validate">
	<div>
		<div class="row">
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-6">
						<?php echo $this->form->renderField('name'); ?>
						<?php echo $this->form->renderField('alias'); ?>
						<?php echo $this->form->renderField('description'); ?>
						<?php echo $this->form->renderField('deadline'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="task" value="">
	<?php echo HTMLHelper::_('form.token'); ?>
</form>
