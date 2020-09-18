<template>
    <header class="header">
        <div class="header__flex-wrap">
            <div class="header__left-block">
                <a href="" class="header__link"><img src="/images/icons/search.svg" alt="Search"
                                                     class="header__icon"></a>
            </div>
            <div class="header__right-block">
                <keep-alive>
                    <div v-if="authenticated && user" class="login__wrap">
                        <a href="" class="header__link"><img src="/images/icons/notification.svg" alt="Notification"
                                                             class="header__icon"></a>
                        <a href="" class="header__link"><img
                            src="/images/icons/user-profile.svg"
                            alt="User Profile"
                            class="header__icon"></a>
                        <div v-on:click="logout()" class="header__icon"><img
                            src="/images/icons/logout.svg" alt="Logout" class="header__icon"/></div>
                    </div>
                    <div v-else class="login__wrap">
                        <router-link :to="{ name: 'login' }" class="login__link">Вход</router-link>
                        /
                        <router-link :to="{ name: 'register' }" class="login__link">Регистрация</router-link>
                    </div>
                </keep-alive>
            </div>
        </div>
        <div class="header__separator">
            <img src="/images/icons/separator.png" alt="" class="separator__img">
        </div>
        <h1 class="header__title"></h1>
    </header>
</template>

<script>
import App from './App'
    export default {
        name: "HeaderComponent",
        props: ['authenticated', 'user'],

        methods: {
            logout() {
                axios
                    .post('/api/logout')
                    .then(response => {
                        auth.logout();
                        this.$router.go();
                    })
                    .catch(error => {
                        console.log(error.message);
                    })
            }
        }
    }
</script>

<style scoped>

</style>
