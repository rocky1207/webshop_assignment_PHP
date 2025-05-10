import { headerTwoCode } from "./htmlCode.js";
import { addNewHeader, handleResize, manageClass } from "./utils.js";
const isLoggedIn = document.querySelector('header').dataset.loggedIn;
const menuBtn = document.querySelector('#menuBtn');


menuBtn.addEventListener('click', addNewHeader.bind(null, headerTwoCode));

window.addEventListener('resize', handleResize);
handleResize();



if(isLoggedIn) {
  const deleteProductBtn = document.querySelector(".overlayButtonDiv")?.firstElementChild;
  const cancelDeleteProductBtn = document.querySelector(".overlayButtonDiv")?.lastElementChild;  
  const productBtns = document.querySelectorAll(".productButtonDiv button");
  if(deleteProductBtn && cancelDeleteProductBtn) {
    cancelDeleteProductBtn.addEventListener("click", manageClass.bind(null, '.overlay', 'hidden', null));
    deleteProductBtn.addEventListener("click", manageClass.bind(null, '.overlay', 'hidden', null));
    const deleteBtnActions = (btn) => {
        const productId = btn.getAttribute('data-id');
        const input = document.querySelector(".overlayContent input");
        input.value = productId;
        manageClass('.overlay', null, 'hidden');
    }
    productBtns.forEach((btn) => {
        btn.addEventListener("click", deleteBtnActions.bind(null, btn))});
    
  }
  
}
