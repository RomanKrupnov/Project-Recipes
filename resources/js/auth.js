/* Класс для сохранения токенов в локальное хранлиище HTML5 после аутентификации пользователя */
class Auth {
    constructor() {
        this.token = window.localStorage.getItem('token');
        let userData = window.localStorage.getItem('user');
        this.user = userData ? JSON.parse(userData) : null;


        if (this.token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token;
            this.getUser();
        }
    }

    login(token, user) {
        window.localStorage.setItem('token', token);
        window.localStorage.setItem('user', JSON.stringify(user));

        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;

        this.token = token;
        this.user = user;

        Event.$emit('userLoggedIn');
    }

    logout() {
        window.localStorage.removeItem('token');
        window.localStorage.removeItem('user');
        window.localStorage.removeItem('userId');

        delete axios.defaults.headers.common['Authorization'];

        Event.$emit('userLoggedOut');
    }

    getUser() {
        axios.get('/api/get-user')
            .then(({data}) => {
                this.user = data;
                this.userId = data.id;
            })
            .catch(({response}) => {
                if (response.status === 401) {
                    this.logout();
                }
            });
    }

    check() {
        return !! this.token;
    }
}

export default Auth;
