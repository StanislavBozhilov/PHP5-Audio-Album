<h1>Create new playlist: </h1>
<form action="/playlists/create" method="post">
    <label for="playlist-name">Playlist Name: </label>
    <input type="text" name="playlist-name"/>
    <br/>
    <label for="genre-id">Choose genre: </label>
    <select name="genre-id">
        <?php foreach ($this->genres as $genre) : ?>
                <option value="<?php echo $genre['id']?>"><?=htmlspecialchars($genre['name']) ?></option>
        <?php endforeach ?>
    </select>
    <br/>
    <input type="submit" value="Add"/>
</form>