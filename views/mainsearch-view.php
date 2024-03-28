<?php
include_once "../header.php";
?>
</header>
<input type="text" id="searchInput" placeholder="Entrez le titre du livre ou le nom de la catégorie" class="input-dark red">
<select id="categorySelect" class="input-dark blue">
    <option value="">Toutes catégories</option>
    <option value="fiction">Fiction</option>
    <option value="history">Histoire</option>
    <option value="technology">Technologie</option>
    <option value="art">Art</option>
    <option value="science">Science</option>
    <option value="religion">Religion</option>
    <option value="travel">Voyages</option>
    <option value="cooking">Cuisine</option>
    <option value="children">Jeunesse</option>
</select>
<button onclick="searchBooks()" class="btn-neon">Rechercher</button>

<div id="results" class="results-grid"></div>


<script src="../apps.js" defer></script>

<?php
include_once "../footer.php";
?>
