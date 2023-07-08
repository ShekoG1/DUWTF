function sleep(num) {
	let now = new Date();
	const stop = now.getTime() + num;
	while(true) {
		now = new Date();
		if(now.getTime() > stop) return;
	}
}
function routeTo(categoryId){
	document.querySelector("#hdn-frm-catid").value = categoryId;
	document.querySelector("#hdn-frm-sbmt").click();
}

function titleCase(str) {
    return str
        .split(' ')
        .map((word) => word[0].toUpperCase() + word.slice(1).toLowerCase())
        .join(' ');
}
function togglePassword(confirmPassword){
	console.log("TOGGLE TRIGGERED");
	let elem;
	if(confirmPassword){
		elem = document.querySelector("#confirmPassword");
		type = elem.type;
		if(type == "password"){
			elem.type = "text";
		}
		else {
			elem.type = "password";
		}
		toggleClass("confirmWrapper");
	}else{
		elem = document.querySelector("#password");
		console.log(elem);
		type = elem.type;
		if(type == "password"){
			console.log("password");
			elem.type = "text";
		}
		else {
			console.log("text");
			elem.type = "password";
		}
		toggleClass("wrapper");
	}
}
function toggleClass(id) {
	var wrapper = document.getElementById(id);
	wrapper.classList.toggle('eye-close');
	wrapper.classList.toggle('eye-open');
}

function nameIsvalid(input){
	var regex = /[0-9!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
	var trimmedInput = input.replace(/\s/g, '');
	
	return !regex.test(trimmedInput);
}
function isValidEmail(email) {
	var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

	return regex.test(email);

}
function isValidPassword(password) {
	var hasNumber = /\d/;
	var hasSpecialChar = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
	
	return (
	  password.length > 10 &&
	  hasNumber.test(password) &&
	  hasSpecialChar.test(password)
	);
}