import { headerTwoCode } from "./htmlCode.js";
import { addNewHeader, handleResize, manageClass, createLiItem } from "./utils.js";
const isLoggedIn = document.querySelector('header').dataset.loggedIn;
const menuBtn = document.querySelector('#menuBtn');

menuBtn.addEventListener('click', addNewHeader.bind(null, headerTwoCode));

window.addEventListener('resize', handleResize);
handleResize();



if(isLoggedIn) {
  const productList = document.querySelector(".productList");
const searchInput = document.getElementById("searchInput");

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

  searchInput?.addEventListener("input", () => {
  const query = searchInput.value;
  fetch("index.php?page=search-product&search="+encodeURIComponent(query))
  .then(res => res.json())
  .then(products => {
    productList.innerHTML = "";
    if(!products.length) {
      productList.innerHTML = "<p class='errorMessage'>There is no any product in the list...</p>";
      return;
    }
    products.forEach((product) => {
      const li = createLiItem(product);
      productList.insertAdjacentHTML('beforeend', li);
    });
    const newProductBtns = document.querySelectorAll(".productButtonDiv button");
    const newDeleteBtnActions = (btn) => {
        const productId = btn.getAttribute('data-id');
        const input = document.querySelector(".overlayContent input");
        input.value = productId;
        manageClass('.overlay', null, 'hidden');
    }
    newProductBtns.forEach((btn) => {
        btn.addEventListener("click", newDeleteBtnActions.bind(null, btn))});
  }).catch((err) => {
      console.error("Error fetching products:", err);
    });
 });
  
}
