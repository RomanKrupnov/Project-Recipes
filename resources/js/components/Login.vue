<template>
    <div>
        <div class="message_div">
            <div v-if="error" class="alert alert-danger alert-dismissible fade show" role="alert">
                <p> {{ message }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="form_wrapper">
            <div class="login__form">
                <ul>
                    <li class="form__list-item">
                        <label class="name" for="username">Email</label>
                        <input id="username" name="username" type="email" maxlength="255" value="" v-model="postData.username"/>
                    </li>
                    <li class="form__list-item">
                        <label class="name" for="password">Пароль</label>
                        <input id="password" name="password" type="password" maxlength="255" value=""
                               v-model="postData.password"/>
                    </li>
                    <button v-on:click="login()" class="button">Вход</button>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data() {
            return {
                postData: {
                    username: '',
                    password: '',
                },
                error: null,
                message: null,
            };
        },

        created() {
        },

        methods: {
            login() {
                const loginAddress = '/api/login';
                axios
                    .post(loginAddress, this.postData)
                    .then(({data})=> {
                        auth.login(data.access_token, this.postData.username);
                            window.location.href = '/';
                        })
                    .catch(error => {
                        this.error = true;
                        typeof(error.response.data.message) === 'undefined' ? this.message = error.message : this.message = error.response.data.message;
                    })
            }
        }
    }
</script>

<style scoped>

</style>
