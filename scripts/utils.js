import { headerOneCode, headerTwoCode } from "./htmlCode.js";

export const addNewHeader = (elements) => {
    const body = document.querySelector('body');
    body.innerHTML = '';
    body.innerHTML = elements;
    
    const menuBtn = document.querySelector('#menuBtn');
    const closeMenuBtn = document.querySelector('.closeMenuBtn');
    if(closeMenuBtn) {
        closeMenuBtn.addEventListener('click', addNewHeader.bind(null, headerOneCode));
    }

    if(menuBtn) {
        menuBtn.addEventListener('click', addNewHeader.bind(null, headerTwoCode));
    }
}

export const handleResize = () => {
    const width = window.innerWidth;
    
    if(width > 767) {
        const headerOne = document.querySelector('.headerOne');
        if(headerOne) {
            const headerOneBtn = document.querySelector('.headerOne').firstElementChild;
            const headerDiv = document.querySelector('.headerDiv');
            headerDiv.classList.remove('hidden');
            headerOneBtn.classList.add('hidden');
        }
        
    }
    if(width < 768) {
        const headerOne = document.querySelector('.headerOne');
        if(headerOne) {
            const headerOneBtn = document.querySelector('.headerOne').firstElementChild;
            const headerDiv = document.querySelector('.headerDiv');
            headerOneBtn.classList.remove('hidden');
            headerDiv.classList.add('hidden');
    }
    }
}