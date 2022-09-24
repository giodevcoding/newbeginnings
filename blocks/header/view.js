const hamburger = document.querySelector(".header__nav-hamburger--wrapper").firstElementChild;
const mobileNavMenu = document.querySelector(".nav-mobile-menu");
const mainMenu = document.querySelector(".nav-mobile-menu__main-menu");
const folderButtons = document.querySelectorAll(".nav-mobile-menu__button--folder");
const backButtons = document.querySelectorAll(".nav-mobile-menu__button--close");

hamburger.addEventListener("click", handleHamburgerClick);
folderButtons.forEach(button => button.addEventListener("click", e => openSubMenu(e.target)));
backButtons.forEach(button => button.addEventListener("click", e => closeSubMenu(e.target)));

//Adding event listener to hide mobile menu if window is resized to normal size
window.addEventListener('resize', e => {
    if (window.innerWidth >= 992) {
        const force = true;
        closeMobileMenu(force);
    }
});


function openMobileMenu() {
    showMobileMenu();
    changeHamburgerToClose();
}

function closeMobileMenu(force = false) {
    hideMobileMenu(force);
    changeCloseToHamburger();
}

function handleHamburgerClick(event) {

    if (!mobileNavMenu.classList.contains("nav-mobile-menu--show")) {
        openMobileMenu();
    } else {
        closeMobileMenu();
    }
}


function showMobileMenu() {
    //Wrapper div.nav-mobile-menu-wrapper
    mobileNavMenu.parentElement.classList.add("nav-mobile-menu-wrapper--show");
    mobileNavMenu.classList.add("nav-mobile-menu--show");
    
    mainMenu.classList.add("slide-menu-right");
    setTimeout(() => {
        mainMenu.classList.remove("slide-menu-right");
        mainMenu.classList.add("nav-mobile-menu__main-menu--show");
    }, 285);
    
}


function hideMobileMenu(force) {
    //Wrapper div.nav-mobile-menu-wrapper

    if (force) {
        mainMenu.classList.remove("nav-mobile-menu__main-menu--show");
        mobileNavMenu.parentElement.classList.remove("nav-mobile-menu-wrapper--show");
        mobileNavMenu.classList.remove("nav-mobile-menu--show");
        closeAllSubMenus();
        return;
    }

    const activeSubMenus = document.querySelectorAll(".nav-mobile-menu__sub-menu--active");
    mainMenu.classList.add("slide-menu-left");
    activeSubMenus.forEach(subMenu => subMenu.classList.add("slide-menu-left"));

    setTimeout(() => {
        mainMenu.classList.remove("slide-menu-left");
        mainMenu.classList.remove("nav-mobile-menu__main-menu--show");
        activeSubMenus.forEach(subMenu => {
            subMenu.classList.remove("slide-menu-left");
            subMenu.classList.remove("nav-mobile-menu__sub-menu--active");
        })
        mobileNavMenu.parentElement.classList.remove("nav-mobile-menu-wrapper--show");
        mobileNavMenu.classList.remove("nav-mobile-menu--show");
        closeAllSubMenus();
    }, 285);
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


function openSubMenu(button) {
    while (button.tagName != "BUTTON") {
        button = button.parentElement;
    }
    const name = button.dataset.folderName;
    const subMenu = document.querySelector(".nav-mobile-menu__sub-menu[data-folder-name=" + name + "]");

    mainMenu.classList.add("slide-menu-left");
    subMenu.classList.add("slide-menu-left");

    setTimeout(() => {
        mainMenu.classList.remove("nav-mobile-menu__main-menu--show");
        subMenu.classList.add("nav-mobile-menu__sub-menu--active");
        mainMenu.classList.remove("slide-menu-left");
        subMenu.classList.remove("slide-menu-left");
    }, 285);
}


function closeSubMenu(subMenu) {
    while (! subMenu.classList.contains("nav-mobile-menu__sub-menu")) {
        subMenu = subMenu.parentElement;
    }

    mainMenu.classList.add("slide-menu-right");
    subMenu.classList.add("slide-menu-right");

    setTimeout(() => {
        mainMenu.classList.add("nav-mobile-menu__main-menu--show");
        subMenu.classList.remove("nav-mobile-menu__sub-menu--active");
        mainMenu.classList.remove("slide-menu-right");
        subMenu.classList.remove("slide-menu-right");
    }, 285);

}


function closeAllSubMenus(force) {
    backButtons.forEach(button => {
        button.parentElement.classList.remove("nav-mobile-menu__sub-menu--active");
    });
}