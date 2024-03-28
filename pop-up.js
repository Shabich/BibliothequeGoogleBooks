//penser a changer le url le name et les params mais je sais pas quoi mettre sah
document.querySelector('button').addEventListener('click', function() {
    let url = "thanks.html";
    let name = "ThanksPopup";
    let params = "height=200,width=200";
    window.open(url, name, params);
});

//pop-up quand un livre est retiré des favoris  
document.querySelector('.remove-favorite').addEventListener('click', function() {
    let url = "removed.html";
    let name = "RemovedPopup";
    let params = "height=200,width=200";
    window.open(url, name, params);
});
