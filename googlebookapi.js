function searchBooks() {
    const searchInput = document.getElementById("searchInput").value;
    const category = document.getElementById("categorySelect").value;

    let url = `https://www.googleapis.com/books/v1/volumes?q=`;

    if (searchInput) {
        url += `intitle:${searchInput}`;
    }

    if (category) {
        url += `+subject:${category}`;
    }

    fetch(url)
        .then(response => response.json())
        .then(data => {
            displayResults(data);
        })
        .catch(error => {
            console.error("Erreur lors de la recherche :", error);
        });
}

function displayResults(data) {
    const resultsDiv = document.getElementById("results");
    resultsDiv.innerHTML = "";

    if (data.items && data.items.length > 0) {
        data.items.forEach(item => {
            const title = item.volumeInfo.title;
            const authors = item.volumeInfo.authors ? item.volumeInfo.authors.join(", ") : "Auteur inconnu";
            const categories = item.volumeInfo.categories ? item.volumeInfo.categories.join(", ") : "Catégorie inconnue";
            const thumbnail = item.volumeInfo.imageLinks ? item.volumeInfo.imageLinks.thumbnail : "https://via.placeholder.com/128x196?text=Image+non+disponible";
            const description = item.volumeInfo.description ? item.volumeInfo.description : "Pas de description disponible";

            const bookDiv = document.createElement("div");
            bookDiv.className = "bookorder";
            bookDiv.innerHTML = `
    <h2>${title}</h2>
    <img src="${thumbnail}" alt="${title}" style="width: 128px; height: 196px;">
    <p>Auteur(s): ${authors}</p>
    <p>Catégorie(s): ${categories}</p>
    <button onclick="toggleDescription(this)">Voir la description</button>
    <div class="description" style="display: none;">
        <p>${description}</p>

    </div>
`;

const addToFavoritesBtn = document.createElement("button");
addToFavoritesBtn.textContent = "Ajouter aux favoris";
addToFavoritesBtn.addEventListener("click", function() {
    addToFavorites(item);
});
bookDiv.appendChild(addToFavoritesBtn);
            resultsDiv.appendChild(bookDiv);
        });
    } else {
        resultsDiv.innerHTML = "<p>Aucun livre trouvé.</p>";
    }
}
toggleDescription = (button) => {
    const description = button.nextElementSibling;
    if (description.style.display === "none") {
        description.style.display = "block";
        button.textContent = "Masquer la description";
    } else {
        description.style.display = "none";
        button.textContent = "Voir la description";
    }
}

function toggleFavorites() {
    const favoritesDiv = document.getElementById("favorites");
    if (favoritesDiv.style.display === "flex" || favoritesDiv.style.display === "") {
        favoritesDiv.style.display = "none";
    } else {
        favoritesDiv.style.display = "flex";
    }
}
function addToFavorites(item) {
    const title = item.volumeInfo.title;
    const authors = item.volumeInfo.authors ? item.volumeInfo.authors.join(", ") : "Auteur inconnu";
    const categories = item.volumeInfo.categories ? item.volumeInfo.categories.join(", ") : "Catégorie inconnue";
    const thumbnail = item.volumeInfo.imageLinks ? item.volumeInfo.imageLinks.thumbnail : "https://via.placeholder.com/128x196?text=Image+non+disponible";
    const description = item.volumeInfo.description ? item.volumeInfo.description : "Pas de description disponible";

    const book = {
        title: title,
        authors: authors,
        categories: categories,
        thumbnail: thumbnail,
        description: description
    };

    fetch('http://localhost:5500/favorite.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(book),
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.status === 'valide') {
            console.log('Livre ajouté aux favoris avec succès !');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        // alert('Une erreur est survenue lors de l\'ajout du livre aux favoris.');
    });
}
function deleteFavorite(bookId) {
    fetch(`http://localhost:5500/favorite.php`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${bookId}`,
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.status === 'valide') {
            console.log('Livre supprimé des favoris avec succès !');
            // Supprimer l'élément du DOM
            const favoriteItem = document.getElementById(`favorite-${bookId}`);
            if (favoriteItem) {
                favoriteItem.remove();
            }
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        // alert('Une erreur est survenue lors de la suppression du livre des favoris.');
    });
}
