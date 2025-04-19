import { headerTwoCode } from "./htmlCode.js";
import { addNewHeader, handleResize } from "./utils.js";

const menuBtn = document.querySelector('#menuBtn');

menuBtn.addEventListener('click', addNewHeader.bind(null, headerTwoCode));

window.addEventListener('resize', handleResize);
handleResize();