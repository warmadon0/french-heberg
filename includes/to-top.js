jQuery(function(){
$(function () {
$(window).scroll(function () { //Fonction appel�e quand on descend la page
if ($(this).scrollTop() > 200 ) {  // Quand on est � 200pixels du haut de page,
$('#scrollUp').css('right','10px'); // Replace � 10pixels de la droite l'image
} else { 
$('#scrollUp').removeAttr( 'style' ); // Enl�ve les attributs CSS affect�s par javascript
}
});
});
});
 