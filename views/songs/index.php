<div id="control-panel">
	<ul>
		<li><a href="/songs/add">Upload Song</a></li>
	</ul>
</div>


<div id="songs" class="song-holder">
	<h2 class="songs-header">Songs</h2>
	<ul id="songsUl">
	    <?php foreach ($this->viewBag['songs'] as $song) : ?>
            <div>
	    	<li>
	    		<h3>Name: <?= $song['name'] ?></h3>
	    		<h3> Genre: <?= $song['genreName'] ?></h3>
	    		<h3> Playlist: <?= $song['playlistName'] ?></h3>
                <audio controls><source src="<?php echo $song['path'] ?>" ></audio>
                <div>
                <a href='/songs/download?id=<?php echo $song['id']?>'>Download</a>
                <a href="#">[X]</a>
<!--                    songs/delete/<?php echo $song['id']?>-->
                </div>

	    	</li>
            </div>
	    <?php endforeach ?>
	</ul>
</div>

