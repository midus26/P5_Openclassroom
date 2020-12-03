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
		
		btnSubmit.addEventListener("click",function (){
			//Vérification des champs
			if(inputaltImage.value == ""){
				alert("Le formulaire altImage n'est pas remplis");
			}
			if(inputTitre.value == ""){
				alert("Le formulaire Titre n'est pas remplis");
			}
			if(inputTexte.value == ""){
				alert("Le formulaire Texte n'est pas remplis");
			}
			if(inputDateDebut.value == ""){
				alert("Le fomulaire Date Debut n'est pas remplis");
			}
			if(inputDateFin.value == ""){
				alert("Le fomulaire Date Fin n'est pas remplis");
			}
			if(inputHeureDebut.value == ""){
				alert("Le fomulaire Heure Debut n'est pas remplis");
			}
			if(inputHeureFin.value == ""){
				alert("Le fomulaire Heure Fin n'est pas remplis");
			}
			//Comparaison des Heures
			if(inputDateDebut.value > inputDateFin.value){
			alert("Erreur sur les dates : La date de fin ne peus être antérieur à celle de début");
			}
			if (inputHeureDebut.value > inputHeureFin.value){
			alert("L'heure de fin ne peus être antérieur à celle du début");
			}
		});
	};
};
let maCtrl = new Ctrl();