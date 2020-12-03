class Ctrl{
	constructor(){
		let inputaltImage = document.getElementById("altImage");
		let inputAnnee = document.getElementById("Annee");
		let inputTitre = document.getElementById("Titre");
		let inputTexte = document.getElementById("Texte");
		let btnSubmit = document.getElementById("AdminBtn");
		
		btnSubmit.addEventListener("click", function(){
			if(inputaltImage.value == ""){
				alert("Le fomulaire AltImage n'est pas remplis");
			}
			if(inputAnnee.value == ""){
				alert("Le fomulaire Annee n'est pas remplis");
			}
			if(inputTitre.value == ""){
				alert("Le formulaire Titre n'est pas remplis");
			}
			if(inputTexte.value == ""){
				alert("Le fomulaire Texte n'est pas remplis");
			}	
		});
	};
};
let maCtrl = new Ctrl();