<template>
    <div class="content">
        <router-view v-bind:authenticated="authenticated" v-bind:user="user"></router-view>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                authenticated: auth.check(),
                user: auth.user,
                userId: auth.userId,
            };
        },
        mounted() {
            Event.$on('userLoggedIn', () => {
                this.authenticated = true;
                this.user = auth.user;
                this.userId = auth.userId;
            });
            Event.$on('userLoggedOut', () => {
                this.authenticated = false;
                this.user = null;
            });
        },
        created() {
            axios.interceptors.request.use((config) => {
                this.$root.isLoading = true;
                return config;
            }, (error) => {
                setTimeout(() => this.$root.isLoading = false, 300);
                return Promise.reject(error);
            });

            axios.interceptors.response.use((response) => {
                setTimeout(() => this.$root.isLoading = false, 300);
                return response;
            }, (error) => {
                setTimeout(() => this.$root.isLoading = false, 300);
                return Promise.reject(error);
            });
        },
    }
</script>
