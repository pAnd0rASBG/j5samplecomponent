<?php
/**
 * @package     com_spm
 *
 * @copyright   (c) 2024 Christoph Schafflinger
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
\defined('_JEXEC') or die;

?>
<div class="project-item p-4">
    <h1><?php echo $this->item->name; ?></h1>
    <div id="created" class="date meta">
        <?php echo $this->item->created; ?>
    </div>
    <div id="description" class="description">
        <?php echo $this->item->description; ?>
    </div>
    <div id="deadline" class="date">
        <?php echo $this->item->deadline; ?>
    </div>
</div>
