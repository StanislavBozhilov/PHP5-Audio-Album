<div id="control-panel">
	<ul id="addSongId">
		<li><a href="/songs/add">Add Song</a></li>
	</ul>
</div>


<div id="song" class="song-holder">
	<h1 class="songs-header">Song</h1>
	<ul>
	    <?php foreach ($this->viewBag['song'] as $song) : ?>
	    	<li>
	    		<h1><?= $song['name'] ?></h1>
	    		<h2>From Genre: <?= $song['genreName'] ?></h2>
	    		<h2>From Playlist: <?= $song['playlistName'] ?></h2>
	    	</li>
	    <?php endforeach ?>
	</ul>
</div>