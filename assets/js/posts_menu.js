//Whole file starts after DOM is loaded to ensure that buttons are loaded.
document.addEventListener('DOMContentLoaded', (event) => {
    let createButton = document.querySelector('#create');
    let readButton = document.querySelector('#read');
    let pageName = window.location.href

    let pageNameStart = pageName.lastIndexOf('/') + 1
    let pageNameEnd = pageName.indexOf('?')
    if (pageNameEnd === -1) {
        pageNameEnd = pageName.length;
    }

    pageName = pageName.slice(pageNameStart, pageNameEnd)

    //Switches active state on buttons on page loading
    switch (pageName) {
        case 'create': {
            createButton.classList.add('active');
            break;
        }
        case 'read': {
            readButton.classList.add('active');
            break;
        }

        default: break;
    }
})
