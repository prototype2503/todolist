document.addEventListener("DOMContentLoaded",function(){
	const wrapper = document.querySelector('.wrapper');
	const loginlink = document.querySelector('.login-link');
	const registerlink = document.querySelector('.register-link');
	
	if(registerlink){
		registerlink.addEventListener('click',function(event){
			event.preventDefault();
			wrapper.classList.add('active');
		});
	}
	
	if(loginlink){
		loginlink.addEventListener('click',function(event){
			event.preventDefault();
			wrapper.classList.remove('active');
		});
	}
	

});
