export default function copyText() {
    let copyTextButton = document.querySelector('.partners .copy-text');

    copyTextButton.addEventListener('click', function(e) {
        e.preventDefault();
        let textLink = e.target.querySelector('a').getAttribute('href');
        let divContent = e.target;

        navigator.clipboard.writeText(textLink).then(() => {
            divContent.setAttribute('data-content', 'Copié !');

            setTimeout(() => {
                divContent.setAttribute('data-content', textLink);
            }, 2000);
        },() => {
            console.error('La copie du texte a échoué');
        });
    })
}