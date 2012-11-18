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
	<?= Navbar::create('Tripper Keeper', '#', $menu, Navbar::FIX_TOP) ?>

	<div id="map-canvas"></div>
	<div id="new-trip"></div>
</body>
</html>