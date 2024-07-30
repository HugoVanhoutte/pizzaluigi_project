//Whole file starts after DOM is loaded to ensure that buttons are loaded.
document.addEventListener('DOMContentLoaded', (event) => {
    let bookingButton = document.querySelector('#booking-button');
    let newsButton = document.querySelector('#news-button');
    let notesButton = document.querySelector('#notes-button');
    let pageName = window.location.href

    let pageNameStart = pageName.lastIndexOf('/') + 1
    let pageNameEnd = pageName.indexOf('?')
    if (pageNameEnd === -1) {
        pageNameEnd = pageName.length;
    }

    pageName = pageName.slice(pageNameStart, pageNameEnd)

    console.log(pageName)

    //Switches active state on buttons on page loading
    switch (pageName) {
        case 'bookings': {
            bookingButton.classList.add('active');
            break;
        }
        case 'read': {
            newsButton.classList.add('active');
            break;
        }
        case 'create': {
            newsButton.classList.add('active');
            break;
        }
        case 'notes': {
            notesButton.classList.add('active');
            break;
        }
        default: break;
    }
})
