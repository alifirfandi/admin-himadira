<div id="<?= $modalId ?>" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered <?= isset($modalType) ? $modalType : "modal-md" ?>">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><?= $modalTitle ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $modalBody ?>
            </div>
            <?php if (isset($content)) : ?>
            <div class="modal-footer">
                <?= $modalFooter  ?>
            </div>
            <?php endif ?>
        </div>
    </div>
</div>