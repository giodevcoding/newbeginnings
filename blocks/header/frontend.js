const hamburger = document.querySelector(".header__nav-hamburger--wrapper").firstElementChild;
const mobileNavMenu = document.querySelector(".nav-mobile-menu");


hamburger.addEventListener("click", handleHamburgerClick);

function handleHamburgerClick(event) {

    if (mobileNavMenu.classList.contains("nav-mobile-menu--hide")) {
        showMobileMenu();
        changeHamburgerToClose();
    } else {
        hideMobileMenu();
        changeCloseToHamburger();
    }
}

function showMobileMenu() {
    mobileNavMenu.classList.remove("nav-mobile-menu--hide");
    mobileNavMenu.classList.add("nav-mobile-menu--show");
}

function hideMobileMenu() {
    mobileNavMenu.classList.remove("nav-mobile-menu--show");
    mobileNavMenu.classList.add("nav-mobile-menu--hide");
}

function changeHamburgerToClose() {
    const hamburgerBars = hamburger.firstElementChild.children;
    const top = hamburgerBars[0];
    const middle = hamburgerBars[1];
    const bottom = hamburgerBars[2];

    top.classList.remove("header__nav-hamburger__bar--unrotate-right");
    top.classList.add("header__nav-hamburger__bar--rotate-right");
    middle.classList.remove("header__nav-hamburger__bar--show")
    middle.classList.add("header__nav-hamburger__bar--hide");
    bottom.classList.remove("header__nav-hamburger__bar--unrotate-left");
    bottom.classList.add("header__nav-hamburger__bar--rotate-left");
}

function changeCloseToHamburger() {
    const hamburgerBars = hamburger.firstElementChild.children;
    const top = hamburgerBars[0];
    const middle = hamburgerBars[1];
    const bottom = hamburgerBars[2];

    top.classList.remove("header__nav-hamburger__bar--rotate-right");
    top.classList.add("header__nav-hamburger__bar--unrotate-right");
    middle.classList.remove("header__nav-hamburger__bar--hide");
    middle.classList.add("header__nav-hamburger__bar--show");
    bottom.classList.remove("header__nav-hamburger__bar--rotate-left");
    bottom.classList.add("header__nav-hamburger__bar--unrotate-left");
}

//Adding event listener to hide mobile menu if window is resized to normal size
window.addEventListener('resize', e => {
    if (window.innerWidth >= 992) {
        hideMobileMenu();
        changeCloseToHamburger();
    }
});