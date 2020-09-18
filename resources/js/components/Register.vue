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
            <div class="register__form">
                <ul>
                    <li class="form__list-item">
                        <label class="name" for="name">Имя, Фамилия</label>
                        <input id="name" name="name" type="text" maxlength="255" value="" v-model="postData.name"/>
                    </li>
                    <li class="form__list-item">
                        <label class="name" for="email">Email</label>
                        <input id="email" name="email" type="email" maxlength="255" value="" v-model="postData.email"/>
                    </li>
                    <li class="form__list-item">
                        <label class="name" for="password">Пароль</label>
                        <input id="password" name="password" type="password" maxlength="255" value=""
                               v-model="postData.password"/>
                    </li>
                    <button v-on:click="register()" class="button">Регистрация</button>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Register",
        data() {
            return {
                postData: {
                    name: '',
                    email: '',
                    password: '',
                },
                error: null,
                message: null,
            };
        },

        created() {
        },

        methods: {
            register() {
                const registerAddress = '/api/register';
                axios
                    .post(registerAddress, this.postData)
                    .then(response => {
                        if (response.status === 200) {
                            this.$router.push({name: "login"});
                    }
                        this.error = true;
                        this.message = response.message;
                    })
                    .catch(error => {
                        this.error = true;
                        this.message = error.message;
                    })
            }
        }
    }
</script>

<style scoped>

</style>
