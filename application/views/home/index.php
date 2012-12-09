<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>triplo.gs</title>
	<meta name="viewport" content="width=device-width">

	<?= Asset::container('bootstrapper')->styles() ?>
	<?= Asset::container('bootstrapper')->scripts() ?>

	<?= Asset::styles() ?>
	<?= Asset::scripts() ?>
</head>
<body>
	<?= Navbar::create('triplo.gs', '#', $menu, Navbar::FIX_TOP) ?>

	<div id="new-post">
		<h2>New Post</h2>

		<?= Form::open_for_files('posts/add_post', 'POST', ['id' => 'new-post-form']) ?>
			<div id="text">
				<?= Form::textarea('post-text', null, ['id' => 'post-text', 'placeholder' => 'Post text']) ?>
			</div>

			<div id="meta">
				<?= Form::file('post-media', ['id' => 'post-media', 'accept' => 'image/*|video/*']) ?>
				<?= Form::hidden('post-location', '', ['id' => 'post-location']) ?>

				<?= Buttons::normal('Add Photo/Video', ['id' => 'post-add-media']) ?>
				<?= Buttons::normal('Add Location', ['id' => 'post-add-location']) ?>
				<?= Buttons::normal('Add Person', ['id' => 'post-add-person']) ?>
			</div>

			<div id="preview">

			</div>

			<?= Buttons::submit('Save Post', ['id' => 'post-save']) ?>
		<?= Form::close() ?>
	</div>

	<div id="map-canvas"></div>

	<div id="modals">
		<?= render('modals.new-trip'); ?>
	</div>
</body>
</html>