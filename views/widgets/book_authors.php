<?php
/**
 * @var Author[] $authors
 */

use app\assets\SubscribeAsset;
use app\models\Author;

SubscribeAsset::register($this);
?>

<?php foreach ($authors as $author): ?>
    <div><?= $author->name; ?> <span class="btn btn-secondary btn-sm subscription-btn" data-id="<?= $author->id; ?>">Subscribe</span></div>
<?php endforeach; ?>

<div class="modal subscription-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Author subscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your phone</p>
                <p><input type="text" id="phone" class="form-control" /></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="subscribe-btn" data-id="">Subscribe</button>
            </div>
        </div>
    </div>
</div>
