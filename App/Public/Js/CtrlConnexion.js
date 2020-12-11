class CtrlConnexion{
	constructor(){
		let inputPseudo = document.getElementsByClassName("Pseudo");
		let inputPassword = document.getElementsByClassName("Password");
		let inputpasswordCheck = document.getElementById("PasswordCheck");
		
		let btnConnexion = document.getElementById("btnConnexion");
		let btnInscription = document.getElementById("btnInscription");
		
		btnConnexion.addEventListener('click',function(e){
			if(inputPseudo[0].value == "" || inputPassword[0].value == ""){
				alert("Tous les champs ne sont pas remplis");
				e.preventDefault();
			}
		});
		btnInscription.addEventListener('click', function(e){
			if (inputPseudo[1].value == "" || inputPassword[1].value == "" || inputpasswordCheck.value == ""){
				if(inputPassword[1].value != inputpasswordCheck.value){
					alert("Les mots de passe ne sont pas identique");
					e.preventDefault();
				}
				alert("Tous les champs ne sont pas remplis");
				e.preventDefault();
			}
		})
	};
};
let monCtrlConnexion = new CtrlConnexion();