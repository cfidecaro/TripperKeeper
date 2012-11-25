<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>TripperKeeper</title>
	<meta name="viewport" content="width=device-width">

	<?= Asset::container('bootstrapper')->styles() ?>
	<?= Asset::container('bootstrapper')->scripts() ?>

	<?= Asset::styles() ?>
	<?= Asset::scripts() ?>
</head>
<body>
	<?= Navbar::create('triplo.gs', '#', $menu, Navbar::FIX_TOP) ?>

	<div id="map-canvas"></div>

    <div id="new-trip" class="modal hide fade">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>New Trip</h3>
        </div>
        <div class="modal-body">
            <?= Form::inline_open() ?>
	            <fieldset>
					<?= Form::text('add-stop', null, ['placeholder' => '123 Sesame St', 'id' => 'add-stop']) ?>
		            <?= Form::block_help('', ['id' => 'add-stop-msg']) ?>
		            <?= Form::button('Add stop', ['id' => 'add-stop-btn', 'data-loading-text' => 'Searching...']) ?>
                </fieldset>
	        <?= Form::close() ?>

	        <ol id="stops"></ol>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn">Close</a>
            <a href="#" class="btn btn-primary">Save changes</a>
        </div>
    </div>
</body>
</html>