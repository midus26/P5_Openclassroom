class Ctrl{
	constructor(){
		let inputaltImage = document.getElementById("altImage");
		let inputDateDebut = document.getElementById("DateDebut");
		let inputDateFin = document.getElementById("DateFin");
		let inputHeureDebut = document.getElementById("TimeStart");
		let inputHeureFin = document.getElementById("TimeEnd");
		let inputTitre = document.getElementById("Titre");
		let inputTexte = document.getElementById("Texte");
		let btnSubmit = document.getElementById("AdminBtn");
		
		let inputsameImg = document.getElementById("sameImage");
		let inputnotsameImg = document.getElementById("notsameImage");
		let inputImage = document.getElementById("Image");
		
		btnSubmit.addEventListener("click",function (e){
			//Vérification des champs
			if(inputaltImage.value == ""){
				alert("Le formulaire altImage n'est pas remplis");
				e.preventDefault();
			}
			if(inputTitre.value == ""){
				alert("Le formulaire Titre n'est pas remplis");
				e.preventDefault();
			}
			if(inputTexte.value == ""){
				alert("Le formulaire Texte n'est pas remplis");
				e.preventDefault();
			}
			if(inputDateDebut.value == ""){
				alert("Le fomulaire Date Debut n'est pas remplis");
				e.preventDefault();
			}
			if(inputDateFin.value == ""){
				alert("Le fomulaire Date Fin n'est pas remplis");
				e.preventDefault();
			}
			if(inputHeureDebut.value == ""){
				alert("Le fomulaire Heure Debut n'est pas remplis");
				e.preventDefault();
			}
			if(inputHeureFin.value == ""){
				alert("Le fomulaire Heure Fin n'est pas remplis");
				e.preventDefault();
			}
			//Comparaison des Heures
			if(inputDateDebut.value > inputDateFin.value){
			alert("Erreur sur les dates : La date de fin ne peus être antérieur à celle de début");
			e.preventDefault();
			}
			if (inputHeureDebut.value > inputHeureFin.value){
			alert("L'heure de fin ne peus être antérieur à celle du début");
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