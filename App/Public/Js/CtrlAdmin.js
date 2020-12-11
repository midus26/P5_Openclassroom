class CtrlAdmin{
	constructor(){
		let Supp = document.getElementsByClassName("confirmDelete");
		
		for(let i=0;i<Supp.length;i++){
			Supp[i].addEventListener('click', function(e){
				let Confirmer = confirm("Etes vous sur de vouloir supprimer cette element?");
				if(Confirmer){
					
				}
				else{
					e.preventDefault();
				}
			});
		}
	};
};
let monAdmin = new CtrlAdmin();