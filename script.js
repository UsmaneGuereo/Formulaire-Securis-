
const urlParams = new URLSearchParams(window.location.search);

if (urlParams.has('msg')) {
    const message = urlParams.get('msg');

    afficherMessage(message);
}

function afficherMessage(status) {
    var myDiv = document.getElementById('msgAlert');

    switch (status) {
        case 'authSuccess':
            myDiv.classList.remove('alert-danger');
            myDiv.classList.remove('alert-secondary');
            myDiv.classList.add('alert-success');
            myDiv.textContent = "Authentification réussie avec succés"
            break;
        case 'failed':
            myDiv.classList.remove('alert-succes');
            myDiv.classList.remove('alert-secondary');
            myDiv.classList.add('alert-danger');
            myDiv.textContent = "Authentification échouée"
            break;
        case 'exists':
            myDiv.classList.remove('alert-succes');
            myDiv.classList.remove('alert-danger');
            myDiv.classList.add('alert-secondary');
            myDiv.textContent = "Cet identifiant est déjà utilisé"
            break;
        case 'signUpSuccess':
            myDiv.classList.remove('alert-danger');
            myDiv.classList.remove('alert-secondary');
            myDiv.classList.add('alert-success');
            myDiv.textContent = "Inscription réussie avec succés"
            break;

        default:
            break;
    }

    myDiv.classList.remove('d-none');

    setTimeout(function () {
        myDiv.classList.add('d-none');
    }, 4000);
}
