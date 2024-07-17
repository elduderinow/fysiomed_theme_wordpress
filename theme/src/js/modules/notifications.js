const proto = {
    init () {
        const notification = document.querySelector('.woocommerce-notices-wrapper');
        if (notification) {
            notification.classList.add('remove');
        }
    }
};

export default Object.create(proto);
