    var moncanvas = document.getElementById('dessin');
    var ctx = moncanvas.getContext('2d');
    var en_dessin = false;
    ctx.strokeStyle = "grey";
    ctx.lineWidth = 4;
    // Bouton de souris activé
    moncanvas.onmousedown = function(evt) {
    // Dessin activé
    en_dessin = true;
    ctx.beginPath();
    // Repositionnement du début du tracé
    ctx.moveTo(evt.offsetX,evt.offsetY);
    };
    // Mouvement de souris
    moncanvas.onmousemove = function(evt) {
    if(en_dessin) dessiner(evt.offsetX,evt.offsetY);
    var dataURL = moncanvas.toDataURL();
    document.getElementById('canvasImg').src = dataURL;
    };
    // Bouton de souris relâché
    moncanvas.onmouseup = function(evt) {
    // Dessin désactivé
    en_dessin = false;
    ctx.closePath();
    };
    // Ajoute un segment au tracé
    function dessiner(x,y) {
    ctx.lineTo(x,y);
    ctx.stroke();
    }
    // Modification de la couleur du contexte
    function changecouleur(macouleur) {
    if(macouleur) ctx.strokeStyle = macouleur;
    }
    function bigHeight(maTaille) {
    if(maTaille) ctx.lineWidth = maTaille;
    }
    // Gomme
