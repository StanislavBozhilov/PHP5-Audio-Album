<div id="genresTable">
<table>
    <tr>
        <th>Name</th>

    </tr>

    <?php foreach ($this->genres as $genre) : ?>
        <tr>
            <td><?= htmlspecialchars($genre['name']) ?></td>
        </tr>
    <?php endforeach ?>

</table>
    <button id="genresButton" onclick="location.href='/genres/create'">Add New Genre</button>
</div>

