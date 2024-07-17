const proto = {
    loginOptions: {
        login: 'Klik hier om in te loggen',
        register: 'Nog geen account?'
    },
    toggleElement: (el, button) => {
        el.classList.contains('hidden') ? el.classList.remove('hidden') : el.classList.add('hidden');
        button.innerHTML === 'Nog geen account?' ? button.innerHTML = proto.loginOptions.login : button.innerHTML = proto.loginOptions.register;
    },
    handleLoginType: () => {
        const button = document.querySelectorAll('.register_account button')[0];
        const loginWrapper = document.getElementsByClassName('login-wrapper')[0];
        const registrationWrapper = document.getElementsByClassName('registration-wrapper')[0];
        if (button && loginWrapper && registrationWrapper) {
            button.addEventListener('click', () => {
                proto.toggleElement(registrationWrapper, button);
                proto.toggleElement(loginWrapper, button);
                button.innerHTML === proto.loginOptions.login ? button.innerHTML = proto.loginOptions.login : button.innerHTML = proto.loginOptions.register;
            });
        }
    },
    init () {
        proto.handleLoginType();
    }
};

export default Object.create(proto);
