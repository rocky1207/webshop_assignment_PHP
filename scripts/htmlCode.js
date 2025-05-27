const isLoggedIn = document.querySelector('header').dataset.loggedIn;

const getNavLinks = (loggedIn) => {
    let links = [
        {href: '/', label: 'Welcome'},
        {href: '?page=aboutUs', label: 'About us'},
        {href: '?page=logIn', label: 'Log In'}
    ];

    if(loggedIn) {
        links = links.filter(li => li.label !== 'Log In'); 
        links.push({href: '?page=products', label: 'Product list'},{href: '?page=add-product', label: 'Add product'},{href: '?page=logOut', label: 'Log Out'});
    }
    return links.map(liEl => `<li><a href='${liEl.href}'>${liEl.label}</a></li>`).join('');
}
export const headerTwoCode = `
<header class="headerTwo">
<div class="eks">
    <button type="button" class="closeMenuBtn">X</button>
</div>
<div class="containerSmall">
    <nav>
        <ul>
            ${getNavLinks(isLoggedIn)}
        </ul>
    </nav>
</div>
</header>
`;


export const headerOneCode = `
    <header class="headerOne">
        <div class="containerLg">
            <button type="button" id="menuBtn">
            <svg class="menuIcon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <line x1="2" y1="6" x2="25" y2="6" />
                <line x1="2" y1="12" x2="25" y2="12" />
                <line x1="2" y1="18" x2="25" y2="18" />
            </svg>
            </button>
        </div>
        <div class="containerLg hidden headerDiv">
            <div>
                <p>LOGO</p>
            </div>
            <nav>
                <ul>
                    ${getNavLinks(isLoggedIn)}
                </ul>
            </nav>
        </div>
    </header>    
`;
