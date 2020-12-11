class CtrlComment{
	constructor(){
		let inputMessage = document.getElementById("Message");
		let inputBtnValid = document.getElementById("AdminBtn");
		
		inputBtnValid.addEventListener("click", function(e){
			if(inputMessage.value == ""){
				alert("Contenu du message vide");
				e.preventDefault();
			}
		});
	};
};
let monCtrlComment = new CtrlComment();