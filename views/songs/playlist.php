<div id="control-panel">
	<ul>
		<li><a href="/songs/add">Add Song</a></li>
	</ul>
</div>


<div id="songs" class="song-holder">
	<h1 class="songs-header">Songs</h1>
	<ul>
	    <?php foreach ($this->viewBag['playlistSongs'] as $song) : ?>
	    	<li>
                <h3><?= $song['name'] ?></h3>
	    	</li>
	    <?php endforeach ?>
	</ul>
</div>

