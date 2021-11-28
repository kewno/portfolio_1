// for popup
let popupWrap = document.querySelector('.popupWrap');

document.addEventListener('click', closePopupClick)


function closePopupClick(e) {
	if (e.target.classList.contains('close') || e.target.classList.contains('popupWrap')) {
		popupWrap.style.display = 'none';
	}
}

function closePopup() {
	popupWrap.style.display = 'none';
}

function openPopup() {
	popupWrap.style.display = 'block';
	setTimeout(closePopup, 3000);
}


//for form
document.addEventListener('DOMContentLoaded', () => {
	const form = document.getElementById('formWriteUs');
	//перехват отправки формы
	form.addEventListener('submit', formSend);

	async function formSend(e) {
		e.preventDefault();

		let error = formValidate(form);

		let formData = new FormData(form);

		if (error === 0) {
			openPopup();
			let response = await fetch('/php/sendmail.php', {
				method: 'POST',
				body: formData
			});
			if (response.ok) {
				let result = await response.json();
				form.reset();
			} else {
				alert(response.message);
			}
		}
	}

	function formValidate() {
		let error = 0;
		let requetion = document.querySelectorAll('.req');

		for (let i =  0; i < requetion.length; i++) {
			let input = requetion[i];
			elementRemoveError(input);
			
			if (input.classList.contains('email')) {
				if (checkEmail(input.value)) {
					elementAddError(input);
					error++;
				}
			} else {
				if (input.value =='') {
					elementAddError(input);
					error++;
				}
			}
		}
		return error;
	}


	function elementAddError(el) {
		el.classList.add('errorElement');
	}
	function elementRemoveError(el) {
		el.classList.remove('errorElement');
	}
	function checkEmail(email) {
		return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(email);
	}
});