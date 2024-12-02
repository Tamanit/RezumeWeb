import httpRequestMethod from './httpRequestMethod.js';

function setClauseOnElementsByClassName(className = '',action = 'click' , clause) {
    const elements = document.getElementsByClassName(className);
    if (elements === undefined || elements === null) return;

    for (let i = 0; i < elements.length; i++) {
        elements[i].addEventListener(action, function (e) {clause(e, this)});
    }
}

setClauseOnElementsByClassName(
    'button__delete',
    'click',
    async (e, _this) => {
        e.preventDefault();
        await httpRequestMethod.delete(_this.href, _this.dataset.csrf);
        window.location.replace('/persons');
        window.location.reload();

    }
)

// setClauseOnElementsByClassName(
//     'resume__edit__form',
//     'submit',
//     async (e, _this) => {
//         e.preventDefault();
//
//         console.debug(new FormData(_this));
//         await httpRequestMethod.put(_this.action, new FormData(_this), _this.dataset.csrf);
//         // window.location.replace('/persons');
//         // window.location.reload();
//     }
// )

