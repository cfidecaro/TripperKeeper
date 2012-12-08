<div id="new-trip" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>New Trip</h3>
    </div>

	<div class="modal-body">
		<?= Form::open(null, null, ['id' => 'add-trip-form']) ?>
	        <fieldset>
				<?= Form::control_group(
					Form::label('trip-name', 'Trip name'),
					Form::text('trip-name', null, ['placeholder' => 'Road trip', 'autofocus' => 'autofocus', 'id' => 'trip-name'])
				) ?>

				<?= Form::control_group(
					Form::label('add-stop-1', 'Enter a location and press enter'),
					Form::text('stops[]', null, ['placeholder' => '123 Sesame St', 'class' => 'add-stop current', 'data-count' => '1', 'disabled' => 'disabled'])
				) ?>
	        </fieldset>
		<?= Form::close() ?>
    </div>

	<div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
    </div>
</div>
