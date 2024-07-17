const proto = {
    resolveOptionSelected: (options) => {
        let pathname = window.location.pathname;
        const option = options.filter((option) => option.dataset.href.includes(pathname));
        return option;
    },
    getHref: (options, targetVal) => {
        const option = options.filter((option) => option.value === targetVal);
        const href = option[0].dataset.href;
        return href;
    },
    goToLocation: (url) => {
        window.location.href = url;
    },
    goToAnchor: (anchor) => {
        let url = location.href;
        location.href = '#' + anchor;
        history.replaceState(null, null, url);
    },
    customerNav: (customerNav) => {
        const selection = customerNav.querySelectorAll('select')[0];
        selection.addEventListener('change', () => {
            const selectedValue = selection.value;
            proto.goToAnchor(selectedValue);
        });
    },
    mobileNav: (mobileNav, webNav) => {
        const hamburger = webNav.querySelectorAll('.hamburger__icon')[0];
        const listItems = mobileNav.querySelectorAll('.list--item.has-children');
        const body = document.querySelectorAll('body')[0];

        const resizeMobileMenu = () => {
            const windowHeight = window.innerHeight;
            const webNavHeight = webNav.getBoundingClientRect().height;
            mobileNav.style.height = `${windowHeight - webNavHeight}px`;
        };

        resizeMobileMenu();

        const toggleDropdown = (item, e) => {
            e.stopPropagation();
            item.classList.toggle('open');
        };

        const activateMobileMenu = () => {
            mobileNav.classList.toggle('open-mobile-menu');
            body.classList.toggle('block-scroll');

            const setBurgerIcon = (type) => {
                const burgerState = hamburger.querySelectorAll('i.icon--inner')[0];
                const icon = {
                    burger: ['icon--inner', 'fas', 'fa-solid', 'fa-bars'],
                    cross: ['icon--inner', 'fas', 'fa-solid', 'fa-times']
                };
                burgerState.className = '';
                burgerState.classList.add(...icon[type]);
            };

            if (mobileNav.classList.contains('open-mobile-menu')) {
                setBurgerIcon('cross');
            } else {
                setBurgerIcon('burger');
            }
        };

        window.addEventListener('resize', resizeMobileMenu);

        hamburger.addEventListener('click', activateMobileMenu);

        listItems.forEach((item) => {
            item.addEventListener('click', (e) => toggleDropdown(item, e));
        });
    },
    wooMyAccountMobileNav: (wooMyAccountMobileNav) => {
        const selectComp = wooMyAccountMobileNav.querySelectorAll('#account--options')[0];
        const options = [...selectComp.querySelectorAll('option')];
        const option = proto.resolveOptionSelected(options);
        option[0]?.setAttribute('selected', 'selected');
        selectComp.addEventListener('change', (e) => {
            const href = proto.getHref(options, e.target.value);
            proto.goToLocation(href);
        });
    },
    init () {
        const customerNav = document.querySelectorAll('.customer-nav--mobile')[0];
        const mobileNav = document.querySelectorAll('.main-nav.mobile')[0];
        const webNav = document.querySelectorAll('.main-nav.web')[0];
        const wooMyAccountMobileNav = document.querySelectorAll('.account-mobile-nav')[0];

        customerNav && proto.customerNav(customerNav);
        mobileNav && webNav && proto.mobileNav(mobileNav, webNav);
        wooMyAccountMobileNav && proto.wooMyAccountMobileNav(wooMyAccountMobileNav);
    }
};

export default Object.create(proto);
