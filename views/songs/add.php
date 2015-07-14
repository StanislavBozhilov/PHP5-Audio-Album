<form method="POST" action="/songs/add" enctype="multipart/form-data">

	<h1 class="songs-header">Add Song</h1>
	<label for="playlistId">Playlist:</label>
	<select name="playlist" id="playlistId">
	    <?php foreach ($this->viewBag['playlists'] as $playlist) : ?>
	    	<option value="<?= $playlist['id'] ?>"> <?= $playlist['name']?></option>
	    <?php endforeach ?>
	</select>
	<label for="name">Song Name:</label>
	<input type="text" name="name" id="name"/>
	<label for="fileToUpload">Choose Song:</label>
	<input type="file" name="fileToUpload" id="fileToUpload"/>
	<input type="submit" value="Add Song" />

</form>