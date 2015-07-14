<div id="playlistsTable">
<table>
    <tr>
        <th>Name</th>
    </tr>
    <?php foreach ($this->playlists as $playlist) : ?>
        <tr>
            <td><a href="/songs/playlist/<?php echo $playlist['id']?>"><?= htmlspecialchars($playlist['name']) ?></a></td>
        </tr>
    <?php endforeach ?>
</table>
<button id="playlistsButton" onclick="location.href='/playlists/create'">Add New Playlist</button>
</div>