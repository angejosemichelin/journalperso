// Adapte la taille des images avec la taille de l'écran
var taille_fenetre;
var taille_conteneur;
setInterval(function(){
    taille_fenetre = $(window).width(); 
    taille_conteneur = $(".publication").width();
    console.log(taille_fenetre);
    $(".image_publication_simple").each(function(){
        var image = $(this);
        if(image.width() > taille_conteneur && taille_fenetre > 500){
            image.width('300px');
        }
        if(image.width() > 250) {
            image.width('250px');
        }
        if(image.width() > taille_conteneur && taille_fenetre < 500){
            image.width('90%');
        }
    });
}, 100);