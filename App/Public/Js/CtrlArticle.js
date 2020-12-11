class Ctrl{
	constructor(){
		let inputaltImage = document.getElementById("altImage");
		let inputTitre = document.getElementById("Titre");
		let inputTexte = document.getElementById("Texte");
		let btnSubmit = document.getElementById("AdminBtn");
		
		let inputsameImg = document.getElementById("sameImage");
		let inputnotsameImg = document.getElementById("notsameImage");
		let inputImage = document.getElementById("Image");
		
		btnSubmit.addEventListener("click", function(e){
			if(inputaltImage.value == ""){
				alert("Le fomulaire AltImage n'est pas remplis");
				e.preventDefault();
			}
			if(inputTitre.value == ""){
				alert("Le formulaire Titre n'est pas remplis");
				e.preventDefault();
			}
			if(inputTexte.value == ""){
				alert("Le fomulaire Texte n'est pas remplis");
				e.preventDefault();
			}	
		});
		if(inputsameImg != null){
			if(inputsameImg.value = "Oui"){
				inputImage.style.display = "none";
			}
			inputsameImg.addEventListener('click', function (){
				inputImage.style.display = "none";
			});
			inputnotsameImg.addEventListener('click', function (){
				inputImage.style.display = "flex";
			});
		}
	};
};
let maCtrl = new Ctrl();