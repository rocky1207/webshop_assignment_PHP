import { headerOneCode, headerTwoCode } from "./htmlCode.js";

export const addNewHeader = (elements) => {
    const oldHeader = document.querySelector('header');
    if (oldHeader) {
        oldHeader.remove();
    }

    const body = document.querySelector('body');
    body.insertAdjacentHTML('afterbegin', elements);

    const menuBtn = document.querySelector('#menuBtn');
    const closeMenuBtn = document.querySelector('.closeMenuBtn');
    
    if (closeMenuBtn) {
        closeMenuBtn.addEventListener('click', addNewHeader.bind(null, headerOneCode))
    }

    if (menuBtn) {
        menuBtn.addEventListener('click', addNewHeader.bind(null, headerTwoCode))
    }
}

export const handleResize = () => {
    const width = window.innerWidth;
    
    if(width > 1025) {
        
        const headerOne = document.querySelector('.headerOne');
        const headerTwo = document.querySelector('.headerTwo');
        if(headerOne) {
            const headerOneBtn = document.querySelector('.headerOne').firstElementChild;
            const headerDiv = document.querySelector('.headerDiv');
            headerDiv.classList.remove('hidden');
            headerOneBtn.classList.add('hidden');
        } 
        if(headerTwo) {
            addNewHeader(headerOneCode);
        }
    }
    if(width < 1024) {
        const headerOne = document.querySelector('.headerOne');
        if(headerOne) {
            const headerOneBtn = document.querySelector('.headerOne').firstElementChild;
            const headerDiv = document.querySelector('.headerDiv');
            headerOneBtn.classList.remove('hidden');
            headerDiv.classList.add('hidden');
    }
    }
}

export const manageClass = (el, add, remove) => {
    console.log(el, add, remove);
    const element = document.querySelector(el);
    element.classList.add(add);
    element.classList.remove(remove);
}

export const createLiItem = (product) => {
    const li = `
      <li>
          <h2>Product name: ${product.ime}</h2>
          <div>
              <img src="" alt="${product.ime}">
          </div>
          <p>Description: ${product.opis}</p>
          <p>Price: ${product.cena}</p>
          <p>Quantity: ${product.kolicina}</p>
          <p><a href="http://localhost/ITMentorstva/vezbe/PHP-16_webshop_assignment/?page=product&id=${product.id}">See more...</a></p>
          <div class="productButtonDiv">
              <button type="button" data-id="${product.id}">DELETE</button>
          </div>
      </li>
    `;
    return li;
}