// // Put event listeners into place
// window.addEventListener("DOMContentLoaded", function() {
// 	// Grab elements, create settings, etc.
// 	var canvas = document.getElementById("canvas"),
// 		context = canvas.getContext("2d"),
// 		video = document.getElementById("video"),
// 		videoObj = { "video": true },
// 		errBack = function(error) {
// 			console.log("Video capture error: ", error.code); 
// 		};

// 	// Put video listeners into place
// 	if(navigator.getUserMedia) { // Standard
// 		navigator.getUserMedia(videoObj, function(stream) {
// 			video.src = stream;
// 			video.play();
// 		}, errBack);
// 	} else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
// 		navigator.webkitGetUserMedia(videoObj, function(stream){
// 			video.src = window.webkitURL.createObjectURL(stream);
// 			video.play();
// 		}, errBack);
// 	}
// 	else if(navigator.mozGetUserMedia) { // Firefox-prefixed
// 		navigator.mozGetUserMedia(videoObj, function(stream){
// 			video.src = window.URL.createObjectURL(stream);
// 			video.play();
// 		}, errBack);
// 	}
// }, false);


// // Trigger photo take
// document.getElementById("snap").addEventListener("click", function() {
// 	context.drawImage(video, 0, 0, 640, 480);
// });


// //galery picture camera
// function displayPics()
// {
//   var photos = document.getElementById('galerie_mini') ;
//   // On récupère l'élément ayant pour id galerie_mini
//   var liens = photos.getElementsByTagName('a') ;
//   // On récupère dans une variable tous les liens contenu dans galerie_mini
//   var big_photo = document.getElementById('big_pict') ;
//   // Ici c'est l'élément ayant pour id big_pict qui est récupéré, c'est notre photo en taille normale

//   var titre_photo = document.getElementById('photo').getElementsByTagName('dt')[0] ;
//   // Et enfin le titre de la photo de taille normale
//   // Une boucle parcourant l'ensemble des liens contenu dans galerie_mini
//   for (var i = 0 ; i < liens.length ; ++i) {
//     // Au clique sur ces liens 
//     liens[i].onclick = function() {
//       big_photo.src = this.href; // On change l'attribut src de l'image en le remplaçant par la valeur du lien
//       big_photo.alt = this.title; // On change son titre
//       titre_photo.firstChild.nodeValue = this.title; // On change le texte de titre de la photo
//       return false; // Et pour finir on inhibe l'action réelle du lien
//     };
//   }
// }

// // Il ne reste plus qu'à appeler notre fonction au chargement de la page
// window.onload = displayPics;


// // Converts image to canvas; returns new canvas element
// function convertImageToCanvas(image) {
// 	var canvas = document.createElement("canvas");
// 	canvas.width = image.width;
// 	canvas.height = image.height;
// 	canvas.getContext("2d").drawImage(image, 0, 0);

// 	return canvas;
// }

// // Converts canvas to an image
// function convertCanvasToImage(canvas) {
// 	var image = new Image();
// 	image.src = canvas.toDataURL("image/png");
// 	return image;
// }