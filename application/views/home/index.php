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

	<div id="post-types">
		<div class="container">
			<ul>
				<li><a href="#text-post" data-toggle="modal"><i class="icon-edit"></i>Text</a></li>
				<li><a href="#picture-post" data-toggle="modal"><i class="icon-picture"></i>Photo</a></li>
				<li><a href="#video-post" data-toggle="modal"><i class="icon-facetime-video"></i>Video</a></li>
				<li><a href="#music-post" data-toggle="modal"><i class="icon-music"></i>Song</a></li>
				<li><a href="#check-in-post" data-toggle="modal"><i class="icon-map-marker"></i>Check in</a></li>
				<li><a href="#person-post" data-toggle="modal"><i class="icon-user"></i>Person</a></li>
			</ul>
		</div>
	</div>

	<div id="map-canvas"></div>

	<div id="modals">
		<?= render('modals.new-trip'); ?>
		<?= render('modals.text-post'); ?>
		<?= render('modals.picture-post'); ?>
		<?= render('modals.video-post'); ?>
		<?= render('modals.music-post'); ?>
		<?= render('modals.check-in-post'); ?>
		<?= render('modals.person-post'); ?>
	</div>
</body>
</html>